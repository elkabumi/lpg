<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tr_cost extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('render');
		$this->load->model('tr_cost_model');
		$this->load->library('access');
		$this->access->set_module('master.tr_cost');
	}
	
	function index(){
		
		$this->render->add_view('app/tr_cost/list');
		$this->render->build('Biaya');
		$this->render->show('Biaya');
	}
	
	function table_controller(){
		$data = $this->tr_cost_model->list_controller();
		send_json($data);
	}
	function form($id = 0){
		$data = array();
		if($id==0){
			$data['row_id']				= '';
			//$data['tr_cost_code']			= format_code('tr_costs','tr_cost_code','S',7);
			$data['tr_cost_type_id']	= '';
			$data['tr_cost_date']		= date('d/m/Y');
			$data['tr_cost_price']		= '';
			$data['tr_cost_desc']		= '';
			
	
		
		}else{
			$result = $this->tr_cost_model->read_id($id);
			if($result){
				$data = $result;
				$data['row_id'] = $id;
				$data['tr_cost_date'] = format_new_date($data['tr_cost_date']);
			}
		}
		$this->load->helper('form');
			
		$this->render->add_form('app/tr_cost/form', $data);
		
			
		$this->render->build('Biaya');
		$this->render->show('Biaya');
		//$this->access->generate_log_view($id);
	}
	
	function form_action($is_delete = 0){
		
		$id = $this->input->post('row_id');
			
		if($is_delete){
			$is_proses_error = $this->tr_cost_model->delete($id);
			send_json_action($is_proses_error, "Data telah dihapus");
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('i_date','Tanggal','trim|required|valid_date|sql_date');
		$this->form_validation->set_rules('i_cost_type_id','Kategori Biaya', 'trim|required');
		$this->form_validation->set_rules('i_price','Jumlah Biaya', 'trim|required|integer');
		
		
		if($this->form_validation->run() == FALSE) send_json_validate();
		
		$data['tr_cost_type_id'] 			= $this->input->post('i_cost_type_id');
		$data['tr_cost_date']		 		= $this->input->post('i_date');
		$data['tr_cost_price'] 				= $this->input->post('i_price');
		$data['tr_cost_desc'] 				= $this->input->post('i_description');
		
		if(empty($id)){
			$error = $this->tr_cost_model->create($data);
			send_json_action($error, "Data telah ditambah", "Data gagal ditambah");
		}else{
			$error = $this->tr_cost_model->update($id, $data);
			send_json_action($error, "Data telah direvisi", "Data gagal direvisi");
		}
		
	}
	
	
	
}
