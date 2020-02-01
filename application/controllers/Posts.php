<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('posts_model');
	}

	public function index()
	{
		$this->load->library('phantrang');

		$current_page = (int) $this->input->get('trang', TRUE);
		$total_record = $this->posts_model->get_total();
		$limit = $this->config->item('per_page');
		// thiết lập
		$config = array(
			'current_page'	 => isset($current_page) ? $current_page : 1, // Trang hiện tại
			'total_record'	 => $total_record, // Tổng số record
			'limit'			 => $limit,// limit
			'link_full'		 => base_url('ebook?trang={page}'),// Link full có dạng như sau: domain/com/page/{page}
			'link_first'	 => base_url('ebook'),// Link trang đầu tiên
			'range'			 => 15 // Số button trang bạn muốn hiển thị 
		);
		$this->phantrang->init($config);
		$start = $this->phantrang->get_start();

		$data['pagination'] = $this->phantrang->html();
		$data['posts'] = $this->posts_model->get_posts($limit, $start);

		/*seo header*/
		$data['seo'] = array(
			'enable' => array(
				'general' => true, //description
				'og' => true,
				'twitter'=> true,
				'robot'=> true
			),
			'title' => 'Tất cả truyện ePub hay luôn cập nhật',
			'desc' => 'Tất cả sách hay miễn phí, cập nhật truyện full và sách hay mỗi ngày. Tải ePub sách hay',
			'imgurl' => '',
			'url' => site_url('ebook'),
			'canonical' => site_url('ebook')
		);

		$this->load->view('templates/header', $data);
		$this->load->view('sites/posts/home', $data);
		$this->load->view('templates/footer');

	}

	public function detail()
	{
		$slug = $this->uri->rsegment(3);
		$data['posts'] = $this->posts_model->get_post_by_slug($slug);

		if (!$data['posts']) redirect();

		/*seo header*/
		$data['seo'] = array(
			'enable' => array(
				'general' => true, //description
				'og' => true,
				'twitter'=> true,
				'robot'=> true
			),
			'title' => 'Tải ePub truyện ' . $data['posts']['title'] . ' - ' . $data['posts']['author_name'],
			'desc' => 'Tải ngay ePub miễn phí ' . $data['posts']['title'] . ' của tác giả ' . $data['posts']['author_name'],
			'imgurl' => $data['posts']['featured_image'],
			'url' => site_url('ebook/' . $data['posts']['slug']),
			'canonical' => site_url('ebook/' . $data['posts']['slug'])
		);

		$this->load->view('templates/header', $data);
		$this->load->view('sites/posts/detail', $data);
		$this->load->view('templates/footer');
	}

	public function download()
	{
		$url = $this->uri->rsegment(3);
		redirect('https://drive.google.com/open?id=' . $url,'refresh');
	}


}

/* End of file Posts.php */
/* Location: ./application/controllers/Posts.php */