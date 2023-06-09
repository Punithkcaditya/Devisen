<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_Model extends CI_Model {

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
    public function insert() {	//echo "<pre>";print_r($this->data);exit;		
        $this->db->insert($this->table, $this->data);
		$this->reset_data();        
        return true;
    }
    public function insertalert() {	//echo "<pre>";print_r($this->data);exit;		
        $this->db->insert('user_alerts', $this->data);
		$this->reset_data();        
        return true;
    }
    public function updatealert() {	//echo "<pre>";print_r($this->data);exit;		
        $this->db->update('user_alerts', $this->data, $this->primary_key);
		$this->reset_data();        
        return true;
    }

	public function update() {
		$this->db->update($this->table, $this->data, $this->primary_key);
		$this->reset();
		return true;
		}
	public function change_password($email,$newpassword) {
		$this->db->set('password', $newpassword);
        $this->db->where('email',$email);
        $this->db->update($this->table);
        $this->reset();
        return true;
    }
	
    public function view() {
        $this->db->where('status_ind', '1');
        $query = $this->db->select('*')->from($this->table)->get();
        return $query->result();
    }

    public function session_user($columns) {
        $this->db->where($this->primary_key);
        $this->db->where('status_ind', '1');
        $query = $this->db->select($columns)->from($this->table)->get();
        $row = $query->row();
        $this->reset_pk();
        return $row;
    }
	public function session_user_all() {
        $this->db->where($this->primary_key);
        $this->db->where('status_ind', '1');
        $query = $this->db->select('*')->from($this->table)->get();
        $row = $query->row();
        $this->reset_pk();
        return $row;
    }
    public function login($data) {
        $this->db->where('username', $data['username']);
        $this->db->where('password', $data['password']);
        $this->db->where('status_ind', '1');
        $this->db->select('user_id as login_user_id,username as login_username,first_name as login_first_name,last_name as login_last_name,email as login_email');
        $query = $this->db->get($this->table);
        $row = $query->row();
        return $row;
    }

    public function is_exist($data) {
        $this->db->where('email', $data['email']);
        $this->db->where('status_ind', '1');
        $query = $this->db->get($this->table);
        $row = $query->row();
        return $row;
    }
		
	public function validate()
	{
        $this->db->where('username', $this->session->userdata('username'));
        $this->db->where('password',$this->session->userdata('password'));
        $query = $this->db->get('users');
        if($query->num_rows == 1)
        {
            $row = $query->row();
            $data = array(
                    'user_id' => $row->user_id,
                	'username' => $row->username,
                    'password' => $row->password,
				    'validated' => true
                    );
            $this->session->set_userdata($data);
            return true;
        }
        return false;
    }

    public function loginAfterOtp($u,$p){
        $this->db->where('email', $u);
        $this->db->where('password',md5($p));
        $this->db->where('status_ind', '1');
        $this->db->select('*,users_id as login_user_id');
        $query = $this->db->get($this->table);
        $row = $query->row();
        return $row;
    }
	
	public function loginsearch($u,$p){
        $this->db->where('email', $u);
        $this->db->where('password',md5($p));
		$this->db->where('status_ind','1');
        $query = $this->db->get('users');
		//echo $this->db->last_query();exit;

        if($query->num_rows == 1){
            $row = $query->row();
            if($row->status_ind == 1){	
                return true;
            } else {
                return false;
            }	
		}else {
            return false;
        }
    }
	
	public function emailsearch($mail)

	{

        $this->db->where('email', $mail);      
        $query = $this->db->get('users');

        if($query->num_rows >= 1)
        {
         $row = $query->row();	         
           return true;        
		}
        return false;
    }
	
	public function getuser($user_id) {
		$this->db->where('users_id', $user_id);
        $query = $this->db->get('users');
        return $query->row();
    }

    public function getalerts($user_id) {
		$this->db->where('users_id', $user_id);
        $query = $this->db->get('user_alerts');
        return $query->result();
    }

	public function get_userid_by_mail($email) {
        $this->db->where('email', $email);
        $this->db->where('status_ind', '1');
        $query = $this->db->get($this->table);
        $row = $query->row();
        return $row->user_id;
    }

	
}
