<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class calculator extends MY_Controller {

    public function __construct() {
        parent::__construct();
		
    }	
    public function index($page_slug) {		
		
		$template_path = $this->pagewisecontent($page_slug);
		$this->data['view_path'] = 'calculator/calculator';
		$data = $this->data;
        $data['scripts'] = array('assets/javascript/calculator.js');
        $this->load->view("templates/inner_page", $data);

    }

    public function brokencalculator($page_slug){

        $template_path = $this->pagewisecontent($page_slug);
        $this->data['view_path'] = 'calculator/brokencalculator';
        $data = $this->data;

        $d = new DateTime( date("Y-m-d") );
        $t = $d->getTimestamp();

        // loop for X days
        for($i=0; $i<2; $i++){

            // add 1 day to timestamp
            $addDay = 86400;

            // get what day it is next day
            $nextDay = date('w', ($t+$addDay));

            // if it's Saturday or Sunday get $i-1
            if($nextDay == 0 || $nextDay == 6) {
                $i--;
            }

            // modify timestamp, add 1 day
            $t = $t+$addDay;
        }

        $d->setTimestamp($t);

        $data['spot_date'] = $d->format( 'Y-m-d' );

        $data['scripts'] = array('assets/javascript/brokencalculator.js');
        $this->load->view("templates/inner_page", $data);

    }


	
}