<?php
class Upload extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url'));
	}

	function index(){
		$this->load->view('upload_form', array('error' => ''));
	}

	function do_upload(){
		$this->load->library('upload');
		if(!$this->upload->do_upload()){
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('upload_form',$error);
		}else{
			$data = array('upload_data' => $this->upload->data());
			$this->load->view('upload_success', $data);
		}
	}

	function img(){
		$config['image_library'] = 'gd2';
		$config['source_image'] = './saecache/test.png';
		$config['create_thumb'] = TRUE;
		$config['new_image'] = '';
		$config['dynamic_output'] = false;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 75;
		$config['height'] = 50;
		$config['x_axis'] = '100';
		$config['y_axis'] = '40';
		$config['rotation_angle'] = '90';
		$config['stor_domain'] = 'test';
		$config['wm_text'] = 'Copyright 2006 - John Doe';
		$config['wm_type'] = 'text';
		$config['wm_font_path'] = './system/fonts/texb.ttf';
		$config['wm_font_size'] = '26';
		$config['wm_font_color'] = 'ff0000';
		$config['wm_vrt_alignment'] = 'bottom';
		$config['wm_hor_alignment'] = 'center';
		$config['wm_padding'] = '0';

		$this->load->library('image_lib',$config);
		/*
		if(!$this->image_lib->watermark()){
			echo $this->image_lib->display_errors();
		}
		*/		
	}

	function zip(){
		$config['stor_domain'] = 'test';
		$this->load->library('zip',$config);
		$name = 'myzip.txt';
		$data = 'this is a test!';
		$this->zip->add_data($name,$data);
		$this->zip->archive('myzip.zip');
	}

	function captcha(){
		$this->load->helper('captcha');
		$vals = array(
			'word' => 'Random word',
			'img_path' => 'saecache/',
			'img_url_or_stor_domain' => 'test',
		);

		$ret = create_captcha($vals);
		var_dump($ret);
	}

	function filetest(){
		date_default_timezone_set("PRC");
		$this->load->helper('file');
		$data = "this is a test";
		var_dump(get_dir_file_info("saecache/", 'test'));
	}
}
?>
