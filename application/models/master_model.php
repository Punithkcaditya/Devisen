<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_Model extends CI_Model {

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

    public function get_row($table_name) {
        $this->db->where($this->primary_key);
        $query = $this->db->get($table_name);
        $row = $query->row();
        $this->reset_pk();
        return $row;
    }

	
    public function insert($table_name) {
        $this->db->insert($table_name, $this->data);
        $this->reset_data();
        return $this->db->insert_id();
	}

    public function update($table_name) {
        $this->db->update($table_name, $this->data, $this->primary_key);
        $this->reset();
        return true;
    }

    public function delete($table_name) {
        $this->db->delete($table_name, $this->primary_key);
        $this->reset_pk();
        return true;
    }
	
	public function get_data($table_name) {
        $this->db->select('*');
        $this->db->where("status_ind = 1");
        $this->db->from($table_name);
        $query = $this->db->get();
		$row = $query->result();
        return $row;
    }

    public function get_alldata($table_name) {
        $this->db->select('*');
        $this->db->where($this->primary_key);
        $this->db->from($table_name);
        $query = $this->db->get();
        $row = $query->result();

        return $row;
    }

    public function get_calender($table_name) {
        $this->db->select('*');
        $this->db->where($this->primary_key);
        $this->db->from($table_name);
        $this->db->order_by("sort_order", "asc");
        $query = $this->db->get();
		$row = $query->result();
        return $row;
    }
	
	public function getCustomer() {
        $this->db->select('*');
        $this->db->from('users as u');
		$this->db->join('package as p', 'p.package_id = u.package_id', 'left');
		$this->db->order_by('u.user_id DESC');
        $query = $this->db->get();
		$row = $query->result();
        return $row;
    }

    public function get_datajoin($table_name,$second_table,$relation_field1,$relation_field2) {
        $this->db->where($this->primary_key);
        $this->db->select('*');
        $this->db->from($table_name." as m");
        $this->db->join($second_table.' as mt', 'm.'.$relation_field1.'= mt.'.$relation_field2, 'left');
        $query = $this->db->get();
        $row = $query->result();
        return $row;
    }
    public function get_rowjoin($table_name,$second_table,$relation_field1,$relation_field2) {
        $this->db->where($this->primary_key);
        $this->db->select('*');
        $this->db->from($table_name." as m");
        $this->db->join($second_table.' as mt', 'm.'.$relation_field1.'= mt.'.$relation_field2, 'left');
        $query = $this->db->get();
        $row = $query->row();
        return $row;
    }
	
	
	public function getTodaycalender(){
		$query = $this->db->query('Select * from calender where calender_date=CURRENT_DATE');
		$row = $query->result();
		return $row;
	}
	
	public function getTomcalender(){
		$query = $this->db->query('Select * from calender where calender_date=(CURRENT_DATE + INTERVAL 1 DAY )');
		$row = $query->result();
		return $row;
	}
	
	public function getThisWeekcalender(){
		$query = $this->db->query('Select * from calender where YEARWEEK(calender_date , 1)= YEARWEEK(CURDATE(),1)');
		$row = $query->result();
		return $row;
	}
	
	public function getNextWeekcalender(){
		$query = $this->db->query('Select * from calender where calender_date BETWEEN NOW() + INTERVAL( 7 -  DAYOFWEEK(NOW()) + 1) DAY AND NOW()+ INTERVAL (7-DAYOFWEEK(NOW()) + 7) DAY');
		$row = $query->result();
		return $row;
	}
	


}