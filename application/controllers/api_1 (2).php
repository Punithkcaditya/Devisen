<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Api extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->model('master_model');
		$this->load->model('email_templates_model');
    }

    public function index() {
        echo "No direct access....";
        
    }
    public function create_file(){

        $file_name = "livemarket_".time().rand().".xlsm";
        $file_path = PROJECT_EXCEL_ONLY_PATH.$file_name;
        if(file_exists($file_path)){

        } else {
            copy(PROJECT_EXCEL_PATH,$file_path);
        }
        return $file_path;

    }

	function crypto_rand_secure($min, $max){
	    $range = $max - $min;
	    if ($range < 1) return $min; // not so random...
	    $log = ceil(log($range, 2));
	    $bytes = (int) ($log / 8) + 1; // length in bytes
	    $bits = (int) $log + 1; // length in bits
	    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
	    do {
	        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
	        $rnd = $rnd & $filter; // discard irrelevant bits
	    } while ($rnd > $range);
	    return $min + $rnd;
	}
	function getToken($length){
	    $token = "";
	    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
	    $codeAlphabet.= "0123456789";
	    $max = strlen($codeAlphabet); // edited

	    for ($i=0; $i < $length; $i++) {
	        $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max-1)];
	    }

	    return $token;
    }
    public function authUser(){
        $header_values = getallheaders();
        $data = array();
        $response = array();
		
        if ((isset($header_values['Auth-Token']) && !empty($header_values['Auth-Token']))) {
			
            $token = $header_values['Auth-Token'];
			
            if(!empty($token)){
	            $this->users_model->primary_key = array('login_token' => $token);
	            $user_data = $this->users_model->session_user_all();
				
			 	if(!empty($user_data)){
			        $this->session->set_userdata((array)$user_data);
					return $user_data;
			 	}else {
	               return false;
            	}
			}
		} else {
            return false;
		}
	}


    public function checklogin() {

        $res = $this->authUser();
        if($res){
            $response = array('success' => 1 , 'result'=>'success');
        } else {
            $response = array('success' => 0 , 'result'=>'Invalid Token');
        }

        header('Content-Type: application/json');
        echo json_encode($response);
        exit;

    }

    public function login() {
        
        $this->form_validation->set_rules('user_name', 'Mobile Number', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        if ($this->form_validation->run() == true) {
			$a=$this->input->post('user_name');
			$b=$this->input->post('password');
            $login_user = $this->users_model->loginsearch($a,$b);	
           
            if ($login_user) {
                $login_user = $this->users_model->loginAfterOtp($a,$b);
				$login_token = $this->getToken(50);
				$this->users_model->data['login_token'] = $login_token;
                $this->users_model->primary_key = array('users_id' => $login_user->users_id);
                $this->users_model->update();
                $response = array('success' => 1 , 'result'=>'Login Successful','token'=>$login_token);
            } else {
                $response = array('success' => 0 , 'result'=>'Invalid Username and Password!');
            }
        } else {
            $response = array('success' => 0 , 'result'=>'Invalid Details');
        }

		header('Content-Type: application/json');
		echo json_encode($response);
		exit;
    }

    public function register(){
        
		$cc=$this->users_model->data = $this->input->post();	
		$this->form_validation->set_rules('email', 'Mobile Number', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('full_name', 'Full Name', 'required');
        $this->form_validation->set_rules('company_name', 'Company Name', 'required');
        $this->form_validation->set_rules('industry_name', 'Industry Name', 'required');
        $this->form_validation->set_rules('name_of_exposure', 'Nature of exposure', 'required');
        $this->form_validation->set_rules('phone_number', 'Mobile number', 'required');
        
        if ($this->form_validation->run() == true) {
            if(!empty($cc)){
                //mail sending to admin email by dynamic id code begins here
                //$to_emailid = $this->settings->STORE_EMAIL_ID;
                $to_emailid = "";
                $email = $this->input->post('email');
                
                //md5 encryption for password				   
                $this->users_model->data['password'] = md5($this->input->post('password'));
                if($this->users_model->insert()){
                    $response = array('success' => 1 , 'result'=>'Successfully Registered.Please login.');
                }
            }
        }else {
            $response = array('success' => 0 , 'result'=>'Please fill all required details');
        }

		header('Content-Type: application/json');
		echo json_encode($response);
		exit;
	}
    
    
    public function profile() {		
        
        $res = $this->authUser();
		$data = array();
		if($res){
            $user_id = $this->session->userdata('users_id');
            
            $data['full_name'] = $this->session->userdata['full_name'];
            $data['company_name'] = $this->session->userdata['company_name'];
            $data['industry_name'] = $this->session->userdata['industry_name'];
            $data['name_of_exposure'] = $this->session->userdata['name_of_exposure'];
            $data['turnover'] = $this->session->userdata['turnover'];
            $data['phone_number'] = $this->session->userdata['phone_number'];
            $data['email'] = $this->session->userdata['email'];

			$response = array('success' => 1 , 'result'=>'success','data'=>$data);
		} else {
			$response = array('success' => 0 , 'result'=>'Invalid Token');
		}
		
		header('Content-Type: application/json');
		echo json_encode($response);
        exit;
        
    }
    
    public function profile_update() {		
        
        $res = $this->authUser();
		$data = array();
		if($res){
            $user_id = $this->session->userdata('users_id');
            
            $this->users_model->data['full_name'] = $this->input->post('full_name');
            $this->users_model->data['company_name'] = $this->input->post('company_name');
            $this->users_model->data['industry_name'] = $this->input->post('industry_name');
            $this->users_model->data['name_of_exposure'] = $this->input->post('name_of_exposure');
            $this->users_model->data['turnover'] = $this->input->post('turnover');
            $this->users_model->data['phone_number'] = $this->input->post('phone_number');
            
            $this->users_model->primary_key = array('users_id' => $user_id);
           
		    if($this->users_model->update()){
                $response = array('success' => 1 , 'result'=>'success');
            } else {
                $response = array('success' => 0 , 'result'=>'Some Problem Occured');
            }

			
		} else {
			$response = array('success' => 0 , 'result'=>'Invalid Token');
		}
		
		header('Content-Type: application/json');
		echo json_encode($response);
        exit;
        
    }
    
    public function change_password() {		
        
        $res = $this->authUser();
		$data = array();
		if($res){
            $user_id = $this->session->userdata('users_id');
            
            $this->users_model->data['password'] = md5($this->input->post('password'));	           
            $this->users_model->primary_key = array('users_id' => $user_id);

		    if($this->users_model->update()){
                $response = array('success' => 1 , 'result'=>'success');
            } else {
                $response = array('success' => 0 , 'result'=>'Some Problem Occured');
            }

		} else {
			$response = array('success' => 0 , 'result'=>'Invalid Token');
		}
		
		header('Content-Type: application/json');
		echo json_encode($response);
        exit;
        
	}
    
    public function devidedetails() {
        
        $res = $this->authUser();
		$data = array();
		if($res){

            $this->form_validation->set_rules('deviceId', 'Device id required', 'required');
            
            if ($this->form_validation->run() == true) {
                $deviceId=$this->input->post('deviceId');
                
                if ($deviceId) {
                    $user_id = $this->session->userdata('users_id');
                    $this->users_model->data['deviceId'] = $deviceId;
                    $this->users_model->primary_key = array('users_id' => $user_id);
                    $this->users_model->update();
                    $response = array('success' => 1 , 'result'=>'Device ID captured');
                } else {
                    $response = array('success' => 0 , 'result'=>'Invalid deviceID!');
                }
            } else {
                $response = array('success' => 0 , 'result'=>'Invalid deviceID');
            }
        } else {
            $response = array('success' => 0 , 'result'=>'Invalid Token');
        }
        
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
		
    }

    public function calender() {		
        
        $res = $this->authUser();
		$data = array();
		if($res){
            $this->master_model->primary_key = array('section_id' => 1);
            $today = $this->master_model->get_calender('calender');
           
            $data['today'] = array();
            if(!empty($today))
                $data['today'] = $today;

            
            $this->master_model->primary_key = array('section_id' => 2);
            $tomorrow = $this->master_model->get_calender('calender');
            $data['tomorrow'] = array();
            if(!empty($tomorrow))
                $data['tomorrow'] = $tomorrow;
    
            $this->master_model->primary_key = array('section_id' => 3);
            $this_week = $this->master_model->get_calender('calender');
            $data['this_week'] = array();
            if(!empty($this_week))
                $data['this_week'] = $this_week;

            
            $this->master_model->primary_key = array('section_id' => 4);
            $next_week = $this->master_model->get_calender('calender');
            $data['next_week'] = array();
            if(!empty($next_week))
                $data['next_week'] = $next_week;


			$response = array('success' => 1 , 'result'=>'success','data'=>$data);
		} else {
			$response = array('success' => 0 , 'result'=>'Invalid Token');
		}
		
		header('Content-Type: application/json');
		echo json_encode($response);
        exit;
        
    }

	public function research() {		
        
        $res = $this->authUser();
		$data = array();
		if($res){
            
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
                    $data['daily_report'][] = base_url().REPORT_UPLOAD_PATH.$daily->report_pdf;
                }
            }

            $this->master_model->primary_key = array('m.report_category_id' => 5);
            $weekly_report = $this->master_model->get_datajoin('report','report_category','report_id','report_category_id');
            $data['weekly_report'] = array();
            if(!empty($weekly_report)){
                foreach($weekly_report as $weekly){
                    $data['weekly_report'][] = base_url().REPORT_UPLOAD_PATH.$weekly->report_pdf;
                }
            }

            $this->master_model->primary_key = array('m.report_category_id' => 5);
            $special_report = $this->master_model->get_datajoin('report','report_category','report_id','report_category_id');
            $data['special_report'] = array();
            if(!empty($special_report)){
                foreach($special_report as $special){
                    $data['special_report'][] = base_url().REPORT_UPLOAD_PATH.$special->report_pdf;
                }
            }

			$response = array('success' => 1 , 'result'=>'success','data'=>$data);
		} else {
			$response = array('success' => 0 , 'result'=>'Invalid Token');
		}
		
		header('Content-Type: application/json');
		echo json_encode($response);
        exit;
        
    }

    public function liverate() {
        $res = $this->authUser();
        $data = array();
        $tabname = $_GET['type'];
		if($res && isset($_GET['type']) && !empty($_GET['type'])){
            $json_result = array();
            if(!empty($tabname)){
                $this->load->library('excel');
                //read file from path
                $file_name = $this->create_file();
                $objPHPExcel = PHPExcel_IOFactory::load($file_name);
                
                $header = false;
                switch($tabname){
                    case 'USDINR':
                        $objPHPExcel->setActiveSheetIndex(0);
                        break;
                    case 'EURINR':
                        $objPHPExcel->setActiveSheetIndex(1);
                        break;
                    case 'GBPINR':
                        $objPHPExcel->setActiveSheetIndex(2);
                        break;
                    case 'JPYINR':
                        $objPHPExcel->setActiveSheetIndex(3);
                        break;
                    case 'LIBOR':
                        $objPHPExcel->setActiveSheetIndex(4);
                        break;
                    case 'OHLC':
                        $objPHPExcel->setActiveSheetIndex(5);
                        break;
                    case 'CF1M':
                        $objPHPExcel->setActiveSheetIndex(6);
                        break;
                    case 'CF2M':
                        $objPHPExcel->setActiveSheetIndex(7);
                        break;
                    case 'CF3M':
                        $objPHPExcel->setActiveSheetIndex(8);
                        break;
                    case 'FTAB1':
                        $header = true;
                        $objPHPExcel->setActiveSheetIndex(9);
                        break;
                    case 'FTAB2':
                        $header = true;
                        $objPHPExcel->setActiveSheetIndex(10);
                        break;
                    case 'FTAB3':
                        $header = true;
                        $objPHPExcel->setActiveSheetIndex(11);
                        break;
                    case 'FTAB4':
                        $header = true;
                        $objPHPExcel->setActiveSheetIndex(12);
                        break;
                    case 'FTAB5':
                        $header = true;
                        $objPHPExcel->setActiveSheetIndex(13);
                        break;
                    case 'FTAB6':
                        $header = true;
                        $objPHPExcel->setActiveSheetIndex(14);
                        break;
                    case 'FTAB7':
                        $header = true;
                        $objPHPExcel->setActiveSheetIndex(15);
                        break;
                    case 'FTAB8':
                        $header = true;
                        $objPHPExcel->setActiveSheetIndex(16);
                        break;
                    
                }
                
                //get only the Cell Collection
                $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
                
                //extract to a PHP readable array format
                foreach ($cell_collection as $cell) {
                    $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
                    $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
                    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getCalculatedValue();
                
                    //The header will/should be in row 1 only. of course, this can be modified to suit your need.
                    
                    if ($row == 1) {
                        if($header){
                            $arr_data[$row][$column] = $data_value;
                        }
                    } else if(isset($data_value)){
                        $arr_data[$row][$column] = $data_value;
                    }
                }
                
                $result = $arr_data;
                
                $json_result = $result;
            
            } else {
                $json_result['response'] = false;
                
            }
            
            $response = array('success' => 1 , 'data'=>$json_result);
        } else {
            $response = array('success' => 0 , 'result'=>'Invalid Token');
        }
        unlink($file_name);
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;

    }

    public function ohlc() {
        $res = $this->authUser();
        $data = array();
        $tabname = $_GET['type'];
		if($res && isset($_GET['type']) && !empty($_GET['type'])){
            $json_result = array();
            if(!empty($tabname)){
                $this->load->library('excel');
                //read file from path
                $file_name = $this->create_file();
                $objPHPExcel = PHPExcel_IOFactory::load($file_name);
                
                $header = false;
                switch($tabname){
                    case 'USDINR':
                        $objPHPExcel->setActiveSheetIndex(0);
                        break;
                    case 'EURINR':
                        $objPHPExcel->setActiveSheetIndex(1);
                        break;
                    case 'GBPINR':
                        $objPHPExcel->setActiveSheetIndex(2);
                        break;
                    case 'JPYINR':
                        $objPHPExcel->setActiveSheetIndex(3);
                        break;
                    case 'LIBOR':
                        $objPHPExcel->setActiveSheetIndex(4);
                        break;
                    case 'OHLC':
                        $objPHPExcel->setActiveSheetIndex(5);
                        break;
                    case 'CF1M':
                        $objPHPExcel->setActiveSheetIndex(6);
                        break;
                    case 'CF2M':
                        $objPHPExcel->setActiveSheetIndex(7);
                        break;
                    case 'CF3M':
                        $objPHPExcel->setActiveSheetIndex(8);
                        break;
                    case 'FTAB1':
                        $header = true;
                        $objPHPExcel->setActiveSheetIndex(9);
                        break;
                    case 'FTAB2':
                        $header = true;
                        $objPHPExcel->setActiveSheetIndex(10);
                        break;
                    case 'FTAB3':
                        $header = true;
                        $objPHPExcel->setActiveSheetIndex(11);
                        break;
                    case 'FTAB4':
                        $header = true;
                        $objPHPExcel->setActiveSheetIndex(12);
                        break;
                    case 'FTAB5':
                        $header = true;
                        $objPHPExcel->setActiveSheetIndex(13);
                        break;
                    case 'FTAB6':
                        $header = true;
                        $objPHPExcel->setActiveSheetIndex(14);
                        break;
                    case 'FTAB7':
                        $header = true;
                        $objPHPExcel->setActiveSheetIndex(15);
                        break;
                    case 'FTAB8':
                        $header = true;
                        $objPHPExcel->setActiveSheetIndex(16);
                        break;
                    
                }
                
                //get only the Cell Collection
                $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
                
                //extract to a PHP readable array format
                foreach ($cell_collection as $cell) {
                    $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
                    $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
                    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getCalculatedValue();
                
                    //The header will/should be in row 1 only. of course, this can be modified to suit your need.
                    
                    if ($row == 1) {
                        if($header){
                            $arr_data[$row][$column] = $data_value;
                        }
                    } else if(isset($data_value)){
                        $arr_data[$row][$column] = $data_value;
                    }
                }

                $result = array();
                if($tabname == 'OHLC' && isset($_GET['currency'])){
                    foreach ($arr_data as $key1=>$org_data) {
                        if($_GET['currency'] == $org_data['A']){
                            unset($org_data['A']);
                            unset($org_data['B']);
                            unset($org_data['C']);
                            //unset($org_data['H']);
                            unset($org_data['I']);
                            unset($org_data['J']);
                            $result = $org_data;
                        }
                    }
                }

                $response = array('success' => 1 , 'data'=>$result);
            } else {
                $response = array('success' => 0 , 'data'=>'Problem in loading data');
            }
            
        } else {
            $response = array('success' => 0 , 'result'=>'Invalid Token');
        }
        unlink($file_name);
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;

    }

    public function currencyfutures() {
        $res = $this->authUser();
        $data = array();
        $tabname = $_GET['type'];
		if($res && isset($_GET['type']) && !empty($_GET['type'])){
            $json_result = array();
            if(!empty($tabname)){
                $this->load->library('excel');
                //read file from path
                $file_name = $this->create_file();
                $objPHPExcel = PHPExcel_IOFactory::load($file_name);
                
                $header = false;
                switch($tabname){
                    case 'USDINR':
                        $objPHPExcel->setActiveSheetIndex(0);
                        break;
                    case 'EURINR':
                        $objPHPExcel->setActiveSheetIndex(1);
                        break;
                    case 'GBPINR':
                        $objPHPExcel->setActiveSheetIndex(2);
                        break;
                    case 'JPYINR':
                        $objPHPExcel->setActiveSheetIndex(3);
                        break;
                    case 'LIBOR':
                        $objPHPExcel->setActiveSheetIndex(4);
                        break;
                    case 'OHLC':
                        $objPHPExcel->setActiveSheetIndex(5);
                        break;
                    case 'CF1M':
                        $objPHPExcel->setActiveSheetIndex(6);
                        break;
                    case 'CF2M':
                        $objPHPExcel->setActiveSheetIndex(7);
                        break;
                    case 'CF3M':
                        $objPHPExcel->setActiveSheetIndex(8);
                        break;
                    case 'FTAB1':
                        $header = true;
                        $objPHPExcel->setActiveSheetIndex(9);
                        break;
                    case 'FTAB2':
                        $header = true;
                        $objPHPExcel->setActiveSheetIndex(10);
                        break;
                    case 'FTAB3':
                        $header = true;
                        $objPHPExcel->setActiveSheetIndex(11);
                        break;
                    case 'FTAB4':
                        $header = true;
                        $objPHPExcel->setActiveSheetIndex(12);
                        break;
                    case 'FTAB5':
                        $header = true;
                        $objPHPExcel->setActiveSheetIndex(13);
                        break;
                    case 'FTAB6':
                        $header = true;
                        $objPHPExcel->setActiveSheetIndex(14);
                        break;
                    case 'FTAB7':
                        $header = true;
                        $objPHPExcel->setActiveSheetIndex(15);
                        break;
                    case 'FTAB8':
                        $header = true;
                        $objPHPExcel->setActiveSheetIndex(16);
                        break;
                    
                }
                
                //get only the Cell Collection
                $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
                
                //extract to a PHP readable array format
                foreach ($cell_collection as $cell) {
                    $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
                    $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
                    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getCalculatedValue();
                
                    //The header will/should be in row 1 only. of course, this can be modified to suit your need.
                    
                    if ($row == 1) {
                        if($header){
                            $arr_data[$row][$column] = $data_value;
                        }
                    } else if(isset($data_value)){
                        $arr_data[$row][$column] = $data_value;
                    }
                }
                
                $result = $arr_data;
                
                $json_result = $result;
            
            } else {
                $json_result['response'] = false;
                
            }
            
            $response = array('success' => 1 , 'data'=>$json_result);
        } else {
            $response = array('success' => 0 , 'result'=>'Invalid Token');
        }
        unlink($file_name);
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;


    }

    public function forward() {
        $res = $this->authUser();
        $data = array();
        $tabname = $_GET['type'];
		if($res && isset($_GET['type']) && !empty($_GET['type'])){
            $json_result = array();
            if(!empty($tabname)){
                $this->load->library('excel');
                //read file from path
                $file_name = $this->create_file();
                $objPHPExcel = PHPExcel_IOFactory::load($file_name);
                
                $header = false;
                switch($tabname){
                    case 'USDINR':
                        $objPHPExcel->setActiveSheetIndex(1);
                    break;
                    case 'EURINR':
                        $objPHPExcel->setActiveSheetIndex(2);
                    break;
                    case 'GBPINR':
                        $objPHPExcel->setActiveSheetIndex(3);
                    break;
                    case 'JPYINR':
                        $objPHPExcel->setActiveSheetIndex(4);
                    break;
                    case 'LIBOR':
                        $objPHPExcel->setActiveSheetIndex(5);
                    break;
                    case 'OHLC':
                        $objPHPExcel->setActiveSheetIndex(6);
                    break;
                    case 'CF1M':
                        $objPHPExcel->setActiveSheetIndex(7);
                    break;
                    case 'CF2M':
                        $objPHPExcel->setActiveSheetIndex(8);
                    break;
                    case 'CF3M':
                        $objPHPExcel->setActiveSheetIndex(9);
                    break;
                    case 'FTAB1':
                        $header = true;
                        $objPHPExcel->setActiveSheetIndex(11);
                    break;
                    case 'FTAB2':
                        $header = true;
                        $objPHPExcel->setActiveSheetIndex(12);
                    break;
                    case 'FTAB3':
                        $header = true;
                        $objPHPExcel->setActiveSheetIndex(13);
                    break;
                    case 'FTAB4':
                        $header = true;
                        $objPHPExcel->setActiveSheetIndex(14);
                    break;
                    case 'FTAB5':
                        $header = true;
                        $objPHPExcel->setActiveSheetIndex(15);
                    break;
                    case 'FTAB6':
                        $header = true;
                        $objPHPExcel->setActiveSheetIndex(16);
                    break;
                    case 'FTAB7':
                        $header = true;
                        $objPHPExcel->setActiveSheetIndex(17);
                    break;
                    case 'FTAB8':
                        $header = true;
                        $objPHPExcel->setActiveSheetIndex(18);
                    break;
                    
                }
                
                //get only the Cell Collection
                $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
                
                //extract to a PHP readable array format
                foreach ($cell_collection as $cell) {
                    $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
                    $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
                    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getCalculatedValue();
                
                    //The header will/should be in row 1 only. of course, this can be modified to suit your need.
                    
                    if ($row == 1) {
                        if($header){
                            $arr_data[$row][$column] = $data_value;
                        }
                    } else if(isset($data_value)){
                        $arr_data[$row][$column] = $data_value;
                    }
                }
                unset($arr_data[1]);
                unset($arr_data[3]);
                unset($arr_data[6]);
                unset($arr_data[9]);
                
                $result = array();
                $i=0;
                foreach ($arr_data as $key1=>$org_data) {
                    
                    $result[$i] = array_values($org_data);
                    unset($result[$i][0]);
                    $result[$i] = array_values($result[$i]);
                    $i++;
                }
                $ouput_result = array();
                $ouput_result[0] = $result[0];
                $ouput_result[1] = $result[1];
                $ouput_result[2] = $result[3];
                $ouput_result[3] = $result[5];
                $ouput_result[4] = $result[2];
                $ouput_result[5] = $result[4];
                $ouput_result[6] = $result[6];

                $json_result = $ouput_result;
            
            } else {
                $json_result['response'] = false;
                
            }
            
            $response = array('success' => 1 , 'data'=>$json_result);
        } else {
            $response = array('success' => 0 , 'result'=>'Invalid Token');
        }
        unlink($file_name);
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;


    }



    public function calculator(){
        $res = $this->authUser();
        $data = array();
        if($res) {

            $this->load->library('excel');
            //read file from path
            $file_name = $this->create_file();
            $objPHPExcel = PHPExcel_IOFactory::load($file_name);

            $objPHPExcel->setActiveSheetIndex(17);

            //get only the Cell Collection
            $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();

            //extract to a PHP readable array format
            foreach ($cell_collection as $cell) {
                $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
                $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
                $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getCalculatedValue();

                //The header will/should be in row 1 only. of course, this can be modified to suit your need.
                $arr_data[$row][$column] = $data_value;
            }

            $now = time(); // or your date as well
            $your_date = strtotime($_POST['forward_date']);
            $datediff = $your_date - $now;

            $datediff = round($datediff / (60 * 60 * 24));

            foreach ($arr_data as $b_c) {
                if (isset($b_c['B']) && $b_c['B'] > $datediff) {
                    switch ($_POST['currency']) {
                        case 'USDINR':
                            $pre_rate = $b_c['D'];
                            $spot_rate = $arr_data[3]['D'];
                            if ($_POST['cover_type'] == 1) {
                                $spot_rate = $arr_data[3]['C'];
                                $pre_rate = $b_c['C'];
                            }


                            $pre_rate = ($datediff * $pre_rate) / $b_c['B'];
                            $pre_rate = $pre_rate / 100;
                            break;
                        case 'EURINR':
                            $pre_rate = $b_c['F'];
                            $spot_rate = $arr_data[3]['F'];
                            if ($_POST['cover_type'] == 1) {
                                $spot_rate = $arr_data[3]['E'];
                                $pre_rate = $b_c['E'];
                            }

                            $pre_rate = ($datediff * $pre_rate) / $b_c['B'];
                            $pre_rate = $pre_rate / 100;
                            break;
                        case 'GBPINR':
                            $pre_rate = $b_c['H'];
                            $spot_rate = $arr_data[3]['H'];
                            if ($_POST['cover_type'] == 1) {
                                $pre_rate = $b_c['G'];
                                $spot_rate = $arr_data[3]['G'];
                            }

                            $pre_rate = ($datediff * $pre_rate) / $b_c['B'];
                            $pre_rate = $pre_rate / 100;
                            break;
                        case 'JPYINR':
                            $pre_rate = $b_c['J'];
                            $spot_rate = $arr_data[3]['J'];
                            if ($_POST['cover_type'] == 1) {
                                $pre_rate = $b_c['I'];
                                $spot_rate = $arr_data[3]['J'];
                            }

                            $pre_rate = ($datediff * $pre_rate) / $b_c['B'];
                            $pre_rate = $pre_rate / 100;
                            break;
                        case 'EURUSD':
                            $pre_rate = $b_c['L'];
                            $spot_rate = $arr_data[3]['L'];
                            if ($_POST['cover_type'] == 1) {
                                $pre_rate = $b_c['K'];
                                $spot_rate = $arr_data[3]['L'];
                            }

                            $pre_rate = ($datediff * $pre_rate) / $b_c['B'];
                            $pre_rate = $pre_rate / 1000;
                            break;
                        case 'GBPUSD':
                            $pre_rate = $b_c['N'];
                            $spot_rate = $arr_data[3]['N'];
                            if ($_POST['cover_type'] == 1) {
                                $pre_rate = $b_c['M'];
                                $spot_rate = $arr_data[3]['N'];
                            }

                            $pre_rate = ($datediff * $pre_rate) / $b_c['B'];
                            $pre_rate = $pre_rate / 1000;
                            break;
                        case 'USDJPY':
                            $pre_rate = $b_c['P'];
                            $spot_rate = $arr_data[3]['P'];
                            if ($_POST['cover_type'] == 1) {
                                $pre_rate = $b_c['O'];
                                $spot_rate = $arr_data[3]['O'];
                            }

                            $pre_rate = ($datediff * $pre_rate) / $b_c['B'];
                            $pre_rate = $pre_rate / 100;
                            break;
                    }

                    $forward_rate = $spot_rate + $pre_rate;

                    $annul_rate = (($forward_rate - $spot_rate) / $spot_rate) * (365 / $datediff) * 100;

                    $spot_rate = number_format($spot_rate, 4);
                    $forward_rate = number_format($forward_rate, 4);
                    $annul_rate = number_format($annul_rate, 2);
                    $response = array();

                    $response['success'] = 1;
                    $response['result'] = array();
                    $response['result']['spot_rate'] = $spot_rate;
                    $response['result']['forward_rate'] = $forward_rate;
                    $response['result']['annul_rate'] = $annul_rate;

                }
            }
	unlink($file_name);
        } else {
            $response = array('success' => 0 , 'result'=>'Invalid Token');
        }
        
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }

    public function rateus() {

        $res = $this->authUser();
        $data = array();
        if($res){

            $this->master_model->data['rate_stars'] = $this->input->post('rate_stars');
            $this->master_model->data['feedback'] = $this->input->post('feedback');
            $this->master_model->data['user_id'] = $this->session->userdata('users_id');

            if($this->master_model->insert('customer_rateus')){
                $response = array('success' => 1 , 'result'=>'success');
            } else {
                $response = array('success' => 0 , 'result'=>'Some Problem Occured');
            }

        } else {
            $response = array('success' => 0 , 'result'=>'Invalid Token');
        }

        header('Content-Type: application/json');
        echo json_encode($response);
        exit;

    }

public function forgotpassword() {
//cust_email
$response = array('success' => 1 , 'result'=>'success');

        header('Content-Type: application/json');
        echo json_encode($response);
        exit;

    }
	
}