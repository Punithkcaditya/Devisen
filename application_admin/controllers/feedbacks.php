<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Feedbacks extends CI_Controller {

    public $class_name;

    public function __construct() {
        parent::__construct();
        $this->class_name = strtolower(get_class());
        /* these are the default modules to load in all controller */
        $this->load->model('admin_roles_model');
        $this->load->model('admin_users_model');
        $this->load->model('admin_menuitems_model');
        $this->load->model('admin_users_accesses_model');
        /* these are the default modules to load in all controller */
        $this->load->model('feedbacks_model');
        $user_id = $this->session->userdata('user_id');
        $this->admin_users_model->primary_key = array('user_id' => $user_id);
        $user_session_id = $this->admin_users_model->session_id();
        if (empty($user_id) && !empty($this->session->userdata['logged_session_id']) && $this->session->userdata['logged_session_id'] != md5($user_session_id) || !$this->admin_users_accesses_model->is_allowed($user_id, 45)) {
            redirect('logout');
        } else {
            $_SESSION['sidebar_menuitems'] = (!empty($_SESSION['sidebar_menuitems'])) ? $_SESSION['sidebar_menuitems'] : $this->admin_users_accesses_model->get_user_access($this->session->userdata('user_id'));
        }
        $permissions = $this->admin_users_accesses_model->get_permisions($user_id, 45);
        $this->permission = array($permissions->add_permission, $permissions->edit_permission, $permissions->delete_permission);
    }

    public function index() {
        $msg = array();
        $data['view'] = $this->class_name . '/list';
        $data['query'] = $this->feedbacks_model->view();
        $data['title'] = 'Feedbacks - ' . SITE_TITLE;
        $data['page_heading'] = 'Feedbacks List';
        $data['breadcrumb'] = "Feedbacks List";
        $data['scripts'] = array('javascripts/' . $this->class_name . '.js', 'javascripts/dashboard.js');
        $this->load->view('templates/dashboard', $data);
    }

    public function edit($feedback_id) {
		if (!empty($feedback_id)) {
			$this->feedbacks_model->primary_key = array('feedback_id' => $feedback_id);
			$data['query'] = $this->feedbacks_model->get_row($feedback_id);
			$data['view'] = $this->class_name . '/form';
			$data['title'] = 'View Feedbacks - ' . SITE_TITLE;
			$data['breadcrumb'] = "<a href=$this->class_name>Feedbacks List</a> &nbsp;&nbsp; > &nbsp;&nbsp; View Feedbacks";
			$data['page_heading'] = 'View Feedbacks';
			$data['scripts'] = array('javascripts/' . $this->class_name . '.js', 'javascripts/dashboard.js');
			$this->load->view('templates/dashboard', $data);
		} 
    }

}