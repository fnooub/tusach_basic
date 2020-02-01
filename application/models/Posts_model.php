<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Categories_model');
	}

	public function get_total()
	{
		return $this->db->count_all('posts');
	}

	public function get_posts($limit, $start = 0)
	{
		$this->db->select('posts.id, posts.title, posts.slug, posts.featured_image, authors.name author_name, authors.slug author_slug');
		$this->db->from('posts');
		$this->db->join('authors', 'posts.author_id = authors.id');
		$this->db->order_by('posts.id', 'DESC');
		$this->db->limit($limit, $start);

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}

	public function get_post_by_slug($slug)
	{
		$this->db->select('posts.*, authors.name author_name, authors.slug author_slug, download_size, download_url');
		$this->db->from('posts');
		$this->db->join('authors', 'posts.author_id = authors.id');
		$this->db->where('posts.slug', $slug);		
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			$post = $query->row_array();
			$post['categories'] = $this->Categories_model->get_categories_by_post_id($post['id']);
			return $post;
		}
		return false;
	}


}

/* End of file Posts_model.php */
/* Location: ./application/models/Posts_model.php */