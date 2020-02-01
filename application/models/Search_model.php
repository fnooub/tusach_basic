<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_total_by_search($tukhoa)
	{
		$this->db->select('posts.id');
		$this->db->from('posts');
		$this->db->join('authors', 'posts.author_id = authors.id');
		$this->db->like('posts.slug', $tukhoa);
		$this->db->or_like('authors.slug', $tukhoa);
		return $this->db->count_all_results();
	}

	public function get_posts_by_search($tukhoa, $limit, $start = 0)
	{
		$this->db->select('posts.id, posts.title, posts.slug, posts.featured_image, authors.name author_name, authors.slug author_slug');
		$this->db->from('posts');
		$this->db->join('authors', 'posts.author_id = authors.id');
		$this->db->like('posts.slug', $tukhoa);
		$this->db->or_like('authors.slug', $tukhoa);
		$this->db->order_by('posts.title', 'DESC');
		$this->db->limit($limit, $start);

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}

}

/* End of file Search_model.php */
/* Location: ./application/models/Search_model.php */