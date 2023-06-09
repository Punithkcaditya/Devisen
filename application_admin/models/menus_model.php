<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menus_Model extends CI_Model {

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
     public function menulist($p_id){ 
       $query = $this->db->query("SELECT a.menuitem_id, a.menuitem_text , Deriv1.Count FROM `menuitems` a  LEFT OUTER JOIN (SELECT parent_menuitem_id, COUNT(*) AS Count FROM `menuitems` GROUP BY parent_menuitem_id) Deriv1 ON a.menuitem_id = Deriv1.parent_menuitem_id WHERE a.parent_menuitem_id= ".$p_id);
       return $query->result();
    }
    public function is_exist() {
        $this->db->where($this->primary_key);
        $this->db->select('COUNT(*) as counter');
        $query = $this->db->get($this->table);
        $row = $query->row();
        return $row->counter;
    }

    public function view() {
        $query = $this->db->get($this->table);
        return $query->result();
    }
}