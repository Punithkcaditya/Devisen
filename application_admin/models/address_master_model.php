<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Address_Master_Model extends CI_Model {

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

    public function view($lang_id = 1) {
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

    public function copy_multiple($banner_ids, $lang_id_from, $copy_lang_id_to) {
        $banner_ids = implode(",", $banner_ids);
        $userid = $this->session->userdata('user_id');
        $this->db->query("REPLACE INTO `banners`(`banner_id`, `lang_id`, `banner_path`,`mobile_banner_path`, `link_target`, `banner_title`, `alt_title`,`display_order`, `status_ind`,`title_txt_ind`,`banner_txt_ind`, `created_date`, `created_by`, `last_modified_by`, `button_text`, `button_url`)
                          SELECT `banner_id`, $copy_lang_id_to as `lang_id`, `banner_path`,`mobile_banner_path`, `link_target`, `banner_title`, `alt_title`,  `display_order`, `status_ind`,`title_txt_ind`,`banner_txt_ind`, `created_date`, `created_by`, $userid as `last_modified_by`, `button_text`, `button_url` FROM `banners` WHERE  banner_id IN($banner_ids) and `lang_id` = $lang_id_from ");

        $this->reset_pk();
        return true;
    }

}