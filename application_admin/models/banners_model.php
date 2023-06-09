<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Banners_Model extends CI_Model {

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

    public function get_row($banner_id) {
        $this->db->where('banner_id', $banner_id);
        $query = $this->db->get($this->table);
        $row = $query->row();
        $this->reset_pk();
        return $row;
    }

    public function view() {
        $this->db->order_by('b.banner_id DESC');
        $this->db->select('b.*,u.username as last_modified_user,au.username as created_user');
        $this->db->from($this->table . ' as b');
        $this->db->join('admin_users as u', 'b.last_modified_by = u.user_id', 'left');
        $this->db->join('admin_users as au', 'b.created_by = au.user_id', 'left');
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
	
	public function update_image($banner_id){
		
		$this->db->where('banner_id', $banner_id);
		$this->db->set('banner_path', null);
		$this->db->update($this->table, $this->data, $this->primary_key);
        $this->reset();
        return true;
	}
	
	public function check_duplicate_slug($field_name, $field_value, $banner_id) {
        $this->db->where($field_name, $field_value);
		if (!empty($banner_id)) {
            $this->db->where('banner_id !=', $banner_id);
        }
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

}