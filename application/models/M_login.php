<?php 
class M_login extends CI_Model{
	 
	 public function __construct()
    {
        $this->load->database();
    }

     function cek_login()    //Cek apakah user pass ada
    {
        $nik=$this->input->post('NIK');
        $password=$this->input->post('PASSWORD');
        $query=$this->db->get_where('user', array('NIK'=>$nik, 'PASSWORD'=>$password));
        return $query->row_array();
    }

}
 ?>