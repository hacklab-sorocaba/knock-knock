<?php defined('BASEPATH') OR exit('No direct script access allowed');
class User_model extends CI_Model {

	public $mac;
	public $name;
	public $status;
	public $last_in;
	public $last_out;

	public function __construct()
	{
		// Call the CI_Model constructor
		parent::__construct();
	}

	public function update($data, $id = 0) {
		if ($id == 0) {
			$this->db->set($data);
			$this->db->set('create_date', 'NOW()', FALSE);
			$this->db->insert('users');
			$this->db->insert_id();
		}
		else {
			$this->db->set($data);
			$this->db->where('id', $id);
			$this->db->update('users');
		}

		return true;
	}

	public function exists($mac) {
		$query = $this->db
					->where('mac', $mac)
					->get('users');
		return count($query->result());
	}

	public function get_active($ignore_always_on = FALSE)
	{
		$query = $this->db
					->select('T0.id, T0.mac, T2.name, T0.status, T1.create_date')
					->from('visitors T0')
					->join('users T2', 'T2.mac = T0.mac')
					->join('(SELECT `mac`, MAX(`create_date`) as `create_date` FROM `visitors` GROUP BY `mac`) T1', 'T0.mac = T1.mac AND T0.create_date = T1.create_date')
					->order_by('T2.name');
	
		if ($ignore_always_on) {
			$query->where('T0.status = 1 AND T0.mac NOT IN (SELECT `mac` FROM `users` WHERE `always_on` = 1)');
		} else {
			$query->where('T0.status = 1');
		}
	
		//$this->output->enable_profiler(TRUE);
		$result = $query->get()->result();

		return $result;
	}

	public function get_active_today() {
		$query = $this->db
					->select('name')
					->from('users')
					->where_in('mac', "SELECT mac FROM `visitors` WHERE status = 1 AND DATE_FORMAT(create_date, '%Y-%m-%d') = DATE_FORMAT(NOW(), '%Y-%m-%d') GROUP BY mac", FALSE)
					->where('always_on', '0')
					->group_by('name')
					->order_by('name');

		$result = $query->get()->result();
		//$this->output->enable_profiler(TRUE);

		return $result;
	}
}