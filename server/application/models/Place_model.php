<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Place_model extends CI_Model {

        public $in;
        public $out;

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }

        public function update($data, $id = 0) {
                if ($id == 0) {
                        $this->db->set($data);
                        $this->db->insert('place');
                        $this->db->insert_id();
                }
                else {
                        $this->db->set($data);
                        $this->db->where('id', $id);
                        $this->db->update('place');
                }

                return true;
        }

        public function get_status()
        {
                $query = $this->db
                                ->order_by('id DESC')
                                ->get('visitors');
                                
                return $query->result();
        }

}