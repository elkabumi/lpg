<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Tr_ralization extends CI_Controller{
			function __construct(){
				parent::__construct();
				$this->load->library('render');
			 	$this->load->model('tr_ralization_model');
			 	$this->load->library('access');
			 	$this->access->set_module('tr_plan.tr_plan');
			 	$this->access->user_page();
			}
		
	function index(){
				
				$data = array();
				$data['row_id'] = '';
				$data['tr_plan_detail_date_realization'] = '';
				$this->load->helper('form');
				
				$this->render->add_form('app/Tr_ralization/form', $data);
				$this->render->build('Realisasi Plan');
				
				$this->render->add_view('app/Tr_ralization/transient_list_kulak');
				$this->render->build('Detail Plan');
			
				$this->render->show('Realisasi Plan');
		}	
	function form($id){
			$result = $this->tr_ralization_model->read_id($id);
			if($result){
				$data = $result;
				$data['row_id'] = $id;
				$data['tr_plan_detail_date_realization'] = format_new_date($data['tr_plan_detail_date_realization']);

			}
		
		$this->load->helper('form');
		$this->render->add_form('app/tr_ralization/form_ralization', $data);
		$this->render->build('Realisasi Plan');
		$this->render->show('Realisasi Plan');
	}
	
	
	
	
	function form_action($is_delete = 0){
		
		$id = $this->input->post('row_id');
			
		if($is_delete){
			$is_proses_error = $this->tr_ralization_model->delete($id);
			send_json_action($is_proses_error, "Data telah dihapus");
		}
		
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('i_date','Tanggal Realisasi Pengambilan','trim|required|valid_date|sql_date');
		
		if($this->form_validation->run() == FALSE) send_json_validate();
		
		$data['tr_plan_detail_code'] 			= $this->input->post('i_code');
		$data['tr_plan_detail_date_realization'] 			= $this->input->post('i_date');
		$data['tr_plan_detail_status_realization'] 			= $this->input->post('i_status_type');
		//send_json($data['tr_plan_detail_status_realization']);
		if(empty($id)){
			$error = $this->tr_ralization_model->create($data,$items_plan_detail);
			send_json_action($error, "Data telah ditambah", "Data gagal ditambah");
		}else{
		
			$error = $this->tr_ralization_model->update($id,$data);
			send_json_action($error, "Data telah direvisi", "Data gagal direvisi");		
		}
		
	}
	

		function detail_table_loader_kulak($date = 0) {
			if($date == 0){
					send_json(make_datatables_list(null));
			}else{
				
				$data = $this->tr_ralization_model->detail_table_loader_kulak($date);
				
				
				$sort_id = 0;
				$no=1;
				foreach($data as $key => $value) 
				{
				if($value['tr_plan_detail_status_realization'] == 0){
					$status='Belum Terealisasi';
				}else{
					$status='Telah Terealisasi';
				}
				$link = "<a href=".site_url('tr_ralization/form/'.$value['tr_plan_detail_id'])." class='link_input'> Proses </a>";
			
				$data[$key] = array(
						form_transient_pair('transient_detail_no', $no,$no),
						form_transient_pair('transient_detail_date_tebusan', format_new_date($value['tr_plan_date']),$value['tr_plan_date']),
						form_transient_pair('transient_detail_code', $value['tr_plan_detail_code'],$value['tr_plan_detail_code']),
						form_transient_pair('transient_detail_date', format_new_date($value['tr_plan_detail_date_realization']),$value['tr_plan_detail_date_realization']),
						form_transient_pair('transient_detail_truck_id', $value['truck_nopol'],$value['truck_id']),
						form_transient_pair('transient_detail_spbe',$value['location_name'],$value['location_id']),
						form_transient_pair('transient_detail_qty',	$value['tr_plan_detail_qty'],$value['tr_plan_detail_qty']),	
						form_transient_pair('transient_detail_total', tool_money_format($value['tr_plan_detail_total_purchase']),$value['tr_plan_detail_total_purchase']),
						form_transient_pair('transient_detail_cost_driver',tool_money_format($value['tr_plan_detail_cost_driver']),$value['tr_plan_detail_cost_driver']),
						form_transient_pair('transient_detail_cost_co_driver',tool_money_format($value['tr_plan_detail_cost_co_driver']),$value['tr_plan_detail_cost_co_driver']),
						form_transient_pair('transient_detail_cost_lain',tool_money_format($value['tr_plan_detail_cost_lain']),$value['tr_plan_detail_cost_lain']),
						form_transient_pair('transient_detail_status', $status, $status),
						form_transient_pair('transient_detail', $link, $link),
		
				);
				
		$no++;				
		}		
		send_json(make_datatables_list($data)); 
		}
	}

	
	
	function load_data_truck()
	{
		$id 	= $this->input->post('id');
		
		$query = $this->tr_ralization_model->load_data_truck($id);
		$data = array();
		
		foreach($query->result_array() as $row)
		{
			$data['truck_nopol'] 		= $row['truck_nopol'];
			$data['driver_id'] 			= $row['driver_id'];
			$data['co_driver_id'] 		= $row['co_driver_id'];
			$data['driver_name'] 		= $row['driver_name'];
			$data['co_driver_name'] 	= $row['co_driver_name'];
			
		
			
		}
		send_json_message('Satuan', $data);
	}		
				
	function load_data_spbe()
	{
		$id 	= $this->input->post('id');
		
		$query = $this->tr_ralization_model->load_data_spbe($id);
		$data = array();
		
		foreach($query->result_array() as $row)
		{
			$data['location_name'] 		= $row['location_name'];
		
		}
		send_json_message('SPBE', $data);
	}		
	function load_data_route()
	{
		$id 	= $this->input->post('id');
		
		$query = $this->tr_ralization_model->load_data_route($id);
		$data = array();
		
		foreach($query->result_array() as $row)
		{
			$data['location_total_cost'] 	= $row['location_total_cost'];
			$data['location_from_name'] 	= $row['location_from_name'];
			$data['location_to_name'] 		= $row['location_to_name'];
			$data['harga'] 					= $row['harga'];
		
		}
		send_json_message('route', $data);
	}		
				
						
				
		
}
			
