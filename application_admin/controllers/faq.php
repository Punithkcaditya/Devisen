<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Faq extends CI_Controller {
	
	public $class_name;
	
    public function __construct() {
        parent::__construct();
        $this->class_name = strtolower(get_class());
		
		$this->load->model('faqs_model');
		
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
		$data['query'] = $this->faqs_model->view();	
		$data['view'] = 'faq/list';
        $data['title'] = 'Administrator Dashboard';
        $data['page_heading'] = 'faq List';
        $data['scripts'] = array('');
        $this->load->view('templates/dashboard', $data);
	}
	
	public function add(){
		$data['query'] = $this->faqs_model->view();	
		$data['categories'] = $this->faqs_model->get_categories();
		$data['view'] = 'faq/form';
        $data['title'] = 'Administrator Dashboard';
        $data['page_heading'] = 'faq List';
        $data['scripts'] = array('js/ckeditor/ckeditor.js');
        $this->load->view('templates/dashboard', $data);
	}
	
	public function edit($faq_id){
		$this->faqs_model->primary_key = array('faq_id' => $faq_id);
		$data['categories'] = $this->faqs_model->get_categories();
		$data['query'] = $this->faqs_model->get_row();		
		$data['view'] = 'faq/form';
        $data['title'] = 'Administrator Dashboard';
        $data['page_heading'] = 'faq List';
        $data['scripts'] = array('js/ckeditor/ckeditor.js');
        $this->load->view('templates/dashboard', $data);
	}

	public function delete($faq_id){
		$this->faqs_model->primary_key = array('faq_id' => $faq_id);
		if($this->faqs_model->delete()){
			$msg = array('type' => 'success', 'icon' => 'icon-ok green', 'txt' => 'Data deleted Successfully');
		}else{
			$msg = array('type' => 'error', 'icon' => 'icon-remove red', 'txt' => 'Sorry! Unable to delete.');
		}
		$this->session->set_flashdata('msg',$msg);
		redirect('faq');
	}
	
	public function save(){
		$sess_user_id = $this->session->userdata('user_id');		
		$faq_id = $this->input->post('faq_id');
		
		$this->form_validation->set_rules('faq_question','faq question', 'required');
		
		if($this->form_validation->run()){
			$this->faqs_model->data = $this->input->post();
			if(empty($faq_id)){//add Case
				$this->faqs_model->data['created_date']	= date('y-m-d h:i:s');
				$this->faqs_model->data['created_by']	= $sess_user_id;
				if ($this->faqs_model->insert()) {
	            	$msg = array('type' => 'success', 'icon' => 'icon-ok green', 'txt' => 'Data Added Successfully');
	            } else {
	            	$msg = array('type' => 'error', 'icon' => 'icon-remove red', 'txt' => 'Sorry! Unable to save.');
	            }			
			}else{//edit Case
				$this->faqs_model->data['last_modified_by']	= $sess_user_id;
				unset($this->faqs_model->data['faq_id']);				
				$this->faqs_model->primary_key = array('faq_id' => $faq_id);
				if ($this->faqs_model->update()){
	            	$msg = array('type' => 'success', 'icon' => 'icon-ok green', 'txt' => 'Data updated successfully.');
	            }else{
	                $msg = array('type' => 'error', 'icon' => 'icon-remove red', 'txt' => 'Sorry! Unable to Update.');
	            }
			}
			$this->session->set_flashdata('msg',$msg);
			redirect('faq');
		}else{
			$data['query'] = (object) $this->input->post();			
			$data['view'] = 'faq/form';
	        $data['title'] = 'Administrator Dashboard';
	        $data['page_heading'] = 'faq form';
	        $data['scripts'] = array('');
	        $this->load->view('templates/dashboard', $data);
		}		
	}
}