<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

    public $class_name;
	public $calender_upload_path;

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

		$this->calender_upload_path = array('upload_path' =>CALENDER_UPLOAD_PATH, 'allowed_types' => '*');
        $this->upload->initialize($this->calender_upload_path);
    }

	//package Master start
    public function package() {
	
        $msg = array();
        $data['view'] = $this->class_name . '/package_list';
		
		$data['query'] = $this->master_model->get_data('package');
		
        $data['title'] = 'Admin Page - ' . SITE_TITLE;
        $data['page_heading'] = 'Package Master';
        $data['breadcrumb'] = "Package Master";
        $data['scripts'] = array('javascripts/package.js', 'javascripts/dashboard.js');
        $this->load->view('templates/dashboard', $data);
    }
	 public function package_add() {
        if ($this->permission[0] > 0) {
            $msg = array();
            $data['view'] = $this->class_name . '/package_form';
            $data['title'] = 'Add Package Master - ' . SITE_TITLE;
            $data['breadcrumb'] = "<a href=$this->class_name>Master</a> &nbsp;&nbsp; > &nbsp;&nbsp; Add Package Master";
            $data['page_heading'] = 'Add Package Master';
            $data['scripts'] = array('javascripts/package.js', 'javascripts/dashboard.js');
            $this->load->view('templates/dashboard', $data);
        } else {
            $msg = array();
            $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! You do not have the permission.');
            $this->session->set_flashdata('msg', $msg);
            redirect("/$this->class_name/package");
        }
    }
	
	public function package_edit($package_id) {
        if ($this->permission[1] > 0) {
            if (!empty($package_id)) {
                $this->master_model->primary_key = array('package_id' => $package_id);
                $data['query'] = $this->master_model->get_row('package');
                $data['view'] = $this->class_name . '/package_form';
                $data['title'] = 'Edit package Master - ' . SITE_TITLE;
                $data['breadcrumb'] = "<a href=$this->class_name>package Master</a> &nbsp;&nbsp; > &nbsp;&nbsp; Edit package Master";
                $data['page_heading'] = 'Edit package Master';
                $data['scripts'] = array('javascripts/package.js', 'javascripts/dashboard.js');
                $this->load->view('templates/dashboard', $data);
            } else {
                $msg = array();
                $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! unauthorised access.');
                $this->session->set_flashdata('msg', $msg);
                redirect("/$this->class_name/package");
            }
        } else {
            $msg = array();
            $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! You do not have the permission.');
            $this->session->set_flashdata('msg', $msg);
            redirect("/$this->class_name/package");
        }
    }
	
	public function package_save(){
		$sess_user_id = $this->session->userdata('user_id');		
		$package_id = $this->input->post('package_id');
		
		$this->master_model->data = $this->input->post();
        if(empty($package_id)){//add Case
            unset($this->master_model->data['package_id']);
			if ($this->master_model->insert('package')) {
				$msg = array('type' => 'success', 'icon' => 'icon-ok green', 'txt' => 'Data Added Successfully');
			} else {
				$msg = array('type' => 'error', 'icon' => 'icon-remove red', 'txt' => 'Sorry! Unable to save.');
			}			
		}else{//edit Case
			unset($this->master_model->data['package_id']);				
			$this->master_model->primary_key = array('package_id' => $package_id);
			if ($this->master_model->update('package')){
				$msg = array('type' => 'success', 'icon' => 'icon-ok green', 'txt' => 'Data updated successfully.');
			}else{
				$msg = array('type' => 'error', 'icon' => 'icon-remove red', 'txt' => 'Sorry! Unable to Update.');
			}
		}
		$this->session->set_flashdata('msg',$msg);
		redirect("/$this->class_name/package");
			
	}
	public function package_delete($package_id){
		$this->master_model->primary_key = array('package_id' => $package_id);
		if($this->master_model->delete('package')){
			$msg = array('type' => 'success', 'icon' => 'icon-ok green', 'txt' => 'Data deleted Successfully');
		}else{
			$msg = array('type' => 'error', 'icon' => 'icon-remove red', 'txt' => 'Sorry! Unable to delete.');
		}
		$this->session->set_flashdata('msg',$msg);
		redirect("/$this->class_name/package");
	}
	//package Master End
	
	
	//Customer Master start
    public function customer() {
	
        $msg = array();
        $data['view'] = $this->class_name . '/customer_list';
		
		$data['query'] = $this->master_model->getCustomer();

		$data['assign_package'] = false;
        $data['title'] = 'Admin Page - ' . SITE_TITLE;
        $data['page_heading'] = 'Customer Master';
        $data['breadcrumb'] = "Customer Master";
        $data['scripts'] = array('javascripts/dashboard.js');
        $this->load->view('templates/dashboard', $data);
    }

    //Customer Master start
    public function assign_package() {
	
        $msg = array();
        $data['view'] = $this->class_name . '/customer_list';
		
		$data['query'] = $this->master_model->getCustomer();
		$data['assign_package'] = true;
        $data['title'] = 'Admin Page - ' . SITE_TITLE;
        $data['page_heading'] = 'Assign package';
        $data['breadcrumb'] = "Assign package";
        $data['scripts'] = array('javascripts/dashboard.js');
        $this->load->view('templates/dashboard', $data);
    }
    public function assign($user_id) {
	
        if (!empty($user_id)) {
            $this->master_model->primary_key = array('users_id' => $user_id);
            $data['query'] = $this->master_model->get_row('users');
            $data['package'] = $this->master_model->get_data('package');
            $data['view'] = $this->class_name . '/assign_package_form';
            $data['title'] = 'Assign Package - ' . SITE_TITLE;
            $data['breadcrumb'] = "<a href=$this->class_name>Customer Master</a> &nbsp;&nbsp; > &nbsp;&nbsp; Assign Package";
            $data['page_heading'] = 'Assign Package';
            $data['scripts'] = array('javascripts/dashboard.js');
            $this->load->view('templates/dashboard', $data);
        } else {
            $msg = array();
            $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! unauthorised access.');
            $this->session->set_flashdata('msg', $msg);
            redirect("/$this->class_name/customer");
        }
    
    }
    

	 public function customer_add() {
        if ($this->permission[0] > 0) {
            $msg = array();
            $data['view'] = $this->class_name . '/customer_form';
            $data['title'] = 'Add Customer Master - ' . SITE_TITLE;
            $data['breadcrumb'] = "<a href=$this->class_name>Master</a> &nbsp;&nbsp; > &nbsp;&nbsp; Add Customer Master";
            $data['page_heading'] = 'Add Customer Master';
            $data['scripts'] = array('javascripts/dashboard.js');
            $this->load->view('templates/dashboard', $data);
        } else {
            $msg = array();
            $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! You do not have the permission.');
            $this->session->set_flashdata('msg', $msg);
            redirect("/$this->class_name/customer");
        }
    }
	
	public function customer_edit($user_id) {
        if ($this->permission[1] > 0) {
            if (!empty($user_id)) {
                $this->master_model->primary_key = array('users_id' => $user_id);
                $data['query'] = $this->master_model->get_row('users');

                $data['view'] = $this->class_name . '/customer_form';
                $data['title'] = 'Edit Customer Master - ' . SITE_TITLE;
                $data['breadcrumb'] = "<a href=$this->class_name>Customer Master</a> &nbsp;&nbsp; > &nbsp;&nbsp; Edit Customer Master";
                $data['page_heading'] = 'Edit Customer Master';
                $data['scripts'] = array('javascripts/dashboard.js');
                $this->load->view('templates/dashboard', $data);
            } else {
                $msg = array();
                $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! unauthorised access.');
                $this->session->set_flashdata('msg', $msg);
                redirect("/$this->class_name/customer");
            }
        } else {
            $msg = array();
            $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! You do not have the permission.');
            $this->session->set_flashdata('msg', $msg);
            redirect("/$this->class_name/customer");
        }
    }
	
	public function customer_save(){
		$sess_user_id = $this->session->userdata('user_id');		
		$user_id = $this->input->post('user_id');
		
		$this->master_model->data = $this->input->post();
		if(empty($user_id)){//add Case
            unset($this->master_model->data['user_id']);
			if ($this->master_model->insert('users')) {
				$msg = array('type' => 'success', 'icon' => 'icon-ok green', 'txt' => 'Data Added Successfully');
			} else {
				$msg = array('type' => 'error', 'icon' => 'icon-remove red', 'txt' => 'Sorry! Unable to save.');
			}			
		}else{//edit Case
			unset($this->master_model->data['user_id']);				
			$this->master_model->primary_key = array('users_id' => $user_id);
			if ($this->master_model->update('users')){
				$msg = array('type' => 'success', 'icon' => 'icon-ok green', 'txt' => 'Data updated successfully.');
			}else{
				$msg = array('type' => 'error', 'icon' => 'icon-remove red', 'txt' => 'Sorry! Unable to Update.');
			}
		}
		$this->session->set_flashdata('msg',$msg);
		redirect("/$this->class_name/customer");
			
    }
    
    public function assign_package_save(){
				
		$user_id = $this->input->post('user_id');
		
		$this->master_model->data = $this->input->post();
		if(!empty($user_id)){//add Case
           
			unset($this->master_model->data['user_id']);				
			$this->master_model->primary_key = array('users_id' => $user_id);
			if ($this->master_model->update('users')){
				$msg = array('type' => 'success', 'icon' => 'icon-ok green', 'txt' => 'Data updated successfully.');
			}else{
				$msg = array('type' => 'error', 'icon' => 'icon-remove red', 'txt' => 'Sorry! Unable to Update.');
			}
		}
		$this->session->set_flashdata('msg',$msg);
		redirect("/$this->class_name/customer");
			
    }
    

	public function customer_delete($user_id){
		$this->master_model->primary_key = array('users_id' => $user_id);
		if($this->master_model->delete('users')){
			$msg = array('type' => 'success', 'icon' => 'icon-ok green', 'txt' => 'Data deleted Successfully');
		}else{
			$msg = array('type' => 'error', 'icon' => 'icon-remove red', 'txt' => 'Sorry! Unable to delete.');
		}
		$this->session->set_flashdata('msg',$msg);
		redirect("/$this->class_name/customer");
	}
    //Customer Master End
    


	//commentry Master start
    public function commentry() {
	
        $msg = array();
        $data['view'] = $this->class_name . '/commentry_list';
		
		$data['query'] = $this->master_model->get_data('commentry');
		
        $data['title'] = 'Admin Page - ' . SITE_TITLE;
        $data['page_heading'] = 'commentry Master';
        $data['breadcrumb'] = "commentry Master";
        $data['scripts'] = array('javascripts/commentry.js', 'javascripts/dashboard.js');
        $this->load->view('templates/dashboard', $data);
    }
	 public function commentry_add() {
        if ($this->permission[0] > 0) {
            $msg = array();
            $data['view'] = $this->class_name . '/commentry_form';
            $data['title'] = 'Add commentry Master - ' . SITE_TITLE;
            $data['breadcrumb'] = "<a href=$this->class_name>Master</a> &nbsp;&nbsp; > &nbsp;&nbsp; Add commentry Master";
            $data['page_heading'] = 'Add commentry Master';
            $data['scripts'] = array('javascripts/commentry.js', 'javascripts/dashboard.js');
            $this->load->view('templates/dashboard', $data);
        } else {
            $msg = array();
            $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! You do not have the permission.');
            $this->session->set_flashdata('msg', $msg);
            redirect("/$this->class_name/commentry");
        }
    }
	
	public function commentry_edit($commentry_id) {
        if ($this->permission[1] > 0) {
            if (!empty($commentry_id)) {
                $this->master_model->primary_key = array('commentry_id' => $commentry_id);
                $data['query'] = $this->master_model->get_row('commentry');
                $data['view'] = $this->class_name . '/commentry_form';
                $data['title'] = 'Edit commentry Master - ' . SITE_TITLE;
                $data['breadcrumb'] = "<a href=$this->class_name>commentry Master</a> &nbsp;&nbsp; > &nbsp;&nbsp; Edit commentry Master";
                $data['page_heading'] = 'Edit commentry Master';
                $data['scripts'] = array('javascripts/commentry.js', 'javascripts/dashboard.js');
                $this->load->view('templates/dashboard', $data);
            } else {
                $msg = array();
                $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! unauthorised access.');
                $this->session->set_flashdata('msg', $msg);
                redirect("/$this->class_name/commentry");
            }
        } else {
            $msg = array();
            $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! You do not have the permission.');
            $this->session->set_flashdata('msg', $msg);
            redirect("/$this->class_name/commentry");
        }
    }
	
	public function commentry_save(){
		$sess_user_id = $this->session->userdata('user_id');		
		$commentry_id = $this->input->post('commentry_id');
		
		$this->master_model->data = $this->input->post();
        if(empty($commentry_id)){//add Case
            unset($this->master_model->data['commentry_id']);
			if ($this->master_model->insert('commentry')) {
				$msg = array('type' => 'success', 'icon' => 'icon-ok green', 'txt' => 'Data Added Successfully');
			} else {
				$msg = array('type' => 'error', 'icon' => 'icon-remove red', 'txt' => 'Sorry! Unable to save.');
			}			
		}else{//edit Case
			unset($this->master_model->data['commentry_id']);				
			$this->master_model->primary_key = array('commentry_id' => $commentry_id);
			if ($this->master_model->update('commentry')){
				$msg = array('type' => 'success', 'icon' => 'icon-ok green', 'txt' => 'Data updated successfully.');
			}else{
				$msg = array('type' => 'error', 'icon' => 'icon-remove red', 'txt' => 'Sorry! Unable to Update.');
			}
		}
		$this->session->set_flashdata('msg',$msg);
		redirect("/$this->class_name/commentry");
			
	}
	public function commentry_delete($commentry_id){
		$this->master_model->primary_key = array('commentry_id' => $commentry_id);
		if($this->master_model->delete('commentry')){
			$msg = array('type' => 'success', 'icon' => 'icon-ok green', 'txt' => 'Data deleted Successfully');
		}else{
			$msg = array('type' => 'error', 'icon' => 'icon-remove red', 'txt' => 'Sorry! Unable to delete.');
		}
		$this->session->set_flashdata('msg',$msg);
		redirect("/$this->class_name/commentry");
	}
	//commentry Master End
    
    
	//Quotes Master start
    public function quotes() {
	
        $msg = array();
        $data['view'] = $this->class_name . '/quotes_list';
		
		$data['query'] = $this->master_model->get_data('quotes');
		
        $data['title'] = 'Admin Page - ' . SITE_TITLE;
        $data['page_heading'] = 'quotes Master';
        $data['breadcrumb'] = "quotes Master";
        $data['scripts'] = array('javascripts/quotes.js', 'javascripts/dashboard.js');
        $this->load->view('templates/dashboard', $data);
    }
	 public function quotes_add() {
        if ($this->permission[0] > 0) {
            $msg = array();
            $data['view'] = $this->class_name . '/quotes_form';
            $data['title'] = 'Add quotes Master - ' . SITE_TITLE;
            $data['breadcrumb'] = "<a href=$this->class_name>Master</a> &nbsp;&nbsp; > &nbsp;&nbsp; Add quotes Master";
            $data['page_heading'] = 'Add quotes Master';
            $data['scripts'] = array('javascripts/quotes.js', 'javascripts/dashboard.js');
            $this->load->view('templates/dashboard', $data);
        } else {
            $msg = array();
            $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! You do not have the permission.');
            $this->session->set_flashdata('msg', $msg);
            redirect("/$this->class_name/quotes");
        }
    }
	
	public function quotes_edit($quotes_id) {
        if ($this->permission[1] > 0) {
            if (!empty($quotes_id)) {
                $this->master_model->primary_key = array('quotes_id' => $quotes_id);
                $data['query'] = $this->master_model->get_row('quotes');
                $data['view'] = $this->class_name . '/quotes_form';
                $data['title'] = 'Edit quotes Master - ' . SITE_TITLE;
                $data['breadcrumb'] = "<a href=$this->class_name>quotes Master</a> &nbsp;&nbsp; > &nbsp;&nbsp; Edit quotes Master";
                $data['page_heading'] = 'Edit quotes Master';
                $data['scripts'] = array('javascripts/quotes.js', 'javascripts/dashboard.js');
                $this->load->view('templates/dashboard', $data);
            } else {
                $msg = array();
                $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! unauthorised access.');
                $this->session->set_flashdata('msg', $msg);
                redirect("/$this->class_name/quotes");
            }
        } else {
            $msg = array();
            $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! You do not have the permission.');
            $this->session->set_flashdata('msg', $msg);
            redirect("/$this->class_name/quotes");
        }
    }
	
	public function quotes_save(){
		$sess_user_id = $this->session->userdata('user_id');		
		$quotes_id = $this->input->post('quotes_id');
		
		$this->master_model->data = $this->input->post();
        if(empty($quotes_id)){//add Case
            unset($this->master_model->data['quotes_id']);
			if ($this->master_model->insert('quotes')) {
				$msg = array('type' => 'success', 'icon' => 'icon-ok green', 'txt' => 'Data Added Successfully');
			} else {
				$msg = array('type' => 'error', 'icon' => 'icon-remove red', 'txt' => 'Sorry! Unable to save.');
			}			
		}else{//edit Case
			unset($this->master_model->data['quotes_id']);				
			$this->master_model->primary_key = array('quotes_id' => $quotes_id);
			if ($this->master_model->update('quotes')){
				$msg = array('type' => 'success', 'icon' => 'icon-ok green', 'txt' => 'Data updated successfully.');
			}else{
				$msg = array('type' => 'error', 'icon' => 'icon-remove red', 'txt' => 'Sorry! Unable to Update.');
			}
		}
		$this->session->set_flashdata('msg',$msg);
		redirect("/$this->class_name/quotes");
			
	}
	public function quotes_delete($quotes_id){
		$this->master_model->primary_key = array('quotes_id' => $quotes_id);
		if($this->master_model->delete('quotes')){
			$msg = array('type' => 'success', 'icon' => 'icon-ok green', 'txt' => 'Data deleted Successfully');
		}else{
			$msg = array('type' => 'error', 'icon' => 'icon-remove red', 'txt' => 'Sorry! Unable to delete.');
		}
		$this->session->set_flashdata('msg',$msg);
		redirect("/$this->class_name/quotes");
	}
	//quotes Master End
    
    
    //Quotes Address start
    public function address() {
	
        $msg = array();
        $data['view'] = $this->class_name . '/address_list';
		
		$data['query'] = $this->master_model->get_data('address');
		
        $data['title'] = 'Admin Page - ' . SITE_TITLE;
        $data['page_heading'] = 'address Master';
        $data['breadcrumb'] = "address Master";
        $data['scripts'] = array('javascripts/address.js', 'javascripts/dashboard.js');
        $this->load->view('templates/dashboard', $data);
    }
	 public function address_add() {
        if ($this->permission[0] > 0) {
            $msg = array();
            $data['view'] = $this->class_name . '/address_form';
            $data['title'] = 'Add address Master - ' . SITE_TITLE;
            $data['breadcrumb'] = "<a href=$this->class_name>Master</a> &nbsp;&nbsp; > &nbsp;&nbsp; Add address Master";
            $data['page_heading'] = 'Add address Master';
            $data['scripts'] = array('javascripts/address.js', 'javascripts/dashboard.js');
            $this->load->view('templates/dashboard', $data);
        } else {
            $msg = array();
            $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! You do not have the permission.');
            $this->session->set_flashdata('msg', $msg);
            redirect("/$this->class_name/address");
        }
    }
	
	public function address_edit($address_id) {
        if ($this->permission[1] > 0) {
            if (!empty($address_id)) {
                $this->master_model->primary_key = array('address_id' => $address_id);
                $data['query'] = $this->master_model->get_row('address');
                $data['view'] = $this->class_name . '/address_form';
                $data['title'] = 'Edit address Master - ' . SITE_TITLE;
                $data['breadcrumb'] = "<a href=$this->class_name>address Master</a> &nbsp;&nbsp; > &nbsp;&nbsp; Edit address Master";
                $data['page_heading'] = 'Edit address Master';
                $data['scripts'] = array('javascripts/address.js', 'javascripts/dashboard.js');
                $this->load->view('templates/dashboard', $data);
            } else {
                $msg = array();
                $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! unauthorised access.');
                $this->session->set_flashdata('msg', $msg);
                redirect("/$this->class_name/address");
            }
        } else {
            $msg = array();
            $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! You do not have the permission.');
            $this->session->set_flashdata('msg', $msg);
            redirect("/$this->class_name/address");
        }
    }
	
	public function address_save(){
		$sess_user_id = $this->session->userdata('user_id');		
		$address_id = $this->input->post('address_id');
		
		$this->master_model->data = $this->input->post();
        if(empty($address_id)){//add Case
            unset($this->master_model->data['address_id']);
			if ($this->master_model->insert('address')) {
				$msg = array('type' => 'success', 'icon' => 'icon-ok green', 'txt' => 'Data Added Successfully');
			} else {
				$msg = array('type' => 'error', 'icon' => 'icon-remove red', 'txt' => 'Sorry! Unable to save.');
			}			
		}else{//edit Case
			unset($this->master_model->data['address_id']);				
			$this->master_model->primary_key = array('address_id' => $address_id);
			if ($this->master_model->update('address')){
				$msg = array('type' => 'success', 'icon' => 'icon-ok green', 'txt' => 'Data updated successfully.');
			}else{
				$msg = array('type' => 'error', 'icon' => 'icon-remove red', 'txt' => 'Sorry! Unable to Update.');
			}
		}
		$this->session->set_flashdata('msg',$msg);
		redirect("/$this->class_name/address");
			
	}
	public function address_delete($address_id){
		$this->master_model->primary_key = array('address_id' => $address_id);
		if($this->master_model->delete('address')){
			$msg = array('type' => 'success', 'icon' => 'icon-ok green', 'txt' => 'Data deleted Successfully');
		}else{
			$msg = array('type' => 'error', 'icon' => 'icon-remove red', 'txt' => 'Sorry! Unable to delete.');
		}
		$this->session->set_flashdata('msg',$msg);
		redirect("/$this->class_name/address");
	}
    //address Master End
    

    //Calender start
    public function calender() {
	
        $msg = array();
        $data['view'] = $this->class_name . '/calender_list';
		
		$data['query'] = $this->master_model->get_data('calender');
		
        $data['title'] = 'Admin Page - ' . SITE_TITLE;
        $data['page_heading'] = 'calender Master';
        $data['breadcrumb'] = "calender Master";
        $data['scripts'] = array('javascripts/calender.js', 'javascripts/dashboard.js');
        $this->load->view('templates/dashboard', $data);
    }
	 public function calender_add() {
        if ($this->permission[0] > 0) {
            $msg = array();
            $data['view'] = $this->class_name . '/calender_form';
            $data['title'] = 'Add calender Master - ' . SITE_TITLE;
            $data['breadcrumb'] = "<a href=$this->class_name>Master</a> &nbsp;&nbsp; > &nbsp;&nbsp; Add calender Master";
            $data['page_heading'] = 'Add calender Master';
            $data['scripts'] = array('javascripts/calender.js', 'javascripts/dashboard.js');
            $this->load->view('templates/dashboard', $data);
        } else {
            $msg = array();
            $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! You do not have the permission.');
            $this->session->set_flashdata('msg', $msg);
            redirect("/$this->class_name/calender");
        }
    }
	
	public function calender_edit($calender_id) {
        if ($this->permission[1] > 0) {
            if (!empty(calender_id)) {
                $this->master_model->primary_key = array('calender_id' => $calender_id);
                $data['query'] = $this->master_model->get_row('calender');
                $data['view'] = $this->class_name . '/calender_form';
                $data['title'] = 'Edit calender Master - ' . SITE_TITLE;
                $data['breadcrumb'] = "<a href=$this->class_name>calender Master</a> &nbsp;&nbsp; > &nbsp;&nbsp; Edit calender Master";
                $data['page_heading'] = 'Edit calender Master';
                $data['scripts'] = array('javascripts/calender.js', 'javascripts/dashboard.js');
                $this->load->view('templates/dashboard', $data);
            } else {
                $msg = array();
                $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! unauthorised access.');
                $this->session->set_flashdata('msg', $msg);
                redirect("/$this->class_name/calender");
            }
        } else {
            $msg = array();
            $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! You do not have the permission.');
            $this->session->set_flashdata('msg', $msg);
            redirect("/$this->class_name/calender");
        }
    }
	
	public function calender_save(){
		$sess_user_id = $this->session->userdata('user_id');		
		$calender_id = $this->input->post('calender_id');
        
		$_POST['currency_flag'] = site_url()."/uploads/flag/".$_POST['currency_type'].".png";
		
        if(empty($_POST['calender_date']))
            $_POST['calender_date'] = null;
        
        if(empty($_POST['calender_time']))
            $_POST['calender_time'] = null;
        
		$this->master_model->data = $this->input->post();
        if(empty($calender_id)){//add Case
            unset($this->master_model->data['calender_id']);
			if ($this->master_model->insert('calender')) {
				$msg = array('type' => 'success', 'icon' => 'icon-ok green', 'txt' => 'Data Added Successfully');
			} else {
				$msg = array('type' => 'error', 'icon' => 'icon-remove red', 'txt' => 'Sorry! Unable to save.');
			}			
		}else{//edit Case
			unset($this->master_model->data['calender_id']);				
			$this->master_model->primary_key = array('calender_id' => $calender_id);
			if ($this->master_model->update('calender')){
				$msg = array('type' => 'success', 'icon' => 'icon-ok green', 'txt' => 'Data updated successfully.');
			}else{
				$msg = array('type' => 'error', 'icon' => 'icon-remove red', 'txt' => 'Sorry! Unable to Update.');
			}
		}
		$this->session->set_flashdata('msg',$msg);
		redirect("/$this->class_name/calender");
			
	}
	public function calender_delete($calender_id){
		$this->master_model->primary_key = array('calender_id' => $calender_id);
		if($this->master_model->delete('calender')){
			$msg = array('type' => 'success', 'icon' => 'icon-ok green', 'txt' => 'Data deleted Successfully');
		}else{
			$msg = array('type' => 'error', 'icon' => 'icon-remove red', 'txt' => 'Sorry! Unable to delete.');
		}
		$this->session->set_flashdata('msg',$msg);
		redirect("/$this->class_name/calender");
	}
	
	public function calender_import(){
			
        $this->master_model->data = $this->input->post();

        // Image Upload Code Begins Here
        if (!empty($_FILES['calender_file']['name']) && $this->upload->do_upload('calender_file')) {
            $upload_data = $this->upload->data();
            $calender_file = rand(400,900)."_".$upload_data['file_name'];
			
			rename(CALENDER_UPLOAD_PATH.$upload_data['file_name'],CALENDER_UPLOAD_PATH.$calender_file);
        } else {
            $data['form_error']['calender_file'] = $this->upload->display_errors();
        }
        
		
		$this->load->library('excel');
                
		$inputFileType = PHPExcel_IOFactory::identify(CALENDER_UPLOAD_PATH.$calender_file);
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load(CALENDER_UPLOAD_PATH.$calender_file);
		$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
		$flag = true;
		$i=0;
		
		foreach ($allDataInSheet as $value) {
			if($flag){
				$flag =false;
				continue;
			}
			if(empty($value['A']))
				continue;
			
			$this->master_model->data['calender_title'] = $value['A'];
			$this->master_model->data['currency_type'] = $value['B'];
			$this->master_model->data['calender_date'] = $value['C'];
			$this->master_model->data['calender_time'] = $value['D'];
			$this->master_model->data['actual'] = $value['E'];
			$this->master_model->data['forecast'] = $value['F'];
			$this->master_model->data['previous'] = $value['G'];
			$i++;
			
			$this->master_model->insert('calender');
		  
		}
		$msg = array('type' => 'success', 'icon' => 'icon-ok green', 'txt' => 'Data Uploaded Successfully');
		$this->session->set_flashdata('msg',$msg);
		redirect("/$this->class_name/calender");
	}
	
	//Calender End
	
	
	


        //App Notification  start
        public function appnotification() {

                $msg = array();
                $data['view'] = $this->class_name . '/appnotification_list';

                $data['query'] = $this->master_model->get_data('appnotification');

                $data['title'] = 'Admin Page - ' . SITE_TITLE;
                $data['page_heading'] = 'App Notification';
                $data['breadcrumb'] = "App Notification";
                $data['scripts'] = array('javascripts/calender.js', 'javascripts/dashboard.js');
                $this->load->view('templates/dashboard', $data);
        }
        public function appnotification_add() {
                if ($this->permission[0] > 0) {
                        $msg = array();
                        $data['view'] = $this->class_name . '/appnotification_form';
                        $data['title'] = 'Send App Notification - ' . SITE_TITLE;
                        $data['breadcrumb'] = "<a href=$this->class_name>Master</a> &nbsp;&nbsp; > &nbsp;&nbsp; Send App Notification";
                        $data['page_heading'] = 'Send App Notification';
                        $data['scripts'] = array('javascripts/calender.js', 'javascripts/dashboard.js');
                        $this->load->view('templates/dashboard', $data);
                } else {
                        $msg = array();
                        $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! You do not have the permission.');
                        $this->session->set_flashdata('msg', $msg);
                        redirect("/$this->class_name/appnotification");
                }
        }

        public function appnotification_save(){
$this->master_model->primary_key = array('users_id' => '1432');
                $cust_data = $this->master_model->getCustomer();

                $registration_ids = array();
                foreach ($cust_data as $cst_data){
					if(!empty($cst_data->deviceId))
                        $registration_ids[] = $cst_data->deviceId;
                }
				
				$registration_ids = array();
				$registration_ids[] = 'cu6t5h8YTViYLf6l1PSsYw:APA91bHJtnYYX7L2zttTnW8rTlc-Taq75051eHpuKMuOKDtNGPO_4CQ8WI3p13Uvm1DD5_1etxQTJCbfnv1M52hEOIVLPoXScx6xrI2svLEuvkO2y4XSFxSK65EvF_fUkkLIsvvTK9Mx';
       
                // API URL
                $url = 'https://fcm.googleapis.com/fcm/send';
                $data = array();
                $data['registration_ids'] = $registration_ids;
                $data['notification'] = array(
                        'title' => $_POST['message_title'],
                        'body' => $_POST['message'],
                        'mutable_content' => true,
                        'sound' => 'Tri-tone',
                        'largeIcon' => 'ic_launcher',
                        'smallIcon' => 'ic_notification',
                );
                $data['data'] = array(
                        'url' => 'optional',
                        'dl' => 'optional',
                );

                $ch = curl_init($url);

                $authorization = 'Authorization: key=AAAACoAD9RU:APA91bFDTbzMj7PsZbywDAdklyiJnyWA1HbEmLFB3rlvBZUDX7-9I8g7Csa_Ekbev5jRhsnJaWgz8fu-u3KotEyhpGZAO29zC6yjv1CgKrWy7VtL5KDDIWe4O689f4Mj_TSEMz32AzhJ';

                $payload = json_encode($data);
				
				
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_FAILONERROR, true);
				curl_setopt($ch, CURLOPT_REFERER, false);
				curl_setopt($ch, CURLOPT_HEADER, false);
				curl_setopt($ch, CURLOPT_PROXY, false);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
			
				$response = curl_exec ($ch);
				
				curl_close($ch);
				
                $this->master_model->data = $this->input->post();

                if ($this->master_model->insert('appnotification')) {
                        $msg = array('type' => 'success', 'icon' => 'icon-ok green', 'txt' => 'Notification sent Successfully');
                } else {
                        $msg = array('type' => 'error', 'icon' => 'icon-remove red', 'txt' => 'Sorry! Unable to save.');
                }

                $this->session->set_flashdata('msg',$msg);
                redirect("/$this->class_name/appnotification");

        }

        //App Notification End
}