<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Historyrates extends MY_Controller {

    public function __construct() {
        parent::__construct();


        $this -> load -> helper('url');
        $this -> load -> helper('form');
        $this -> load -> database();
        $this -> load -> helper('html');
        $this -> load -> library('excel');


    }

    public function spotrates($page_slug) {
		
		$template_path = $this->pagewisecontent($page_slug);
		$this->data['view_path'] = 'historyrates/spotrates';
		$data = $this->data;

        $d = new DateTime( date("Y-m-d") );
        $data['spot_date'] = $d->format( 'Y-m-d' );

        $data['scripts'] = array('assets/javascript/historyrates.js');
        $this->load->view("templates/inner_page", $data);

    }

    public function ajaxspotrate(){

        $currency = $_POST['currency'];
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];

        $this->master_model->primary_key = "rate_currency = '$currency' AND date(rate_date) >='$from_date' AND date(rate_date)<= '$to_date'";
        $spot_rate = $this->master_model->get_alldata('sport_rate');

        $html = '';
        if(!empty($spot_rate)){
            foreach ($spot_rate as $sp_data){

                $phpdate = strtotime( $sp_data->rate_date );
                $show_date = date( 'd-m-Y', $phpdate );

                $s_date = $show_date;
                $s_currency = $sp_data->rate_currency;
                $content_json = json_decode($sp_data->content_json);
                $html.= '<tr>';
                $html.= '<td><strong>'.$s_currency.'</strong></td>';
                $html.= '<td>'.$s_date.'</td>';
                $html.= '<td>'.number_format((float)$content_json->B, 4, '.', '').'</td>';
                $html.= '<td>'.number_format((float)$content_json->C, 4, '.', '').'</td>';
                $html.= '<td>'.number_format((float)$content_json->D, 4, '.', '').'</td>';
                $html.= '<td>'.number_format((float)$content_json->E, 4, '.', '').'</td>';
                $html.= '</tr>';
            }
        } else {
            $html.= '<tr>';
            $html.= '<td colspan="6">No Data</td>';
            $html.= '</tr>';
        }

        header('Content-Type: application/json');
        echo json_encode($html);
        exit;

    }

    public function sportratexport(){

        $currency = $_GET['currency'];
        $from_date = $_GET['from_date'];
        $to_date = $_GET['to_date'];

        $this->master_model->primary_key = "rate_currency = '$currency' AND rate_date >='$from_date' AND rate_date<= '$to_date'";
        $spot_rate = $this->master_model->get_alldata('sport_rate');


        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Task Reports');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'Currency');
        $this->excel->getActiveSheet()->setCellValue('B1', 'Date');
        $this->excel->getActiveSheet()->setCellValue('C1', 'Open');
        $this->excel->getActiveSheet()->setCellValue('D1', 'High');
        $this->excel->getActiveSheet()->setCellValue('E1', 'Low');
        $this->excel->getActiveSheet()->setCellValue('F1', 'Close');

        $exceldata=array();

        if(!empty($spot_rate)){
            foreach ($spot_rate as $sp_data){
                $phpdate = strtotime( $sp_data->rate_date );
                $show_date = date( 'd-m-Y', $phpdate );

                $s_date = $show_date;
                $s_currency = $sp_data->rate_currency;
                $content_json = json_decode($sp_data->content_json);
		$data_add = array();
                $data_add[] = $s_currency;
                $data_add[] = $s_date;
                $data_add[] = $content_json->B;
                $data_add[] = $content_json->C;
                $data_add[] = $content_json->D;
                $data_add[] = $content_json->E;
                $exceldata[] = $data_add;
            }
        }


        //Fill data
        $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');

        $filename='TaskReport.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename=spotrates.xls'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');

    }

    public function forwardrates($page_slug) {

        $template_path = $this->pagewisecontent($page_slug);
        $this->data['view_path'] = 'historyrates/forwardrates';
        $data = $this->data;
        $data['scripts'] = array('assets/javascript/historyrates.js');
        $this->load->view("templates/inner_page", $data);

    }
    public function ajaxforwardrates(){

        $currency = $_POST['currency'];
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];

        $this->master_model->primary_key = "rate_currency = '$currency' AND rate_date >='$from_date' AND rate_date<= '$to_date'";
        $spot_rate = $this->master_model->get_alldata('forward_rate');

        $html = '';
        if(!empty($spot_rate)){
            foreach ($spot_rate as $sp_data){

                $phpdate = strtotime( $sp_data->rate_date );
                $show_date = date( 'd-m-Y', $phpdate );

                $s_date = $show_date;
                $s_currency = $sp_data->rate_currency;
                $content_json = json_decode($sp_data->content_json);
                $html.= '<tr>';
                $html.= '<td><strong>'.$s_currency.'</strong></td>';
                $html.= '<td>'.$s_date.'</td>';
                $html.= '<td>'.number_format((float)$content_json->B, 4, '.', '').'</td>';
                $html.= '<td>'.number_format((float)$content_json->C, 4, '.', '').'</td>';
                $html.= '<td>'.number_format((float)$content_json->D, 4, '.', '').'</td>';
                $html.= '<td>'.number_format((float)$content_json->E, 4, '.', '').'</td>';
                $html.= '<td>'.number_format((float)$content_json->F, 4, '.', '').'</td>';
                $html.= '<td>'.number_format((float)$content_json->G, 4, '.', '').'</td>';
                $html.= '<td>'.number_format((float)$content_json->H, 4, '.', '').'</td>';
                $html.= '<td>'.number_format((float)$content_json->I, 4, '.', '').'</td>';
                $html.= '<td>'.number_format((float)$content_json->J, 4, '.', '').'</td>';
                $html.= '<td>'.number_format((float)$content_json->K, 4, '.', '').'</td>';
                $html.= '<td>'.number_format((float)$content_json->L, 4, '.', '').'</td>';
                $html.= '<td>'.number_format((float)$content_json->M, 4, '.', '').'</td>';
                $html.= '<td>'.number_format((float)$content_json->N, 4, '.', '').'</td>';
                $html.= '</tr>';
            }
        } else {
            $html.= '<tr>';
            $html.= '<td colspan="15">No Data</td>';
            $html.= '</tr>';
        }

        header('Content-Type: application/json');
        echo json_encode($html);
        exit;

    }

    public function forwardratexport(){

        $currency = $_GET['currency'];
        $from_date = $_GET['from_date'];
        $to_date = $_GET['to_date'];

        $this->master_model->primary_key = "rate_currency = '$currency' AND rate_date >='$from_date' AND rate_date<= '$to_date'";
        $spot_rate = $this->master_model->get_alldata('forward_rate');


        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Task Reports');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'Currency');
        $this->excel->getActiveSheet()->setCellValue('B1', 'Date');
        $this->excel->getActiveSheet()->setCellValue('C1', 'Spot Rate');
        $this->excel->getActiveSheet()->setCellValue('D1', '1M');
        $this->excel->getActiveSheet()->setCellValue('E1', '2M');
        $this->excel->getActiveSheet()->setCellValue('F1', '3M');
        $this->excel->getActiveSheet()->setCellValue('G1', '4M');
        $this->excel->getActiveSheet()->setCellValue('H1', '5M');
        $this->excel->getActiveSheet()->setCellValue('I1', '6M');
        $this->excel->getActiveSheet()->setCellValue('J1', '7M');
        $this->excel->getActiveSheet()->setCellValue('K1', '8M');
        $this->excel->getActiveSheet()->setCellValue('L1', '9M');
        $this->excel->getActiveSheet()->setCellValue('M1', '10M');
        $this->excel->getActiveSheet()->setCellValue('N1', '11M');
        $this->excel->getActiveSheet()->setCellValue('O1', '12M');


        $exceldata=array();

        if(!empty($spot_rate)){
            foreach ($spot_rate as $sp_data){
                $phpdate = strtotime( $sp_data->rate_date );
                $show_date = date( 'd-m-Y', $phpdate );

                $s_date = $show_date;
                $s_currency = $sp_data->rate_currency;
                $content_json = json_decode($sp_data->content_json);
$data_add = array();
                $data_add[] = $s_currency;
                $data_add[] = $s_date;
                $data_add[] = $content_json->B;
                $data_add[] = $content_json->C;
                $data_add[] = $content_json->D;
                $data_add[] = $content_json->E;
                $data_add[] = $content_json->F;
                $data_add[] = $content_json->G;
                $data_add[] = $content_json->H;
                $data_add[] = $content_json->I;
                $data_add[] = $content_json->J;
                $data_add[] = $content_json->K;
                $data_add[] = $content_json->L;
                $data_add[] = $content_json->M;
                $data_add[] = $content_json->N;
                $exceldata[] = $data_add;
            }
        }


        //Fill data
        $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');

        $filename='TaskReport.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename=Forwardrates.xls'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');

    }

    public function liborrates($page_slug) {

        $template_path = $this->pagewisecontent($page_slug);
        $this->data['view_path'] = 'historyrates/liborrates';
        $data = $this->data;
        $data['scripts'] = array('assets/javascript/historyrates.js');
        $this->load->view("templates/inner_page", $data);

    }

    public function ajaxliborrate(){

        $currency = $_POST['currency'];
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];

        $this->master_model->primary_key = "rate_currency = '$currency' AND rate_date >='$from_date' AND rate_date<= '$to_date'";
        $spot_rate = $this->master_model->get_alldata('libor_rate');

        $html = '';
        if(!empty($spot_rate)){
            foreach ($spot_rate as $sp_data){

                $phpdate = strtotime( $sp_data->rate_date );
                $show_date = date( 'd-m-Y', $phpdate );

                $s_date = $show_date;
                $s_currency = $sp_data->rate_currency;
                $content_json = json_decode($sp_data->content_json);

                $html.= '<tr>';
                $html.= '<td><strong>'.$s_currency.'</strong></td>';
                $html.= '<td>'.$s_date.'</td>';
                $html.= '<td>'.number_format((float)$content_json->B, 4, '.', '').'</td>';
                $html.= '<td>'.number_format((float)$content_json->C, 4, '.', '').'</td>';
                $html.= '<td>'.number_format((float)$content_json->D, 4, '.', '').'</td>';
                $html.= '<td>'.number_format((float)$content_json->E, 4, '.', '').'</td>';
                $html.= '<td>'.number_format((float)$content_json->F, 4, '.', '').'</td>';
                $html.= '<td>'.number_format((float)$content_json->G, 4, '.', '').'</td>';
                $html.= '<td>'.number_format((float)$content_json->H, 4, '.', '').'</td>';
                $html.= '<td>'.number_format((float)$content_json->I, 4, '.', '').'</td>';
                $html.= '<td>'.number_format((float)$content_json->J, 4, '.', '').'</td>';
                $html.= '<td>'.number_format((float)$content_json->K, 4, '.', '').'</td>';
                $html.= '<td>'.number_format((float)$content_json->L, 4, '.', '').'</td>';
                $html.= '<td>'.number_format((float)$content_json->M, 4, '.', '').'</td>';
                $html.= '<td>'.number_format((float)$content_json->N, 4, '.', '').'</td>';
                $html.= '<td>'.number_format((float)$content_json->O, 4, '.', '').'</td>';
                $html.= '<td>'.number_format((float)$content_json->P, 4, '.', '').'</td>';
                $html.= '</tr>';
            }
        } else {
            $html.= '<tr>';
            $html.= '<td colspan="15">No Data</td>';
            $html.= '</tr>';
        }

        header('Content-Type: application/json');
        echo json_encode($html);
        exit;

    }

    public function liborrateexport(){

        $currency = $_GET['currency'];
        $from_date = $_GET['from_date'];
        $to_date = $_GET['to_date'];

        $this->master_model->primary_key = "rate_currency = '$currency' AND date(rate_date) >='$from_date' AND date(rate_date)<= '$to_date'";
        $spot_rate = $this->master_model->get_alldata('libor_rate');


        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Task Reports');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'Currency');
        $this->excel->getActiveSheet()->setCellValue('B1', 'Date');
        $this->excel->getActiveSheet()->setCellValue('C1', 'O/N');
        $this->excel->getActiveSheet()->setCellValue('D1', '1W');
        $this->excel->getActiveSheet()->setCellValue('E1', '2W');
        $this->excel->getActiveSheet()->setCellValue('F1', '1M');
        $this->excel->getActiveSheet()->setCellValue('G1', '2M');
        $this->excel->getActiveSheet()->setCellValue('H1', '3M');
        $this->excel->getActiveSheet()->setCellValue('I1', '4M');
        $this->excel->getActiveSheet()->setCellValue('J1', '5M');
        $this->excel->getActiveSheet()->setCellValue('K1', '6M');
        $this->excel->getActiveSheet()->setCellValue('L1', '7M');
        $this->excel->getActiveSheet()->setCellValue('M1', '8M');
        $this->excel->getActiveSheet()->setCellValue('N1', '9M');
        $this->excel->getActiveSheet()->setCellValue('O1', '10M');
        $this->excel->getActiveSheet()->setCellValue('P1', '11M');
        $this->excel->getActiveSheet()->setCellValue('Q1', '12M');


        $exceldata=array();

        if(!empty($spot_rate)){
            foreach ($spot_rate as $sp_data){
                $phpdate = strtotime( $sp_data->rate_date );
                $show_date = date( 'd-m-Y', $phpdate );

                $s_date = $show_date;
                $s_currency = $sp_data->rate_currency;
                $content_json = json_decode($sp_data->content_json);
$data_add = array();
                $data_add[] = $s_currency;
                $data_add[] = $s_date;
                $data_add[] = $content_json->B;
                $data_add[] = $content_json->C;
                $data_add[] = $content_json->D;
                $data_add[] = $content_json->E;
                $data_add[] = $content_json->F;
                $data_add[] = $content_json->G;
                $data_add[] = $content_json->H;
                $data_add[] = $content_json->I;
                $data_add[] = $content_json->J;
                $data_add[] = $content_json->K;
                $data_add[] = $content_json->L;
                $data_add[] = $content_json->M;
                $data_add[] = $content_json->N;
                $data_add[] = $content_json->O;
                $data_add[] = $content_json->P;
                $exceldata[] = $data_add;
            }
        }


        //Fill data
        $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');

        $filename='TaskReport.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename=Liborrates.xls'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');

    }

}