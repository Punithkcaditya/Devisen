<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Testimonials extends MY_Controller {

    public function __construct() {
        parent::__construct();
		
		$this->load->model('testimonial_model');
    }

    public function index($page_slug) {
		
		$template_path = $this->pagewisecontent($page_slug);
        $data = $this->data;
        $data['query'] = $this->testimonial_model->get_details();
		//echo "<pre/>"; print_r($data['query']); exit;
        $data['scripts'] = array('javascripts/common.js', 'javascripts/partners.js');
        $this->load->view($template_path, $data);
    }
	
}