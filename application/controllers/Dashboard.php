<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

date_default_timezone_set("Asia/Makassar");

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
class Dashboard extends CI_Controller {
	private $filename = "import_data";
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_dashboard');
		$this->login_kah();
	}

	public function login_kah()
	{
		if ( $this->session->has_userdata('USERNAME') )
			return TRUE; 
		else
		  	redirect(base_url('logout'));    
	}
	

	public function index()
	{
		$data['judul']	='Selamat Datang di Logistic WH Banjarmasin';
		$data['page']	='home';
        $data['jml_material'] =$this->m_dashboard->jumlah_record_tabel('material');
		$this->tampil($data);
		
	}

	public function material()
    {
        $data['judul']='Stok Material WH Banjermasin';
        $data['page']='material';
        $data['material']=$this->m_dashboard->dt_material();
        $data['date']=$this->m_dashboard->get_last_update();
        $this->tampil($data);
    }

    

    public function material_edit($id = FALSE)
	{
		$data['judul'] = 'Edit Data Material';
		$data['page'] = 'material_edit';
        $this->form_validation->set_rules('ID_MATERIAL', 'Kode Material', 'required', array('required' => '%s harus diisi'));
        // $this->form_validation->set_rules(
        //     'nama_material',
        //     'Nama material',
        //     'required|min_length[3]|max_length[45]',
        //     array('required' => '%s harus diisi.')
        // );
        $this->form_validation->set_rules('SATUAN', 'SATUAN', 'required', array('required' => '%s harus dipilih'));
        $this->form_validation->set_rules('JUMLAH', 'JUMLAH', 'required', array('required' => '%s harus dipilih'));
        $data['d'] = $this->m_dashboard->cari_data('material', 'ID_material', $id);

        if ($this->form_validation->run() === FALSE) {
            $this->tampil($data);
        } else {
            $this->m_dashboard->dt_material_edit($id);
            redirect(base_url('dashboard/material'));
        }
        
	}


    //==================Staff================================//

    public function staff_gudang()
    {
        $data['judul']='Staff WH Banjarmasin';
        $data['page']='staff_gudang';
        $data['staff_gudang']=$this->m_dashboard->dt_staff();
        $this->tampil($data);
      
    }

    public function staff_tambah()
	{
		$data['judul'] = 'Tambah Data Staff';
		$data['page'] = 'staff_tambah';

		$this->form_validation->set_rules(
			'nama_staff',
			'Nama Staff',
			'required|min_length[3]|max_length[45]',
			array('required' => '%s harus diisi.')
		);
		$this->form_validation->set_rules('jenkel', 'Gender', 'required', array('required' => '%s harus dipilih'));
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required', array('required' => '%s harus dipilih'));	
		if ($this->form_validation->run() === FALSE) {
			$this->tampil($data);
		} else {
			$this->m_dashboard->dt_staff_tambah();
			redirect(base_url('dashboard/staff_gudang'));
		}
	}
	public function staff_edit($id = FALSE)
	{
		$data['judul'] = 'Edit Data staff';
		$data['page'] = 'staff_edit';
		$this->form_validation->set_rules(
			'nama_staff',
			'Nama_Staff',
			'required|min_length[3]|max_length[45]',
			array('required' => '%s harus diisi.')
		);
		$this->form_validation->set_rules('jenkel', 'Gender', 'required', array('required' => '%s harus dipilih'));
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required', array('required' => '%s harus dipilih'));
		$data['d'] = $this->m_dashboard->cari_data('staff_gudang', 'id_staff', $id);

		if ($this->form_validation->run() === FALSE) {
			$this->tampil($data);
		} else {
			$this->m_dashboard->dt_staff_edit($id);
			redirect(base_url('dashboard/staff_gudang'));
		}
	}

//====================================material KELUAR==============================//
	public function material_keluar()
    {
        $data['judul']='Material Keluar';
        $data['page']='material_keluar';
        $data['material_keluar']=$this->m_dashboard->dt_material_keluar();
        $this->tampil($data);
    }

     public function bk_tambah($id=false)
    {
        $data['judul'] = 'Form Input Data Material Keluar';
        $data['page'] = 'bk_tambah';
        $input = $this->input->post('ID_MATERIAL', true);
        $stok = $this->m_dashboard->get('material', ['ID_MATERIAL' => $input])['JUMLAH'];
        $stok_valid = $stok + 1;
         $this->form_validation->set_rules('ID_MATERIAL', 'Pilih ID material', 'callback_dd_cek');
        // $this->form_validation->set_rules(
        //     'nama_material',
        //     'Nama material',
        //     'required|min_length[3]|max_length[45]',
        //     array('required' => '%s harus diisi.')
        // );
        $this->form_validation->set_rules('JUMLAH', 'JUMLAH', 'required|', array('required' => '%s harus diisi'));
        $this->form_validation->set_rules(
            'JUMLAH',
            'JUMLAH',
            "required|trim|numeric|greater_than[0]|less_than[{$stok_valid}]",
            [
                'less_than' => "Jumlah Keluar tidak boleh lebih dari {$stok}"
            ]
        );
        $data['d'] = $this->m_dashboard->cari_data('material_keluar', 'ID_material_KELUAR', $id);
       

        $data['ddmaterial'] = $this->m_dashboard->dropdown_material();

        if ($this->form_validation->run()  === FALSE ) {
            $this->tampil($data);
        } else {
            
            $this->m_dashboard->dt_material_keluar_tambah($id);
            redirect(base_url('dashboard/bk_tambah'));
        }
        
    }
   public function bk_edit($id=false)
    {
        $data['judul'] = 'Edit Data Material Keluar';
        $data['page'] = 'bk_edit';
         $this->form_validation->set_rules('ID_MATERIAL', 'Pilih ID material', 'callback_dd_cek');
        $this->form_validation->set_rules('JUMLAH', 'JUMLAH', 'required', array('required' => '%s harus diisi'));
         $data['d'] = $this->m_dashboard->cari_data('material_keluar', 'ID_material_KELUAR', $id);


        $data['ddmaterial'] = $this->m_dashboard->dropdown_material();

        if ($this->form_validation->run() === FALSE) {
            $this->tampil($data);
        } else {
            $this->m_dashboard->dt_bk_edit($id);
            redirect(base_url('dashboard/material_keluar'));
        }
        
    }


    public function bk_hapus($id)
	{
		$this->m_dashboard->hapus_data('material_keluar', 'ID_MATERIAL_KELUAR', $id);
		redirect(base_url('dashboard/material_keluar'));
	}

	//====================================material masuk==============================//
	public function material_masuk()
    {
        $data['judul']='Material Masuk';
        $data['page']='material_masuk';
        $data['material_masuk']=$this->m_dashboard->dt_material_masuk();
        $this->tampil($data);
    }

     public function bm_tambah($id=false)
    {
        $data['judul'] = 'Form Input Data Material Masuk';
        $data['page'] = 'bm_tambah';
        $input = $this->input->post('ID_MATERIAL', true);
        $stok = $this->m_dashboard->get('material', ['ID_MATERIAL' => $input])['JUMLAH'];
        $stok_valid = $stok + 1;
         $this->form_validation->set_rules('ID_MATERIAL', 'Pilih ID material', 'callback_dd_cek');
        // $this->form_validation->set_rules(
        //     'nama_material',
        //     'Nama material',
        //     'required|min_length[3]|max_length[45]',
        //     array('required' => '%s harus diisi.')
        // );
        $this->form_validation->set_rules('JUMLAH', 'JUMLAH', 'required|', array('required' => '%s harus diisi'));
        $this->form_validation->set_rules(
            'JUMLAH',
            'JUMLAH',
            "required|trim|numeric|greater_than[0]",
            [
                'less_than' => "Jumlah Keluar tidak boleh kurang dari 0"
            ]
        );
        $data['d'] = $this->m_dashboard->cari_data('material_masuk', 'ID_MATERIAL_MASUK', $id);
       

        $data['ddmaterial'] = $this->m_dashboard->dropdown_material();

        if ($this->form_validation->run()  === FALSE ) {
            $this->tampil($data);
        } else {
            $this->m_dashboard->dt_material_masuk_tambah($id);
            redirect(base_url('dashboard/bm_tambah'));
        }
        
    }

   public function bm_edit($id=false)
    {
        $data['judul'] = 'Edit Data material';
        $data['page'] = 'bm_edit';
         $this->form_validation->set_rules('ID_MATERIAL', 'Pilih ID material', 'callback_dd_cek');
        $this->form_validation->set_rules('JUMLAH', 'JUMLAH', 'required', array('required' => '%s harus diisi'));
         $data['d'] = $this->m_dashboard->cari_data('material_masuk', 'ID_MATERIAL_MASUK', $id);


        $data['ddmaterial'] = $this->m_dashboard->dropdown_material();

        if ($this->form_validation->run() === FALSE) {
            $this->tampil($data);
        } else {
            $this->m_dashboard->dt_bm_edit($id);
            redirect(base_url('dashboard/material_masuk'));
        }
        
    }


    public function bm_hapus($id)
	{
		$this->m_dashboard->hapus_data('material_masuk', 'ID_MATERIAL_MASUK', $id);
		redirect(base_url('dashboard/material_masuk'));
	}

	//////////////////////////////////////////


	public function staff_hapus($id)
	{
		$this->m_dashboard->hapus_data('staff_gudang', 'id_staff', $id);
		redirect(base_url('dashboard/staff_gudang'));
	}

    

    public function material_hapus($id)
    {
        $this->m_dashboard->hapus_data('material','ID_MATERIAL',$id);
        redirect(base_url('dashboard/material'));
    }

       public function uploaddata()
    {
        
        $uploadPath='uploads/documents/';

		if(!is_dir($uploadPath))
		{
			mkdir($uploadPath,0777,TRUE);
		}

        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = 'xlsx|xls';
        $config['file_name'] = 'doc' . time();
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('importexcel')) {

            $file = $this->upload->data();
            $numRow=0;
            $reader = ReaderEntityFactory::createXLSXReader();
            $reader->open($uploadPath . $file['file_name']);
            foreach ($reader->getSheetIterator() as $sheet) {

                // $this->db->empty_table('material');
                foreach ($sheet->getRowIterator() as $row) {
            	$rowIsEmpty = true;
				    // Iterate through each cell in the row
				    // foreach ($row->getCells() as $cell) {
				    //   // Check if the cell has a value
				    //   if ($cell->getValue() !== null) {
				    //     // The row is not empty
				    //     $rowIsEmpty = false;
				    //     break;
				    //   }
				    // }
				    // Check if the row is empty
				    if ($rowIsEmpty and $numRow>0 and $rowIsEmpty =false) {
				      // Set an error message and return
				      $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> Data Excel Kosong </div>');
                redirect('dashboard/material');
				    } else {
				    	$this->db->empty_table('material');
				    }
		  }
		}
  //             if ($row->isEmpty() and empty($numRow) || empty($numRow)) {
  //        				// A row after the first row is empty, do not allow upload
	 //         		 $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">
  // <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> Data Excel Kosong </div>');
  //               redirect('dashboard/material');
	 //      			} 

	      				// $this->db->empty_table('material');
	      				
            foreach ($reader->getSheetIterator() as $sheet) {

                // $this->db->empty_table('material');
                foreach ($sheet->getRowIterator() as $row) {

 
	                    if ($numRow >0 ) {
                        $datamaterial = array(
                            'id_material'    => $row->getCellAtIndex(0),
                            'nama_material'  => $row->getCellAtIndex(1),
                            'jumlah'       => $row->getCellAtIndex(2),
                            'satuan'       => $row->getCellAtIndex(3),
                            'updated' 	   => date('Y-m-d H:i:s')
                        );
                        $this->m_dashboard->import_data($datamaterial);

                    }   
                    $numRow++;
                }
                $reader->close();
                unlink($uploadPath . $file['file_name']);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> Data berhasil diperbarui </div>');
                redirect('dashboard/material');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> Data Gagal ditambahkan </div>');
                redirect('dashboard/material');
        };
    }

//============ Tools ===============
function dd_cek($str)    //Untuk Validasi DropDown jika tidak dipilih
{
	if ($str == '-Pilih-') {
	  $this->form_validation->set_message('dd_cek', 'Harus dipilih');
	  return FALSE;
	} else
	  return TRUE;
}

function tampil($data)
	{
		$this->load->view('dashboard/header',$data);
		$this->load->view('dashboard/isi');
		$this->load->view('dashboard/footer');
	}
		
    //============================= Quality Check Material ================
    public function qcm()
    {
        $data['judul']='QC Material WH Banjarmasin';
        $data['page']='qcm';
        $data['qcm']=$this->m_dashboard->dt_qcm();
        $this->tampil($data);
    }

    public function qcm_upload()
    {
        $data['judul'] = 'Form Input Data QC Material';
        $data['page'] = 'qcm_upload';

        // set validation rules
        $this->form_validation->set_rules('id_material', 'Nama material', 'required');
        // $this->form_validation->set_rules('dokumen', 'Upload PDF', 'callback_file_check');
        // $this->form_validation->set_rules('evidence', 'Upload Evidence', 'callback_file_check');
        $this->form_validation->set_rules('status_qcm', 'Status QC', 'required');
        $this->form_validation->set_rules('tgl_qcm', 'Tanggal QCM', 'required');
        $this->form_validation->set_rules('tgl_upload', 'Tanggal Upload', 'required');

        $data['ddmaterial'] = $this->m_dashboard->dropdown_material();
        $this->load->library('upload');

            $uploadPath1='uploads/pdf/';
            if(!is_dir($uploadPath1))
            {
                mkdir($uploadPath1,0777,TRUE);
            }
                // Set configuration for first file input field
            $config1['upload_path']          = $uploadPath1;
            $config1['allowed_types']        = 'pdf';
            $config1['encrypt_name']         = TRUE;
            $this->upload->initialize($config1);

            // Attempt to upload first file
            if ($this->upload->do_upload('dokumen'))
            {
                $uploadedpdf = $this->upload->data();
                $pdf = $uploadedpdf['file_name'];
            }
            else
            {
                // File upload failed, set $pdf to null
                $pdf = null;
            }

            $this->upload->initialize(array());


            $uploadPath2='uploads/images/';
            if(!is_dir($uploadPath2))
            {
                mkdir($uploadPath2,0777,TRUE);
            }
                // Set configuration for second file input field
            $config2['upload_path']          = $uploadPath2;
            $config2['allowed_types']        = 'jpeg|jpg|png';
            $config2['encrypt_name']         = TRUE;
            $this->upload->initialize($config2);

            // Attempt to upload second file
            if ($this->upload->do_upload('evidence'))
            {
                $uploadedimg = $this->upload->data();
                $img = $uploadedimg['file_name'];
            }
            else
            {
                // File upload failed, set $img to null
                $img = null;
            }

        if ($this->form_validation->run() === FALSE){
            $this->tampil($data);
        }else{

                $this->m_dashboard->dt_qcm_tambah3($pdf,$img);
                redirect(base_url('dashboard/qcm'));
        }
    }



	function uploadimg()
	{
		$uploadPath='uploads/images/';
		if(!is_dir($uploadPath))
		{
			mkdir($uploadPath,0777,TRUE);
		}

		$config['upload_path'] = $uploadPath;
		$config['allowed_types']= 'jpeg|JPEG|JPG|jpg|png|PNG';
        $config['max_size'] = 100;
		$config['encrypt_name']=TRUE;

		$this->load->library('upload',$config);
	}

    function uploadpdf()
    {
        $uploadPath='uploads/docs/';
		if(!is_dir($uploadPath))
		{
			mkdir($uploadPath,0777,TRUE);
		}

		$config['upload_path'] = $uploadPath;
		$config['allowed_types']= 'pdf';
        $config['max_size'] = 100;
		$config['encrypt_name']=TRUE;

		$this->load->library('upload',$config);
		$this->uploadpdf->initialize($config);
    }

}
