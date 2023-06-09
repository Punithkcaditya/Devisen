<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Adminusers extends CI_Controller {

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
        //$this->load->model('countries_model');
        //$this->load->model('states_model');
        $user_id = $this->session->userdata('user_id');
        $this->admin_users_model->primary_key = array('user_id' => $user_id);
        $user_session_id = $this->admin_users_model->session_id();
        if (empty($user_id) && $this->session->userdata['logged_session_id'] != md5($user_session_id) || !$this->admin_users_accesses_model->is_allowed($user_id, 1)) {
            redirect('logout');
        } else {
            $_SESSION['sidebar_menuitems'] = (!empty($_SESSION['sidebar_menuitems'])) ? $_SESSION['sidebar_menuitems'] : $this->admin_users_accesses_model->get_user_access($this->session->userdata('user_id'));
        }
        $permissions = $this->admin_users_accesses_model->get_permisions($user_id, 1);
        $this->permission = array($permissions->add_permission, $permissions->edit_permission, $permissions->delete_permission);
        
    }

    public function index() {
        $msg = array();
        $data['view'] = $this->class_name . '/users_list';
        $data['query'] = $this->admin_users_model->view();
        $data['title'] = 'Admin User Page - ' . SITE_TITLE;
        $data['page_heading'] = 'Admin Users List';
        $data['breadcrumb'] = "Users List";
        $data['scripts'] = array('javascripts/' . $this->class_name . '.js', 'javascripts/dashboard.js');
        $this->load->view('templates/dashboard', $data);
    }

    public function add() {
        if ($this->permission[0] > 0) {
            $msg = array();
            $data['roles'] = $this->admin_roles_model->view_roles();
            //$data['countries'] = $this->countries_model->countryView(1);
            //$data['states'] = $this->states_model->stateView();
            $data['view'] = $this->class_name . '/form';
            $data['title'] = 'Add New User - ' . SITE_TITLE;
            $data['breadcrumb'] = "<a href=$this->class_name>Users List</a> &nbsp;&nbsp; > &nbsp;&nbsp; Add New User";
            $data['page_heading'] = 'Add New User';
            $data['scripts'] = array('javascripts/' . $this->class_name . '.js', 'javascripts/dashboard.js');
            $this->load->view('templates/dashboard', $data);
        } else {
            $msg = array();
            $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! You do not have the permission.');
            $this->session->set_flashdata('msg', $msg);
            redirect("/$this->class_name/");
        }
    }

    public function edit($admin_user_id) {
        if ($this->permission[1] > 0) {
            if (!empty($admin_user_id)) {
                $this->admin_users_model->primary_key = array('user_id' => $admin_user_id);
                $data['query'] = $this->admin_users_model->get_row();
                $data['roles'] = $this->admin_roles_model->view_roles();
                //$data['countries'] = $this->countries_model->countryView(1);
                //$data['states'] = $this->states_model->stateView();
                $data['view'] = $this->class_name . '/form';
                $data['title'] = 'Edit User Profile - ' . SITE_TITLE;
                $data['breadcrumb'] = "<a href=$this->class_name>Users List</a> &nbsp;&nbsp; > &nbsp;&nbsp; Edit User";
                $data['page_heading'] = 'Edit User';
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
            $admin_user_id = $this->input->post('user_id'); 
            $this->admin_users_model->data = $this->input->post();
            if (!empty($admin_user_id)) {
                $this->admin_users_model->data['password'] = md5($this->input->post('password'));
                $this->admin_users_model->data['modified_date'] = date('Y-m-d');
                $this->admin_users_model->data['modified_by'] = $this->session->userdata('user_id');
                $this->admin_users_model->primary_key = array('user_id' => $admin_user_id);
                if ($this->admin_users_model->update()) {
                    $msg = array('type' => 'success', 'icon' => 'fa fa-check', 'txt' => 'Record Updated Successfully');
                } else {
                    $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! Unable to Update Record.');
                }
            } else {
                $this->admin_users_model->data['password'] = md5($this->input->post('password'));
                $this->admin_users_model->data['created_date'] = date('Y-m-d');
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
        //$data['countries'] = $this->countries_model->countryView(1);
        //$data['states'] = $this->states_model->stateView();
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

    public function profile() {
        $msg = array();
        $data['view'] = $this->class_name . '/profile';
        $this->admin_users_model->primary_key = array('user_id' => $this->session->userdata('user_id'));
        $data['query'] = $this->admin_users_model->get_row();
        $data['title'] = 'User Profile - ' . SITE_TITLE;
        $data['page_heading'] = 'User Profile';
        $data['breadcrumb'] = "User Profile";
        $data['scripts'] = array('javascripts/' . $this->class_name . '.js', 'javascripts/dashboard.js');
        $this->load->view('templates/dashboard', $data);
    }

    public function access($user_id) {
        if (!empty($user_id) && ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 2)) {
            $accesses = array();
            $data['query'] = $this->admin_menuitems_model->view();
            $roles_accesses = $this->admin_users_accesses_model->view($user_id);
            foreach ($roles_accesses as $row) {
                $accesses[] = $row->menuitem_id;
            }
            $data['user_id'] = $user_id;
            $data['admin_users_accesses'] = $accesses;
            $data['view'] = $this->class_name . '/accessform';
            $data['title'] = 'User Access - ' . SITE_TITLE;
            $data['page_heading'] = 'User Access';
            $data['breadcrumb'] = "User Access";
            $data['scripts'] = array('javascripts/' . $this->class_name . '.js', 'javascripts/dashboard.js');
            $this->load->view('templates/dashboard', $data);
        } else {
            $msg = array();
            $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! You do not have the permission.');
            $this->session->set_flashdata('msg', $msg);
            redirect("/$this->class_name/");
        }
    }

    public function permission($user_id) {
        if (!empty($user_id) && ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 2)) {
            $accesses = array();
            $roles_accesses = $this->admin_users_accesses_model->view_access($user_id);
            foreach ($roles_accesses as $row) {
                $accesses[] = $row->menuitem_id;
            }
            $data['user_id'] = $user_id;
            $data['query'] = $roles_accesses; //$_SESSION['sidebar_menuitems'];
            $data['view'] = $this->class_name . '/permissionform';
            $data['title'] = 'User Access - ' . SITE_TITLE;
            $data['page_heading'] = 'User Access';
            $data['breadcrumb'] = "User Access";
            $data['scripts'] = array('javascripts/' . $this->class_name . '.js', 'javascripts/dashboard.js');
            $this->load->view('templates/dashboard', $data);
        } else {
            $msg = array();
            $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! You do not have the permission.');
            $this->session->set_flashdata('msg', $msg);
            redirect("/$this->class_name/");
        }
    }

    public function saveaccess() {
        if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 2) {
            $status = true;
            $user_id = $this->input->post('user_id');
            $this->admin_users_accesses_model->primary_key = array('user_id' => $user_id);
            if ($this->admin_users_accesses_model->delete()) {
                $menuitem_ids = $this->input->post('menuitem_id');
                foreach ($menuitem_ids as $menuitem_id) {
                    $this->admin_users_accesses_model->data = array('menuitem_id' => $menuitem_id, 'user_id' => $user_id);
                    if ($this->admin_users_accesses_model->insert()) {
                        $status = true;
                    }
                }
            }

            if ($status) {
                $msg = array('type' => 'success', 'icon' => 'icon-ok green', 'txt' => 'Save Changes Updated Successfully');
            } else {
                $msg = array('type' => 'error', 'icon' => 'icon-remove red', 'txt' => 'Sorry! Unable to Delete.');
            }
        } else {
            $msg = array();
            $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! You do not have the permission.');
        }
        $this->session->set_flashdata('msg', $msg);
        redirect("/$this->class_name/");
    }

    public function savepermission() {
        if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 2) {
            $status = true;
            $user_id = $this->input->post('user_id');
            $menuitem_ids = $this->input->post('menuitem_id');
            $i = 0;
            foreach ($menuitem_ids as $menuitem_id) {
                $add_permission = $this->input->post('add_permission');
                if (!empty($add_permission[$i])) {
                    $add_permission = $add_permission[$i];
                } else {
                    $add_permission = 0;
                }
                if (!empty($this->input->post('edit_permission')[$i])) {
                    $edit_permission = $this->input->post('edit_permission')[$i];
                } else {
                    $edit_permission = 0;
                }
                if (!empty($this->input->post('delete_permission')[$i])) {
                    $delete_permission = $this->input->post('delete_permission')[$i];
                } else {
                    $delete_permission = 0;
                }
                $this->admin_users_accesses_model->data = array('add_permission' => $add_permission, 'edit_permission' => $edit_permission, 'delete_permission' => $delete_permission);
                $this->admin_users_accesses_model->primary_key = array('menuitem_id' => $menuitem_id);
                if ($this->admin_users_accesses_model->update()) {
                    $status = true;
                }
                $i++;
            }
            if ($status) {
                $msg = array('type' => 'success', 'icon' => 'icon-ok green', 'txt' => 'Save Changes Updated Successfully');
            } else {
                $msg = array('type' => 'error', 'icon' => 'icon-remove red', 'txt' => 'Sorry! Unable to Delete.');
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
            $files = scandir(USER_PHOTO_UPLOAD_PATH);
        }
        foreach ($files as $file) {
            if (is_file(USER_PHOTO_UPLOAD_PATH . $file)) {
                //Start of Resize image code
                $image_config['image_library'] = 'gd2';
                $image_config['source_image'] = USER_PHOTO_UPLOAD_PATH . $file;
                $image_config['new_image'] = USER_PHOTO_UPLOAD_PATH_THUMB . $file;
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