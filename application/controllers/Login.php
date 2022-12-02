<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$data['pesan']="";		
	    $this->form_validation->set_rules('PASSWORD', 'PASSWORD', 'required', array('required'=>'Password tidak boleh kosong'));
		if ($this->form_validation->run() == FALSE)
			$this->load->view("login",$data);
	    else
	    {
	    	if($data['dt']=$this->m_login->cek_login())
			{
				$data_user = array(
			        'NIK'  => $data['dt']['NIK']
			        // 'PASSWORD'  => $data['dt']['PASSWORD']
					);
				$this->session->set_userdata($data_user);
				redirect(base_url("dashboard"));
			}        	
			else
	    	{
	    		$data['pesan']='username password salah';
				$this->load->view("login",$data);			
	    	}
	    }	
	    	
	}

	
	function logout(){
        unset(
            $_SESSION['NIK'],
            $_SESSION['PASSWORD']
        );  
		$data['pesan']='Logout Sukses';
		$this->load->view("login",$data);			
	}
}
