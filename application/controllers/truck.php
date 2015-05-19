<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class truck extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('render');
		$this->load->model('truck_model');
		$this->load->library('access');
		$this->access->set_module('master.truck');
	}
	
	function index(){
		
		$this->render->add_view('app/truck/list');
		$this->render->build('Truk');
		$this->render->show('Truk');
	}
	
	function table_controller(){
		$data = $this->truck_model->list_controller();
		send_json($data);
	}
	
	function form($id = 0){
		$data = array();
		if($id==0){
			$data['row_id']				= '';
			//$data['truck_code']			= format_code('trucks','truck_code','S',7);
			$data['driver_id']			= '';
			$data['co_driver_id']		= '';
			$data['truck_nopol']	= '';
			$data['truck_stnk']	= '';
			$data['truck_owner']	= '';
			$data['truck_color']			= '';
			$data['truck_manufacture_date']		= '';
			$data['truck_merk']		= '';
			$data['truck_type_id']	= '';
			
			$data['truck_cc']		= '';
			$data['truck_no_rangka'] = '';
			$data['truck_no_mesin']	 = '';
			$data['truck_no_bpkb']	 = '';
			$data['truck_jatuh_tempo']	= '';
			$data['truck_jatuh_tempo_kiur']	= '';
			$data['truck_rekom']	= '';
	
		
		}else{
			$result = $this->truck_model->read_id($id);
			if($result){
				$data = $result;
				$data['row_id'] = $id;
				$data['truck_jatuh_tempo'] = format_new_date($data['truck_jatuh_tempo']);
				$data['truck_jatuh_tempo_kiur'] = format_new_date($data['truck_jatuh_tempo_kiur']);
				$data['truck_rekom'] = format_new_date($data['truck_rekom']);
				
			}
		}
		$this->load->model('global_model');
		$data['truck_type'] 	= $this->global_model->get_truck_type();
		$this->load->helper('form');
			
		$this->render->add_form('app/truck/form', $data);
		
			
		$this->render->build('Truck');
		$this->render->show('Truck');
		//$this->access->generate_log_view($id);
	}
	
	function form_action($is_delete = 0){
		
		$id = $this->input->post('row_id');
			
		if($is_delete){
			$is_proses_error = $this->truck_model->delete($id);
			send_json_action($is_proses_error, "Data telah dihapus");
		}
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('i_nopol','Nopol', 'trim|required');
		$this->form_validation->set_rules('i_stnk','No. STNK', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('i_owner','Pemilik Kendaraan', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('i_color','Warna', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('i_manufacture_year','Tahun Pembuata', 'trim|required|integer');
		$this->form_validation->set_rules('i_merk','Merk', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('i_truck_type_id','Jenis Armada', 'trim|required');
		$this->form_validation->set_rules('i_driver_id','Sopir', 'trim|required');
		$this->form_validation->set_rules('i_co_driver_id','Kernet', 'trim|required');
		
		
		$this->form_validation->set_rules('i_cc','CC', 'trim|required|integer');
		$this->form_validation->set_rules('i_rangka','NO Rangka', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('i_mesin','No Mesin', 'trim|required|max_length[100]');
		
		$this->form_validation->set_rules('i_bpkb','No BPKB', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('i_tempo','Jatuh Tempo','trim|required|valid_date|sql_date');
		$this->form_validation->set_rules('i_kiur','Jatuh Kiur','trim|required|valid_date|sql_date');
		$this->form_validation->set_rules('i_rekom','Rekom','trim|required|valid_date|sql_date');
		
		if($this->form_validation->run() == FALSE) send_json_validate();
		
		$data['truck_nopol'] 				= $this->input->post('i_nopol');
		$data['truck_stnk'] 				= $this->input->post('i_stnk');
		$data['truck_owner'] 				= $this->input->post('i_owner');
		$data['truck_color'] 				= $this->input->post('i_color');
		$data['truck_manufacture_date'] 	= $this->input->post('i_manufacture_year');
		$data['truck_merk'] 				= $this->input->post('i_merk');
		$data['truck_type_id'] 				= $this->input->post('i_truck_type_id');
		$data['driver_id'] 					= $this->input->post('i_driver_id');
		$data['co_driver_id'] 				= $this->input->post('i_co_driver_id');
		
		$data['truck_cc'] 					= $this->input->post('i_cc');
		$data['truck_no_rangka'] 			= $this->input->post('i_rangka');
		
		$data['truck_no_mesin'] 			= $this->input->post('i_mesin');
		$data['truck_no_bpkb'] 				= $this->input->post('i_bpkb');
		$data['truck_jatuh_tempo'] 			= $this->input->post('i_tempo');
		$data['truck_jatuh_tempo_kiur'] 	= $this->input->post('i_kiur');
		$data['truck_rekom'] 				= $this->input->post('i_rekom');
		
		if(empty($id)){
			$error = $this->truck_model->create($data);
			send_json_action($error, "Data telah ditambah", "Data gagal ditambah");
		}else{
			$error = $this->truck_model->update($id, $data);
			send_json_action($error, "Data telah direvisi", "Data gagal direvisi");
		}
		
	}
	
	
	
}
