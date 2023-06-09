<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Widgets_model extends CI_Model {

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
    
    public function get_widgets($template_id = 2) {
        $this->db->where('page_wise_widgets', '0');
        $this->db->where('template_id', $template_id);
        $this->db->where('area_id IN (5,7)');
        $this->db->select('widget_id,widget_title');
        $query = $this->db->get($this->table);
        return $query->result();
    }
    
     public function get_widgets_1() {
        $this->db->where('page_wise_widgets', '0');
        $this->db->where('status_ind', '1');
        $this->db->where('area_id IN (1,2,4,5,7,9)');
        $this->db->where('widget_type IN (1,2,5,8,9,10,11,12,13,14,20,0)');
        $this->db->select('widget_id,widget_title');
        $query = $this->db->get($this->table);
        //echo $this->db->last_query(); die;
        return $query->result();
    }
    
    public function get_widgets_2($widget_typ) {
        $this->db->where('status_ind', '1');
        $this->db->where('page_wise_widgets', '0');
        if (!empty($widget_type)) {
            $this->db->where('widget_type', $widget_type);
        } else {
            $this->db->where('widget_type IN (1,2,5,8,9,10,11,12,13,14,20,0)');
        }
        //$this->db->where('template_id IN (2,5)');
        $this->db->where('area_id IN (1,2,4,5,7,9)');
        //$this->db->where('widget_type IN (1,2,5,8,9,10,11,12,13,14,20,0)');
        $this->db->select('widget_id,widget_title');
        $query = $this->db->get($this->table);
	//echo $this->db->last_query(); die;
        return $query->result();
    }

    public function view() {
        $this->db->where('w.page_wise_widgets', '0');
        $this->db->order_by('w.display_order ASC');
        $this->db->select('w.*,t.template_name,a.area_name,p.type_name');
        $this->db->from($this->table . ' as w');
        $this->db->join('templates as t', 'w.template_id = t.template_id ', 'left');
        $this->db->join('widget_areas as a', 'w.area_id = a.area_id', 'left');
        $this->db->join('page_types as p', 'w.widget_type = p.type_id', 'left');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        return $query->result();
    }

    public function insert() { 
        $this->db->insert($this->table, $this->data);
        //$this->reset_data();
        //echo $this->db->last_query();exit;
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
