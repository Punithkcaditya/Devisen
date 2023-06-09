<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings_Model extends CI_Model {

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

    public function view() {
        $query = $this->db->select('*')->from($this->table)->get();
        return $query->result();
    }

    public function view_setting() {
        $records = array();
        $query = $this->db->select('*')->from($this->table)->get();
        $tmp_records = $query->result(); //return $query->result();
        foreach ($tmp_records as $tmp_record) {
            $records[strtoupper($tmp_record->setting_key)] = $tmp_record->setting_value;
        }
        return (object) $records;
    }

    public function insert() {
        $this->db->insert($this->table, $this->data);
        //$this->reset_data();
        return true;
    }

    public function update() {
        $this->db->update($this->table, $this->data, $this->primary_key);
        //$this->reset();
        return true;
    }

    public function delete() {
        $this->db->delete($this->table, $this->primary_key);
        $this->reset_pk();
        return true;
    }

}
