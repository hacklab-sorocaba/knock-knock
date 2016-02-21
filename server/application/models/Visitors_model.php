<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Visitors_model extends CI_Model {

	public $title;
	public $content;
	public $date;

	public function __construct()
	{
		// Call the CI_Model constructor
		parent::__construct();
	}

	public function insert($data) {
		$this->db->set($data);
		$this->db->insert('visitors');
		$this->db->insert_id();

		return true;
	}

	public function get_status($mac) {
		$this->db->select('status');
		$this->db->where('mac', $mac);
		$this->db->order_by('create_date DESC');
		$this->db->limit(1);
		$result = $this->db->get('visitors')->row(0);

		return isset($result->status) ? $result->status : 0;
	}

}