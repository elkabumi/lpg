<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cost_type extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('render');
		$this->load->model('cost_type_model');
		$this->load->library('access');
		$this->access->set_module('master.cost_type');
		$this->access->user_page();
	}
	
	function index(){
		
		$this->render->add_view('app/cost_type/list');
		$this->render->build('Kategori Biaya');
		$this->render->show('Kategori Biaya');
	}
	
	function list_loader()
	{
		$data = $this->cost_type_model->list_loader();
		send_json(make_datatables_list($data)); 
	}
	
	function form() // jika id tidak diisi maka dianggap create, else dianggap edit
	{
		$id = $this->input->post('row_id');
		$data = array();
		$this->load->library('render');		
		if ($id == 0) {
			
			// FORM CREATE - isi form dengan nilai default / kosong
			$data['row_id']				= '';
			$data['tr_cost_type_name']	= '';
			$data['tr_cost_type_desc']	= '';
			
		} else {
			
			// FORM UPDATE - ambil data yang diedit kemudian tampilkan dalam form			
			$result = $this->cost_type_model->read_id($id);
			if ($result) // cek dulu apakah data ditemukan 
			{
				$data['row_id']		= $result['tr_cost_type_id'];
				$data['tr_cost_type_name'] 	= $result['tr_cost_type_name'];
				$data['tr_cost_type_desc'] 	= $result['tr_cost_type_desc'];
			}
		}
		
		
		
		$this->render->add_form('app/cost_type/form', $data);
		$this->render->show_buffer();
	}
	
	
	function form_action($is_delete = 0){
		
		$id = $this->input->post('row_id');
			
		if($is_delete){
			$is_proses_error = $this->cost_type_model->delete($id);
			
			send_json_action($is_proses_error, "Data telah dihapus");
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('i_name','Nama Kategori Biaya', 'trim|required|max_length[200]');
	
		
		if($this->form_validation->run() == FALSE) send_json_validate();
		
		$data['tr_cost_type_name'] 				= $this->input->post('i_name');
		$data['tr_cost_type_desc'] 			= $this->input->post('i_description');
	
		
		if(empty($id)){
			
			$error = $this->cost_type_model->create($data);
			send_json_action($error, "Data telah ditambah", "Data gagal ditambah");
		}else{
			$error = $this->cost_type_model->update($id, $data);
			send_json_action($error, "Data telah direvisi", "Data gagal direvisi");
		}
		
	}
}