<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authors_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_author($slug)
	{
		$this->db->from('authors');
		$this->db->where('slug', $slug);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row_array();
		}
		return false;

	}

	public function get_posts_by_author_slug($slug)
	{
		$this->db->select('posts.id, posts.title, posts.slug, posts.featured_image, authors.name author_name, authors.slug author_slug');
		$this->db->from('posts');
		$this->db->join('authors', 'posts.author_id = authors.id');
		$this->db->where('authors.slug', $slug);
		$this->db->order_by('posts.title', 'ASC');

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}


}

/* End of file Authors_model.php */
/* Location: ./application/models/Authors_model.php */