<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_category_by_slug($slug)
	{
		$this->db->select('*');
		$this->db->from('categories');
		$this->db->where('slug', $slug);
		$query = $this->db->get();

		if ($query->num_rows() > 0)
			return $query->row_array();
		return false;
	}

	public function get_categories_by_post_id($post_id)
	{
		$this->db->select('name, slug');
		$this->db->from('categories');
		$this->db->join('posts_categories', 'posts_categories.category_id = categories.id');
		$this->db->where('posts_categories.post_id', $post_id);
		$query = $this->db->get();

		if ($query->num_rows() > 0)
			return $query->result_array();
		return false;
	}

	public function get_posts_by_category_slug($slug, $limit, $start = 0)
	{
		$this->db->select('posts.id, posts.title, posts.slug, posts.featured_image, authors.name author_name, authors.slug author_slug');
		$this->db->from('posts');
		$this->db->join('posts_categories', 'posts.id = posts_categories.post_id');
		$this->db->join('categories', 'posts_categories.category_id = categories.id');
		$this->db->join('authors', 'posts.author_id = authors.id');
		$this->db->where('categories.slug', $slug);
		$this->db->order_by('posts.id', 'desc');
		$this->db->limit($limit, $start);

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}

	public function get_count_posts_by_category_slug($slug)
	{
		$this->db->select('posts.id');
		$this->db->from('posts');
		$this->db->join('posts_categories', 'posts.id = posts_categories.post_id');
		$this->db->join('categories', 'posts_categories.category_id = categories.id');
		$this->db->where('categories.slug', $slug);
		return $this->db->count_all_results();
	}

	public function get_categories()
	{
		$this->db->from('categories');
		$this->db->order_by('id', 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

}

/* End of file Categories_model.php */
/* Location: ./application/models/Categories_model.php */