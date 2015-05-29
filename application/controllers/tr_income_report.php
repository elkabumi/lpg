<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class tr_income_report extends CI_Controller{
			function __construct(){
				parent::__construct();
				$this->load->library('render');
			 	$this->load->model('tr_income_report_model');
			 	$this->load->library('access');
			 	$this->access->set_module('tr_income_report.tr_income_report');
			 	$this->access->user_page();
			}
		
		function index(){
				
				$data = array();
				$data['row_id'] = '';
				$data['date'] = '';
				$this->load->helper('form');
				$this->render->add_form('app/tr_income_report/form', $data);
				$this->render->build('laporan pendapatan harian');
				$this->render->add_view('app/tr_income_report/transient_list_income');
				$this->render->build('Date Pendapatan');
				$this->render->show('laporan pendapatan harian');
	}	
	function detail_table_loader_income($type=0,$date = 0) {
			if($type == 0){
					send_json(make_datatables_list(null));
			}else{
				
				$data = $this->tr_income_report_model->detail_table_loader_income($date);
				
				$sort_id = 0;
				$no=1;
				
				foreach($data as $key => $value) 
				{
				$data[$key] = array(
						form_transient_pair('transient_detail_no', $no,$no),
						form_transient_pair('transient_detail_date', $value['tr_plan_date'],$value['tr_plan_date']),
						
						form_transient_pair('transient_detail_purchase', tool_money_format($value['total_purcahse']),$value['total_purcahse']),
						form_transient_pair('transient_detail_price', tool_money_format($value['total_price']),$value['total_price']),
						form_transient_pair('transient_detail_cost', tool_money_format($value['total_cost']),$value['total_cost']),
						form_transient_pair('transient_detail_income',tool_money_format($value['total_income']),$value['total_income']),
					//form_transient_pair('transient_shipment_detail_link',$link,$link),
				
				);
				
		$no++;				
		}		
		send_json(make_datatables_list($data)); 
		}
	}
	function report($date = 0){
	
	if($date){
	   $this->load->model('global_model');
	   
			$data['detail']  = $this->tr_income_report_model->detail_table_loader_income($date);
			$date=format_new_date($date);
			$this->global_model->create_report('Laporan_Pendapatan_Harian_'.$date.'', 'report/tr_income_report.php', $data);
		}
	}


	
				
		
}
			
