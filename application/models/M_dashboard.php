<?php 
class M_dashboard extends CI_Model{
	public function __construct()
    {
        $this->load->database();
        return $this->db->get('material')->result();
    }



    public function dt_MATERIAL()
    {
        $this->db->select('ID_MATERIAL, NAMA_MATERIAL, JUMLAH, SATUAN');
        $this->db->from('material');
        $query = $this->db->get();
        return $query->result_array();        
    }

    public function get_last_update()
    {
       $this->db->select('updated');
        $this->db->from('material');
        $query = $this->db->get();
        return $query->row_array();
    }


    public function dt_MATERIAL_edit($id)
    {
      $data = array(
        'ID_MATERIAL' => $this->input->post('ID_MATERIAL'),
        'NAMA_MATERIAL' => $this->input->post('NAMA_MATERIAL'),
        'JUMLAH' => $this->input->post('JUMLAH'),
        'SATUAN' => $this->input->post('SATUAN')
      );
      $this->db->where('ID_MATERIAL', $id);
      return $this->db->update('material', $data);
     
  }

  public function dropdown_MATERIAL()
    {
        $query = $this->db->get('material');
        $result = $query->result();

        $ID_MATERIAL = array('-Pilih-');
        $NAMA_MATERIAL = array('-Pilih-');

        for ($i = 0; $i < count($result); $i++) {
            array_push($ID_MATERIAL, $result[$i]->ID_MATERIAL);
            array_push($NAMA_MATERIAL, $result[$i]->NAMA_MATERIAL);
        }
        return array_combine($ID_MATERIAL, $NAMA_MATERIAL);
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

//========================MATERIAL Keluar=========================///
    public function dt_material_keluar()
    {
       $this->db->select('bk.ID_MATERIAL_KELUAR, b.ID_MATERIAL, b.NAMA_MATERIAL, bk.JUMLAH, b.SATUAN, bk.TANGGAL, bk.WAKTU');
         $this->db->from('material_keluar bk');
           $this->db->join('material b', 'bk.ID_MATERIAL = b.ID_MATERIAL','left');
         $query = $this->db->get();
       return $query->result_array();    
       
    }

     public function dt_material_keluar_tambah($id)
    {
        $data = array(
            'ID_MATERIAL' => $this->input->post('ID_MATERIAL'),
            'JUMLAH' => $this->input->post('JUMLAH')
        );
        $this->db->set('TANGGAL','NOW()', FALSE);
        $this->db->set('WAKTU','NOW()', FALSE);
        $this->db->where('ID_MATERIAL_KELUAR', $id);
        return $this->db->insert('material_keluar', $data);
    }

      public function dt_bk_edit($id)
    {
        $data = array(
            'ID_MATERIAL' => $this->input->post('ID_MATERIAL'),
            'JUMLAH' => $this->input->post('JUMLAH')
        );
        $this->db->where('ID_MATERIAL_KELUAR', $id);
        return $this->db->update('material_keluar', $data);
    }

    //========================MATERIAL Keluar=========================///
    public function dt_material_masuk()
    {
       $this->db->select('bm.ID_MATERIAL_MASUK, b.ID_MATERIAL, b.NAMA_MATERIAL, bm.JUMLAH, b.SATUAN, bm.TANGGAL, bm.WAKTU');
         $this->db->from('material_masuk bm');
           $this->db->join('material b', 'bm.ID_MATERIAL = b.ID_MATERIAL','left');
         $query = $this->db->get();
       return $query->result_array();    
       
    }

     public function dt_material_masuk_tambah($id)
    {
        $data = array(
            'ID_MATERIAL' => $this->input->post('ID_MATERIAL'),
            'JUMLAH' => $this->input->post('JUMLAH')
        );
        $this->db->set('TANGGAL','NOW()', FALSE);
        $this->db->set('WAKTU','NOW()', FALSE);
        $this->db->where('ID_MATERIAL_MASUK', $id);
        return $this->db->insert('material_masuk', $data);
    }

    public function dt_material_baru_tambah()
    {
        $data = array(
        'ID_MATERIAL' => $this->input->post('ID_MATERIAL'),
        'NAMA_MATERIAL' => $this->input->post('NAMA_MATERIAL'),
        'JUMLAH' => $this->input->post('JUMLAH'),
        'SATUAN' => $this->input->post('SATUAN')
        );
        $this->db->set('UPDATED','NOW()', FALSE);
        // $this->db->set('WAKTU','NOW()', FALSE);
        return $this->db->insert('material', $data);
    }

      public function dt_bm_edit($id)
    {
        $data = array(
            'ID_MATERIAL' => $this->input->post('ID_MATERIAL'),
            'JUMLAH' => $this->input->post('JUMLAH')
        );
        $this->db->where('ID_MATERIAL_MASUK', $id);
        return $this->db->update('material_masuk', $data);
    }


  



    // =========================== Upload QCM ========================

    public function dt_qcm()
    {
        $this->db->select('id_qcm, id_material, dokumen, evidence,status_qcm, tgl_qcm, tgl_upload ');
        $this->db->from('qcmaterial');
        $query = $this->db->get();
        return $query->result_array();        
    }

    function dt_qcm_tambah()
    {
        echo "dt_qcm_tambah function called";
        $data = array();

    if (isset($_FILES['filepdf']) && !empty($_FILES['filepdf']['name'])) {
        $this->load->library('upload', $this->getPDFConfig());

        if ( ! $this->upload->do_upload('filepdf')) {
            $error = array('error' => $this->upload->display_errors());
            return $error;
        } else {
            $uploadedpdf = $this->upload->data();
            $data['dokumen'] = $uploadedpdf['file_name'];
        }
    }

    if (isset($_FILES['fileimg']) && !empty($_FILES['fileimg']['name'])) {
        $this->load->library('upload', $this->getImgConfig());

        if ( ! $this->upload->do_upload('fileimg')) {
            $error = array('error' => $this->upload->display_errors());
            return $error;
        } else {
            $uploadedimg = $this->upload->data();
            $data['evidence'] = $uploadedimg['file_name'];
        }
    }

    if (!empty($data)) {
        $data['id_material'] = $this->input->post('id_material');
        $data['status_qcm'] = $this->input->post('status_qcm');
        $data['tgl_qcm'] = $this->input->post('tgl_qcm');
        $data['tgl_upload'] = $this->input->post('tgl_upload');
        return $this->db->insert('qcmaterial', $data);
    }

    return false;
    }

    function dt_qcm_tambah2()
    {
        if ( !$this->upload->do_upload('dokumen')){
            redirect(base_url('dashboard/qcm_tambah'));
        }else {
            $uploadedpdf = $this->upload->data();
            $pdf=$uploadedpdf['file_name'];
        }if ( !$this->upload->do_upload('evidance')){
            redirect(base_url('dashboard/qcm_tambah'));
        }else{
            $uploadedimg = $this->upload->data();
            $img= $uploadedimg['file_name'];
        }
        $data = array(
            'id_material' => $this->input->post('id_material'),
            'dokumen' => $pdf,
            'evidence' => $img,
            'status_qcm' => $this->input->post('status_qcm'),
            'tgl_qcm' => $this->input->post('tgl_qcm'),
            'tgl_upload' => $this->input->post('tgl_upload'),
        );    
        return $this->db->insert('qcmaterial', $data);

    }

    public function dt_qcm_tambah3()
    {
        $data = array(
            'id_material' => $this->input->post('id_material'),
            'dokumen' => $pdf,
            'evidence' => $img,
            'status_qcm' => $this->input->post('status_qcm'),
            'tgl_qcm' => $this->input->post('tgl_qcm'),
            'tgl_upload' => $this->input->post('tgl_upload'),
        );    
        return $this->db->insert('qcmaterial', $data);

    }

    private function getPDFConfig() {
        $config = array();
        $config['upload_path'] = 'uploads/pdf/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 100;
        $config['encrypt_name'] = TRUE;
        return $config;
    }
    
    private function getImgConfig() {
        $config = array();
        $config['upload_path'] = 'uploads/images/';
        $config['allowed_types'] = 'jpeg|JPEG|JPG|jpg|png|PNG';
        $config['max_size'] = 100;
        $config['encrypt_name'] = TRUE;
        return $config;
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
        $this->db->insert_batch('material', $data);
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

    
      public function import_data($datamaterial)
    {

        $jumlah = count($datamaterial);
        if ($jumlah > 0 ) {

            $this->db->replace('material', $datamaterial);

        }else{
            echo "File Kosong";
        }
    }


}
 ?>