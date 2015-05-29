<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class tr_cost_summary_report extends CI_Controller{
			function __construct(){
				parent::__construct();
				$this->load->library('render');
			 	$this->load->model('tr_cost_summary_report_model');
			 	$this->load->library('access');
			 	$this->access->set_module('tr_cost_summary_report.tr_cost_summary_report');
			 	$this->access->user_page();
			}
		
		function index(){
				
				$data = array();
				$data['row_id'] = '';
				$data['date_1'] = '';
				$data['date_2'] = '';
				$this->load->helper('form');
				$this->render->add_form('app/tr_cost_summary_report/form', $data);
				$this->render->build('laporan biaya Summary');
				$this->render->add_view('app/tr_cost_summary_report/transient_list');
				$this->render->build('Biaya sopir dan kernet');
				$this->render->add_view('app/tr_cost_summary_report/transient_list2');
				$this->render->build('Data Biaya lain-lain');
				$this->render->show('laporan biaya Summary');
	}	
	function detail_table_loader($date_1 = 0,$date_2=0) {
			if($date_1 == 0 or $date_2 ==0 ){
					send_json(make_datatables_list(null));
			}else{
				
				$data = $this->tr_cost_summary_report_model->detail_table_loader($date_1,$date_2);
				
				$sort_id = 0;
				$no=1;
				
				foreach($data as $key => $value) 
				{
			
				$data[$key] = array(
						form_transient_pair('transient_driver_no', $no,$no),
						form_transient_pair('transient_driver_name', $value['employee_name'],$value['employee_name']),
						form_transient_pair('transient_driver_cost', tool_money_format($value['total_cost']),$value['total_cost']),
						//form_transient_pair('transient_shipment_detail_link',$link,$link),
				
				);
				
		$no++;				
		}		
		send_json(make_datatables_list($data)); 
		}
	}
	function detail_table_loader2($date_1 = 0,$date_2=0) {
			if($date_1 == 0 or $date_2 == 0 ){
					send_json(make_datatables_list(null));
			}else{
				
				$data = $this->tr_cost_summary_report_model->detail_table_loader2($date_1,$date_2);
				
				$sort_id = 0;
				$no=1;
				
				foreach($data as $key => $value) 
				{
			
				$data[$key] = array(
						form_transient_pair('transient_cost_no', $no,$no),
						form_transient_pair('transient_cost_category', $value['tr_cost_type_name'],$value['tr_cost_type_name']),
						form_transient_pair('transient_cost_total', tool_money_format($value['get_total_cost']),$value['get_total_cost']),
						//form_transient_pair('transient_shipment_detail_link',$link,$link),
				
				);
				
		$no++;				
		}		
		send_json(make_datatables_list($data)); 
		}
	}
	function get_total_cost()
	{
		$date 	= $this->input->post('date');
		$date = explode("-", $date);
		$date1 = $date[0];
		$date2 = $date[1];
		$date1 = format_date($date1);
		$date2 = format_date($date2);
		
		$data['total_cost_driver_co'] = $this->tr_cost_summary_report_model->get_total_cost_driver_co($date1,$date2);
		$data['total_cost'] = $this->tr_cost_summary_report_model->get_total_cost($date1,$date2);
	
		send_json_message('Satuan', $data);
	}
	
	function report($date = 0,$date_2 = 0){
	if($date and $date_2){
	   $this->load->model('global_model');
	   
			$data['detail_cost_driver']  = $this->tr_cost_summary_report_model->detail_table_loader($date,$date_2);
			$data['detail_cost_lain']  = $this->tr_cost_summary_report_model->detail_table_loader2($date,$date_2);
			$date=format_new_date($date);
			$date_2=format_new_date($date_2);
			
			$this->global_model->create_report('Laporan_Biaya_summary_'.$date.'_s/d_'.$date_2.'','Laporan Biaya summary Tgl : '.$date.' s/d '.$date_2.'', 'report/tr_cost_summary_report.php', $data);
		}
	}
	
				
		
}
			
