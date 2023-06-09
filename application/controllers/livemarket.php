<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class livemarket extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $user_id = $this->session->userdata('login_user_id');
        if (empty($user_id)) {
            redirect('login');
		}
		
    }	
    public function index($page_slug) {		
		
		$template_path = $this->pagewisecontent($page_slug);
		$this->data['view_path'] = 'livemarket/livemarket';
		$data = $this->data;
        $data['scripts'] = array('assets/javascript/livemarket.js');
        $this->load->view("templates/inner_page", $data);

    }
	
}