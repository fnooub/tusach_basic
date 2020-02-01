<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_pages()
	{
		$this->db->from('pages');
		$this->db->order_by('id', 'ASC');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}

	public function get_page($slug)
	{
		$this->db->from('pages');
		$this->db->where('slug', $slug);
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
			return $query->row_array();
		}
		return false;
	}

}

/* End of file Pages_model.php */
/* Location: ./application/models/Pages_model.php */