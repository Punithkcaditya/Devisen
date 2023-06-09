<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Faq_category extends CI_Controller {
	public $class_name;
    public function __construct() {
        parent::__construct();
        $this->class_name = strtolower(get_class());
		
		$this->load->model('faq_category_model');
		
		$this->load->model('admin_roles_model');
        $this->load->model('admin_users_model');
        $this->load->model('admin_menuitems_model');
        $this->load->model('admin_users_accesses_model');
        /* these are the default modules to load in all controller */
        $this->load->model('hotels_model');
		$this->load->model('galleries_model');
        $user_id = $this->session->userdata('user_id');
        $this->admin_users_model->primary_key = array('user_id' => $user_id);
        $user_session_id = $this->admin_users_model->session_id();
        if (empty($user_id) && !empty($this->session->userdata['logged_session_id']) && $this->session->userdata['logged_session_id'] != md5($user_session_id) || !$this->admin_users_accesses_model->is_allowed($user_id, 63)) {
            redirect('logout');
        } else {
            $_SESSION['sidebar_menuitems'] = (!empty($_SESSION['sidebar_menuitems'])) ? $_SESSION['sidebar_menuitems'] : $this->admin_users_accesses_model->get_user_access($this->session->userdata('user_id'));
        }
        $permissions = $this->admin_users_accesses_model->get_permisions($user_id, 66);
        $this->permission = array($permissions->add_permission, $permissions->edit_permission, $permissions->delete_permission);
	}
		
	public function index() {
		$data['query'] = $this->faq_category_model->view();	
		$data['view'] = 'faq_category/list';
        $data['title'] = 'Administrator Dashboard';
        $data['page_heading'] = 'faq Category List';
        $data['scripts'] = array('');
        $this->load->view('templates/dashboard', $data);
	}
	
	public function add(){
		$data['query'] = $this->faq_category_model->view();		
		$data['view'] = 'faq_category/form';
        $data['title'] = 'Administrator Dashboard';
        $data['page_heading'] = 'faq category add';
        $data['scripts'] = array('');
        $this->load->view('templates/dashboard', $data);
	}
	
	public function edit($faq_category_id){
		$this->faq_category_model->primary_key = array('faq_category_id' => $faq_category_id);
		$data['query'] = $this->faq_category_model->get_row();		
		$data['view'] = 'faq_category/form';
        $data['title'] = 'Administrator Dashboard';
        $data['page_heading'] = 'faq category edit';
        $data['scripts'] = array('');
        $this->load->view('templates/dashboard', $data);
	}

	public function delete($faq_category_id){
		$this->faq_category_model->primary_key = array('faq_category_id' => $faq_category_id);
		if($this->faq_category_model->delete()){
			$msg = array('type' => 'success', 'icon' => 'icon-ok green', 'txt' => 'Data deleted Successfully');
		}else{
			$msg = array('type' => 'error', 'icon' => 'icon-remove red', 'txt' => 'Sorry! Unable to delete.');
		}
		$this->session->set_flashdata('msg',$msg);
		redirect('faq_category');
	}
	
	public function save(){
		$sess_user_id = $this->session->userdata('user_id');		
		$faq_id = $this->input->post('faq_category_id');
		
		$this->form_validation->set_rules('category_name','category name', 'required');
		
		if($this->form_validation->run()){
			$this->faq_category_model->data = $this->input->post();
			if(empty($faq_id)){//add Case
				if ($this->faq_category_model->insert()) {
	            	$msg = array('type' => 'success', 'icon' => 'icon-ok green', 'txt' => 'Data Added Successfully');
	            } else {
	            	$msg = array('type' => 'error', 'icon' => 'icon-remove red', 'txt' => 'Sorry! Unable to save.');
	            }			
			}else{//edit Case
				unset($this->faq_category_model->data['faq_id']);				
				$this->faq_category_model->primary_key = array('faq_category_id' => $faq_id);
				if ($this->faq_category_model->update()){
	            	$msg = array('type' => 'success', 'icon' => 'icon-ok green', 'txt' => 'Data updated successfully.');
	            }else{
	                $msg = array('type' => 'error', 'icon' => 'icon-remove red', 'txt' => 'Sorry! Unable to Update.');
	            }
			}
			$this->session->set_flashdata('msg',$msg);
			redirect('faq_category');
		}else{
			$data['query'] = (object) $this->input->post();			
			$data['view'] = 'faq_category/form';
	        $data['title'] = 'Administrator Dashboard';
	        $data['page_heading'] = 'faq category form';
	        $data['scripts'] = array('');
	        $this->load->view('templates/dashboard', $data);
		}		
	}
}