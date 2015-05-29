<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class tr_cost_detail_report extends CI_Controller{
			function __construct(){
				parent::__construct();
				$this->load->library('render');
			 	$this->load->model('tr_cost_detail_report_model');
			 	$this->load->library('access');
			 	$this->access->set_module('tr_cost_detail_report.tr_cost_detail_report');
			 	$this->access->user_page();
			}
		
		function index(){
				
				$data = array();
				$data['row_id'] = '';
				$data['date'] = '';
				$this->load->helper('form');
				$this->render->add_form('app/tr_cost_detail_report/form', $data);
				$this->render->build('laporan biaya harian');
				$this->render->add_view('app/tr_cost_detail_report/transient_list');
				$this->render->build('Biaya sopir dan kernet');
				$this->render->add_view('app/tr_cost_detail_report/transient_list2');
				$this->render->build('Data Biaya lain-lain');
				$this->render->show('laporan biaya harian');
	}	
	function detail_table_loader($date = 0) {
			if($date == 0){
					send_json(make_datatables_list(null));
			}else{
				
				$data = $this->tr_cost_detail_report_model->detail_table_loader($date);
				
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
	function detail_table_loader2($date = 0) {
			if($date == 0){
					send_json(make_datatables_list(null));
			}else{
				
				$data = $this->tr_cost_detail_report_model->detail_table_loader2($date);
				
				$sort_id = 0;
				$no=1;
				
				foreach($data as $key => $value) 
				{
			
				$data[$key] = array(
						form_transient_pair('transient_cost_no', $no,$no),
						form_transient_pair('transient_cost_category', $value['tr_cost_type_name'],$value['tr_cost_type_name']),
						form_transient_pair('transient_cost_total', tool_money_format($value['tr_cost_price']),$value['tr_cost_price']),
						form_transient_pair('transient_cost_desc', $value['tr_cost_desc'],$value['tr_cost_desc']),
						
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

		$date = format_date($date);
		$data['total_cost_driver_co'] = $this->tr_cost_detail_report_model->get_total_cost_driver_co($date);
		$data['total_cost'] = $this->tr_cost_detail_report_model->get_total_cost($date);
		
		send_json_message('Satuan', $data);
	}		
	function report($date = 0){
	if($date){
	   $this->load->model('global_model');
	   
			$data['detail_cost_driver']  = $this->tr_cost_detail_report_model->detail_table_loader($date);
			$data['detail_cost_lain']  = $this->tr_cost_detail_report_model->detail_table_loader2($date);
			$date=format_new_date($date);
			
			$this->global_model->create_report('Laporan_Biaya_Harian_'.$date.'', 'report/tr_cost_detail_report.php', $data);
		}
	}


	
				
		
}
			
