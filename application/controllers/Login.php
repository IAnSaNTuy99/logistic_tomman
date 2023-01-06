<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$data['pesan']="";
		$this->form_validation->set_rules('USERNAME', 'USERNAME', 'required', array('required'=>'Username tidak boleh kosong!'));	
	    $this->form_validation->set_rules('PASSWORD', 'PASSWORD', 'required', array('required'=>'Password tidak boleh kosong!'));
		if ($this->form_validation->run() == FALSE)
			$this->load->view("login",$data);
	    else
	    {
	    	if($data['dt']=$this->m_login->cek_login())
			{
				$data_user = array(
			        'USERNAME'  => $data['dt']['USERNAME']
			        // 'PASSWORD'  => $data['dt']['PASSWORD']
					);
				$this->session->set_userdata($data_user,TRUE);
				redirect(base_url("dashboard"));
			}        	
			else
	    	{
	    		$this->session->set_flashdata('message', 'Username or password is incorrect');
	    		// $data['pesan']='username password salah';
				$this->load->view("login",$data);			
	    	}
	    	
	    }	
	    	
	}

	
	function logout(){
        unset(
            $_SESSION['USERNAME'],
            $_SESSION['PASSWORD']
        );  
		$data['pesan']='Logout Sukses';
		$this->load->view("login",$data);			
	}
}
