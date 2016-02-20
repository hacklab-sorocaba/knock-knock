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

        public function get_active()
        {
                $query = $this->db
                                ->where('status', 1)
                                ->get('users');

                return $query->result();
        }

}
