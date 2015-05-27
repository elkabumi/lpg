<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class tr_shipment_report extends CI_Controller{
			function __construct(){
				parent::__construct();
				$this->load->library('render');
			 	$this->load->model('tr_shipment_report_model');
			 	$this->load->library('access');
			 	$this->access->set_module('tr_shipment_report.tr_shipment_report');
			 	$this->access->user_page();
			}
		
		function index(){
				
				$data = array();
				$data['row_id'] = '';
				$data['tr_plan_detail_date_realization'] = '';
				$this->load->helper('form');
				$this->render->add_form('app/tr_shipment_report/form', $data);
				$this->render->build('laporan penjualan harian');
				$this->render->add_view('app/tr_shipment_report/transient_list_shipment');
				$this->render->build('Date penjualan');
				$this->render->show('laporan penjualan harian');
	}	
	function detail_table_loader_shipment($date = 0) {
			if($date == 0){
					send_json(make_datatables_list(null));
			}else{
				
				$data = $this->tr_shipment_report_model->detail_table_loader_shipment($date);
				
				$sort_id = 0;
				$no=1;
				
				foreach($data as $key => $value) 
				{
				if($value['tr_plan_detail_shipment_status_realization'] == 0){
					$status='Belum Terealisasi';
				}else{
					$status='Telah Terealisasi';
				}
			
				$data[$key] = array(
						form_transient_pair('transient_detail_no', $no,$no),
						form_transient_pair('transient_detail_code', $value['tr_plan_detail_code'],$value['tr_plan_detail_code']),
						form_transient_pair('transient_detail_date', $value['tr_plan_detail_date_realization'],$value['tr_plan_detail_date_realization']),
						form_transient_pair('transient_detail_truck_id', $value['truck_nopol'],$value['truck_id']),
						form_transient_pair('transient_detail_spbe',$value['spbe'],$value['spbe']),
						
						form_transient_pair('transient_shipment_detail_date',$value['tr_plan_detail_shipment_realization_date'],$value['tr_plan_detail_shipment_realization_date']),
						
						form_transient_pair('transient_shipment_detail_route_from', $value['route_from'],$value['location_from_id']),
						form_transient_pair('transient_shipment_detail_route_to', $value['route_to'],$value['location_to_id'],
											array('transient_shipment_detail_route_id' =>$value['route_id'],$value['route_id'],
												  'transient_tr_plan_detail_shipment_id' =>$value['tr_plan_detail_shipment_id'],$value['tr_plan_detail_shipment_id'],
												  'transient_shipment_detail_price' =>$value['tr_plan_detail_shipment_price'],$value['tr_plan_detail_shipment_price'],
											
											)
						),

						form_transient_pair('transient_shipment_detail_qty',$value['tr_plan_detail_shipment_qty'],$value['tr_plan_detail_shipment_qty']),
						form_transient_pair('transient_shipment_detail_total_price',$value['tr_plan_detail_shipment_total_price'],$value['tr_plan_detail_shipment_total_price']),
						form_transient_pair('transient_shipment_detail_cost',$value['tr_plan_detail_shipment_cost'],$value['tr_plan_detail_shipment_cost']),
						//form_transient_pair('transient_shipment_detail_link',$link,$link),
				
				);
				
		$no++;				
		}		
		send_json(make_datatables_list($data)); 
		}
	}

	
				
		
}
			
