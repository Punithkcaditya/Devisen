<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Phrases extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('phrases_model');
        $this->load->model('admin_users_accesses_model');

        $user_id = $this->session->userdata('user_id');
        if (empty($user_id) || $this->session->userdata('user_id') != 1) {
            redirect('');
        } else {
            $_SESSION['sidebar_menuitems'] = (!empty($_SESSION['sidebar_menuitems'])) ? $_SESSION['sidebar_menuitems'] : $this->admin_users_accesses_model->get_user_access($this->session->userdata('user_id'));
        }

        $this->settings_upload_config = array('upload_path' => SETTINGS_UPLOAD_PATH, 'allowed_types' => 'gif|jpg|png|jpeg');
        $this->upload->initialize($this->settings_upload_config);
    }

    public function index($controller_name = 'general') {
        $data['controller_name'] = $controller_name;
        $data['controllers'] = $this->phrases_model->get_distinct_controller();
        $data['query'] = $this->phrases_model->view($controller_name);
        $data['view'] = 'phrases/form';
        $data['title'] = 'Administrator Dashboard - Phillipcapital';
        $data['page_heading'] = 'Phrases';
        $data['scripts'] = array('javascripts/phrases.js');
        $this->load->view('templates/dashboard', $data);
    }

    public function update() {
        $redirect = $this->input->post('controller_name');
        $data_all = array(
            'phrase_value' => $this->input->post('phrase_value'),
            'phrase_id' => $this->input->post('phrase_id'),
        );

        foreach ($data_all['phrase_id'] as $key => $pid) {
            $status = true;
            $this->phrases_model->data = array('phrase_id' => $pid, 'phrase_value' => $data_all['phrase_value'][$key]);
                $this->phrases_model->primary_key = array('phrase_id' => $pid);
                if ($this->phrases_model->update()) {
					$msg = array('type' => 'success', 'icon' => 'fa fa-check', 'txt' => 'Record Updated Successfully');
				} else {
					$msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! Unable to Update Record.');
				}
        }
        $this->session->set_flashdata('msg', $msg);        
        redirect('/phrases/');
        //redirect($redirect);
    }

}