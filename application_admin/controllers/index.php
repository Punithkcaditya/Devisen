<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin_users_model');
        $this->load->model('admin_users_accesses_model');
    }

    public function index() {
  
        $msg = array();
        $user_id = $this->session->userdata('user_id');
        if (!empty($user_id)) {
            redirect('dashboard');
        }
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        if ($this->form_validation->run() == true) {
            $login_detail = (array) $this->admin_users_model->login($this->input->post());
            if (!empty($login_detail) && $login_detail > 0) {
                unset($login_detail['user_session_id']);
                $user_session_id = rand(1000, 9999) . rand(1000, 9999);
                $this->admin_users_model->data['user_session_id'] = $user_session_id;
                $login_detail['logged_session_id'] = md5($user_session_id);
                $this->session->set_userdata($login_detail);
                $this->admin_users_model->primary_key = array('user_id' => $this->session->userdata('user_id'));
                $this->admin_users_model->update();
                redirect('dashboard');
            } else {
                $msg = array('txt' => 'Invalid Username and Password!');
                $this->session->set_flashdata('msg', $msg);
                redirect('');
            }
        }
        $data['view'] = 'index/index';
        $data['title'] = 'Login Page - ' . SITE_TITLE;
        $this->load->view('templates/default', $data);
    }

    public function dashboard() {
        $user_id = $this->session->userdata('user_id');
        $this->admin_users_model->primary_key = array('user_id' => $user_id);
        $user_session_id = $this->admin_users_model->session_id();
        if (empty($user_id) && $this->session->userdata['logged_session_id'] != md5($user_session_id)) {
            redirect('');
        } else {
            $_SESSION['sidebar_menuitems'] = (!empty($_SESSION['sidebar_menuitems'])) ? $_SESSION['sidebar_menuitems'] : $this->admin_users_accesses_model->get_user_access($this->session->userdata('user_id'));
        }

        $data['view'] = 'dashboard/index';
        $data['title'] = 'Administrator Dashboard - Creative Yogi Portal';
        $data['page_heading'] = 'Welcome to Administrative';
        $data['sub_heading'] = 'Control panel';
        $data['breadcrumb'] = "Dashboard";
        $data['scripts'] = array('javascripts/dashboard.js');
        $this->load->view('templates/dashboard', $data);
    }

    public function logout() {
        $this->session->sess_destroy();
       // session_destroy();
        redirect('');
    }

}
