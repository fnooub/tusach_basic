<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('search_model');
	}

	public function index()
	{
		$this->load->library('phantrang');

		$data = array();
		
		if ( $tukhoa = trim($this->input->get('tukhoa', TRUE)) ) {

			if (mb_strlen($tukhoa, 'UTF-8') > 1 && mb_strlen($tukhoa, 'UTF-8') < 60) {

				$slug_tukhoa = slug($tukhoa);
				$current_page = (int) $this->input->get('trang', TRUE);
				$total_record = $this->search_model->get_total_by_search($slug_tukhoa);
				$limit = $this->config->item('per_page');

				if ($total_record > 0) {
					// thiết lập
					$config = array(
						'current_page'	 => isset($current_page) ? $current_page : 1,
						'total_record'	 => $total_record,
						'limit'			 => $limit,
						'link_full'		 => base_url('search?tukhoa=' . $tukhoa . '&trang={page}'),
						'link_first'	 => base_url('search?tukhoa=' . $tukhoa),
						'range'			 => 15
					);

					$this->phantrang->init($config);

					$start = $this->phantrang->get_start();

					$data['pagination'] = $this->phantrang->html();
					$data['posts'] = $this->search_model->get_posts_by_search($slug_tukhoa, $limit, $start);
				} else {
					$data['error'] = "Không tìm thấy kết quả";
				}

			} else {
				$data['error'] = "Tìm kiếm phải dài hơn 3 và nhỏ hơn 60 ký tự";
			}

			$data['title'] = $tukhoa;

		}

		if (empty($tukhoa)) redirect();

		/*seo header*/
		$data['seo'] = array(
			'enable' => array(
				'general' => true, //description
				'og' => false,
				'twitter'=> false,
				'robot'=> false
			),
			'title' => 'Tìm kiếm với ' . $tukhoa,
			'desc' => '',
			'imgurl' => '',
			'url' => '',
			'canonical' => false
		);

		$this->load->view('templates/header', $data);
		$this->load->view('sites/search/detail', $data);
		$this->load->view('templates/footer');

	}

	public function ajax()
	{
		if ( $tukhoa = trim($this->input->get('tukhoa', TRUE)) ) {

			$tukhoa = slug($tukhoa);

			$result = $this->search_model->get_posts_by_search($tukhoa, 5);

			if ($result) {
				if (mb_strlen($tukhoa, 'UTF-8') > 1) {
					foreach ($result as $row):
						?>
						<li class="list-group-item px-2 py-1">
							<a href="<?php echo base_url('ebook/' . $row['slug']); ?>"><?php echo $row['title'] ?> <span class="text-success font-italic"><small>{<?php echo $row['author_name'] ?>}</small></span></a>
						</li>
						<?php
					endforeach;
					if (count($result) == 5):
						?>
						<li class="list-group-item px-2 py-1">
							<a class="text-secondary" href="<?php echo base_url('search?tukhoa=' . $tukhoa) ?>">
								<em>Xem thêm kết quả khác</em>
							</a>
						</li>
						<?php
					endif;
				} else { ?>
					<li class="list-group-item px-2 py-1">
						<em>Quá ngắn nhập tiếp nào...</em>
					</li>
				<?php }
			} else { ?>
				<li class="list-group-item px-2 py-1">
					<em>Không tìm thấy...</em>
				</li>
			<?php }

		}
	}

}

/* End of file Search.php */
/* Location: ./application/controllers/Search.php */