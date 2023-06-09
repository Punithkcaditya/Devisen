<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contact extends MY_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->model('feedbacks_model');
    }

    public function index($slug) {
        $template_path = $this->pagewisecontent($slug);
        $data = $this->data;
        if (!empty($_POST) && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['description'])) {
            $this->feedbacks_model->data = $this->input->post();
			$name = $this->input->post('name', TRUE);
			$email_id = $this->input->post('email', TRUE);
			$phone = $this->input->post('phone', TRUE);
			$description = $this->input->post('description', TRUE);
            $this->feedbacks_model->data['name'] = ucwords($name);
            $this->feedbacks_model->data['created_date'] = date('Y-m-d H:i:s');
            $this->feedbacks_model->data['ip_address'] = $_SERVER['REMOTE_ADDR'];
            if ($this->feedbacks_model->insert()) {
				//mail sending to admin email by dynamic id code begins here

                    $to_emailid = $this->settings->DONATION_EMAIL_ID;
                    //mail sending to admin email by dynamic id code end here
                    //IMP to add this two line for sending html email
                    $email_setting = array('mailtype' => 'html');
                    $this->email->initialize($email_setting);
                    //IMP
                    $this->email_templates_model->primary_key = array('template_id' => 14);
                    $emailtemplate = $this->email_templates_model->get_row();

                    $this->email->to($email_id);
                    $this->email->cc($emailtemplate->cc);
                    $this->email->bcc($emailtemplate->bcc);
                    $this->email->from($emailtemplate->from);

                    $this->email->subject($emailtemplate->template_title);
                    $emailmsg = $emailtemplate->template_content;
					
					$emailmsg = str_replace('##FULLNAME##', $name, $emailmsg);
                    $emailmsg = str_replace('##EMAIL##', $email_id, $emailmsg);
                    $emailmsg = str_replace('##PHONE##', $phone, $emailmsg);
                    $emailmsg = str_replace('##SUBJECT##', $description, $emailmsg);

                    $this->email->message($emailmsg);
                    $this->email->send();
				
                $msg = array('type' => 'success', 'icon' => 'fa fa-check', 'txt' => 'Submitted Successfully');
            } else {
                $msg = array('type' => 'error', 'icon' => 'fa fa-thumbs-down', 'txt' => 'Sorry! Unable to Add Record.');
            }
            $this->session->set_flashdata('msg', $msg);
            redirect("/contact-us/");
        }
        $data['scripts'] = array('javascripts/common.js', 'javascripts/index.js', 'javascripts/feedbacks.js');
        $this->load->view($template_path, $data);
    }

}