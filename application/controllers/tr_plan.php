<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Tr_plan extends CI_Controller{
			function __construct(){
			parent::__construct();
			$this->load->library('render');
			$this->load->model('tr_plan_model');
			$this->load->library('access');
			$this->access->set_module('tr_plan.tr_plan');
			$this->access->user_page();
			}
			function index(){
			$this->render->add_view('app/tr_plan/list');
			$this->render->build('Plan');
			$this->render->show('Plan');
		}
		
	function table_controller(){
			$data = $this->tr_plan_model->list_controller();
			send_json($data);
		}
		
	function form($id = 0){
		$data = array();
		if($id==0){
			$data['row_id']				= '';
			//$data['truck_code']			= format_code('trucks','truck_code','S',7);
			
			$data['tr_plan_total_order']		= '';
			$data['tr_plan_total_purchase']		= '';
			
			
			$data['tr_plan_total_shipment	']	= '';
			$data['tr_plan_date']	= '';
	
	
		
		}else{
			$result = $this->tr_plan_model->read_id($id);
			if($result){
				$data = $result;
				$data['row_id'] = $id;
				$data['tr_plan_date'] = format_new_date($data['tr_plan_date']);
			}
		}
		$this->load->helper('form');
			
		$this->render->add_form('app/tr_plan/form', $data);
		$this->render->build('Plan');
		//List Kulak
		$this->render->add_view('app/tr_plan/transient_list_kulak');
		$this->render->build('Data Kulak');
		
		$this->render->show('Plan');
	}
	function form_plan($id){
		//$data = array();
		/*if($id==0){
			$data['row_id']				= '';
			//$data['truck_code']			= format_code('trucks','truck_code','S',7);
			$data['tr_plan_qty']			= '';
			$data['tr_plan_total_order']		= '';
			$data['tr_plan_total_shipment	']	= '';
			$data['tr_plan_date']	= '';
	
	
		
		}else{*/
		
			$result = $this->tr_plan_model->read_plan_id($id);
			if($result){
				$data = $result;
				$data['row_id'] = $id;
			}
		//}
		$this->load->helper('form');
			
		$this->render->add_form('app/tr_plan/form_plan', $data);
		$this->render->build('Detail Plan');
		//List Pengiriman
		$this->render->add_view('app/tr_plan/transient_list_shipment', $data);
		$this->render->build('Data Kulak');
		
		$this->render->show('Detail Plan');
	}
	
	
	
	function form_action($is_delete = 0){
		
		$id = $this->input->post('row_id');
			
		if($is_delete){
			$is_proses_error = $this->tr_plan_model->delete($id);
			send_json_action($is_proses_error, "Data telah dihapus");
		}
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('i_date','Tanggal Plan','trim|required|valid_date|sql_date');
		
		if($this->form_validation->run() == FALSE) send_json_validate();
		
		$data['tr_plan_date'] 				= $this->input->post('i_date');
	
		
		
		$get_date=$this->tr_plan_model->cek_date($data['tr_plan_date']);
	
		if($get_date > 1){
			 send_json_error('Simpan gagal. Plan di Tanggal '.$data['tr_plan_date'].' Sudah ada');
	
		}
			// simpan transient kulak
		$list_td_code			= ($this->input->post('transient_detail_code'));
		$list_td_truck_id		= ($this->input->post('transient_detail_truck_id'));
		$list_td_cost_lain		= ($this->input->post('transient_detail_cost_lain'));
		$list_td_driver 		= ($this->input->post('transient_detail_driver'));
		$list_td_driver_id		= ($this->input->post('transient_detail_driver_id'));
		$list_td_co_driver		= ($this->input->post('transient_detail_co_driver'));
		$list_td_co_driver_id 	= ($this->input->post('transient_detail_co_driver_id'));
		$list_td_plan_id		= ($this->input->post('transient_detail_plan_id'));
		$list_td_spbe			= ($this->input->post('transient_detail_spbe'));
		$list_td_qty 			= ($this->input->post('transient_detail_qty'));
		$list_td_purchase		= ($this->input->post('transient_detail_purchase'));
		$list_td_total_purchase	= ($this->input->post('transient_detail_total'));
		$list_td_cost_driver 	= ($this->input->post('transient_detail_cost_driver'));
		$list_td_cost_co_driver	= ($this->input->post('transient_detail_cost_co_driver'));
		$list_td_cost_lain		= ($this->input->post('transient_detail_cost_lain'));
					
	
		$total_purchase = 0;
		$total_kulak 	= 0;
		$items_plan_detail = array();
		if(!$list_td_truck_id) send_json_error('Simpan gagal. Data Kulak Masih Kosong');
	
		if($list_td_truck_id){
			foreach($list_td_truck_id as $key => $value)
			{
			$items_plan_detail[] = array(
					'tr_plan_detail_id' => ($list_td_plan_id[$key]),
					'location_id' => ($list_td_spbe[$key]),
					'truck_id' => ($list_td_truck_id[$key]),
					'driver_id' => ($list_td_driver_id[$key]),
					'co_driver_id' => ($list_td_co_driver_id[$key]),
					'tr_plan_detail_code' => ($list_td_code[$key]),
					'tr_plan_detail_qty' => ($list_td_qty[$key]),
					'tr_plan_detail_purchase' => ($list_td_purchase[$key]),
					'tr_plan_detail_total_purchase' => ($list_td_total_purchase[$key]),
					'tr_plan_detail_cost_driver' => ($list_td_cost_driver[$key]),
					'tr_plan_detail_cost_co_driver' => ($list_td_cost_co_driver[$key]),
					'tr_plan_detail_cost_lain' => ($list_td_cost_lain[$key]),
			);
			   $total_kulak += $list_td_qty[$key];
			    $total_purchase += $list_td_total_purchase[$key];
			}		
		}
		
		$data['tr_plan_total_order'] = $total_kulak;
		$data['tr_plan_total_purchase'] = $total_purchase;		
		if(empty($id)){
			$error = $this->tr_plan_model->create($data,$items_plan_detail);
			send_json_action($error, "Data telah ditambah", "Data gagal ditambah",$this->tr_plan_model->insert_id);
		}else{
			$error = $this->tr_plan_model->update($id, $data,$items_plan_detail);
			send_json_action($error, "Data telah direvisi", "Data gagal direvisi",$id);		
		}
		
	}
	function form_plan_action($is_delete = 0){
		
		$id = $this->input->post('row_id');
			
		if($is_delete){
			$is_proses_error = $this->tr_plan_model->delete($id);
			send_json_action($is_proses_error, "Data telah dihapus");
		}
		
		$this->load->library('form_validation');
		/*
		$this->form_validation->set_rules('i_date','Tanggal Plan','trim|required|valid_date|sql_date');
		
		if($this->form_validation->run() == FALSE) send_json_validate();
		
		$data['tr_plan_date'] 				= $this->input->post('i_date');
		*/
		$data['tr_plan_detail_qty'] 				= $this->input->post('i_qty_kulak');
		
		// simpan transient shipment/pengiriman
		$list_ts_route_id	= ($this->input->post('transient_shipment_detail_route_id'));
		$list_ts_route_qty	= ($this->input->post('transient_shipment_detail_qty'));
		$list_ts_route_price	= ($this->input->post('transient_shipment_detail_price'));
		$list_ts_route_total_price	= ($this->input->post('transient_shipment_detail_total_price'));
		$list_ts_route_cost = ($this->input->post('transient_shipment_detail_cost'));
		$list_shipment_id = ($this->input->post('transient_tr_plan_detail_shipment_id'));
		
			
					
	
		$total_kirim 	= 0;
		$total_sisa 	= 0;
		$items_shipment = array();
		if(!$list_ts_route_id) send_json_error('Simpan gagal. Data Pengiriman Masih Kosong');
	
		if($list_ts_route_id){
			foreach($list_ts_route_id as $key => $value)
			{
			$items_shipment[] = array(
					'tr_plan_detail_shipment_id' => ($list_shipment_id[$key]),
					'route_id' => ($list_ts_route_id[$key]),
					'tr_plan_detail_shipment_qty' => ($list_ts_route_qty[$key]),
					'tr_plan_detail_shipment_price' => ($list_ts_route_price[$key]),
					'tr_plan_detail_shipment_total_price' => ($list_ts_route_total_price[$key]),
					'tr_plan_detail_shipment_cost' => ($list_ts_route_cost[$key]),
					'tr_plan_detail_shipment_total_paid' => 0,
					'tr_plan_detail_shipment_status_id' => 0,
			);
			   $total_kirim += $list_ts_route_qty[$key];
			}		
		}
		
		if($total_kirim > $data['tr_plan_detail_qty']){
			send_json_error('Simpan Gagal. Jumlah Keseluruhan Total Kirim Tidak boleh melebihi Total kulak['.$data['tr_plan_detail_qty'].']');
		}
		$data['tr_plan_detail_qty_shipment'] = $total_kirim;
		$data['tr_plan_detail_qty_sisa'] = $data['tr_plan_detail_qty'] -	$data['tr_plan_detail_qty_shipment'];
		if(empty($id)){
			$error = $this->tr_plan_model->create_plan($data,$items_shipment);
			send_json_action($error, "Data telah ditambah", "Data gagal ditambah",$this->tr_plan_model->insert_id);
		}else{
			$error = $this->tr_plan_model->update_plan($id, $data,$items_shipment);
			send_json_action($error, "Data telah direvisi", "Data gagal direvisi",$id);		}
		
	}
		
	function detail_list_loader_kulak($row_id=0)
			{
			if($row_id == 0)
				
				send_json(make_datatables_list(null)); 
						
				$data = $this->tr_plan_model->detail_list_loader_kulak($row_id);
				$sort_id = 0;
				foreach($data as $key => $value) 
				{
				if(!$value['tr_plan_detail_id']){
					$detail='';
				}else{
					$detail="<a href='".site_url('tr_plan/form_plan/'.$value['tr_plan_detail_id'])."' class='link_input' style='color:#fff;'>detail </a>";
				}
				$data[$key] = array(
						form_transient_pair('transient_detail_code', $value['tr_plan_detail_code'],$value['tr_plan_detail_code']),
												
						form_transient_pair('transient_detail_truck_id', $value['truck_nopol'],$value['truck_id'],
												array(
													  'transient_detail_nopol'=>$value['truck_nopol'],$value['truck_nopol'],
													  'transient_detail_driver'=>$value['driver_name'],$value['driver_name'],
													  'transient_detail_driver_id'=>$value['driver_id'],$value['driver_id'],
													  'transient_detail_co_driver'=>$value['co_driver_name'],$value['co_driver_name'],
													  'transient_detail_co_driver_id'=>$value['co_driver_id'],$value['co_driver_id'],
													  'transient_detail_plan_id'=>$value['tr_plan_detail_id'],$value['tr_plan_detail_id']
													  )
												),
						form_transient_pair('transient_detail_spbe',$value['location_name'],$value['location_id']),
						form_transient_pair('transient_detail_qty',	$value['tr_plan_detail_qty'],$value['tr_plan_detail_qty'],
											array('transient_detail_purchase'=>$value['tr_plan_detail_purchase'],$value['tr_plan_detail_purchase'])
											),	
						form_transient_pair('transient_detail_total', tool_money_format($value['tr_plan_detail_total_purchase']),$value['tr_plan_detail_total_purchase']),
						form_transient_pair('transient_detail_cost_driver',tool_money_format($value['tr_plan_detail_cost_driver']),$value['tr_plan_detail_cost_driver']),
						form_transient_pair('transient_detail_cost_co_driver',tool_money_format($value['tr_plan_detail_cost_co_driver']),$value['tr_plan_detail_cost_co_driver']),
						form_transient_pair('transient_detail_cost_lain',tool_money_format($value['tr_plan_detail_cost_lain']),$value['tr_plan_detail_cost_lain']),
						form_transient_pair('transient_detail', $detail, $detail),
		
				);
				
						
		}		
		send_json(make_datatables_list($data)); 
	}
	
	function detail_list_loader_shipment($row_id=0)
			{
			if($row_id == 0)
				
				send_json(make_datatables_list(null)); 
						
				$data = $this->tr_plan_model->detail_list_loader_shipment($row_id);
				$sort_id = 0;
				foreach($data as $key => $value) 
				{
				$data[$key] = array(
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
						
				);
				
						
		}		
		send_json(make_datatables_list($data)); 
	}
	
	function detail_form_kulak($row_id = 0) // jika id tidak diisi maka dianggap create, else dianggap edit
		{		
			$this->load->library('render');
			$index = $this->input->post('transient_index');
			if (strlen(trim($index)) == 0) {
						
				// TRANSIENT CREATE - isi form dengan nilai default / kosong
					$cost=$this->tr_plan_model->get_cost();
					$data['index']							= '';
					$data['tr_plan_id']						= $row_id ;
					$data['transient_detail_code'] 			= '';
					$data['transient_detail_nopol'] 		= '';
					$data['transient_detail_truck_id'] 		= '';
					$data['transient_detail_driver'] 		= '';
					$data['transient_detail_driver_id'] 	= '';
					$data['transient_detail_co_driver'] 	= '';
					$data['transient_detail_co_driver_id'] 	= '';
					$data['transient_detail_plan_id'] 		= '';
					$data['transient_detail_spbe'] 			= '';
					$data['transient_detail_qty'] 			= '';
					$data['transient_detail_total'] 		= '';
					
					$data['transient_detail_purchase'] 		= $cost[0];
					$data['transient_detail_cost_driver'] 	= $cost[1];
					$data['transient_detail_cost_co_driver']= $cost[2];
					$data['transient_detail_cost_lain'] 	= '';
			
					
			} else {
				
					$data['index']						= $index;
					$data['tr_plan_id'] 				= $row_id;
					$data['transient_detail_code'] 			= array_shift($this->input->post('transient_detail_code'));;
					$data['transient_detail_nopol'] 		= array_shift($this->input->post('transient_detail_nopol'));
					$data['transient_detail_truck_id'] 		= array_shift($this->input->post('transient_detail_truck_id'));
					$data['transient_detail_driver'] 		= array_shift($this->input->post('transient_detail_driver'));
					$data['transient_detail_driver_id'] 	= array_shift($this->input->post('transient_detail_driver_id'));
					$data['transient_detail_co_driver'] 	= array_shift($this->input->post('transient_detail_co_driver'));
					$data['transient_detail_co_driver_id'] 	= array_shift($this->input->post('transient_detail_co_driver_id'));
					$data['transient_detail_plan_id'] 		= array_shift($this->input->post('transient_detail_plan_id'));
					$data['transient_detail_spbe'] 			= array_shift($this->input->post('transient_detail_spbe'));
					$data['transient_detail_qty'] 			= array_shift($this->input->post('transient_detail_qty'));
					$data['transient_detail_total'] 		= array_shift($this->input->post('transient_detail_total'));
					$data['transient_detail_purchase'] 		= array_shift($this->input->post('transient_detail_purchase'));
					$data['transient_detail_cost_driver'] 	= array_shift($this->input->post('transient_detail_cost_driver'));
					$data['transient_detail_cost_co_driver']= array_shift($this->input->post('transient_detail_cost_co_driver'));
					$data['transient_detail_cost_lain'] 	= array_shift($this->input->post('transient_detail_cost_lain'));
					
					
					
			}
		
			$this->render->add_form('app/tr_plan/transient_form_kulak', $data);
			$this->render->show_buffer();
	}
	
	
	function detail_form_shipment($row_id = 0) // jika id tidak diisi maka dianggap create, else dianggap edit
	{	$this->load->library('render');
			$index = $this->input->post('transient_index');
			if (strlen(trim($index)) == 0) {
						
				// TRANSIENT CREATE - isi form dengan nilai default / kosong
					$cost=$this->tr_plan_model->get_cost();
					$data['index']							= '';
					$data['row_id']						= $row_id ;
					$data['transient_shipment_detail_route_from'] 	= '';
					$data['transient_shipment_detail_route_to'] 	= '';
					$data['transient_shipment_detail_route_id'] 	= '';
					$data['transient_shipment_detail_qty'] 			= '';
					$data['transient_shipment_detail_price'] 		= '';
					$data['transient_shipment_detail_total_price'] 	= '';
					$data['transient_shipment_detail_cost'] 		= '';
					$data['transient_tr_plan_detail_shipment_id'] 		= '';
					
					
			
					
			} else {
				
					$data['index']									= $index;
					$data['row_id'] 						= $row_id;
					$data['transient_shipment_detail_route_from'] 	= array_shift($this->input->post('transient_shipment_detail_route_from'));;
					$data['transient_shipment_detail_route_to']	 	= array_shift($this->input->post('transient_shipment_detail_route_to'));
					$data['transient_shipment_detail_route_id']		= array_shift($this->input->post('transient_shipment_detail_route_id'));
					$data['transient_shipment_detail_qty'] 			= array_shift($this->input->post('transient_shipment_detail_qty'));
					$data['transient_shipment_detail_price'] 		= array_shift($this->input->post('transient_shipment_detail_price'));
					$data['transient_shipment_detail_total_price'] 	= array_shift($this->input->post('transient_shipment_detail_total_price'));
					$data['transient_shipment_detail_cost'] 		= array_shift($this->input->post('transient_shipment_detail_cost'));
					$data['transient_tr_plan_detail_shipment_id'] 	= array_shift($this->input->post('transient_tr_plan_detail_shipment_id'));
					
			}
				
		
				$this->render->add_form('app/tr_plan/transient_form_shipment', $data);
				$this->render->show_buffer();
	}
	
	
	function detail_form_action_kulak()
	{		
			$this->load->library('form_validation');
			$this->form_validation->set_rules('i_truck_id', 'Truck', 'trim|required');
			$this->form_validation->set_rules('i_spbe_id', 'SPBE', 'trim|required');
			$this->form_validation->set_rules('i_qty', 'SPBE', 'trim|required|integer|min_value[0]');
			$this->form_validation->set_rules('i_purchase', 'Harga satuan', 'trim|required|integer|min_value[0]');
			
			$index = $this->input->post('i_index');		
			// cek data berdasarkan kriteria
			if ($this->form_validation->run() == FALSE) send_json_validate();
		
			$no 						= $this->input->post('i_index');
			$transient_detail_code 	= $this->input->post('i_code');
			
			$transient_detail_nopol 	= $this->input->post('i_truck_nopol');
			$transient_detail_truck_id 	= $this->input->post('i_truck_id');
			$transient_detail_driver 	= $this->input->post('i_driver_name');
			
			$transient_detail_driver_id 	= $this->input->post('i_driver_id');
			$transient_detail_co_driver_id 	= $this->input->post('i_co_driver_id');
			
			$transient_detail_co_driver 	= $this->input->post('i_co_driver_name');
			$transient_detail_plan_id 	= $this->input->post('i_plan_id');
			$transient_detail_spbe 	= $this->input->post('i_spbe_id');
			$transient_detail_spbe_name 	= $this->input->post('i_location_name');
			$transient_detail_qty 	= $this->input->post('i_qty');
			$transient_detail_purchase 	= $this->input->post('i_purchase');
			$transient_detail_total 	= $this->input->post('i_total_purchase');
			$transient_detail_cost_driver 	= $this->input->post('i_cost_driver');
			$transient_detail_cost_co_driver 	= $this->input->post('i_cost_co_driver');
			$transient_detail_cost_lain 	= $this->input->post('i_cost_lain');
	
			
			$data = array(
						form_transient_pair('transient_detail_code', $transient_detail_code,$transient_detail_code),
						form_transient_pair('transient_detail_truck_id', $transient_detail_nopol,$transient_detail_truck_id,
												array(
													  'transient_detail_nopol'=>$transient_detail_nopol,$transient_detail_nopol,
													  'transient_detail_driver'=>$transient_detail_driver,$transient_detail_driver,
													  'transient_detail_driver_id'=>$transient_detail_driver_id,$transient_detail_driver_id,
													  'transient_detail_co_driver'=>$transient_detail_co_driver,$transient_detail_co_driver,
													  'transient_detail_co_driver_id'=>$transient_detail_co_driver_id,$transient_detail_co_driver_id,
													  'transient_detail_plan_id'=>$transient_detail_plan_id,$transient_detail_plan_id
													  )
												),
						form_transient_pair('transient_detail_spbe',$transient_detail_spbe_name,$transient_detail_spbe),
						form_transient_pair('transient_detail_qty',	$transient_detail_qty,$transient_detail_qty,
											array('transient_detail_purchase'=>$transient_detail_purchase,$transient_detail_purchase)
											),	
						form_transient_pair('transient_detail_total', tool_money_format($transient_detail_total),$transient_detail_total),
						form_transient_pair('transient_detail_cost_driver',tool_money_format($transient_detail_cost_driver),$transient_detail_cost_driver),
						form_transient_pair('transient_detail_cost_co_driver',tool_money_format($transient_detail_cost_co_driver),$transient_detail_cost_co_driver),
						form_transient_pair('transient_detail_cost_lain',tool_money_format($transient_detail_cost_lain),$transient_detail_cost_lain),
						form_transient_pair('transient_detail', '', ''),
		
				);
		
		send_json_transient($index, $data);

		
	}		
	
	function detail_form_action_shipment()
	{		
			$this->load->library('form_validation');
			$this->form_validation->set_rules('i_route_id', 'Route', 'trim|required');
			$this->form_validation->set_rules('i_qty', 'Jumlah Kirim', 'trim|required|integer');
			$this->form_validation->set_rules('i_price', 'Harga Kirim', 'trim|required|integer');
			
			$index = $this->input->post('i_index');		
			// cek data berdasarkan kriteria
			if ($this->form_validation->run() == FALSE) send_json_validate();
		
			$no 									= $this->input->post('i_index');
			$row_id 									= $this->input->post('row_id');
			
			$transient_shipment_detail_route_id 	= $this->input->post('i_route_id');
			$transient_shipment_detail_route_from 	= $this->input->post('i_location_from');
			$transient_shipment_detail_route_to 	= $this->input->post('i_location_to');
			$transient_shipment_detail_cost 		= $this->input->post('i_cost_route');
			$transient_shipment_detail_qty 			= $this->input->post('i_qty');
			$transient_shipment_detail_price 		= $this->input->post('i_price');
			$transient_shipment_detail_total_price 		= $this->input->post('i_total_price');
			
			$transient_tr_plan_detail_shipment_id 	= $this->input->post('i_tr_plan_shipment_id');
		
		$total_kulak =  $this->tr_plan_model->get_total_kulak($row_id);
		
		if($transient_shipment_detail_qty > $total_kulak ){
			 send_json_error('Simpan gagal. Jumlah Kirim tidak boleh melebihi Jumlah Kulak['.$total_kulak.']');
		}
			$data = array(
					form_transient_pair('transient_shipment_detail_route_from', $transient_shipment_detail_route_from,$transient_shipment_detail_route_from),
						form_transient_pair('transient_shipment_detail_route_to', $transient_shipment_detail_route_to,$transient_shipment_detail_route_to,
											array('transient_shipment_detail_route_id' =>$transient_shipment_detail_route_id,$transient_shipment_detail_route_id,
												  'transient_tr_plan_detail_shipment_id' =>$transient_tr_plan_detail_shipment_id,$transient_tr_plan_detail_shipment_id,
												  'transient_shipment_detail_price' =>$transient_shipment_detail_price,$transient_shipment_detail_price,
				
											)
						),
						form_transient_pair('transient_shipment_detail_qty',$transient_shipment_detail_qty,$transient_shipment_detail_qty),
						form_transient_pair('transient_shipment_detail_total_price',$transient_shipment_detail_total_price,$transient_shipment_detail_total_price),
						form_transient_pair('transient_shipment_detail_cost',$transient_shipment_detail_cost,$transient_shipment_detail_cost ),
						
				);
		
		send_json_transient($index, $data);

		
	}					
	function load_data_truck()
	{
		$id 	= $this->input->post('id');
		
		$query = $this->tr_plan_model->load_data_truck($id);
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
		
		$query = $this->tr_plan_model->load_data_spbe($id);
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
		
		$query = $this->tr_plan_model->load_data_route($id);
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
			
