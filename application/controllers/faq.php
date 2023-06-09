<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Faq extends MY_Controller {

    public function __construct() {
        parent::__construct();
		
		$this->load->model('faq_category_model');
		$this->load->model('faqs_model');
    }	
    public function index($page_slug) {		
		

		$template_path = $this->pagewisecontent('faq');
		$this->data['view_path'] == 'hotels/details';
		$data = $this->data;
				
		$data['page_items']->page_content = '';
		$data['view_path'] = 'faq/index';
		$data['faqs'] = $this->faq_category_model->view();
        $data['scripts'] = array('javascripts/common.js');
		
        $this->load->view("templates/inner_page", $data);

    }
	public function get_faqs($faq_category_id){
		
		$template_path = $this->pagewisecontent('faq');
		$this->data['view_path'] == 'hotels/details';
		$data = $this->data;
				
		$data['page_items']->page_content = '';
		$data['view_path'] = 'faq/faq';
		$data['faq_category'] = $this->faqs_model->get_row_category($faq_category_id);
		$data['faqs'] = $this->faqs_model->get_faqs($faq_category_id);
        $data['scripts'] = array('javascripts/common.js');
		
        $this->load->view("templates/inner_page", $data);
	}
}