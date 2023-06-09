<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Banners extends CI_Controller {

    private $event_photos_upload_config;
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
        $this->load->model('banners_model');
        $user_id = $this->session->userdata('user_id');
        $this->admin_users_model->primary_key = array('user_id' => $user_id);
        $user_session_id = $this->admin_users_model->session_id();
        if (empty($user_id) && !empty($this->session->userdata['logged_session_id']) && $this->session->userdata['logged_session_id'] != md5($user_session_id) || !$this->admin_users_accesses_model->is_allowed($user_id, 25)) {
            redirect('logout');
        } else {
            $_SESSION['sidebar_menuitems'] = (!empty($_SESSION['sidebar_menuitems'])) ? $_SESSION['sidebar_menuitems'] : $this->admin_users_accesses_model->get_user_access($this->session->userdata('user_id'));
        }
        $permissions = $this->admin_users_accesses_model->get_permisions($user_id, 25);
        $this->permission = array($permissions->add_permission, $permissions->edit_permission, $permissions->delete_permission);

        $this->event_photos_upload_config = array('upload_path' => BANNERS_PHOTO_UPLOAD_PATH, 'allowed_types' => 'gif|jpg|png|jpeg');
        $this->upload->initialize($this->event_photos_upload_config);
    }

    public function index() {
        $msg = array();
        $data['view'] = $this->class_name . '/list';
        $data['query'] = $this->banners_model->view();
        $data['title'] = 'Admin Page Page - ' . SITE_TITLE;
        $data['page_heading'] = 'Banners List';
        $data['breadcrumb'] = "Banners List";
        $data['scripts'] = array('javascripts/' . $this->class_name . '.js', 'javascripts/dashboard.js');
        $this->load->view('templates/dashboard', $data);
    }

    public function add() {
        if ($this->permission[0] > 0) {
            $msg = array();
            $data['view'] = $this->class_name . '/form';
            $data['title'] = 'Add New Banner - ' . SITE_TITLE;
            $data['breadcrumb'] = "<a href=$this->class_name>Banners List</a> &nbsp;&nbsp; > &nbsp;&nbsp; Add New Banner";
            $data['page_heading'] = 'Add New Banner';
            $data['scripts'] = array('javascripts/' . $this->class_name . '.js', 'javascripts/dashboard.js');
            $this->load->view('templates/dashboard', $data);
        } else {
            $msg = array();
            $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! You do not have the permission.');
            $this->session->set_flashdata('msg', $msg);
            redirect("/$this->class_name/");
        }
    }

    public function edit($banner_id) {
        if ($this->permission[1] > 0) {
            if (!empty($banner_id)) {
                $this->banners_model->primary_key = array('banner_id' => $banner_id);
                $data['query'] = $this->banners_model->get_row($banner_id);
                $data['view'] = $this->class_name . '/form';
                $data['title'] = 'Edit Page Profile - ' . SITE_TITLE;
                $data['breadcrumb'] = "<a href=$this->class_name>Banners List</a> &nbsp;&nbsp; > &nbsp;&nbsp; Edit Banner";
                $data['page_heading'] = 'Edit Banner';
                $data['scripts'] = array('javascripts/' . $this->class_name . '.js', 'javascripts/dashboard.js');
                $this->load->view('templates/dashboard', $data);
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
            $data['form_error']['banner_path'] = '';
            $banner_id = $this->input->post('banner_id');
            $banner_path = $this->input->post('banner_path', TRUE);
            $this->banners_model->data = $this->input->post();
            if (empty($banner_id) && empty($_FILES['banner_path']['name'])) {
                $this->form_validation->set_rules('banner_path', 'Banner Image', 'required');
            } else {
                if (!empty($_FILES['banner_path']['name'])) {
                    $this->form_validation->set_rules('banner_path', 'Banner Image', 'callback_check_image_width_height');
                } else {
                    $this->form_validation->set_rules('banner_path', 'Banner Image', 'required');
                }
            }
            if ($this->form_validation->run() == true && empty($data['form_error']['banner_path'])) {
                // Image Upload Code Begins Here
                if (!empty($_FILES['banner_path']['name']) && $this->upload->do_upload('banner_path')) {
                    $upload_data = $this->upload->data();
                    $this->banners_model->data['banner_path'] = $upload_data['file_name'];
                    $this->createthumbs(array($upload_data['file_name']));
                } else {
                    $data['form_error']['banner_path'] = $this->upload->display_errors();
                }
                //Image Upload Code end here
                if (!empty($banner_id)) {
                    $this->banners_model->data['last_modified_date'] = date('Y-m-d');
                    $this->banners_model->data['last_modified_by'] = $this->session->userdata('user_id');
                    $this->banners_model->primary_key = array('banner_id' => $banner_id);
                    if ($this->banners_model->update()) {
                        $msg = array('type' => 'success', 'icon' => 'fa fa-check', 'txt' => 'Record Updated Successfully');
                    } else {
                        $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! Unable to Update Record.');
                    }
                } else {
                    unset($this->banners_model->data['banner_id']);
                    $this->banners_model->data['created_date'] = date('Y-m-d');
                    $this->banners_model->data['created_by'] = $this->session->userdata('user_id');
                    if ($this->banners_model->insert()) {
                        $msg = array('type' => 'success', 'icon' => 'fa fa-check', 'txt' => 'Record Added Successfully');
                    } else {
                        $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! Unable to Add Record.');
                    }
                }
                $this->session->set_flashdata('msg', $msg);
                redirect("/$this->class_name/");
            } else {
                $data['query'] = (object) $this->input->post();
                $data['view'] = "/$this->class_name/form";
                $data['title'] = 'Administrator Dashboard - Phillipcapital';
                $data['page_heading'] = 'Add/Edit Banner';
                $data['breadcrumb'] = "<a href=$this->class_name>Banners List</a> &nbsp;&nbsp; > &nbsp;&nbsp; Edit Banner";
                $data['scripts'] = array('javascripts/' . $this->class_name . '.js');
                $this->load->view('templates/dashboard', $data);
            }
        } else {
            $msg = array();
            $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! You do not have the permission.');
            $this->session->set_flashdata('msg', $msg);
            redirect("/$this->class_name/");
        }
    }

    public function check_image_width_height() {

        if (!empty($_FILES['banner_path']['name'])) {
            $upload_dataa = $this->upload->data();
            $img_size = getimagesize($_FILES['banner_path']['tmp_name']);
            $imgwidth = $img_size[0];
            $imgheight = $img_size[1];
            return true;
            if ($imgwidth == 1350 && $imgheight == 560) {
                return true;
            } else {
                $this->form_validation->set_message('check_image_width_height', 'Sorry! Banner Image Size Should be 1350 width and 560 height.');
                return false;
            }
        }
    }

    public function delete($banner_id) {
        if (!empty($banner_id) && $this->permission[2] > 0) {
            $this->banners_model->primary_key = array('banner_id' => $banner_id);
            if ($this->banners_model->delete()) {
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

    public function removeimg($banner_id) {
        if ($this->permission[2] > 0) {
            if (!empty($banner_id)) {
                $this->banners_model->primary_key = array('banner_id' => $banner_id);
                if ($this->banners_model->update_image($banner_id)) {
                    $msg = array('type' => 'success', 'icon' => 'fa fa-check', 'txt' => 'Image Removed Successfully');
                } else {
                    $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! Unable to Remove.');
                }
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

    public function createthumbs($files = array()) {
        if (count($files) == 0) {
            $files = scandir(BANNERS_PHOTO_UPLOAD_PATH);
        }
        foreach ($files as $file) {
            if (is_file(BANNERS_PHOTO_UPLOAD_PATH . $file)) {
                //Start of Resize image code
                $image_config['image_library'] = 'gd2';
                $image_config['source_image'] = BANNERS_PHOTO_UPLOAD_PATH . $file;
                $image_config['new_image'] = BANNERS_PHOTO_UPLOAD_PATH_THUMB . $file;
                $image_config['maintain_ratio'] = FALSE;
                $image_config['width'] = 400;
                $image_config['height'] = 166;
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