<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Testimonial_Model extends CI_Model {

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

    public function view() {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function insert() {
        $this->db->insert($this->table, $this->data);
        $this->reset_data();
        return true;
    }

    public function update() {
        $this->db->update($this->table, $this->data, $this->primary_key);
        $this->reset();
        return true;
    }

    public function delete() {
        $this->db->delete($this->table, $this->primary_key);
        $this->reset_pk();
        return true;
    }

    public function get_row() {
        $this->db->where($this->primary_key);
        //$this->db->where('u.status_ind', '1');
        $this->db->select('u.*');
        $this->db->from($this->table . ' as u');
        $query = $this->db->get();
        $row = $query->row();
        return $row;
    }

    public function get_slug($key, $field) {
        //creating slug code here
        $slug = preg_replace('~[^\\pL\d]+~u', '-', $key); // replace non letter or digits by
        $slug = trim($slug, '-'); // trim
        $slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug); // transliterate
        $slug = strtolower($slug); // lowercase
        $slug = preg_replace('~[^-\w]+~', '', $slug); // remove unwanted characters

        if (!empty($slug)) {
            $this->db->select('count(*) as counter');
            $this->db->like($field, $slug, 'after');
            $query = $this->db->get($this->table);
            $counter = $query->row()->counter;
            $slug = (!empty($counter)) ? $slug . '-' . (++$counter) : $slug;
        }

        return $slug;
    }
    
    public function check_duplicate_slug($field_name, $field_value, $testimonial_id) {
        $this->db->where($field_name, $field_value);
        if (!empty($testimonial_id)) {
            $this->db->where('testimonial_id !=', $testimonial_id);
        }
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

}