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

     public function dt_barang_keluar_tambah($id)
    {
        $data = array(
            'ID_BARANG' => $this->input->post('ID_BARANG'),
            'JUMLAH' => $this->input->post('JUMLAH')
        );
        $this->db->set('TANGGAL','NOW()', FALSE);
        $this->db->where('ID_BARANG_KELUAR', $id);
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


  

    // Fungsi untuk melakukan proses upload file
      // public function upload_file($filename){
      //   $this->load->library('upload'); // Load librari upload
        
      //   $config['upload_path'] = './excel/';
      //   $config['allowed_types'] = 'xlsx';
      //   $config['max_size']  = '10240';
      //   $config['overwrite'] = true;
      //   $config['file_name'] = $filename;
      
      //   $this->upload->initialize($config); // Load konfigurasi uploadnya
      //   if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
      //     // Jika berhasil :
      //     $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
      //     return $return;
      //   }else{
      //     // Jika gagal :
      //     $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
      //     return $return;
      //   }
      // }


    // =========================== Upload QCM ========================

    public function dt_qcm()
    {
        $this->db->select('id_qcm,nama_barang, dokumen, evidence,status_qcm, tgl_qcm, tgl_upload ');
        $this->db->from('qcmaterial');
        $query = $this->db->get();
        return $query->result_array();        
    }

    function dt_qcm_tambah()
    {
        if ( !$this->upload->do_upload('filepdf')){
            $error = array('error' => $this->upload->display_errors());
            return $error;
        }else if ( !$this->upload->do_upload('fileimg')){
            $error = array('error' => $this->upload->display_errors());
            return $error;
        }else{
            $uploadedpdf = $this->upload->data();
            $pdf['filepdf']=$uploadedpdf['file_name'];
            $uploadedimg = $this->upload->data();
            $img['fileimg']= $uploadedimg['file_name'];
            
            $data = array(
                'nama_barang' => $this->input->post('nama_barang'),
                'dokumen' => $pdf,
                'evidence' => $img,
                'status_qcm' => $this->input->post('status_qcm'),
                'tgl_qcm' => $this->input->post('tgl_qcm'),
                'tgl_upload' => $this->input->post('tgl_upload'),
            );    
            return $this->db->insert('qcmaterial', $data);
        }

    }

//================================TOOLS======================//
    
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

     public function get($table, $data = null, $where = null)
    {
        if ($data != null) {
            return $this->db->get_where($table, $data)->row_array();
        } else {
            return $this->db->get_where($table, $where)->result_array();
        }
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

    
      public function import_data($databarang)
    {
        $jumlah = count($databarang);
        if ($jumlah > 0) {
            $this->db->replace('barang', $databarang);
        }
    }


}
 ?>