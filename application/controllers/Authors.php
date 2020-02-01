<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authors extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('authors_model');
	}

	public function index()
	{
		redirect();
	}

	public function detail()
	{
		$slug = $this->uri->rsegment(3);
		$data['posts'] = $this->authors_model->get_posts_by_author_slug($slug);
		$data['author'] = $this->authors_model->get_author($slug);
		if (!$data['author']) redirect();

		/*seo header*/
		$data['seo'] = array(
			'enable' => array(
				'general' => true, //description
				'og' => true,
				'twitter'=> true,
				'robot'=> true
			),
			'title' => 'Tác giả ' . $data['author']['name'],
			'desc' => 'Những bộ ePub hay nhất của ' . $data['author']['name'],
			'imgurl' => '',
			'url' => site_url('tac-gia/' . $data['author']['slug']),
			'canonical' => site_url('tac-gia/' . $data['author']['slug'])
		);

		$this->load->view('templates/header', $data);
		$this->load->view('sites/authors/detail', $data);
		$this->load->view('templates/footer');
	}

}

/* End of file Authors.php */
/* Location: ./application/controllers/Authors.php */