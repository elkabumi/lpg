<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class customer extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('render');
		$this->load->model('customer_model');
		$this->load->library('access');
		$this->access->set_module('master.customer');
	}
	
	function index(){
		
		$this->render->add_view('app/customer/list');
		$this->render->build('Pangkalan');
		$this->render->show('Pangkalan');
	}
	
	function table_controller(){
		$data = $this->customer_model->list_controller();
		send_json($data);
	}
	
	function form($id = 0){
		$data = array();
		if($id==0){
			$data['row_id']				= '';
			//$data['customer_code']			= format_code('customers','customer_code','S',7);
			$data['customer_name']			= '';
			$data['customer_leader']		= '';
			$data['customer_description']	= '';
			$data['customer_address']	= '';
			$data['customer_phone']	= '';
	
		
		}else{
			$result = $this->customer_model->read_id($id);
			if($result){
				$data = $result;
				$data['row_id'] = $id;
			}
		}

		$this->load->helper('form');
		$this->render->add_form('app/customer/form', $data);
		$this->render->build('Cabang');
		$this->render->show('Cabang');
		//$this->access->generate_log_view($id);
	}
	
	function form_action($is_delete = 0){
		
		$id = $this->input->post('row_id');
			
		if($is_delete){
			$is_proses_error = $this->customer_model->delete($id);
			send_json_action($is_proses_error, "Data telah dihapus");
		}
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('i_code','Kode', 'trim|required');
		$this->form_validation->set_rules('i_name','Nama', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('i_leader','Leader', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('i_phone','telepon', 'trim|required');
		$this->form_validation->set_rules('i_address','Alamat', 'trim|required');
		
		if($this->form_validation->run() == FALSE) send_json_validate();
		
		$data['customer_code'] 				= $this->input->post('i_code');
		$data['customer_name'] 				= $this->input->post('i_name');
		$data['customer_leader'] 				= $this->input->post('i_leader');
		$data['customer_description'] 			= $this->input->post('i_description');
		$data['customer_phone'] 				= $this->input->post('i_phone');
		$data['customer_address'] 				= $this->input->post('i_address');
		
		if(empty($id)){
			$data['customer_status'] 					= 1;
			$data['customer_code']			= format_code('customers','customer_code','S',7);
			$error = $this->customer_model->create($data);
			send_json_action($error, "Data telah ditambah", "Data gagal ditambah");
		}else{
			$error = $this->customer_model->update($id, $data);
			send_json_action($error, "Data telah direvisi", "Data gagal direvisi");
		}
		
	}
	
	
	
}
