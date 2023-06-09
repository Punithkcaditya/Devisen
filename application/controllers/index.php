<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Index extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('master_model');
    }

    public function index($slug = 'home') {
       
        $template_path = $this->pagewisecontent($slug);
        $data = $this->data;
        $data['commentry'] = $this->master_model->get_data('commentry');
        $data['quotes'] = $this->master_model->get_data('quotes');

        $this->load->view($template_path, $data);
    }
    
}
