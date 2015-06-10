<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Tr_report extends CI_Controller{
			function __construct(){
				parent::__construct();
				$this->load->library('render');
			 	$this->load->model('tr_report_model');
			 	$this->load->library('access');
			 	$this->access->set_module('tr_report.tr_report');
			 	$this->access->user_page();
			}
		
		function index(){
				
				$data = array();
				$data['row_id'] = '';
				$data['date_1'] = '';
				$data['date_2'] = '';
				$this->load->helper('form');
				$this->render->add_form('app/tr_report/form', $data);
				$this->render->build('laporan transaksi');
				$this->render->add_view('app/tr_report/transient_list');
				$this->render->build('Biaya sopir dan kernet');
				$this->render->show('laporan transaksi');
	}	
	function detail_table_loader($date_1 = 0,$date_2=0) {
			if($date_1 == 0 or $date_2 ==0 ){
					send_json(make_datatables_list(null));
			}else{
				
				$data = $this->tr_report_model->detail_table_loader($date_1,$date_2);
				
				$sort_id = 0;
				$no=1;
				
				foreach($data as $key => $value) 
				{
				$value['jumlah']= str_replace(',','<br>',$value['jumlah']);
				
				$value['tgl_kirim']= str_replace(',','<br>',$value['tgl_kirim']);
				$value['pangakalan']= str_replace(',','<br>',$value['pangakalan']);
				$value['tgl_dibayar']= str_replace(',','<br>',$value['tgl_dibayar']);
				$value['total']= str_replace(',','<br>',$value['total']);
				
				$value['dibayar']= str_replace(',','<br>',$value['dibayar']);
				$value['sisa']= str_replace(',','<br>',$value['sisa']);
			
		$data[$key] = array(
						form_transient_pair('transient_driver_no', $no,$no),
						form_transient_pair('transient_driver_no',format_new_date($value['tr_plan_date']),$value['tr_plan_detail_date_realization']),
						form_transient_pair('transient_driver_no',format_new_date($value['tr_plan_detail_date_realization']),$value['tr_plan_detail_date_realization']),
						form_transient_pair('transient_driver_no',  $value['tr_plan_detail_code'],$value['tr_plan_detail_code']),
						form_transient_pair('transient_driver_name', $value['truck_nopol'],$value['truck_nopol']),
						form_transient_pair('transient_driver_no',  $value['employee_name'],$value['employee_name']),
						form_transient_pair('transient_driver_no',$value['jumlah'],$value['jumlah']),
						form_transient_pair('transient_driver_no',$value['tgl_kirim'],$value['tgl_kirim']),
						form_transient_pair('transient_driver_name', $value['pangakalan'],$value['pangakalan']),
						
						form_transient_pair('transient_driver_name', $value['tgl_dibayar'],$value['tgl_dibayar']),
						form_transient_pair('transient_driver_cost', tool_money_format($value['total']),$value['total']),
						form_transient_pair('transient_driver_cost', tool_money_format($value['dibayar']),$value['dibayar']),
						form_transient_pair('transient_driver_cost', tool_money_format($value['sisa']),$value['sisa']),
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
				
				$data = $this->tr_report_model->detail_table_loader2($date_1,$date_2);
				
				$sort_id = 0;
				$no=1;
				
				foreach($data as $key => $value) 
				{
			
				$data[$key] = array(
						form_transient_pair('transient_cost_no', $no,$no),
						form_transient_pair('transient_cost_category', $value['tr_cost_type_name'],$value['tr_cost_type_name']),
						form_transient_pair('transient_cost_total', tool_money_format($value['total_cost']),$value['total_cost']),
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
		//biaya sopir dan kernet
		$data['total_cost_driver_co'] = $this->tr_report_model->get_total_cost_driver_co($date1,$date2);
		//biaya lain-lain
		$data['total_cost_lain'] = $this->tr_report_model->get_total_cost($date1,$date2);
		$data['total_cost_shipment_lain'] = $this->tr_report_model->get_total_cost_shipment_lain($date1,$date2);
		$data['total_cost_shipment_route'] = $this->tr_report_model->get_total_cost_shipment_route($date1,$date2);
	
		$data['total_cost'] = $data['total_cost_lain']  + $data['total_cost_shipment_lain'] + $data['total_cost_shipment_route'];
		send_json_message('Satuan', $data);
	}
	
	function report($date = 0,$date_2 = 0){
	if($date and $date_2){
	   $this->load->model('global_model');
	   
			$data['detail_cost_driver']  = $this->tr_report_model->detail_table_loader($date,$date_2);
			$data['detail_cost_lain']  = $this->tr_report_model->detail_table_loader2($date,$date_2);
			$date=format_new_date($date);
			$date_2=format_new_date($date_2);
			
			$this->global_model->create_report('Laporan_Biaya_summary_'.$date.'_s/d_'.$date_2.'','Laporan Biaya summary Tgl : '.$date.'  s/d   '.$date_2.'', 'report/tr_report.php', $data);
		}
	}
	
				
		
}
			
