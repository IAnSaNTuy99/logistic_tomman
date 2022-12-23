<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';
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
		if ( $this->session->has_userdata('NIK') )
			return TRUE; 
		else
		  	redirect(base_url('logout'));    
	}

	public function index()
	{
		$data['judul']	='Selamat Datang di Logistic WH Gambut';
		$data['page']	='home';
        $data['jml_barang'] =$this->m_dashboard->jumlah_record_tabel('barang');
		$this->tampil($data);
		
	}

	public function barang()
    {
        $data['judul']='Stok Material WH Gambut';
        $data['page']='barang';
        $data['barang']=$this->m_dashboard->dt_barang();
        $this->tampil($data);
    }

    public function barang_edit($id = FALSE)
	{
		$data['judul'] = 'Edit Data Barang';
		$data['page'] = 'barang_edit';
        $this->form_validation->set_rules('ID_BARANG', 'Kode Material', 'required', array('required' => '%s harus diisi'));
        // $this->form_validation->set_rules(
        //     'nama_barang',
        //     'Nama Barang',
        //     'required|min_length[3]|max_length[45]',
        //     array('required' => '%s harus diisi.')
        // );
        $this->form_validation->set_rules('SATUAN', 'SATUAN', 'required', array('required' => '%s harus dipilih'));
        $this->form_validation->set_rules('JUMLAH', 'JUMLAH', 'required', array('required' => '%s harus dipilih'));
        $data['d'] = $this->m_dashboard->cari_data('barang', 'ID_BARANG', $id);

        if ($this->form_validation->run() === FALSE) {
            $this->tampil($data);
        } else {
            $this->m_dashboard->dt_barang_edit($id);
            redirect(base_url('dashboard/barang'));
        }
        
	}


    //==================Staff================================//

    public function staff_gudang()
    {
        $data['judul']='Staff WH Gambut';
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

//====================================BARANG KELUAR==============================//
	public function barang_keluar()
    {
        $data['judul']='Barang keluar';
        $data['page']='barang_keluar';
        $data['barang_keluar']=$this->m_dashboard->dt_barang_keluar();
        $this->tampil($data);
    }

     public function bk_tambah()
    {
        $data['judul'] = 'Form Input Data Material Keluar';
        $data['page'] = 'bk_tambah';
         $this->form_validation->set_rules('ID_BARANG', 'Pilih ID Barang', 'callback_dd_cek');
        // $this->form_validation->set_rules(
        //     'nama_barang',
        //     'Nama Barang',
        //     'required|min_length[3]|max_length[45]',
        //     array('required' => '%s harus diisi.')
        // );
        $this->form_validation->set_rules('JUMLAH', 'JUMLAH', 'required', array('required' => '%s harus diisi'));
        
       

        $data['ddbarang'] = $this->m_dashboard->dropdown_barang();

        if ($this->form_validation->run() === FALSE) {
            $this->tampil($data);
        } else {
            $this->m_dashboard->dt_barang_keluar_tambah();
            redirect(base_url('dashboard/barang_keluar'));
        }
        
    }
   public function bk_edit($id=false)
    {
        $data['judul'] = 'Edit Data Barang';
        $data['page'] = 'bk_edit';
         $this->form_validation->set_rules('ID_BARANG', 'Pilih ID Barang', 'callback_dd_cek');
        $this->form_validation->set_rules('JUMLAH', 'JUMLAH', 'required', array('required' => '%s harus diisi'));
         $data['d'] = $this->m_dashboard->cari_data('barang_keluar', 'ID_BARANG_KELUAR', $id);


        $data['ddbarang'] = $this->m_dashboard->dropdown_barang();

        if ($this->form_validation->run() === FALSE) {
            $this->tampil($data);
        } else {
            $this->m_dashboard->dt_bk_edit($id);
            redirect(base_url('dashboard/barang_keluar'));
        }
        
    }


    public function bk_hapus($id)
	{
		$this->m_dashboard->hapus_data('barang_keluar', 'ID_BARANG_KELUAR', $id);
		redirect(base_url('dashboard/barang_keluar'));
	}


	public function staff_hapus($id)
	{
		$this->m_dashboard->hapus_data('staff_gudang', 'id_staff', $id);
		redirect(base_url('dashboard/staff_gudang'));
	}

    

    public function barang_hapus($id)
    {
        $this->m_dashboard->hapus_data('barang','ID_BARANG',$id);
        redirect(base_url('dashboard/barang'));
    }

       public function uploaddata()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'xlsx|xls';
        $config['file_name'] = 'doc' . time();
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('importexcel')) {
            $file = $this->upload->data();
            $reader = ReaderEntityFactory::createXLSXReader();

            $reader->open('uploads/' . $file['file_name']);
            foreach ($reader->getSheetIterator() as $sheet) {
                $numRow = 0;
                foreach ($sheet->getRowIterator() as $row) {
                    if ($numRow > 0) {
                        $databarang = array(
                            'id_barang'  => $row->getCellAtIndex(0),
                            'nama_barang'  => $row->getCellAtIndex(1),
                            'jumlah'       => $row->getCellAtIndex(2),
                            'satuan'       => $row->getCellAtIndex(3),
                        );
                        $this->m_dashboard->import_data($databarang);
                    }
                    $numRow++;
                }
                $reader->close();
                unlink('uploads/' . $file['file_name']);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> Data berhasil diperbarui </div>');
                redirect('dashboard/barang');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> Data Gagal ditambahkan </div>');
                redirect('dashboard/barang');
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
		

}
