<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Route extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('render');
		$this->load->model('route_model');
		$this->load->library('access');
		$this->access->set_module('master.route');
	}
	
	function index(){
		
		$this->render->add_view('app/route/list');
		$this->render->build('Route');
		$this->render->show('Route');
	}
	
	function table_controller(){
		$data = $this->route_model->list_controller();
		send_json($data);
	}
	
	function form($id = 0){
		$data = array();
		if($id==0){
			$data['row_id']					= '';
			//$data['route_code']			= format_code('routes','route_code','S',7);
			$data['location_from_id']		= '';
			$data['location_to_id']			= '';
			$data['location_total_cost']	= '';
			$data['location_desc']			= '';
	
		
		}else{
			$result = $this->route_model->read_id($id);
			if($result){
				$data = $result;
				$data['row_id'] = $id;
			}
		}

		$this->load->helper('form');
		$this->render->add_form('app/route/form', $data);
		$this->render->build('Route');
		
		$this->render->add_view('app/route/transient_list');
		$this->render->build('Biaya Route');
		
		$this->render->show('Route');
		//$this->access->generate_log_view($id);
	}
	
	function form_action($is_delete = 0){
		
		$id = $this->input->post('row_id');
			
		if($is_delete){
			$is_proses_error = $this->route_model->delete($id);
			send_json_action($is_proses_error, "Data telah dihapus");
		}
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('i_from_id','Dari Lokasi', 'trim|required');
		$this->form_validation->set_rules('i_to_id','Ke Lokasi', 'trim|required');
		$this->form_validation->set_rules('i_description','Keterangan', 'trim|required');
		
		if($this->form_validation->run() == FALSE) send_json_validate();
		
		$data['location_from_id'] 				= $this->input->post('i_from_id');
		$data['location_to_id'] 				= $this->input->post('i_to_id');
		$data['location_desc']	 				= $this->input->post('i_description');
		
		if($data['location_from_id'] == $data['location_to_id']){
			send_json_error('Simpan Gagal.Dari Lokasi dan ke Lokasi Tidak Boleh sama');
		}
		
		// simpan transient biaya Route
		$list_name_biaya	= ($this->input->post('transient_rd_name'));
		$list_biaya  =  	($this->input->post('transient_rd_price'));
		$total_biaya = 0;
		$items_biaya = array();
		
		if($list_name_biaya){
			foreach($list_name_biaya as $key => $value)
			{
			$items_biaya[] = array(
					'route_detail_name' => ($list_name_biaya[$key]),
					'route_detail_cost' => $list_biaya[$key],
			);
				$total_biaya += $list_biaya[$key];
			}		
		}
		
		$data['location_total_cost'] = $total_biaya;
				
		if(empty($id)){
			$error = $this->route_model->create($data,$items_biaya);
			send_json_action($error, "Data telah ditambah", "Data gagal ditambah");
		}else{
			$get_route=$this->route_model->cek_route($data['location_from_id'],$data['location_to_id']);
			if($get_route == '1'){
				send_json_error('Simpan Gagal.Route Sudah Ada');
		
			}
			$error = $this->route_model->update($id, $data,$items_biaya);
			send_json_action($error, "Data telah direvisi", "Data gagal direvisi");
		}
		
	}
	function detail_list_loader($row_id=0)
			{
			if($row_id == 0)
				
				send_json(make_datatables_list(null)); 
						
				$data = $this->route_model->detail_list_loader($row_id);
				$sort_id = 0;
				foreach($data as $key => $value) 
				{
				$data[$key] = array(
						form_transient_pair('transient_rd_name', $value['route_detail_name'],$value['route_detail_name']),
						form_transient_pair('transient_rd_price',	tool_money_format($value['route_detail_cost']),$value['route_detail_cost'])
						//form_transient_pair('transient_reg_aproved_price',	tool_money_format($value['detail_registration_approved_price']),$value['detail_registration_approved_price'])
				);
		}		
		send_json(make_datatables_list($data)); 
	}
	function detail_form($route_id = 0) // jika id tidak diisi maka dianggap create, else dianggap edit
		{		
			$this->load->library('render');
			$index = $this->input->post('transient_index');
			if (strlen(trim($index)) == 0) {
						
				// TRANSIENT CREATE - isi form dengan nilai default / kosong
					$data['index']							= '';
					$data['route_id']						= $route_id ;
					$data['transient_rd_name'] 				= '';
					$data['transient_rd_price'] 			= '';
			
					
			} else {
				
					$data['index']								= $index;
					$data['route_id'] 					= $route_id;
					$data['transient_rd_name'] 			= array_shift($this->input->post('transient_rd_name'));
					$data['transient_rd_price'] 		= array_shift($this->input->post('transient_rd_price'));
				
			}
		
			$this->render->add_form('app/route/transient_form', $data);
			$this->render->show_buffer();
		}

			
		function detail_form_action()
		{		
			$this->load->library('form_validation');
			$this->form_validation->set_rules('i_name', 'Nama Biaya', 'trim|required');
			$this->form_validation->set_rules('i_cost', 'Biaya', 'trim|required|integer');
			
			$index = $this->input->post('i_index');		
			// cek data berdasarkan kriteria
			if ($this->form_validation->run() == FALSE) send_json_validate();
		
			$no 					= $this->input->post('i_index');
			$transient_rd_name 		= $this->input->post('i_name');
			$transient_rd_price 	= $this->input->post('i_cost');
			
			$data = array(
						form_transient_pair('transient_rd_name',$transient_rd_name,$transient_rd_name ),
						form_transient_pair('transient_rd_price',	tool_money_format($transient_rd_price),$transient_rd_price)
						//form_transient_pair('transient_reg_aproved_price',	tool_money_format($value['detail_registration_approved_price']),$value['detail_registration_approved_price'])
				);
		
		send_json_transient($index, $data);

		
		}

	
}
