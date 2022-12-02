<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
		$this->load->view('dashboard/dashboard');
		// $data['judul']	='Selamat Datang di Logistic WH Gambut';
		// $data['page']	='home';
		// $this->tampil();//dalam tanda kurung jangan lupa dikasih $data
	}

	// function tampil()//dalam tanda kurung jangan lupa dikasih $data
	// {
	// 	$this->load->view('dashboard/dashboard');
		
	// }
}
