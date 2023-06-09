<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    public $class_name;
    private $report_upload_path;

    public function __construct() {
        parent::__construct();
        $this->class_name = strtolower(get_class());
        /* these are the default modules to load in all controller */
        $this->load->model('admin_roles_model');
        $this->load->model('admin_users_model');
        $this->load->model('admin_menuitems_model');
        $this->load->model('admin_users_accesses_model');
        /* these are the default modules to load in all controller */
        $this->load->model('master_model');
		
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

        $this->report_upload_path = array('upload_path' => REPORT_UPLOAD_PATH, 'allowed_types' => 'pdf');
        $this->upload->initialize($this->report_upload_path);

    }

    public function category() {
	
        $msg = array();
        $data['view'] = $this->class_name . '/category_list';
		
		$data['query'] = $this->master_model->get_data('report_category');
		
        $data['title'] = 'Admin Page - ' . SITE_TITLE;
        $data['page_heading'] = 'Report Category';
        $data['breadcrumb'] = "Report Category";
        $data['scripts'] = array('javascripts/report_category.js', 'javascripts/dashboard.js');
        $this->load->view('templates/dashboard', $data);
    }
	 public function category_add() {
        if ($this->permission[0] > 0) {
            $msg = array();
            $data['view'] = $this->class_name . '/category_form';
            $data['title'] = 'Add Report Category - ' . SITE_TITLE;
            $data['breadcrumb'] = "<a href=$this->class_name>Rports</a> &nbsp;&nbsp; > &nbsp;&nbsp; Add Report Category";
            $data['page_heading'] = 'Add Report Category';
            $data['scripts'] = array('javascripts/category.js', 'javascripts/dashboard.js');
            $this->load->view('templates/dashboard', $data);
        } else {
            $msg = array();
            $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! You do not have the permission.');
            $this->session->set_flashdata('msg', $msg);
            redirect("/$this->class_name/category");
        }
    }
	
	public function category_edit($report_category_id) {
        if ($this->permission[1] > 0) {
            if (!empty($report_category_id)) {
                $this->master_model->primary_key = array('report_category_id' => $report_category_id);
                $data['query'] = $this->master_model->get_row('report_category');
                $data['view'] = $this->class_name . '/category_form';
                $data['title'] = 'Edit Report Category - ' . SITE_TITLE;
                $data['breadcrumb'] = "<a href=$this->class_name>Report Category</a> &nbsp;&nbsp; > &nbsp;&nbsp; Edit Report Category";
                $data['page_heading'] = 'Edit Report Category';
                $data['scripts'] = array('javascripts/category.js', 'javascripts/dashboard.js');
                $this->load->view('templates/dashboard', $data);
            } else {
                $msg = array();
                $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! unauthorised access.');
                $this->session->set_flashdata('msg', $msg);
                redirect("/$this->class_name/category");
            }
        } else {
            $msg = array();
            $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! You do not have the permission.');
            $this->session->set_flashdata('msg', $msg);
            redirect("/$this->class_name/category");
        }
    }
	
	public function category_save(){
		$sess_user_id = $this->session->userdata('user_id');		
		$report_category_id = $this->input->post('report_category_id');
		
		$this->master_model->data = $this->input->post();
        if(empty($report_category_id)){//add Case
            unset($this->master_model->data['report_category_id']);
			if ($this->master_model->insert('report_category')) {
				$msg = array('type' => 'success', 'icon' => 'icon-ok green', 'txt' => 'Data Added Successfully');
			} else {
				$msg = array('type' => 'error', 'icon' => 'icon-remove red', 'txt' => 'Sorry! Unable to save.');
			}			
		}else{//edit Case
			unset($this->master_model->data['report_category_id']);				
			$this->master_model->primary_key = array('report_category_id' => $report_category_id);
			if ($this->master_model->update('report_category')){
				$msg = array('type' => 'success', 'icon' => 'icon-ok green', 'txt' => 'Data updated successfully.');
			}else{
				$msg = array('type' => 'error', 'icon' => 'icon-remove red', 'txt' => 'Sorry! Unable to Update.');
			}
		}
		$this->session->set_flashdata('msg',$msg);
		redirect("/$this->class_name/category");
			
	}
	public function category_delete($report_category_id){
		$this->master_model->primary_key = array('report_category_id' => $report_category_id);
		if($this->master_model->delete('report_category')){
			$msg = array('type' => 'success', 'icon' => 'icon-ok green', 'txt' => 'Data deleted Successfully');
		}else{
			$msg = array('type' => 'error', 'icon' => 'icon-remove red', 'txt' => 'Sorry! Unable to delete.');
		}
		$this->session->set_flashdata('msg',$msg);
		redirect("/$this->class_name/category");
	}
	
    public function index() {
	
        $msg = array();
        $data['view'] = $this->class_name . '/report_list';
		
		$data['query'] = $this->master_model->get_catjoin('report','report_category','report_category_id','report_category_id');
		
        $data['title'] = 'Admin Page - ' . SITE_TITLE;
        $data['page_heading'] = 'Reports';
        $data['breadcrumb'] = "Reports";
        $data['scripts'] = array('javascripts/report.js', 'javascripts/dashboard.js');
        $this->load->view('templates/dashboard', $data);
    }
	 public function report_add() {
        if ($this->permission[0] > 0) {
            $msg = array();
            $data['view'] = $this->class_name . '/report_form';
            $data['category'] = $this->master_model->get_data('report_category');
            $data['title'] = 'Add Report - ' . SITE_TITLE;
            $data['breadcrumb'] = "<a href=$this->class_name>Rports</a> &nbsp;&nbsp; > &nbsp;&nbsp; Add Report";
            $data['page_heading'] = 'Add Report';
            $data['scripts'] = array('javascripts/report.js', 'javascripts/dashboard.js');
            $this->load->view('templates/dashboard', $data);
        } else {
            $msg = array();
            $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! You do not have the permission.');
            $this->session->set_flashdata('msg', $msg);
            redirect("/$this->class_name");
        }
    }
	
	public function report_edit($report_id) {
        if ($this->permission[1] > 0) {
            if (!empty($report_id)) {
                $this->master_model->primary_key = array('report_id' => $report_id);
                $data['query'] = $this->master_model->get_row('report');
                $data['category'] = $this->master_model->get_data('report_category');
                $data['view'] = $this->class_name . '/report_form';
                $data['title'] = 'Edit Report - ' . SITE_TITLE;
                $data['breadcrumb'] = "<a href=$this->class_name>Report Category</a> &nbsp;&nbsp; > &nbsp;&nbsp; Edit Report";
                $data['page_heading'] = 'Edit Report';
                $data['scripts'] = array('javascripts/report.js', 'javascripts/dashboard.js');
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
	
	public function reportsave(){
		
		$sess_user_id = $this->session->userdata('user_id');		
		$report_id = $this->input->post('report_id');
		
        $this->master_model->data = $this->input->post();

        // Image Upload Code Begins Here
        if (!empty($_FILES['report_pdf']['name']) && $this->upload->do_upload('report_pdf')) {
            $upload_data = $this->upload->data();
            $this->master_model->data['report_pdf'] = $upload_data['file_name'];
        } else {
            $data['form_error']['report_pdf'] = $this->upload->display_errors();
        }
        
        //Image Upload Code end here
        $this->master_model->data['last_modified_date'] = date('Y-m-d');
        $this->master_model->data['last_modified_by'] = $this->session->userdata('user_id');
        if(empty($report_id)){//add Case
            unset($this->master_model->data['report_id']);
            $this->master_model->data['created_date'] = date('Y-m-d');
            $this->master_model->data['created_by'] = $this->session->userdata('user_id');
			if ($this->master_model->insert('report')) {
				$msg = array('type' => 'success', 'icon' => 'icon-ok green', 'txt' => 'Data Added Successfully');
			} else {
				$msg = array('type' => 'error', 'icon' => 'icon-remove red', 'txt' => 'Sorry! Unable to save.');
			}			
		}else{//edit Case
			unset($this->master_model->data['report_id']);				
            $this->master_model->primary_key = array('report_id' => $report_id);
            
			if ($this->master_model->update('report')){
				$msg = array('type' => 'success', 'icon' => 'icon-ok green', 'txt' => 'Data updated successfully.');
			}else{
				$msg = array('type' => 'error', 'icon' => 'icon-remove red', 'txt' => 'Sorry! Unable to Update.');
			}
		}
		$this->session->set_flashdata('msg',$msg);
		redirect("/$this->class_name/");
			
	}
	public function report_delete($report_id){
		$this->master_model->primary_key = array('report_id' => $report_id);
		if($this->master_model->delete('report')){
			$msg = array('type' => 'success', 'icon' => 'icon-ok green', 'txt' => 'Data deleted Successfully');
		}else{
			$msg = array('type' => 'error', 'icon' => 'icon-remove red', 'txt' => 'Sorry! Unable to delete.');
		}
		$this->session->set_flashdata('msg',$msg);
		redirect("/$this->class_name/");
	}
	
}