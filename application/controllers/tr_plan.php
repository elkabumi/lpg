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
				
				$data = array();
					$data['row_id'] = '';
					$data['date'] =0;
					$data['tr_plan_date'] = '';
				
				
				$this->load->helper('form');
				$this->render->add_form('app/tr_plan/form', $data);
				$this->render->build('Plan');
				
				$this->render->add_view('app/tr_plan/transient_list_kulak');
				$this->render->build('Detail Plan');
				
				$this->render->add_form('app/tr_plan/form_save', $data);
				$this->render->build('Plan');
				$this->render->show('Plan');
		}
		function form($date=0){
				
				$data = array();
				if($date==0){
					$data['row_id'] = '';
					$data['date'] =0;
					$data['tr_plan_date'] = '';
				
				}else{
					$data['row_id'] = '';
					$data['date'] = $date;
					$data['tr_plan_date'] = format_new_date($date);
				}
				$this->load->helper('form');
				$this->render->add_form('app/tr_plan/form', $data);
				$this->render->build('Plan');
				
				$this->render->add_view('app/tr_plan/transient_list_kulak');
				$this->render->build('Detail Plan');
				
				$this->render->add_form('app/tr_plan/form_save', $data);
				$this->render->build('Plan');
				$this->render->show('Plan');
		}
		function form_plan($id){

		
			$result = $this->tr_plan_model->read_plan_id($id);
			if($result){
				$data = $result;
				$data['row_id'] = $id;

			}
		
		$this->load->helper('form');
			
		$this->render->add_form('app/tr_plan/form_plan', $data);
		$this->render->build('Detail Plan');
		//List Pengiriman
		$this->render->add_view('app/tr_plan/transient_list_shipment', $data);
		$this->render->build('Data Kulak');
		
		$this->render->add_form('app/tr_plan/form_plan_save', $data);
		$this->render->build('Detail Plan');
			
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
		
		$data['tr_plan_date'] 			= $this->input->post('i_date');
	
		
		// simpan transient kulak
		//$list_td_code			= ($this->input->post('transient_detail_code'));
		$list_td_date		= ($this->input->post('transient_detail_date'));
		
		$list_td_truck_id		= ($this->input->post('transient_detail_truck_id'));
		$list_td_cost_lain		= ($this->input->post('transient_detail_cost_lain'));
		$list_td_driver_type	= ($this->input->post('transient_detail_driver_type'));
		$list_td_driver 		= ($this->input->post('transient_detail_driver'));
		$list_td_driver_id		= ($this->input->post('transient_detail_driver_id'));
		$list_td_co_driver		= ($this->input->post('transient_detail_co_driver'));
		$list_td_co_driver_id 	= ($this->input->post('transient_detail_co_driver_id'));
		$list_td_co_driver_add_id 	= ($this->input->post('transient_detail_co_driver_add_id'));
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
					'tr_plan_detail_date_realization' => ($list_td_date[$key]),
					'truck_id' => ($list_td_truck_id[$key]),
					'tr_plan_truck_driver_type' => ($list_td_driver_type[$key]),
					'driver_id' => ($list_td_driver_id[$key]),
					'co_driver_id' => ($list_td_co_driver_id[$key]),
					'co_driver_additional_id' => ($list_td_co_driver_add_id[$key]),
					//'tr_plan_detail_code' => ($list_td_code[$key]),
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
		
		
		if(empty($id)){
			
			$error = $this->tr_plan_model->create($data,$items_plan_detail);
			send_json_action($error, "Data telah ditambah", "Data gagal ditambah");
		}else{
		
			$error = $this->tr_plan_model->update($id,$data,$items_plan_detail);
			send_json_action($error, "Data telah direvisi", "Data gagal direvisi",$id);		
		}
		
	}
	function form_plan_action($is_delete = 0){
		
		$id = $this->input->post('row_id');
			
		/*if($is_delete){
			$is_proses_error = $this->tr_plan_model->delete($id);
			send_json_action($is_proses_error, "Data telah dihapus");
		}*/
		
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
		$list_ts_date= ($this->input->post('transient_shipment_detail_date'));
		
		
			
					
	
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
					'tr_plan_detail_shipment_realization_date' => ($list_ts_date[$key]),

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
		

		function detail_table_loader_kulak($date = 0) {
			if($date == 0){
					send_json(make_datatables_list(null));
			}else{
				
				$data = $this->tr_plan_model->detail_table_loader_kulak($date);
				
				
				$sort_id = 0;
				$no=1;
				$div1 = "<span class='active'>";
				$div2 = "</div>";
				foreach($data as $key => $value) 
				{
					if(!$value['truck_id']){
						$detail='';
					}else{
						$detail="<a href='".site_url('tr_plan/form_plan/'.$value['tr_plan_detail_id'])."' class='link_input' style='color:#fff;'>detail </a>";
					}
					$detail_kirim = $this->tr_plan_model->get_detail_kirim($value['tr_plan_detail_id']);
					//send_json($detail_kirim);
					if($detail_kirim > 0){
						 $no = $div1.$value['tr_plan_detail_no'].$div2 ;
						 $location = $div1.$value['location_name'].$div2;
						 $plan_purchase_date = $div1.format_new_date($value['tr_plan_purchase_date']).$div2;
						 $date_realization = $div1.format_new_date($value['tr_plan_detail_date_realization']).$div2;
						 $nopol = $div1.$value['truck_nopol'].$div2;
						 $qty = $div1.$value['tr_plan_detail_qty'].$div2;
						 $total_purchase = $div1.tool_money_format($value['tr_plan_detail_total_purchase']).$div2;
						 
						 $cost_driver = $div1.tool_money_format($value['tr_plan_detail_cost_driver']).$div2;
						 $cost_co_driver = $div1.tool_money_format($value['tr_plan_detail_cost_co_driver']).$div2;
						 
						 $cost_lain = $div1.tool_money_format($value['tr_plan_detail_cost_lain']).$div2;
					}else{
						 $no = $value['tr_plan_detail_no'];
						 $location = $value['location_name'];
						 $plan_purchase_date = $value['tr_plan_purchase_date'];
						 $date_realization = $value['tr_plan_detail_date_realization'];
						 $nopol = $value['truck_nopol'];
						 $qty = $value['tr_plan_detail_qty'];
						 $total_purchase = tool_money_format($value['tr_plan_detail_total_purchase']);
						 
						 $cost_driver = tool_money_format($value['tr_plan_detail_cost_driver']);
						 $cost_co_driver = tool_money_format($value['tr_plan_detail_cost_co_driver']);
						 $cost_lain = tool_money_format($value['tr_plan_detail_cost_lain']);
						 
						
					}
				$data[$key] = array(
						form_transient_pair('transient_detail_no', $no,$value['tr_plan_detail_no']),
						//form_transient_pair('transient_detail_code', $value['tr_plan_detail_code'],$value['tr_plan_detail_code']),
						form_transient_pair('transient_detail_spbe',$location,$value['location_id']),
						form_transient_pair('transient_detail_purchase_date', $plan_purchase_date, $value['tr_plan_purchase_date']),
						form_transient_pair('transient_detail_date', $date_realization, $value['tr_plan_detail_date_realization']),
						form_transient_pair('transient_detail_truck_id', $nopol,$value['truck_id'],
												array(
													  'transient_detail_nopol'=>$value['truck_nopol'],$value['truck_nopol'],
													  'transient_detail_driver_type'=>$value['tr_plan_truck_driver_type'],$value['tr_plan_truck_driver_type'],
													  'transient_detail_driver'=>$value['driver_name'],$value['driver_name'],
													  'transient_detail_driver_id'=>$value['driver_id'],$value['driver_id'],
													  'transient_detail_co_driver'=>$value['co_driver_name'],$value['co_driver_name'],
													  'transient_detail_co_driver_id'=>$value['co_driver_id'],$value['co_driver_id'],
													  'transient_detail_co_driver_add_id'=>$value['co_driver_additional_id'],$value['co_driver_additional_id'],
													  'transient_detail_plan_id'=>$value['tr_plan_detail_id'],$value['tr_plan_detail_id']
													  )
												),
						
						form_transient_pair('transient_detail_qty',	$qty,$value['tr_plan_detail_qty'],
											array('transient_detail_purchase'=>$value['tr_plan_detail_purchase'],$value['tr_plan_detail_purchase'])
											),	
						form_transient_pair('transient_detail_total', $total_purchase,$value['tr_plan_detail_total_purchase']),
						form_transient_pair('transient_detail_cost_driver',$cost_driver,$value['tr_plan_detail_cost_driver']),
						form_transient_pair('transient_detail_cost_co_driver',$cost_co_driver,$value['tr_plan_detail_cost_co_driver']),
						form_transient_pair('transient_detail_cost_lain',$cost_lain,$value['tr_plan_detail_cost_lain']),
						form_transient_pair('transient_detail', $detail, $detail),
		
				);
				
		$no++;				
		}		
		send_json(make_datatables_list($data)); 
		}
	}
	
	
	function detail_list_loader_shipment($row_id=0)
			{
			if($row_id == 0)
				
				send_json(make_datatables_list(null)); 
						
				$data = $this->tr_plan_model->detail_list_loader_shipment($row_id);
				$sort_id = 0;
				foreach($data as $key => $value) 
				{
					
				/*
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
						form_transient_pair('transient_shipment_detail_date', normal_date($transient_shipment_detail_date),format_date($transient_shipment_detail_date)),
						
				);
				*/

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
						form_transient_pair('transient_shipment_detail_date', format_new_date($value['tr_plan_detail_shipment_realization_date']),$value['tr_plan_detail_shipment_realization_date'])
						
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
					$data['transient_detail_driver_type'] 	= 0;
					$data['transient_detail_driver'] 		= '';
					$data['transient_detail_driver_id'] 	= '';
					$data['transient_detail_co_driver'] 	= '';
					$data['transient_detail_co_driver_id'] 	= '';
					$data['transient_detail_co_driver_add_id']  = '';
					$data['transient_detail_plan_id'] 		= '';
					$data['transient_detail_spbe'] 			= '';
					$data['transient_detail_qty'] 			= '';
					$data['transient_detail_total'] 		= '';
					$data['transient_detail_no'] 		= '';
					$data['transient_detail_date'] 		= '';
					$data['transient_detail_purchase'] 		= $cost[0];
					$data['transient_detail_cost_driver'] 	= $cost[1];
					$data['transient_detail_cost_co_driver']= $cost[2];
					$data['transient_detail_cost_lain'] 	= '';
			
					
			} else {
				
					$data['index']							= $index;
					$data['tr_plan_id'] 					= $row_id;
					//$data['transient_detail_code'] 			= array_shift($this->input->post('transient_detail_code'));;
					$data['transient_detail_nopol'] 		= array_shift($this->input->post('transient_detail_nopol'));
					$data['transient_detail_no'] 			= array_shift($this->input->post('transient_detail_no'));
					$data['transient_detail_truck_id'] 		= array_shift($this->input->post('transient_detail_truck_id'));
					$data['transient_detail_driver_type'] 	= array_shift($this->input->post('transient_detail_driver_type'));
					$data['transient_detail_driver'] 		= array_shift($this->input->post('transient_detail_driver'));
					$data['transient_detail_driver_id'] 	= array_shift($this->input->post('transient_detail_driver_id'));
					$data['transient_detail_co_driver'] 	= array_shift($this->input->post('transient_detail_co_driver'));
					$data['transient_detail_co_driver_id'] 	= array_shift($this->input->post('transient_detail_co_driver_id'));
					$data['transient_detail_co_driver_add_id']  = array_shift($this->input->post('transient_detail_co_driver_add_id'));
					$data['transient_detail_plan_id'] 		= array_shift($this->input->post('transient_detail_plan_id'));
					$data['transient_detail_spbe'] 			= array_shift($this->input->post('transient_detail_spbe'));
					$data['transient_detail_qty'] 			= array_shift($this->input->post('transient_detail_qty'));
					$data['transient_detail_total'] 		= array_shift($this->input->post('transient_detail_total'));
					$data['transient_detail_purchase'] 		= array_shift($this->input->post('transient_detail_purchase'));
					$data['transient_detail_cost_driver'] 	= array_shift($this->input->post('transient_detail_cost_driver'));
					$data['transient_detail_cost_co_driver']= array_shift($this->input->post('transient_detail_cost_co_driver'));
					$data['transient_detail_cost_lain'] 	= array_shift($this->input->post('transient_detail_cost_lain'));
					if(array_shift($this->input->post('transient_detail_date')) == "0000-00-00"){
						$detail_date = "";
					}else{
						$detail_date = format_new_date(array_shift($this->input->post('transient_detail_date')));
					}
					$data['transient_detail_date']          = $detail_date;
					
					$data['transient_detail_purchase_date']          = format_new_date(array_shift($this->input->post('transient_detail_purchase_date'))); 
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
					$data['transient_shipment_detail_route_id'] 	= '0';
					$data['transient_shipment_detail_qty'] 			= '';
					$data['transient_shipment_detail_price'] 		= '';
					$data['transient_shipment_detail_total_price'] 	= '';
					$data['transient_shipment_detail_cost'] 		= '';
					$data['transient_tr_plan_detail_shipment_id'] 	= '';
					$data['transient_shipment_detail_date'] 		= date('d/m/Y');
					
					
			
					
			} else {
				
					$data['index']									= $index;
					$data['row_id'] 								= $row_id;
					$data['transient_shipment_detail_route_from'] 	= array_shift($this->input->post('transient_shipment_detail_route_from'));;
					$data['transient_shipment_detail_route_to']	 	= array_shift($this->input->post('transient_shipment_detail_route_to'));
					$data['transient_shipment_detail_route_id']		= array_shift($this->input->post('transient_shipment_detail_route_id'));
					$data['transient_shipment_detail_qty'] 			= array_shift($this->input->post('transient_shipment_detail_qty'));
					$data['transient_shipment_detail_price'] 		= array_shift($this->input->post('transient_shipment_detail_price'));
					$data['transient_shipment_detail_total_price'] 	= array_shift($this->input->post('transient_shipment_detail_total_price'));
					$data['transient_shipment_detail_cost'] 		= array_shift($this->input->post('transient_shipment_detail_cost'));
					$data['transient_tr_plan_detail_shipment_id'] 	= array_shift($this->input->post('transient_tr_plan_detail_shipment_id'));
					$data['transient_shipment_detail_date'] 		= format_new_date(array_shift($this->input->post('transient_shipment_detail_date')));
			}
				
		
				$this->render->add_form('app/tr_plan/transient_form_shipment', $data);
				$this->render->show_buffer();
	}
	
	
	function detail_form_action_kulak()
	{		
			$this->load->library('form_validation');
			$this->form_validation->set_rules('i_date','Tanggal Pengambilan','trim|required|valid_date|sql_date');
			$this->form_validation->set_rules('i_purchase_date','Tanggal Jatah','trim|required|valid_date|sql_date');
			$this->form_validation->set_rules('i_truck_id', 'Truck', 'trim|required');
			$this->form_validation->set_rules('i_spbe_id', 'SPBE', 'trim|required');
			$this->form_validation->set_rules('i_qty', 'SPBE', 'trim|required|numeric|min_value[0]');
			$this->form_validation->set_rules('i_purchase', 'Harga satuan', 'trim|required|numeric|min_value[0]');
			
			//type sopir / kernet
			$transient_detail_driver_type	= $this->input->post('i_drive_type');
			//jika type sopir/kernet adalah cadangan periksa 
			if($transient_detail_driver_type == '0'){
				$this->form_validation->set_rules('i_driver_id', 'Sopir', 'trim|required|');
				$this->form_validation->set_rules('i_co_driver_id', 'Kernet', 'trim|required|');
			}else{
				$this->form_validation->set_rules('i_driver_id2', 'Sopir cadangan', 'trim|required|');
				$this->form_validation->set_rules('i_co_driver_id2', 'Kernet', 'trim|required|');
			}
			$index = $this->input->post('i_index');		
			// cek data berdasarkan kriteria
			if ($this->form_validation->run() == FALSE) send_json_validate();
		
			$no 						= $this->input->post('i_index');
			$transient_detail_code 	= $this->input->post('i_code');
			$transient_detail_no	= $this->input->post('i_no');
			$transient_detail_nopol 	= $this->input->post('i_truck_nopol');
			$transient_detail_date 	= $this->input->post('i_date');
			$transient_detail_purchase_date 	= $this->input->post('i_purchase_date');
			
			$transient_detail_truck_id 	= $this->input->post('i_truck_id');
			$transient_detail_driver 	= $this->input->post('i_driver_name');
			$transient_detail_co_driver 	= $this->input->post('i_co_driver_name');
			if($transient_detail_driver_type == '0'){
				$transient_detail_driver_id 	= $this->input->post('i_driver_id');
				$transient_detail_co_driver_id 	= $this->input->post('i_co_driver_id');
			}else if($transient_detail_driver_type == '1'){
				$transient_detail_driver_id 	= $this->input->post('i_driver_id2');
				$transient_detail_co_driver_id 	= $this->input->post('i_co_driver_id2');
			}
			$transient_detail_co_driver_add_id 	= $this->input->post('i_co_driver_add_id');
			
			
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
						form_transient_pair('transient_detail_no', $transient_detail_no,$transient_detail_no),
						form_transient_pair('transient_detail_spbe',$transient_detail_spbe_name,$transient_detail_spbe),
						
						//form_transient_pair('transient_detail_code', $transient_detail_code,$transient_detail_code),
						form_transient_pair('transient_detail_purchase_date', normal_date($transient_detail_purchase_date),format_date($transient_detail_purchase_date)),
						form_transient_pair('transient_detail_date', normal_date($transient_detail_date), format_date($transient_detail_date)),
						form_transient_pair('transient_detail_truck_id', $transient_detail_nopol,$transient_detail_truck_id,
												array(
													  'transient_detail_nopol'=>$transient_detail_nopol,$transient_detail_nopol,
													  'transient_detail_driver_type'=>$transient_detail_driver_type,$transient_detail_driver_type,
													  'transient_detail_driver'=>$transient_detail_driver,$transient_detail_driver,
													  'transient_detail_driver_id'=>$transient_detail_driver_id,$transient_detail_driver_id,
													  'transient_detail_co_driver'=>$transient_detail_co_driver,$transient_detail_co_driver,
													  'transient_detail_co_driver_id'=>$transient_detail_co_driver_id,$transient_detail_co_driver_id,
													  'transient_detail_co_driver_add_id'=>$transient_detail_co_driver_add_id,$transient_detail_co_driver_add_id,
													 	'transient_detail_plan_id'=>$transient_detail_plan_id,$transient_detail_plan_id
													  )
												),
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
			$this->form_validation->set_rules('i_date','Tanggal pengiriman','trim|required|valid_date|sql_date');
			$this->form_validation->set_rules('i_route_id', 'Route', 'trim|required');
			$this->form_validation->set_rules('i_qty', 'Jumlah Kirim', 'trim|required|integer');
			$this->form_validation->set_rules('i_price', 'Harga Kirim', 'trim|required|integer');
			
			$index = $this->input->post('i_index');		
			// cek data berdasarkan kriteria
			if ($this->form_validation->run() == FALSE) send_json_validate();
		
			$no 									= $this->input->post('i_index');
			$row_id 								= $this->input->post('row_id');
			$transient_shipment_detail_date		 	= $this->input->post('i_date');
			
			
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
						form_transient_pair('transient_shipment_detail_date', normal_date($transient_shipment_detail_date),format_date($transient_shipment_detail_date)),
						
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

	function get_total_purchase()
	{
		$date 	= $this->input->post('date');

		$date = format_date($date);
		
		$query = $this->tr_plan_model->get_total_purchase($date);
		$data = array();
		
		foreach($query->result_array() as $row)
		{
			$data['result'] 		= $row['result'];
			
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
			
