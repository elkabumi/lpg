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
			$data['row_id']				= '';
			//$data['route_code']			= format_code('routes','route_code','S',7);
			$data['route_name']			= '';
			$data['route_leader']		= '';
			$data['route_description']	= '';
			$data['route_address']	= '';
			$data['route_phone']	= '';
	
		
		}else{
			$result = $this->route_model->read_id($id);
			if($result){
				$data = $result;
				$data['row_id'] = $id;
			}
		}

		$this->load->helper('form');
		$this->render->add_form('app/route/form', $data);
		$this->render->build('Cabang');
		$this->render->show('Cabang');
		//$this->access->generate_log_view($id);
	}
	
	function form_action($is_delete = 0){
		
		$id = $this->input->post('row_id');
			
		if($is_delete){
			$is_proses_error = $this->route_model->delete($id);
			send_json_action($is_proses_error, "Data telah dihapus");
		}
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('i_code','Kode', 'trim|required');
		$this->form_validation->set_rules('i_name','Nama', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('i_leader','Leader', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('i_phone','telepon', 'trim|required');
		$this->form_validation->set_rules('i_address','Alamat', 'trim|required');
		
		if($this->form_validation->run() == FALSE) send_json_validate();
		
		$data['route_code'] 				= $this->input->post('i_code');
		$data['route_name'] 				= $this->input->post('i_name');
		$data['route_leader'] 				= $this->input->post('i_leader');
		$data['route_description'] 			= $this->input->post('i_description');
		$data['route_phone'] 				= $this->input->post('i_phone');
		$data['route_address'] 				= $this->input->post('i_address');
		
		if(empty($id)){
			$data['route_status'] 					= 1;
			$data['route_code']			= format_code('routes','route_code','S',7);
			$error = $this->route_model->create($data);
			send_json_action($error, "Data telah ditambah", "Data gagal ditambah");
		}else{
			$error = $this->route_model->update($id, $data);
			send_json_action($error, "Data telah direvisi", "Data gagal direvisi");
		}
		
	}
	
	
	
}
