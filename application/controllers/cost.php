<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cost extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('render');
		$this->load->model('cost_model');
		$this->load->library('access');
		$this->access->set_module('master.customer');
	}
	
	function index()
	{
		$data = array();
		$id=1; // cost_id 
		$result = $this->cost_model->read_id($id);
			if($result){
				$data = $result;
				$data['row_id'] = $id;
			}
		
		$this->load->helper('form');
		
		
		$this->render->add_form('app/cost/form', $data);
		$this->render->build('Harga');
		$this->render->show('Harga');
		
	}
	/*function table_controller(){
		$data = $this->customer_model->list_controller();
		send_json($data);
	}
	
	function form($id = 0){
		$data = array();
		if($id==0){
			$data['row_id']				= '';
			//$data['customer_code']			= format_code('customers','customer_code','S',7);
			$data['location_name']			= '';
			$data['location_phone']			= '';
			$data['location_address']		= '';
			$data['location_rt_rw']			= '';
			$data['location_kelurahan']		= '';
			$data['location_kecamatan']		= '';
			$data['location_kota']			= '';
	
		
		}else{
			$result = $this->customer_model->read_id($id);
			if($result){
				$data = $result;
				$data['row_id'] = $id;
			}
		}

		$this->load->helper('form');
		$this->render->add_form('app/customer/form', $data);
		$this->render->build('Pangkalan');
		$this->render->show('Pangkalan');
		//$this->access->generate_log_view($id);
	}*/
	
	function form_action($is_delete = 0){
		
		$id = $this->input->post('row_id');
			
		if($is_delete){
			$is_proses_error = $this->cost_model->delete($id);
			send_json_action($is_proses_error, "Data telah dihapus");
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('i_purchase','Harg Beli', 'trim|required|numeric|min_value[1]');
		$this->form_validation->set_rules('i_cost_driver','Gaji Sopir','trim|required|numeric|min_value[1]');
		$this->form_validation->set_rules('i_cost_co_driver','Gaji Kernet', 'trim|required|numeric|min_value[1]');
		
		if($this->form_validation->run() == FALSE) send_json_validate();
		
			$data['cost_purchase'] 				= $this->input->post('i_purchase');
			$data['cost_driver'] 			= $this->input->post('i_cost_driver');
			$data['cost_co_driver'] 			= $this->input->post('i_cost_co_driver');
		if(empty($id)){
			$error = $this->cost_model->create($data);
			send_json_action($error, "Data telah ditambah", "Data gagal ditambah");
		}else{
			$error = $this->cost_model->update($id, $data);
			send_json_action($error, "Data telah direvisi", "Data gagal direvisi");
		}
		
	}
	
	
	
}
