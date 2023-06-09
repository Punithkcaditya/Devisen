<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

    private $wall_photos_upload_config;
    private $video_image_upload_config;
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
        $this->load->model('settings_model');
        $user_id = $this->session->userdata('user_id');
        $this->admin_users_model->primary_key = array('user_id' => $user_id);
        $user_session_id = $this->admin_users_model->session_id();
        if (empty($user_id) && !empty($this->session->userdata['logged_session_id']) && $this->session->userdata['logged_session_id'] != md5($user_session_id) || !$this->admin_users_accesses_model->is_allowed($user_id, 29)) {
            redirect('logout');
        } else {
            $_SESSION['sidebar_menuitems'] = (!empty($_SESSION['sidebar_menuitems'])) ? $_SESSION['sidebar_menuitems'] : $this->admin_users_accesses_model->get_user_access($this->session->userdata('user_id'));
        }
        $permissions = $this->admin_users_accesses_model->get_permisions($user_id, 29);
        $this->permission = array($permissions->add_permission, $permissions->edit_permission, $permissions->delete_permission);

        $this->wall_photos_upload_config = array('upload_path' => SETTINGS_UPLOAD_PATH, 'allowed_types' => 'gif|jpg|png|jpeg');
        $this->upload->initialize($this->wall_photos_upload_config);
		
    }

    public function index() {
        $msg = array();
        $data['view'] = $this->class_name . '/form';
        $data['query'] = $this->settings_model->view();
        $data['title'] = 'Page - ' . SITE_TITLE;
        $data['page_heading'] = 'Settings';
        $data['breadcrumb'] = "Settings";
        $data['scripts'] = array('javascripts/' . $this->class_name . '.js', 'javascripts/dashboard.js');
        $this->load->view('templates/dashboard', $data);
    }

    public function update() {
        if (!empty($_POST) && ($this->permission[0] > 0 || $this->permission[1] > 0)) {
            $data_all = array(
                'setting_value' => $this->input->post('setting_value'),
                'setting_id' => $this->input->post('setting_id'),
            );
            
            foreach ($data_all['setting_id'] as $key => $sid) {
                
                if (!empty($_FILES['setting_value_' . $key]['name']) && $this->upload->do_upload('setting_value_' . $key)) {
                    $upload_data = $this->upload->data();
                    $data_all['setting_value'][$key] = $upload_data['file_name'];
                }
                if (empty($data_all['setting_value'][$key])) {
                }
            }
            
            foreach ($data_all['setting_id'] as $key => $sid) {
                $status = true;
                $this->settings_model->data = array('setting_id' => $sid, 'setting_value' => !empty($data_all['setting_value'][$key]) ? $data_all['setting_value'][$key] : '');
                $this->settings_model->primary_key = array('setting_id' => $sid);
                if (!$this->settings_model->is_exist()) {
                    $this->db->query("INSERT INTO `settings`( `setting_id`, `type`, `setting_key`, `setting_name`, `setting_value`, `status_ind`)
                            SELECT `setting_id`, `type`, `setting_key`, `setting_name`, `setting_value`, `status_ind` FROM `settings` WHERE `setting_id` = $sid");
                }
                $this->settings_model->primary_key = array('setting_id' => $sid);
                if (!$this->settings_model->update()) {
                    $status = false;
                }
            }
            if ($status) {
                $msg = array('type' => 'success', 'icon' => 'icon-ok green', 'txt' => 'Save Changes Updated Successfully');
            } else {
                $msg = array('type' => 'error', 'icon' => 'icon-remove red', 'txt' => 'Sorry! Unable to Delete.');
            }
            $this->session->set_flashdata('msg', $msg);
            redirect('/settings/');
        } else {
            $msg = array();
            $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! You do not have the permission.');
            $this->session->set_flashdata('msg', $msg);
            redirect('/settings/');
        }
    }

    public function save() {
        
        if (!empty($_POST) && ($this->permission[0] > 0 || $this->permission[1] > 0)) {
            $admin_user_id = $this->input->post('user_id');
            $this->admin_users_model->data = $this->input->post();
            $user_photo = $_FILES['user_photo']['name'];
            if (!empty($user_photo) && $this->upload->do_upload('user_photo')) {
                $upload_data = $this->upload->data();
                $this->admin_users_model->data['user_photo'] = $upload_data['file_name'];
                $this->createthumbs(array($upload_data['file_name']));
            } else {
                $data['form_error']['user_photo'] = $this->upload->display_errors();
            }

            if (!empty($admin_user_id)) {
                $this->admin_users_model->data['password'] = md5($this->input->post('password'));
                $this->admin_users_model->data['modified_date'] = date('Y-m-d : H:i:s');
                $this->admin_users_model->data['modified_by'] = $this->session->userdata('user_id');
                $this->admin_users_model->primary_key = array('user_id' => $admin_user_id);
                if ($this->admin_users_model->update()) {
                    $msg = array('type' => 'success', 'icon' => 'fa fa-check', 'txt' => 'Record Updated Successfully');
                } else {
                    $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! Unable to Update Record.');
                }
            } else {
                $this->admin_users_model->data['created_date'] = date('Y-m-d : H:i:s');
                $this->admin_users_model->data['created_by'] = $this->session->userdata('user_id');
                if ($this->admin_users_model->insert()) {
                    $msg = array('type' => 'success', 'icon' => 'fa fa-check', 'txt' => 'Record Added Successfully');
                } else {
                    $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! Unable to Add Record.');
                }
            }
        } else {
            $msg = array();
            $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! You do not have the permission.');
        }
        $data['countries'] = $this->countries_model->countryView(1);
        $data['states'] = $this->states_model->stateView();
        $this->session->set_flashdata('msg', $msg);
        redirect("/$this->class_name/");
    }

    public function delete($user_id) {
        if (!empty($user_id) && $this->permission[2] > 0) {
            $this->admin_users_model->primary_key = array('user_id' => $user_id);
            if ($this->admin_users_model->delete()) {
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

    public function createthumbs($files = array()) {
        if (count($files) == 0) {
            $files = scandir(SETTINGS_UPLOAD_PATH);
        }
        foreach ($files as $file) {
            if (is_file(SETTINGS_UPLOAD_PATH . $file)) {
                //Start of Resize image code
                $image_config['image_library'] = 'gd2';
                $image_config['source_image'] = SETTINGS_UPLOAD_PATH . $file;
                $image_config['new_image'] = SETTINGS_UPLOAD_PATH_THUMB . $file;
                $image_config['maintain_ratio'] = FALSE;
                $image_config['width'] = 250;
                $image_config['height'] = 200;
                $image_config['x_axis'] = '100';
                $image_config['y_axis'] = '100';

                $this->image_lib->clear();
                $this->image_lib->initialize($image_config);

                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors();
                }
                //Resize image code end
            }
        }
    }

}