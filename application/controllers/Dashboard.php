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
		$this->tampil($data);
		// $this->tampil();//dalam tanda kurung jangan lupa dikasih $data
	}

	public function barang()
    {
        $data['judul']='Stok Material WH Gambut';
        $data['page']='barang';
        $data['barang']=$this->m_dashboard->dt_barang();
        $this->tampil($data);
    }

  //   public function barang_import(){
  //   $data = array(); // Buat variabel $data sebagai array
    
  //   if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
  //     // lakukan upload file dengan memanggil function upload yang ada di SiswaModel.php
  //     $upload = $this->m_dashboard->upload_file($this->filename);
      
  //     if($upload['result'] == "success"){ // Jika proses upload sukses
  //       // Load plugin PHPExcel nya
  //       include APPPATH.'third_party/PHPExcel/PHPExcel.php';
        
  //       $excelreader = new PHPExcel_Reader_Excel2007();
  //       $loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
  //       $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
        
  //       // Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
  //       // Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
  //       $data['sheet'] = $sheet; 
  //     }else{ // Jika proses upload gagal
  //       $data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
  //     }
  //   }
    
  //   $this->load->view('dashboard/barang', $data);
  // }
  
  // public function import(){
  //   // Load plugin PHPExcel nya
  //   include APPPATH.'third_party/PHPExcel/PHPExcel.php';
    
  //   $excelreader = new PHPExcel_Reader_Excel2007();
  //   $loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
  //   $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
    
  //   // Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
  //   $data = array();
    
  //   $numrow = 1;
  //   foreach($sheet as $row){
  //     // Cek $numrow apakah lebih dari 1
  //     // Artinya karena baris pertama adalah nama-nama kolom
  //     // Jadi dilewat saja, tidak usah diimport
  //     if($numrow > 1){
  //       // Kita push (add) array data ke variabel data
  //       array_push($data, array(
  //         'ID_BARANG'=>$row['A'], // Insert data nis dari kolom A di excel
  //         'NAMA_BARANG'=>$row['B'], // Insert data nama dari kolom B di excel
  //         'JUMLAH'=>$row['C'], // Insert data jenis kelamin dari kolom C di excel
  //         // Insert data alamat dari kolom D di excel
  //       ));
  //     }
      
  //     $numrow++; // Tambah 1 setiap kali looping
  //   }
  //   // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
  //   $this->m_dashboard->insert_multiple($data);
    
  //   redirect("dashboard/barang"); // Redirect ke halaman awal (ke controller siswa fungsi index)
  // }
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
                           
                        );
                        $this->m_dashboard->import_data($databarang);
                    }
                    $numRow++;
                }
                $reader->close();
                unlink('uploads/' . $file['file_name']);
                $this->session->set_flashdata('pesan', 'import Data Berhasil');
                redirect('dashboard/barang');
            }
        } else {
            echo "Error :" . $this->upload->display_errors();
        };
    }


	function tampil($data)
	{
		$this->load->view('dashboard/header',$data);
		$this->load->view('dashboard/isi');
		$this->load->view('dashboard/footer');
	}
		

}
