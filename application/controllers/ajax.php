<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ajax extends CI_Controller {

    public function __construct() {
        parent::__construct();

        //$this->phrases = $this->phrases_model->view();
    }

    public function index() {
        //echo "No direct access....";
        echo $this->phrases->USERS['NO_DIRECT_ACCESS'];
    }

    public function spotratecron(){
        $this->load->model('master_model');
        $this->load->library('excel');
        //read file from path
        $file_name = $this->create_file();
        $objPHPExcel = PHPExcel_IOFactory::load($file_name);

        $objPHPExcel->setActiveSheetIndex(18);

        //get only the Cell Collection
        $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();

        //extract to a PHP readable array format
        foreach ($cell_collection as $cell) {
            $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
            $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
            $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getCalculatedValue();

            $arr_data[$row][$column] = $data_value;
        }

        foreach ($arr_data as $key=>$rate_data){
            if($key == 1)
                continue;

            if($key <=16){
                $this->master_model->data['rate_currency'] = $rate_data['A'];
                $this->master_model->data['content_json'] = json_encode($rate_data);
                $this->master_model->insert('sport_rate');
            }
            if($key >=19 && $key <=33){

                $this->master_model->data['rate_currency'] = $rate_data['A'];
                $this->master_model->data['content_json'] = json_encode($rate_data);
                $this->master_model->insert('forward_rate');

            }
            if($key >=36 && $key <=39){
                $this->master_model->data['rate_currency'] = $rate_data['A'];
                $this->master_model->data['content_json'] = json_encode($rate_data);
                $this->master_model->insert('libor_rate');
            }
        }
        unlink($file_name);
    }

    public function getcurrencyrates($tabname) {

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
            
            $html_cont = '';
            foreach ($arr_data as $key1=>$org_data) {
                if($header && ($key1==1 ||$key1==2)){
                    $html_cont.="<thead><tr>";
                    foreach($org_data as $key=>$each_Data){    
                        if(empty($each_Data))
                            continue;

                        $html_cont.=" <td>
                                        ".$each_Data."		
                                    </td>";
                    }
                    $html_cont.="</tr></thead>";   
                } elseif($header && ($key1==3 ||$key1==6||$key1==9)){
                   
                    $html_cont.="<tr class='2'>";
                    foreach($org_data as $key=>$each_Data){
                        
                            $html_cont.=" <td colspan='14' style='text-align: left;'>
                                    <b>".$each_Data."</b>
                                </td>";
                    }
                            $html_cont.="</tr>"; 
                            
                }else {
                    
                    $html_cont.="<tr>";
                    
                    foreach($org_data as $key=>$each_Data){
                        if($key != 'A'){
                            $each_Data = sprintf("%.4f", $each_Data);
                            if (floor($each_Data) == $each_Data){
                                if($each_Data <= 0)
                                    $each_Data = '0.0000';
                                //$each_Data = round($each_Data);
                            } else {
                               // $each_Data = '0.0000';
                            }
                            
                        }

                            
                        $html_cont.=" <td>
                                        ".$each_Data."		
                                    </td>";
                    }
                    $html_cont.="</tr>";     

                }
                      
            }
            $json_result['response'] = true;
            $json_result['data'] = $html_cont;
        
        } else {
            $json_result['response'] = false;
            
        }
        unlink($file_name);
        header('Content-Type: application/json');
        echo json_encode($json_result);
    }

    public function ajaxbroken(){

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
		
        $now = time(); // or your date as well
		$now = strtotime($data['spot_date']); // or your date as well
        $your_date = strtotime($_POST['forward_date']);
        $datediff = $your_date - $now;

        $datediff =  round($datediff / (60 * 60 * 24));

        foreach ($arr_data as $b_c) {
            if(isset($b_c['B']) && $b_c['B'] > $datediff){
                switch($_POST['currency']) {
                    case 'USDINR':
                        $pre_rate = $b_c['D'];
                        $spot_rate = $arr_data[3]['D'];
                        if($_POST['cover_type'] == 1){
                            $spot_rate = $arr_data[3]['C'];
                            $pre_rate = $b_c['C'];
                        }


                        $pre_rate = ($pre_rate/$b_c['B'])*$datediff;
                        $pre_rate = $pre_rate/100;
                        break;
                    case 'EURINR':
                        $pre_rate = $b_c['F'];
                        $spot_rate = $arr_data[3]['F'];
                        if($_POST['cover_type'] == 1){
                            $spot_rate = $arr_data[3]['E'];
                            $pre_rate = $b_c['E'];
                        }

                        $pre_rate = ($pre_rate/$b_c['B'])*$datediff;
                        $pre_rate = $pre_rate/100;
                        break;
                    case 'GBPINR':
                        $pre_rate = $b_c['H'];
                        $spot_rate = $arr_data[3]['H'];
						
                        if($_POST['cover_type'] == 1) {
                            $pre_rate = $b_c['G'];
                            $spot_rate = $arr_data[3]['G'];
                        }

                        $pre_rate = ($pre_rate/$b_c['B'])*$datediff;
                        $pre_rate = $pre_rate/100;
						
                        break;
                    case 'JPYINR':
                        $pre_rate = $b_c['J'];
                        $spot_rate = $arr_data[3]['J'];
                        if($_POST['cover_type'] == 1) {
                            $pre_rate = $b_c['I'];
                            $spot_rate = $arr_data[3]['J'];
                        }

                        $pre_rate = ($pre_rate/$b_c['B'])*$datediff;
                        $pre_rate = $pre_rate/100;
                        break;
                    case 'EURUSD':
                        $pre_rate = $b_c['L'];
                        $spot_rate = $arr_data[3]['L'];
                        if($_POST['cover_type'] == 1) {
                            $pre_rate = $b_c['K'];
                            $spot_rate = $arr_data[3]['L'];
                        }

                        $pre_rate = ($pre_rate/$b_c['B'])*$datediff;
                        $pre_rate = $pre_rate/10000;
                        break;
                    case 'GBPUSD':
                        $pre_rate = $b_c['N'];
                        $spot_rate = $arr_data[3]['N'];
                        if($_POST['cover_type'] == 1) {
                            $pre_rate = $b_c['M'];
                            $spot_rate = $arr_data[3]['N'];
                        }

                        $pre_rate = ($pre_rate/$b_c['B'])*$datediff;
                        $pre_rate = $pre_rate/10000;
                        break;
                    case 'USDJPY':
                        $pre_rate = $b_c['P'];
                        $spot_rate = $arr_data[3]['P'];
                        if($_POST['cover_type'] == 1) {
                            $pre_rate = $b_c['O'];
                            $spot_rate = $arr_data[3]['O'];
                        }

                        $pre_rate = ($pre_rate/$b_c['B'])*$datediff;
                        $pre_rate = $pre_rate/100;
                        break;
                }

                    $forward_rate = $spot_rate + $pre_rate;

                    $annul_rate = (($forward_rate - $spot_rate) / $spot_rate) * (365 / $datediff) * 100;

                    $spot_rate = number_format($spot_rate, 4);
                    $forward_rate = number_format($forward_rate, 4);
                    $annul_rate = number_format($annul_rate, 2);
                    $response = array();

					$response['status'] = 1;
					$response['result'] = array();
                    
                    $response['result']['spot_rate'] = $spot_rate;
                    $response['result']['forward_rate'] = $forward_rate;
                    $response['result']['annul_rate'] = $annul_rate;

                unlink($file_name);
                header('Content-Type: application/json');
                echo json_encode($response);
                exit;
            }
        }
        unlink($file_name);
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
}

/* End of file ajax.php */
/* Location: ./application/controllers/ajax.php */
