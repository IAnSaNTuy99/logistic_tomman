<?php 
class M_dashboard extends CI_Model{
	public function __construct()
    {
        $this->load->database();
        return $this->db->get('barang')->result();
    }

    public function dt_barang()
    {
        $this->db->select('ID_BARANG, NAMA_BARANG, JUMLAH, SATUAN');
        $this->db->from('barang');
        $query = $this->db->get();
        return $query->result_array();        
    }

    public function dt_barang_edit($id)
    {
      $data = array(
        'ID_BARANG' => $this->input->post('ID_BARANG'),
        'NAMA_BARANG' => $this->input->post('NAMA_BARANG'),
        'JUMLAH' => $this->input->post('JUMLAH'),
        'SATUAN' => $this->input->post('SATUAN')
      );
      $this->db->where('ID_BARANG', $id);
      return $this->db->update('barang', $data);
     
  }

  public function dropdown_barang()
    {
        $query = $this->db->get('barang');
        $result = $query->result();

        $ID_BARANG = array('-Pilih-');
        $NAMA_BARANG = array('-Pilih-');

        for ($i = 0; $i < count($result); $i++) {
            array_push($ID_BARANG, $result[$i]->ID_BARANG);
            array_push($NAMA_BARANG, $result[$i]->NAMA_BARANG);
        }
        return array_combine($ID_BARANG, $NAMA_BARANG);
    }

//============================STAFF===========================//
    public function dt_staff()
    {
        $this->db->select('id_staff, nama_staff, jenkel, tgl_lahir');
        $this->db->from('staff_gudang');
        $query = $this->db->get();
        return $query->result_array();        
    }

    public function dt_staff_tambah()
    {
        $data = array(
            'nama_staff' => $this->input->post('nama_staff'),
            'jenkel' => $this->input->post('jenkel'),
            'tgl_lahir' => $this->input->post('tgl_lahir')
        );
        return $this->db->insert('staff_gudang', $data);
    }

    public function dt_staff_edit($id)
    {
        $data = array(
          'nama_staff' => $this->input->post('nama_staff'),
          'jenkel' => $this->input->post('jenkel'),
          'tgl_lahir' => $this->input->post('tgl_lahir')
        );
        $this->db->where('id_staff', $id);
        return $this->db->update('staff_gudang', $data);
    }

//========================Barang Keluar=========================///
    public function dt_barang_keluar()
    {
       $this->db->select('bk.ID_BARANG_KELUAR, b.ID_BARANG, b.NAMA_BARANG, bk.JUMLAH, b.SATUAN, bk.TANGGAL');
         $this->db->from('barang_keluar bk');
           $this->db->join('barang b', 'bk.ID_BARANG = b.ID_BARANG','left');
         $query = $this->db->get();
       return $query->result_array();    
       
    }

     public function dt_barang_keluar_tambah()
    {
        $data = array(
            'ID_BARANG' => $this->input->post('ID_BARANG'),
            'JUMLAH' => $this->input->post('JUMLAH')
        );
        $this->db->set('TANGGAL','NOW()', FALSE);
        return $this->db->insert('barang_keluar', $data);
    }

      public function dt_bk_edit($id)
    {
        $data = array(
            'ID_BARANG' => $this->input->post('ID_BARANG'),
            'JUMLAH' => $this->input->post('JUMLAH')
        );
        $this->db->where('ID_BARANG_KELUAR', $id);
        return $this->db->update('barang_keluar', $data);
    }


     public function jumlah_record_tabel($tabel)    
    {
        $query = $this->db->select("COUNT(*) as num")->get($tabel);
        $result = $query->row();
        if (isset($result))
            return $result->num;
        return 0;
    }
  
  
    public function cari_data($tabel, $namafield, $isifield)
{
            $this->db->select('*');
            $this->db->from($tabel);
            $this->db->where($namafield,$isifield);
            $query = $this->db->get();
            return $query->row_array();           
    }

    // Fungsi untuk melakukan proses upload file
      public function upload_file($filename){
        $this->load->library('upload'); // Load librari upload
        
        $config['upload_path'] = './excel/';
        $config['allowed_types'] = 'xlsx';
        $config['max_size']  = '10240';
        $config['overwrite'] = true;
        $config['file_name'] = $filename;
      
        $this->upload->initialize($config); // Load konfigurasi uploadnya
        if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
          // Jika berhasil :
          $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
          return $return;
        }else{
          // Jika gagal :
          $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
          return $return;
        }
      }

      public function import_data($databarang)
    {
        $jumlah = count($databarang);
        if ($jumlah > 0) {
            $this->db->replace('barang', $databarang);
        }
    }

    function dd_cek($str)    //Untuk Validasi DropDown jika tidak dipilih
    {
        if ($str == '-Pilih-') {
          $this->form_validation->set_message('dd_cek', 'Harus dipilih');
          return FALSE;
        } else
          return TRUE;
    }
      
      // Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
      public function insert_multiple($data){
        $this->db->insert_batch('barang', $data);
      }

      function hapus_data($tabel, $kolom, $id)  
    {
        $this->db->delete($tabel, array($kolom => $id));
        if (!$this->db->affected_rows())
            return (FALSE);
        else
            return (TRUE);
    }
    
}
 
 ?>