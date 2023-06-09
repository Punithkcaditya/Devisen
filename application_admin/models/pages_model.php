<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pages_Model extends CI_Model {

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

    public function get_row($page_id) {
        $this->db->where('page_id', $page_id);
        $query = $this->db->get($this->table);
        $row = $query->row();
        $this->reset_pk();
        return $row;
    }

    public function view() {
        $this->db->order_by('page_id DESC');
        $this->db->select('p.*,pt.type_name,u.username as last_modified_user,au.username as created_user');
        $this->db->from($this->table . ' as p ');
        $this->db->join('page_types as pt', 'pt.type_id = p.type_id', 'left');        
        $this->db->join('admin_users as u', 'p.last_modified_by = u.user_id', 'left');
        $this->db->join('admin_users as au', 'p.created_by = au.user_id', 'left');
        $query = $this->db->get();
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

    public function check_duplicate_slug($field_name, $field_value, $page_id) {
        $this->db->where($field_name, $field_value);
        if (!empty($page_id)) {
            $this->db->where('page_id !=', $page_id);
        }
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

    public function update_image($page_id) {

        $this->db->where('page_id', $page_id);
        $this->db->set('photo_path', null);
        $this->db->update($this->table, $this->data, $this->primary_key);
        $this->reset();
        return true;
    }

    public function view_widgets() {
        $this->db->order_by('p.page_id DESC');
        $this->db->where('p.status_ind', '1');
        $this->db->select('p.*,pt.type_name,u.username as last_modified_user,au.username as created_user');
        $this->db->from($this->table . ' as p');
        $this->db->join('page_types as pt', 'p.type_id = pt.type_id', 'left');
        $this->db->join('admin_users as u', 'p.last_modified_by = u.user_id', 'left');
        $this->db->join('admin_users as au', 'p.created_by = au.user_id', 'left');
        $query = $this->db->get();
        return $query->result();
    }

}