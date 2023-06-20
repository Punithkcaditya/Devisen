<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

    private $wall_photos_upload_config;
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
        $this->load->model('pages_model');
        $this->load->model('page_types_model');
        $this->load->model('templates_model');
        
        $user_id = $this->session->userdata('user_id');
        $this->admin_users_model->primary_key = array('user_id' => $user_id);
        $user_session_id = $this->admin_users_model->session_id();
        if (empty($user_id) && !empty($this->session->userdata['logged_session_id']) && $this->session->userdata['logged_session_id'] != md5($user_session_id) || !$this->admin_users_accesses_model->is_allowed($user_id, 13)) {
            redirect('logout');
        } else {
            $_SESSION['sidebar_menuitems'] = (!empty($_SESSION['sidebar_menuitems'])) ? $_SESSION['sidebar_menuitems'] : $this->admin_users_accesses_model->get_user_access($this->session->userdata('user_id'));
        }

        $permissions = $this->admin_users_accesses_model->get_permisions($user_id, 13);
        $this->permission = array($permissions->add_permission, $permissions->edit_permission, $permissions->delete_permission);
        $this->wall_photos_upload_config = array('upload_path' => PAGES_PHOTO_UPLOAD_PATH, 'allowed_types' => 'gif|jpg|png|jpeg');
        $this->upload->initialize($this->wall_photos_upload_config);
    }

    public function index() {
        $msg = array();
        $data['view'] = $this->class_name . '/list';
        $data['query'] = $this->pages_model->view();
        $data['title'] = 'Page - ' . SITE_TITLE;
        $data['page_heading'] = 'Pages List';
        $data['breadcrumb'] = "Pages List";
        $data['scripts'] = array('javascripts/' . $this->class_name . '.js', 'javascripts/dashboard.js');
        $this->load->view('templates/dashboard', $data);
    }

    public function add() {
        if ($this->permission[0] > 0) {
            $msg = array();
            $data['view'] = $this->class_name . '/form';
            $data['title'] = 'Add New Page - ' . SITE_TITLE;
            $data['page_type'] = $this->page_types_model->page_type();
            $data['templates'] = $this->templates_model->view();
            $data['breadcrumb'] = "<a href=$this->class_name>Pages List</a> &nbsp;&nbsp; > &nbsp;&nbsp; Add New Page";
            $data['page_heading'] = 'Add New Page';
            $data['scripts'] = array('javascripts/' . $this->class_name . '.js', 'javascripts/dashboard.js');
            $this->load->view('templates/dashboard', $data);
        } else {
            $msg = array();
            $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! You do not have the permission.');
            $this->session->set_flashdata('msg', $msg);
            redirect("/$this->class_name/");
        }
    }

    public function edit($page_id) {
        if ($this->permission[1] > 0) {
            if (!empty($page_id)) {
                $this->pages_model->primary_key = array('page_id' => $page_id);
                $data['query'] = $this->pages_model->get_row($page_id);
                $data['page_type'] = $this->page_types_model->page_type();
                $data['templates'] = $this->templates_model->view();
                $data['view'] = $this->class_name . '/form';
                $data['title'] = 'Edit Page - ' . SITE_TITLE;
                $data['breadcrumb'] = "<a href=$this->class_name>Pages List</a> &nbsp;&nbsp; > &nbsp;&nbsp; Edit Page";
                $data['page_heading'] = 'Edit Page';
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
            $page_slug = $this->input->post('page_slug');
            if (!empty($page_slug)) {
                $this->form_validation->set_rules('page_slug', 'page Slug', 'required|callback_check_duplicate_slug');
            }
            $page_id = $this->input->post('page_id');
            $this->pages_model->data = $this->input->post();
            
            // Image Upload Code Begins Here
            if (!empty($_FILES['photo_path']['name']) && $this->upload->do_upload('photo_path')) {
                $upload_data = $this->upload->data();
                $this->pages_model->data['photo_path'] = $upload_data['file_name'];
                $this->createthumbs(array($upload_data['file_name']));
            } else {
                $data['form_error']['photo_path'] = $this->upload->display_errors();
            }
            //Image Upload Code end here
            if ($this->form_validation->run() == true) {
                if (!empty($page_id)) {
                    $this->pages_model->data['last_modified_date'] = date('Y-m-d');
                    $this->pages_model->data['last_modified_by'] = $this->session->userdata('user_id');
                    $this->pages_model->primary_key = array('page_id' => $page_id);
                    if ($this->pages_model->update()) {
                        $msg = array('type' => 'success', 'icon' => 'fa fa-check', 'txt' => 'Record Updated Successfully');
                    } else {
                        $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! Unable to Update Record.');
                    }
                } else {
                    unset($this->pages_model->data['page_id']);
                    $this->pages_model->data['created_date'] = date('Y-m-d');
                    $this->pages_model->data['created_by'] = $this->session->userdata('user_id');
                    if ($this->pages_model->insert()) {
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
                $data['page_heading'] = 'Add/Edit pages';
                $data['scripts'] = array('javascripts/' . $this->class_name . 'js');
                $this->load->view('templates/dashboard', $data);
            }
        } else {
            $msg = array();
            $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! You do not have the permission.');
            $this->session->set_flashdata('msg', $msg);
            redirect("/$this->class_name/");
        }
    }

    public function check_duplicate_slug() {
        $page_slug = $this->input->post('page_slug');
        $page_id = $this->input->post('page_id');
        $page_id = (!empty($page_id)) ? $this->input->post('page_id') : 0;
        if ($this->pages_model->check_duplicate_slug('page_slug', $page_slug, $page_id)) {
            $this->form_validation->set_message('check_duplicate_slug', 'Sorry! Page Slug aready exist.');
            return false;
        }
        return true;
    }

    public function delete($page_id) {
        if (!empty($page_id) && $this->permission[2] > 0) {
            $this->pages_model->primary_key = array('page_id' => $page_id);
            if ($this->pages_model->delete()) {
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

    public function removeimg($page_id) {
        if ($this->permission[2] > 0) {
            if (!empty($page_id)) {
                $this->pages_model->primary_key = array('page_id' => $page_id);
                if ($this->pages_model->update_image($page_id)) {
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
            $files = scandir(PAGES_PHOTO_UPLOAD_PATH);
        }
        foreach ($files as $file) {
            if (is_file(PAGES_PHOTO_UPLOAD_PATH . $file)) {
                //Start of Resize image code
                $image_config['image_library'] = 'gd2';
                $image_config['source_image'] = PAGES_PHOTO_UPLOAD_PATH . $file;
                $image_config['new_image'] = PAGES_PHOTO_UPLOAD_PATH_THUMB . $file;
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