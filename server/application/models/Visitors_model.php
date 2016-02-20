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

}