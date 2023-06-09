<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class research extends MY_Controller {

    public function __construct() {
        parent::__construct();
		$user_id = $this->session->userdata('login_user_id');
        if (empty($user_id)) {
            redirect('login');
		}
		
    }	
    public function index($page_slug) {		

		$template_path = $this->pagewisecontent($page_slug);
		$this->data['view_path'] = 'research/research';
        $data = $this->data;
        
        $this->master_model->primary_key = array('m.report_category_id' => 1);
        $morning_report = $this->master_model->get_rowjoin('report','report_category','report_id','report_category_id');
        $data['morning_report'] = '';
        if(!empty($morning_report))
            $data['morning_report'] = base_url().REPORT_UPLOAD_PATH.$morning_report->report_pdf;

        
        $this->master_model->primary_key = array('m.report_category_id' => 2);
        $afternoon_report = $this->master_model->get_rowjoin('report','report_category','report_id','report_category_id');
        $data['afternoon_report'] = '';
        if(!empty($afternoon_report))
            $data['afternoon_report'] = base_url().REPORT_UPLOAD_PATH.$afternoon_report->report_pdf;


        $this->master_model->primary_key = array('m.report_category_id' => 3);
        $evening_report = $this->master_model->get_rowjoin('report','report_category','report_id','report_category_id');
        $data['evening_report'] = '';
        if(!empty($evening_report))
            $data['evening_report'] = base_url().REPORT_UPLOAD_PATH.$evening_report->report_pdf;

        $this->master_model->primary_key = array('m.report_category_id' => 4);
        $daily_report = $this->master_model->get_datajoin('report','report_category','report_id','report_category_id');
        $data['daily_report'] = array();
        if(!empty($daily_report)){
            foreach($daily_report as $daily){
                $data['daily_report'][$daily->report_name] = base_url().REPORT_UPLOAD_PATH.$daily->report_pdf;
            }
        }

        $this->master_model->primary_key = array('m.report_category_id' => 5);
        $weekly_report = $this->master_model->get_datajoin('report','report_category','report_id','report_category_id');
        $data['weekly_report'] = array();
        if(!empty($weekly_report)){
            foreach($weekly_report as $weekly){
                $data['weekly_report'][$weekly->report_name] = base_url().REPORT_UPLOAD_PATH.$weekly->report_pdf;
            }
        }

        $this->master_model->primary_key = array('m.report_category_id' => 6);
        $special_report = $this->master_model->get_datajoin('report','report_category','report_id','report_category_id');
        $data['special_report'] = array();
        if(!empty($special_report)){
            foreach($special_report as $special){
                $data['special_report'][$special->report_name] = base_url().REPORT_UPLOAD_PATH.$special->report_pdf;
            }
        }
  
        $this->load->view("templates/inner_page", $data);

    }
	
}