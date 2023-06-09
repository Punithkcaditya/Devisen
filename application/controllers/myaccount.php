<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class myaccount extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $user_id = $this->session->userdata('login_user_id');
        if (empty($user_id)) {
            redirect('login');
		}
		$this->load->model('users_model');
		$this->load->model('email_templates_model');	
		
    }	
    public function index() {		
		
		$template_path = $this->pagewisecontent('my-account');
		$this->data['view_path'] = 'account/myaccount';
		$data = $this->data;
		$user_id = $this->session->userdata('login_user_id');
		$data['userdata'] = $this->users_model->getuser($user_id);

        $this->load->view("templates/inner_page", $data);

	}
	
	public function account_update()
	{
		$user_id = $this->session->userdata('login_user_id');
        if (empty($user_id)) {
            redirect('login');
		}
		
		$this->users_model->data = $this->input->post();	
		
		$this->users_model->primary_key = array('users_id' => $user_id);
		$emailtemplate = $this->users_model->update();
		
		$msg = array('type' => 'success', 'txt' => "Details updated successfully..!"); 
		$this->session->set_flashdata('msg', $msg);
		redirect('my-account');
		
	}

	public function change_password() {		
		
		$template_path = $this->pagewisecontent('my-account');
		$this->data['view_path'] = 'account/changepassword';
		$data = $this->data;
		
        $this->load->view("templates/inner_page", $data);

	}
	
	public function updatepassword()
	{
		
		if(isset($_POST['password']) && !empty($_POST['password'])){
			$user_id = $this->session->userdata('login_user_id');

			$this->users_model->data['password'] = md5($this->input->post('password'));	
			
			$this->users_model->primary_key = array('users_id' => $user_id);

			$this->users_model->update();
			
			$this->session->sess_destroy();//session distroy 
			session_destroy();

			$msg = array('type' => 'success', 'txt' => "Please login with new password..!"); 
			$this->session->set_flashdata('msg', $msg);
			redirect('login');
		} else {
			redirect('home');
		}
		
		
	}

	public function myalerts() {
		
		$template_path = $this->pagewisecontent('my-account');
		$this->data['view_path'] = 'account/myalerts';
		$data = $this->data;
		
		$user_id = $this->session->userdata('login_user_id');
		$data['useralerts'] = $this->users_model->getalerts($user_id);
		
        $this->load->view("templates/inner_page", $data);

	}

	public function savealert($val) {
		
		$user_id = $this->session->userdata('login_user_id');
		
		$this->users_model->data['currency_name'] = $this->input->post('currency_name_'.$val);
		$this->users_model->data['nature_exposer'] = $this->input->post('nature_exposer_'.$val);
		$this->users_model->data['base_value'] = $this->input->post('base_value_'.$val);
		$this->users_model->data['up_down'] = $this->input->post('up_down_'.$val);
		
		if(isset($_POST['user_alerts_id']) && $_POST['user_alerts_id'] > 0){
			$this->users_model->primary_key = array('user_alerts_id' => $_POST['user_alerts_id']);
			
			$this->users_model->updatealert();
		} else {
			$this->users_model->data['users_id'] = $user_id;
			$this->users_model->insertalert();
		}
		
		$msg = array('type' => 'success', 'txt' => "Alert Add/modified successfully..!"); 
		$this->session->set_flashdata('msg', $msg);
		redirect('my-alerts');
	}
	
	
	
}