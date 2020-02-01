<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->model('posts_model');
		$data['count'] = $this->posts_model->get_total();
		/*seo header*/
		$data['seo'] = array(
			'enable' => array(
				'general' => true, //description
				'og' => true,
				'twitter'=> true,
				'robot'=> true
			),
			'title' => '',
			'desc' => '',
			'imgurl' => '',
			'url' => base_url(),
			'canonical' => base_url()
		);
		$this->load->view('templates/header', $data);
		$this->load->view('sites/home', $data);
		$this->load->view('templates/footer');
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */