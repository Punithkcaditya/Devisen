<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Widgets extends CI_Controller {

    private $widgets_upload_config;
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
        $this->load->model('widgets_model');
        $this->load->model('widget_areas_model');
        $this->load->model('templates_model');
        $this->load->model('page_types_model');
        
        $user_id = $this->session->userdata('user_id');
        $this->admin_users_model->primary_key = array('user_id' => $user_id);
        $user_session_id = $this->admin_users_model->session_id();
        if (empty($user_id) && !empty($this->session->userdata['logged_session_id']) && $this->session->userdata['logged_session_id'] != md5($user_session_id) || !$this->admin_users_accesses_model->is_allowed($user_id, 30)) {
            redirect('logout');
        } else {
            $_SESSION['sidebar_menuitems'] = (!empty($_SESSION['sidebar_menuitems'])) ? $_SESSION['sidebar_menuitems'] : $this->admin_users_accesses_model->get_user_access($this->session->userdata('user_id'));
        }
        $permissions = $this->admin_users_accesses_model->get_permisions($user_id, 30);
        $this->permission = array($permissions->add_permission, $permissions->edit_permission, $permissions->delete_permission);

        $this->widgets_upload_config = array('upload_path' => WIDGETS_UPLOAD_PATH, 'allowed_types' => 'gif|jpg|png|jpeg');
        $this->upload->initialize($this->widgets_upload_config);
    }

    public function index() {
        $msg = array();
        $data['view'] = $this->class_name . '/list';
        $data['query'] = $this->widgets_model->view();
        
        $data['title'] = 'Widget - ' . SITE_TITLE;
        $data['page_heading'] = 'Widget List';
        $data['breadcrumb'] = "Widget List";
        $data['scripts'] = array('javascripts/' . $this->class_name . '.js', 'javascripts/dashboard.js');
        $this->load->view('templates/dashboard', $data);
    }

    public function add() {
        if ($this->permission[0] > 0) {
            $msg = array();
            $data['view'] = $this->class_name . '/form';
            $data['title'] = 'Add New Widget - ' . SITE_TITLE;
            $data['breadcrumb'] = "<a href=$this->class_name>Widget List</a> &nbsp;&nbsp; > &nbsp;&nbsp; Add New Widget";
            $data['page_heading'] = 'Add New Widget';
            $data['page_type'] = $this->page_types_model->get_widget_types();
            
            $this->templates_model->db->where('allow_customize', '1');
            $data['templates'] = $this->templates_model->view();
            $data['area'] = $this->widget_areas_model->view();
            $data['scripts'] = array('javascripts/' . $this->class_name . '.js', 'javascripts/dashboard.js');
            $this->load->view('templates/dashboard', $data);
        } else {
            $msg = array();
            $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! You do not have the permission.');
            $this->session->set_flashdata('msg', $msg);
            redirect("/$this->class_name/");
        }
    }

    public function edit($widget_id) {
        if ($this->permission[1] > 0) {
            if (!empty($widget_id)) {
                $this->widgets_model->primary_key = array('widget_id' => $widget_id);
                $data['query'] = $this->widgets_model->get_row();
                $data['page_type'] = $this->page_types_model->get_widget_types();
                $this->templates_model->db->where('allow_customize', '1');
                $data['templates'] = $this->templates_model->view();
                $data['area'] = $this->widget_areas_model->view();
               
                if (!empty($data['query']->widget_type)) {
                    $data['ddwidgetcontent'] = $this->ddwidgetcontent($data['query']->widget_type);
                }
                $data['view'] = $this->class_name . '/form';
                $data['title'] = 'Edit Widget - ' . SITE_TITLE;
                $data['breadcrumb'] = "<a href=$this->class_name>Widget List</a> &nbsp;&nbsp; > &nbsp;&nbsp; Edit Widget";
                $data['page_heading'] = 'Edit Widget';
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

    private function set_upload_options() {
        //upload an image options
        $config = array();
        $config['upload_path'] = USER_PHOTO_UPLOAD_PATH;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '0';
        $config['overwrite'] = FALSE;
        return $config;
    }

    public function save() {
        if (!empty($_POST) && ($this->permission[0] > 0 || $this->permission[1] > 0)) {
            $widget_id = $this->input->post('widget_id');
            $this->widgets_model->data = $this->input->post();
            $user_photo = $_FILES['content_image']['name'];
            if (!empty($user_photo) && $this->upload->do_upload('content_image')) {
                $upload_data = $this->upload->data();
                $this->widgets_model->data['content_image'] = $upload_data['file_name'];
                $this->createthumbs(array($upload_data['file_name']));
            } else {
                $data['form_error']['content_image'] = $this->upload->display_errors();
            }

            if (!empty($widget_id)) {
                $this->widgets_model->data['last_modified_date'] = date('Y-m-d');
                $this->widgets_model->data['last_modified_by'] = $this->session->userdata('user_id');
                $this->widgets_model->primary_key = array('widget_id' => $widget_id);
                if ($this->widgets_model->update()) {
                    $msg = array('type' => 'success', 'icon' => 'fa fa-check', 'txt' => 'Record Updated Successfully');
                } else {
                    $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! Unable to Update Record.');
                }
            } else {
                unset($this->widgets_model->data['widget_id']);
                $this->widgets_model->data['created_date'] = date('Y-m-d');
                $this->widgets_model->data['created_by'] = $this->session->userdata('user_id');
                if ($this->widgets_model->insert()) {
                    $msg = array('type' => 'success', 'icon' => 'fa fa-check', 'txt' => 'Record Added Successfully');
                } else {
                    $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! Unable to Add Record.');
                }
            }
        } else {
            $msg = array();
            $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! You do not have the permission.');
        }
        $this->session->set_flashdata('msg', $msg);
        redirect("/$this->class_name/");
    }

    public function delete($widget_id) {
        if (!empty($widget_id) && $this->permission[2] > 0) {
            $this->widgets_model->primary_key = array('widget_id' => $widget_id);
            if ($this->widgets_model->delete()) {
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

    private function ddwidgetcontent($widget_type) {
      $this->page_types_model->primary_key = array('type_id' => $widget_type);
        $page_type = $this->page_types_model->get_row();
        $content_model = $page_type->model_name;
        $value_field = $page_type->value_field;
        $text_field = $page_type->text_field;
        $this->load->model($content_model);
        
        if ($widget_type == 8) {
            $this->$content_model->db->where('story_type', 1);
            //die;
        } elseif ($widget_type == 9) {
            $this->$content_model->db->where('story_type', 2);
        } elseif ($widget_type == 10) {
            $this->$content_model->db->where('story_type', 4);
        } elseif ($widget_type == 11) {
            $this->$content_model->db->where('story_type', 3);
        } elseif ($widget_type == 20) {
            $this->$content_model->db->where('p.type_id', 20);
        }
         $result_array = $this->$content_model->view();
        $widgetcontent = array();
        foreach ($result_array as $result) {
            $widgetcontent[] = array('value' => $result->$value_field, 'text' => $result->$text_field);
        }
        return $widgetcontent;
    }
    
    public function createthumbs($files = array()) {
        if (count($files) == 0) {
            $files = scandir(V);
        }
        foreach ($files as $file) {
            if (is_file(WIDGETS_UPLOAD_PATH . $file)) {
                //Start of Resize image code
                $image_config['image_library'] = 'gd2';
                $image_config['source_image'] = WIDGETS_UPLOAD_PATH . $file;
                $image_config['new_image'] = WIDGETS_UPLOAD_PATH_THUMB . $file;
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