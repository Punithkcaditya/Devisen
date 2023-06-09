<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class admin_users_accesses_model extends CI_Model {

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

    public function get_user_access($user_id, $parent_menuitem_id = NULL) {
        if (empty($parent_menuitem_id)) {
            $this->db->where('am.parent_menuitem_id IS NULL ');
            $this->db->where('ua.user_id', $user_id);
			$this->db->where('am.status_ind', 1);
            $this->db->from('admin_menuitems as am');
            $this->db->join('admin_users_accesses as ua', 'am.menuitem_id = ua.menuitem_id', 'left');
        } else {
            $this->db->where('am.parent_menuitem_id', $parent_menuitem_id);
            $this->db->where('ua.user_id', $user_id);
            $this->db->from('admin_menuitems as am');
			$this->db->where('am.status_ind', 1);
            $this->db->join('admin_users_accesses as ua', 'am.menuitem_id = ua.menuitem_id', 'left');
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $tmpresult = $query->result();
            for ($i = 0; $i < count($tmpresult); $i++) {
                $tmpresult[$i]->submenus = $this->get_user_access($user_id, $tmpresult[$i]->menuitem_id);
            }
            return $tmpresult;
        } else {
            return;
        }
    }

    public function is_allowed($user_id, $menuitem_id) {
    	if(!empty($user_id)){
        $sql = "SELECT menuitem_id FROM admin_users_accesses WHERE user_id=$user_id AND menuitem_id=$menuitem_id";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return true;
        }
        return false;
        }else{
        return false;
        }
    }

    public function get_permisions($user_id, $menu_id) {
        $this->db->select('add_permission,edit_permission,delete_permission');
        $this->db->where('user_id', $user_id);
        $this->db->where('menuitem_id', $menu_id);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function view($user_id = 1) {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function view_access($user_id = 1) {
        $this->db->select('a.*,am.parent_menuitem_id,am.menuitem_link,am.menuitem_text');
        $this->db->where('a.user_id', $user_id);
        $this->db->from($this->table . ' as a');
        $this->db->join('admin_menuitems am', 'a.menuitem_id = am.menuitem_id', 'left');
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

}