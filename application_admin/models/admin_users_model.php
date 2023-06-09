<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_Users_Model extends CI_Model {

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
        $this->db->select('a.*,b.role_id,b.role_name');
        $this->db->from($this->table . ' as a');
        $this->db->join('admin_roles as b', 'a.role_id = b.role_id', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    public function login($data) {
        $this->db->where('a.username', $data['username']);
        $this->db->where('a.password', md5($data['password']));
        $this->db->where('a.status_ind', '1');
        $this->db->from($this->table . ' as a');
        $this->db->join('admin_roles as ar', 'a.role_id=ar.role_id', 'left');
        $query = $this->db->get();
        $row = $query->row();
        return $row;
    }

    public function get_row() {
        $this->db->where($this->primary_key);
        $this->db->select('u.*,r.role_name');
        $this->db->from($this->table . ' as u');
        $this->db->join('admin_roles as r', 'u.role_id=r.role_id', 'left');
        $query = $this->db->get();
        $row = $query->row();
        return $row;
    }

    public function session_id() {
        $this->db->where($this->primary_key);
        $this->db->where('status_ind', '1');
        $query = $this->db->get($this->table);
        $row = $query->row();
        if (!empty($row->user_session_id)) {
            return $row->user_session_id;
        } else {
            return false;
        }
    }

    public function update() {
        $this->db->update($this->table, $this->data, $this->primary_key);
        $this->reset();
        return true;
    }

    public function insert() {
        $this->db->insert($this->table, $this->data);
        $this->reset();
        return true;
    }

    public function delete() {
        $this->db->delete($this->table, $this->primary_key);
        $this->reset();
        return true;
    }

}