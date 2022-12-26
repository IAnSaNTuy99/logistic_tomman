<?php 
class M_cqmaterial extends CI_Model {
	function upload_data($data)
	{
		$this->db->insert('qcmaterial',$data);
	}
}