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