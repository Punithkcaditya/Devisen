<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Logincontroller extends MY_Controller {

    function __construct() {
        parent::__construct();

		$this->secondDb = $this->load->database('second_db', TRUE);
		$this->load->model('users_model');
		$this->load->model('email_templates_model');	
	}

	public function index($page_slug) {	
		$user_id = $this->session->userdata('login_user_id');
        if (!empty($user_id)) {
            redirect('my-account');
		}
		$template_path = $this->pagewisecontent('login');
		$this->data['view_path'] = 'account/login';
		$data = $this->data;
        $data['scripts'] = array('assets/javascript/login.js');
        $this->load->view("templates/inner_page", $data);

	}
	
	public function register()
	{
		$user_id = $this->session->userdata('login_user_id');
        if (!empty($user_id)) {
            redirect('my-account');
        }


        $recaptchaResponse = trim($this->input->post('g-recaptcha-response'));
        $userIp=$this->input->ip_address();
        $secret = $this->config->item('google_secret');
        $url="https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$recaptchaResponse."&remoteip=".$userIp;
        //$url="https://www.google.com/recaptcha/api/siteverify";

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"secret=".$secret."&response=".$recaptchaResponse."&remoteip=".$userIp);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $output = curl_exec($ch);

        curl_close ($ch);

        $status= json_decode($output, true);

        if (!empty($recaptchaResponse)) {

        }
		
		// else{
        //     $msg = array('type' => 'error', 'txt' => "Invalid Captcha...!");
        //     $this->session->set_flashdata('msg', $msg);
        //     redirect('login');
        //     exit;
        // }
unset($_POST['g-recaptcha-response']);
		$cc=$this->users_model->data = $this->input->post();	
		$data2 =  $this->input->post();	

		if (array_key_exists('password', $data2)) {
			$data2['password'] = md5($data2['password']);
		}
		
		if (array_key_exists('full_name', $data2)) {
			$data2['first_name'] = $data2['full_name'];
			unset($data2['full_name']);
		}
		


		if(!empty($cc)){

				//mail sending to admin email by dynamic id code begins here
				//$to_emailid = $this->settings->STORE_EMAIL_ID;
				$to_emailid = "";
				$email = $this->input->post('email');
				
				//md5 encryption for password				   
				$this->users_model->data['password'] = md5($this->input->post('password'));
				$insertedId = $this->users_model->insert();										
				$data2['employee_id'] = $insertedId;
				$this->secondDb->insert('admin_users', $data2);
				$a=$this->input->post('email');
				$b=md5($this->input->post('password'));
				$c=$this->users_model->loginsearch($a,$b);	
				//$login_user = (array) $this->users_model->loginAfterOtp($a,$b);
				//$this->session->set_userdata($login_user);
$msg = array('type' => 'error', 'txt' => "Registration Successful.Account under review.");
            $this->session->set_flashdata('msg', $msg);



				redirect('login');
				
			
		}
	}
	
	public function loginfun()
	{
		$user_id = $this->session->userdata('login_user_id');
        if (!empty($user_id)) {
            redirect('my-account');
        }
        $this->form_validation->set_rules('user_name', 'Mobile Number', 'required');
        $this->form_validation->set_rules('password', 'OTP', 'required');
        if ($this->form_validation->run() == true) {
			$a=$this->input->post('user_name');
			$b=$this->input->post('password');
            $login_user = $this->users_model->loginsearch($a,$b);	
           
            if ($login_user) {
				$login_user = (array) $this->users_model->loginAfterOtp($a,$b);
				$this->session->set_userdata($login_user);
			
                redirect('live-market');
            } else {
				$msg = array('type' => 'warning', 'txt' => "Invalid combinations"); 
                $this->session->set_flashdata('msg', $msg);
                redirect('login');
               
            }
        } else {
			$msg = array('type' => 'warning', 'txt' => "Invalid combinations");
            $this->session->set_flashdata('msg', $msg);
            redirect('login');
        }

	}
	
	public function logout()
	{
		if(($this->session->userdata('remember'))!='1'){		
			$this->session->sess_destroy();//session distroy 
			session_destroy();
		}else{
			$data['new_expiration'] = 60*60*1;//1hr
        	$this->session->sess_expiration = $data['new_expiration'];
			$x=$this->session->userdata('logged_in');
			unset($x['password']);
			$this->session->set_userdata('logged_in',$x);			
		}
		redirect('login');
       
    }
	
	public function forgotpass()
	{		
		$email=$this->input->post('forgot-email');
		$emailval = $this->users_model->emailsearch($email);
		
        if($emailval == 1){
        	
			 $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    		 $password = substr( str_shuffle( $chars ), 0, 6 );
			 	
			 
		   //mail sending to admin email by dynamic id code begins here
	      //$to_emailid = $this->settings->STORE_EMAIL_ID;
	      	 $to_emailid = '';
             //mail sending to admin email by dynamic id code end here
			 if($this->users_model->change_password($email,$password)){						
				//IMP to add this 2 line for sending html email configuration
                $email_setting = array('mailtype' => 'html');
                $this->email->initialize($email_setting);
                //IMP
                
                $this->email_templates_model->primary_key = array('template_id' => 1);
                $emailtemplate = $this->email_templates_model->get_row();
                $this->email->subject($emailtemplate->template_title);
                //$mail_list = array($to_emailid, $email);
                $this->email->to($email);
                $this->email->cc($emailtemplate->cc);
                $this->email->bcc($emailtemplate->bcc);
                $this->email->from($emailtemplate->from);
                $emailmsg = $emailtemplate->template_content;
				//$emailmsg = str_replace('##FIRSTNAME##', $result[0]->first_name, $emailmsg);
				//$emailmsg = str_replace('##LASTNAME##', $result[0]->last_name, $emailmsg);
				// $emailmsg = str_replace('##EMAIL##', $email, $emailmsg);
				// $emailmsg = str_replace('##USERNAME##', $result[0]->username, $emailmsg);
				// $emailmsg = str_replace('##NEWPASSWORD##', $password, $emailmsg);
				//echo "<pre>";print_r($emailmsg);//die();  			
				$this->email->message($emailmsg);
				$this->email->send();
				//$emailmsg = 'To Varify Your Email Click on this link - <a href='.$form_url.'/verifyEmail/'.$confirmation_code.'>'.$form_url.'/verifyEmail/'.$confirmation_code.'</a>';
				//$form_url = '192.168.2.71/lifeingoa';
				//$emailmsg = str_replace('##FORMURL##', $form_url, $emailmsg);
				//$emailmsg = str_replace('##CONFIRMATIONCODE##', $confirmation_code, $emailmsg);
                /*$emailmsg = str_replace('##FIRSTNAME##', $first_name, $emailmsg);
                $emailmsg = str_replace('##EMAIL##', $email, $emailmsg);
                $emailmsg = str_replace('##CONTACT##', $mobile, $emailmsg);
                $emailmsg = str_replace('##PINCODE##', $postal_code, $emailmsg);
                $emailmsg = str_replace('##CITY##', $city, $emailmsg);
                $emailmsg = str_replace('##ADDRESS##', $address, $emailmsg);*/             
				         
				//echo $this->email->print_debugger(array('headers')); exit;
				
				//redirect('');
				echo "T";
             }
			       
        }else{
				echo "F";
	    }  

	 }

	 public function emailvalidate(){
		  $emailval = $this->users_model->emailsearch($this->input->post('email')); //echo "vjxjhvcxv".$emailval;exit;

		  if($emailval==1){
			 echo "failed";			
			 return false;
		 }
		 else{
			 echo "success";
			 return true;
		 }  
	 }

	 public function fxlogin(){
		$data['email'] = $this->session->userdata('email');
		$data['password'] = $this->session->userdata('password');
		// return redirect('https://localhost/FXmanager/admin?login_user=' . urlencode(json_encode($login_user)));
		$encodedLoginUser = urlencode(json_encode($data));
		return redirect("https://localhost/FXmanager/admin?login_user={$encodedLoginUser}");
	 }
}
?>