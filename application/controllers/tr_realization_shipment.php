<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class tr_realization_shipment extends CI_Controller{
			function __construct(){
				parent::__construct();
				$this->load->library('render');
			 	$this->load->model('tr_realization_shipment_model');
			 	$this->load->library('access');
			 	$this->access->set_module('tr_realization_shipment.tr_realization_shipment');
			 	$this->access->user_page();
			}
		
		function index(){
				
				$data = array();
				$data['row_id'] = '';
				$data['tr_plan_detail_date_realization'] = '';
				$this->load->helper('form');
				$this->render->add_form('app/tr_realization_shipment/form', $data);
				$this->render->build('Realisasi Kirim');
				$this->render->add_view('app/tr_realization_shipment/transient_list_shipment');
				$this->render->build('Detail Kirim');
				$this->render->show('Realisasi Kirim');
	}	
	function form($id){
			$result = $this->tr_realization_shipment_model->read_id($id);
			if($result){
				$data = $result;
				$data['row_id'] = $id;
				$data['tr_plan_detail_shipment_realization_date'] = format_new_date($data['tr_plan_detail_shipment_realization_date']);

			}
		
		$this->load->helper('form');
		$this->render->add_form('app/tr_realization_shipment/form_ralization_shipment', $data);
		$this->render->build('Realisasi Kirim');
		$this->render->show('Realisasi Kirim');
	}
	
	
	
	
	function form_action($is_delete = 0){
		
		$id = $this->input->post('row_id');
			
		if($is_delete){
			$is_proses_error = $this->tr_realization_shipment_model->delete($id);
			send_json_action($is_proses_error, "Data telah dihapus");
		}
		
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('i_date','Tanggal Realisasi Pengambilan','trim|required|valid_date|sql_date');
		
		if($this->form_validation->run() == FALSE) send_json_validate();
		
		$data['tr_plan_detail_shipment_realization_date'] 			= $this->input->post('i_date');
		$data['tr_plan_detail_shipment_status_realization'] 			= $this->input->post('i_status_type');
		
		//send_json($data['tr_plan_detail_shipment_realization_date']);
		
		if(empty($id)){
			$error = $this->tr_realization_shipment_model->create($data);
			send_json_action($error, "Data telah ditambah", "Data gagal ditambah");
		}else{
		$error = $this->tr_realization_shipment_model->update($id,$data);
			send_json_action($error, "Data telah direvisi", "Data gagal direvisi");		
		}
		
	}
	

		function detail_table_loader_shipment($date = 0) {
			if($date == 0){
					send_json(make_datatables_list(null));
			}else{
				
				$data = $this->tr_realization_shipment_model->detail_table_loader_shipment($date);
				
				$sort_id = 0;
				$no=1;
				
				foreach($data as $key => $value) 
				{
				if($value['tr_plan_detail_shipment_status_realization'] == 0){
					$status='Belum Terealisasi';
					$link = "<a href=".site_url('tr_realization_shipment/form/'.$value['tr_plan_detail_shipment_id'])." class='link_input'> Realisasi </a>";
			
				}else{
					$status='Telah Terealisasi';
					$link = "";
				}
				
				$data[$key] = array(
						form_transient_pair('transient_detail_date', format_new_date($value['tr_plan_detail_date_realization']),$value['tr_plan_detail_date_realization']),
						form_transient_pair('transient_shipment_detail_date', format_new_date($value['tr_plan_detail_shipment_realization_date']),$value['tr_plan_detail_shipment_realization_date']),
						
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
						form_transient_pair('transient_shipment_detail_status_realization',show_checkbox_status($value['tr_plan_detail_shipment_status_realization'] ),$value['tr_plan_detail_shipment_status_realization'] ),
						form_transient_pair('transient_shipment_detail_link',$link,$link),
				
				);
				
		$no++;				
		}		
		send_json(make_datatables_list($data)); 
		}
	}

	
				
		
}
			
