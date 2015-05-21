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
			$data['row_id']					= '';
			//$data['customer_code']		= format_code('customers','customer_code','S',7);
			$data['location_name']			= '';
			$data['location_phone']			= '';
			$data['location_address']		= '';
			$data['location_rt_rw']			= '';
			$data['location_kelurahan']		= '';
			$data['location_kecamatan']		= '';
			$data['location_kota']			= '';
			$data['location_price']			= '';
	
		
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
	}
	
	function form_action($is_delete = 0){
		
		$id = $this->input->post('row_id');
			
		if($is_delete){
			$is_proses_error = $this->customer_model->delete($id);
			send_json_action($is_proses_error, "Data telah dihapus");
		}
		
		$this->load->library('form_validation');
	
		$this->form_validation->set_rules('i_name','Nama Pangkalan', 'trim|required');
		$this->form_validation->set_rules('i_phone','No.Telpn Pangakalan', 'trim|required');
		$this->form_validation->set_rules('i_address','Alamat', 'trim|required');
		$this->form_validation->set_rules('i_price','Harga Jual Satuan', 'trim|required|integer');
		
		if($this->form_validation->run() == FALSE) send_json_validate();
		
			$data['location_name'] 				= $this->input->post('i_name');
			$data['location_phone'] 			= $this->input->post('i_phone');
			$data['location_address'] 			= $this->input->post('i_address');
			$data['location_rt_rw'] 			= $this->input->post('i_rt');
			$data['location_kelurahan'] 		= $this->input->post('i_kel');
			$data['location_kecamatan'] 		= $this->input->post('i_kec');
			$data['location_kota'] 				= $this->input->post('i_city');
			$data['location_price'] 			= $this->input->post('i_price');
		
		if(empty($id)){
			$data['location_category_id'] 					= 2;
			$error = $this->customer_model->create($data);
			send_json_action($error, "Data telah ditambah", "Data gagal ditambah");
		}else{
			$error = $this->customer_model->update($id, $data);
			send_json_action($error, "Data telah direvisi", "Data gagal direvisi");
		}
		
	}
	
	
	
}
