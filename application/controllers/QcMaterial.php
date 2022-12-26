<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qcmaterial extends CI_Controller {

	
	public function index()
	{
		$this->load->view('home');
	}

	function upload()
	{

		$countFiles = count($_FILES['uploadedFiles']['name']);
		$countUploadedFiles=0;
		$countErrorUploadFiles=0;
		for($i=0;$i<$countFiles;$i++)
		{
			$_FILES['uploadFile']['name'] = $_FILES['uploadedFiles']['name'][$i]; 
			$_FILES['uploadFile']['type'] = $_FILES['uploadedFiles']['type'][$i];
			$_FILES['uploadFile']['size'] = $_FILES['uploadedFiles']['size'][$i];
			$_FILES['uploadFile']['tmp_name'] = $_FILES['uploadedFiles']['tmp_name'][$i];
			$_FILES['uploadFile']['error'] = $_FILES['uploadedFiles']['error'][$i];

			$uploadStatus = $this->uploadFile('uploadFile');
			if($uploadStatus!=false)
			{
				$countUploadedFiles++;
				$this->load->model('upload_file');
				$data =array(
					'img_path'=>$uploadStatus,
					'upload_time'=>date('Y-m-d H:i:s'),
				);
				$this->upload_file->upload_data($data);
			}
			else
			{
				$countErrorUploadFiles++;
			}

		}

		$this->session->set_flashdata('messgae','Files Uploaded. Successfull Files Uploaded:'.$countUploadedFiles. ' and Error Uploading Files:'.$countErrorUploadFiles);
		redirect(base_url('welcome/index'));

	}

	function uploadFile($name)
	{
		$uploadPath='uploads/images/';
		if(!is_dir($uploadPath))
		{
			mkdir($uploadPath,0777,TRUE);
		}

		$config['upload_path'] = $uploadPath;
		$config['allowed_types']= 'jpeg|JPEG|JPG|jpg|png|PNG';
		$config['encrypt_name']=TRUE;

		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		if($this->upload->do_upload($name))
		{
			$fileData = $this->upload->data();
			return $fileData['file_name'];
		}
		else
		{
			return false;
		}
	}
}
