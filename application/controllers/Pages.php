<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('text');
	}

	public function index()
	{
		redirect();
	}

	public function detail()
	{
		$slug = $this->uri->rsegment(3);
		$data['posts'] = $this->pages_model->get_page($slug);
		if (!$data['posts']) redirect();

		/*seo header*/
		$data['seo'] = array(
			'enable' => array(
				'general' => true, //description
				'og' => true,
				'twitter'=> true,
				'robot'=> true
			),
			'title' => $data['posts']['title'],
			'desc' => character_limiter(strip_tags($data['posts']['content']), 160),
			'imgurl' => '',
			'url' => base_url('p/' . $data['posts']['slug']),
			'canonical' => base_url('p/' . $data['posts']['slug'])
		);

		$this->load->view('templates/header', $data);
		$this->load->view('sites/pages/detail', $data);
		$this->load->view('templates/footer');
	}

}

/* End of file Pages.php */
/* Location: ./application/controllers/Pages.php */