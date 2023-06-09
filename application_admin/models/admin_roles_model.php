<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_Roles_Model extends CI_Model {

    private $table;
    public $primary_key;
    public $data;

    function __construct() {
        parent::__construct();
        $this->table = substr(strtolower(get_class($this)), 0, -6);
        $this->primary_key = array();
        $this->date = array();
    }

    private function reset() {
        $this->primary_key = array();
        $this->data = array();
    }

    private function reset_pk() {
        $this->primary_key = array();
    }

    private function reset_data() {
        $this->data = array();
    }

    public function view() {
        $query = $this->db->get($this->table);
        return $query->result();
    }
    
    public function view_roles() {
        $this->db->where('status_ind','1');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function insert($data) {
        $this->db->update($this->table, $this->data);
        return true;
    }

    public function get_row() {
        $this->db->where($this->primary_key);
        $this->db->where('status_ind', '1');
        $query = $this->db->get($this->table);
        $row = $query->row();
        return $row->user_session_id;
    }

    public function update() {
        $this->db->update($this->table, $this->data, $this->primary_key);
        return true;
    }

}