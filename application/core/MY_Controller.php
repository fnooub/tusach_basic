<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	// Bien luu thong tin gui den view
	var $data = array();
	
	/**
	 * Ham khoi dong
	 */
	function __construct()
	{
		//kế thừa từ CI_Controller
		parent::__construct();
		
		// Xu ly controller
		$controller = $this->uri->segment(1);
		$controller = strtolower($controller);
		
		switch ($controller) {
			//Nếu đang truy cập vào trang Admin
			case 'admin': {
				//load các file sử dụng nhiều cho trang admin
				//kiểm tra admin đăng nhập hay chưa
				//kiểm tra quyền của admin
				//....
				break;
			}
			
			//Trang chủ
			default: {
				//load các file sử dụng nhiều cho trang chủ
				//Xử lý ngôn ngữ
				//Xử lý tiền tệ
				//....

				// load config
				$this->config->load('site_config');

				// categories
				$this->load->model('categories_model');
				$navbar_cats               = $this->categories_model->get_categories();
				$this->data['navbar_cats'] = $navbar_cats;

				// pages
				$this->load->model('pages_model');
				$navbar_pages 				= $this->pages_model->get_pages();
				$this->data['navbar_pages'] = $navbar_pages;
				break;
			}
		}
		
	}

}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */