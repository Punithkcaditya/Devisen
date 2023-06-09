<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Emailtemplates extends CI_Controller {

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
        $this->load->model('email_templates_model');
        $user_id = $this->session->userdata('user_id');
        $this->admin_users_model->primary_key = array('user_id' => $user_id);
        $user_session_id = $this->admin_users_model->session_id();
        if (empty($user_id) && !empty($this->session->userdata['logged_session_id']) && $this->session->userdata['logged_session_id'] != md5($user_session_id) || !$this->admin_users_accesses_model->is_allowed($user_id, 1)) {
            redirect('logout');
        } else {
            $_SESSION['sidebar_menuitems'] = (!empty($_SESSION['sidebar_menuitems'])) ? $_SESSION['sidebar_menuitems'] : $this->admin_users_accesses_model->get_user_access($this->session->userdata('user_id'));
        }
        $permissions = $this->admin_users_accesses_model->get_permisions($user_id, 1);
        $this->permission = array($permissions->add_permission, $permissions->edit_permission, $permissions->delete_permission);

    }

    public function index() {
        $msg = array();
        $data['view'] = $this->class_name . '/list';
        $data['query'] = $this->email_templates_model->view();
        $data['title'] = 'Admin Page Page - ' . SITE_TITLE;
        $data['page_heading'] = 'Email Template List';
        $data['breadcrumb'] = "Email Template List";
        $data['scripts'] = array('javascripts/' . $this->class_name . '.js', 'javascripts/dashboard.js');
        $this->load->view('templates/dashboard', $data);
    }

    public function add() {
        if ($this->permission[0] > 0) {
            $msg = array();
            $data['view'] = $this->class_name . '/form';
            $data['title'] = 'Add Email Template - ' . SITE_TITLE;
            $data['breadcrumb'] = "<a href=$this->class_name>Email Template List</a> &nbsp;&nbsp; > &nbsp;&nbsp; Add Email Template";
            $data['page_heading'] = 'Add Email Template';
            $data['scripts'] = array('javascripts/' . $this->class_name . '.js', 'javascripts/dashboard.js');
            $this->load->view('templates/dashboard', $data);
        } else {
            $msg = array();
            $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! You do not have the permission.');
            $this->session->set_flashdata('msg', $msg);
            redirect("/$this->class_name/");
        }
    }

    public function edit($template_id) {
        if ($this->permission[1] > 0) {
            if (!empty($template_id)) {
                $this->email_templates_model->primary_key = array('template_id' => $template_id);
                $data['query'] = $this->email_templates_model->get_row();
                $data['view'] = $this->class_name . '/form';
                $data['title'] = 'Edit Email Template - ' . SITE_TITLE;
                $data['breadcrumb'] = "<a href=$this->class_name>Email Template List</a> &nbsp;&nbsp; > &nbsp;&nbsp; Edit Page";
                $data['page_heading'] = 'Edit Email Templates';
                $data['scripts'] = array('javascripts/' . $this->class_name . '.js', 'javascripts/dashboard.js');
                $this->load->view('templates/dashboard', $data);
            } else {
                $msg = array();
                $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! unauthorised access.');
                $this->session->set_flashdata('msg', $msg);
                redirect("/$this->class_name/");
            }
        } else {
            $msg = array();
            $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! You do not have the permission.');
            $this->session->set_flashdata('msg', $msg);
            redirect("/$this->class_name/");
        }
    }

    public function save() {
        if (!empty($_POST) && ($this->permission[0] > 0 || $this->permission[1] > 0)) {
            $template_id = $this->input->post('template_id');
            $this->email_templates_model->data = $this->input->post();

            if (empty($template_id)) { // ADD case
                unset($this->email_templates_model->data['template_id']);
                $this->email_templates_model->data['created_date'] = date("Y-m-d H:i:s");
                $this->email_templates_model->data['created_by'] = $this->session->userdata('user_id');
                if ($this->email_templates_model->insert()) {
                    $msg = array('type' => 'success', 'icon' => 'fa fa-check', 'txt' => 'Record Inserted Successfully');
                } else {
                    $msg = array('type' => 'danger', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! Unable to Update Record.');
                }
            } else { // EDIT case                
                $this->email_templates_model->data['last_modified_date'] = date("Y-m-d H:i:s");
                $this->email_templates_model->data['last_modified_by'] = $this->session->userdata('user_id');
                $this->email_templates_model->primary_key = array('template_id' => $template_id);
                if ($this->email_templates_model->update()) {
                    $msg = array('type' => 'success', 'icon' => 'fa fa-check', 'txt' => 'Record updated successfully.');
                } else {
                    $msg = array('type' => 'danger', 'icon' => 'icon-remove red', 'txt' => 'Sorry! Unable to Update.');
                }
            }
            $this->session->set_flashdata('msg', $msg);
            redirect("/$this->class_name/");
        } else {
            $msg = array();
            $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! You do not have the permission.');
        }
        $this->session->set_flashdata('msg', $msg);
        redirect("/$this->class_name/");
    }

    public function delete($template_id) {
        if (!empty($template_id) && $this->permission[2] > 0) {
            $this->email_templates_model->primary_key = array('template_id' => $template_id);
            if ($this->email_templates_model->delete()) {
                $msg = array('type' => 'success', 'icon' => 'fa fa-check', 'txt' => 'Record Deleted Successfully');
            } else {
                $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! Unable to Add Record.');
            }
        } else {
            $msg = array();
            $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! You do not have the permission.');
        }
        $this->session->set_flashdata('msg', $msg);
        redirect("/$this->class_name/");
    }

}