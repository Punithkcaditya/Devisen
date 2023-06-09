<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Phrases_Model extends CI_Model {

    private $table;
    public $primary_key;
    public $data;

    function __construct() {
        parent::__construct();
        $this->table = substr(strtolower(get_class($this)), 0, -6);
        $this->primary_key = array();
        $this->data = array();
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

    public function get_max_value($field) {
        $this->db->select_max($field);
        $query = $this->db->get($this->table);
        $row = $query->row();
        return $row->$field;
    }

    public function get_row() {
        $this->db->where($this->primary_key);
        $query = $this->db->get($this->table);
        $row = $query->row();
        $this->reset_pk();
        return $row;
    }
    
    public function is_exist() {
        $this->db->where($this->primary_key);
        $this->db->select('COUNT(*) as counter');
        $query = $this->db->get($this->table);
        $row = $query->row();
        return $row->counter;
    }
    
    public function view($controller_name='') {
        
        if(!empty($controller_name)){
            $this->db->where('controller_name', $controller_name);
        }
        $query = $this->db->select('*')->from($this->table)->get();
        return $query->result();
    }

    public function insert() {
        $this->db->insert($this->table, $this->data);
        return true;
    }

    public function update() {
        $this->db->update($this->table, $this->data, $this->primary_key);
        return true;
    }

    public function delete() {
        $this->db->delete($this->table, $this->primary_key);
        $this->reset_pk();
        return true;
    }
    
    public function get_distinct_controller() { 
        $this->db->select('controller_name');
        $this->db->distinct('controller_name');
        $this->db->group_by('controller_name');
        $this->db->order_by('controller_name ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

}