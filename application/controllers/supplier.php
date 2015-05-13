<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class supplier extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('render');
		$this->load->model('supplier_model');
		$this->load->library('access');
		$this->access->set_module('master.supplier');
	}
	
	function index(){
		
		$this->render->add_view('app/supplier/list');
		$this->render->build('SPBE');
		$this->render->show('SPBE');
	}
	
	function table_controller(){
		$data = $this->supplier_model->list_controller();
		send_json($data);
	}
	
	function form($id = 0){
		$data = array();
		if($id==0){
			$data['row_id']				= '';
			//$data['supplier_code']			= format_code('suppliers','supplier_code','S',7);
			$data['supplier_name']			= '';
			$data['supplier_leader']		= '';
			$data['supplier_description']	= '';
			$data['supplier_address']	= '';
			$data['supplier_phone']	= '';
	
		
		}else{
			$result = $this->supplier_model->read_id($id);
			if($result){
				$data = $result;
				$data['row_id'] = $id;
			}
		}

		$this->load->helper('form');
		$this->render->add_form('app/supplier/form', $data);
		$this->render->build('Cabang');
		$this->render->show('Cabang');
		//$this->access->generate_log_view($id);
	}
	
	function form_action($is_delete = 0){
		
		$id = $this->input->post('row_id');
			
		if($is_delete){
			$is_proses_error = $this->supplier_model->delete($id);
			send_json_action($is_proses_error, "Data telah dihapus");
		}
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('i_code','Kode', 'trim|required');
		$this->form_validation->set_rules('i_name','Nama', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('i_leader','Leader', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('i_phone','telepon', 'trim|required');
		$this->form_validation->set_rules('i_address','Alamat', 'trim|required');
		
		if($this->form_validation->run() == FALSE) send_json_validate();
		
		$data['supplier_code'] 				= $this->input->post('i_code');
		$data['supplier_name'] 				= $this->input->post('i_name');
		$data['supplier_leader'] 				= $this->input->post('i_leader');
		$data['supplier_description'] 			= $this->input->post('i_description');
		$data['supplier_phone'] 				= $this->input->post('i_phone');
		$data['supplier_address'] 				= $this->input->post('i_address');
		
		if(empty($id)){
			$data['supplier_status'] 					= 1;
			$data['supplier_code']			= format_code('suppliers','supplier_code','S',7);
			$error = $this->supplier_model->create($data);
			send_json_action($error, "Data telah ditambah", "Data gagal ditambah");
		}else{
			$error = $this->supplier_model->update($id, $data);
			send_json_action($error, "Data telah direvisi", "Data gagal direvisi");
		}
		
	}
	
	
	
}
