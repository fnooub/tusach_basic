<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('text');
		//$this->load->model('categories_model'); da tai o my_controller
	}

	public function index()
	{
		redirect();
	}

	public function detail()
	{
		$slug = $this->uri->rsegment(3);
		$this->load->library('phantrang');

		$data['category'] = $this->categories_model->get_category_by_slug($slug);

		$current_page = (int) $this->input->get('trang', TRUE);
		$total_record = $this->categories_model->get_count_posts_by_category_slug($slug);
		$limit = $this->config->item('per_page');
		// thiết lập
		$config = array(
			'current_page'	 => isset($current_page) ? $current_page : 1, // Trang hiện tại
			'total_record'	 => $total_record, // Tổng số record
			'limit'			 => $limit,// limit
			'link_full'		 => base_url('the-loai/' . $slug . '?trang={page}'),// Link full có dạng như sau: domain/com/page/{page}
			'link_first'	 => base_url('the-loai/' . $slug),// Link trang đầu tiên
			'range'			 => 15 // Số button trang bạn muốn hiển thị 
		);
		$this->phantrang->init($config);
		$start = $this->phantrang->get_start();

		$data['pagination'] = $this->phantrang->html();
		$data['posts'] = $this->categories_model->get_posts_by_category_slug($slug, $limit, $start);

		if (!$data['posts']) redirect();

		/*seo header*/
		$data['seo'] = array(
			'enable' => array(
				'general' => true, //description
				'og' => true,
				'twitter'=> true,
				'robot'=> true
			),
			'title' => 'ePub ' . $data['category']['name'],
			'desc' => character_limiter(strip_tags($data['category']['description']), 160),
			'imgurl' => '',
			'url' => site_url('the-loai/' . $data['category']['slug']),
			'canonical' => site_url('the-loai/' . $data['category']['slug'])
		);

		$this->load->view('templates/header', $data);
		$this->load->view('sites/categories/detail', $data);
		$this->load->view('templates/footer');
	}

}

/* End of file Categories.php */
/* Location: ./application/controllers/Categories.php */