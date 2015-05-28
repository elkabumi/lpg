<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Ransom extends CI_Controller{
			function __construct(){
			parent::__construct();
			$this->load->library('render');
			$this->load->model('ransom_model');
			$this->load->library('access');
			$this->access->set_module('ransom.ransom');
			$this->access->user_page();
			}
			function index(){
			$this->render->add_view('app/ransom/list');
			$this->render->build('Tebusan');
			$this->render->show('Tebusan');
		}
		
	function table_controller(){
			$data = $this->ransom_model->list_controller();
			send_json($data);
		}
		
	function form($id = 0){
		$data = array();
		if($id==0){
			$data['row_id']				= '';
			//$data['truck_code']			= format_code('trucks','truck_code','S',7);
			
			$data['tr_plan_date']		= '';
			$data['tr_plan_total_purchase'] = '0';
			
	
	
		
		}else{
			$result = $this->ransom_model->read_id($id);
			if($result){
				$data = $result;
				$data['row_id'] = $id;
				$data['tr_plan_date'] = format_new_date($data['tr_plan_date']);

				$data['tr_plan_total_purchase'] = $this->ransom_model->get_total_tebusan($id);

			}
		}
		$this->load->helper('form');
			
		$this->render->add_form('app/ransom/form', $data);
		$this->render->build('Tebusan');
		//List Kulak
		$this->render->add_view('app/ransom/transient_list');
		$this->render->build('Data Kulak');
		
		$this->render->add_form('app/ransom/form_save', $data);
		$this->render->build('Tebusan');
		$this->render->show('Tebusan');
	}
	
	function form_action($is_delete = 0){
		
		$id = $this->input->post('row_id');
			
		if($is_delete){
			$is_proses_error = $this->ransom_model->delete($id);
			send_json_action($is_proses_error, "Data telah dihapus");
		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('i_date','Tanggal Tebusan','trim|required|valid_date|sql_date');
		if($this->form_validation->run() == FALSE) send_json_validate();
		
		$data['tr_plan_date'] 				= $this->input->post('i_date');
		
		// simpan transient Tebusan
		$list_purchase_id		= ($this->input->post('transient_detail_purchase_id'));
		$list_location_id		= ($this->input->post('transient_detail_location_id'));
		$list_qty				= ($this->input->post('transient_detail_qty'));
	
	
		$total_purchase = 0;
		$total 	= 0;
		$items_purchase = array();
		if(!$list_location_id) send_json_error('Simpan gagal. Data Tebusan Masih Kosong');
	
		if($list_location_id){
			foreach($list_location_id as $key => $value)
			{
			$items_purchase[] = array(
					'tr_plan_purchase_id' => ($list_purchase_id[$key]),
					'location_id' => ($list_location_id[$key]),
					'tr_plan_purchase_qty' => ($list_qty[$key]),
			
			);
			$check = 0;
			$check_loaction = 0;
			$loaction_id_original = $list_location_id[$key];
			foreach($list_location_id as $key_check => $value)
				{
			
					if($loaction_id_original == $list_location_id[$key_check]){
						$check++;
					}
			
				}
			if($check > 1){
				
				$get_data_location = $this->ransom_model->get_data_spbe($loaction_id_original);
				send_json_error("Simpan gagal. SPBE  tidak boleh sama [ ".$get_data_location."]");
			}
			}
		}
		$get_date=$this->ransom_model->cek_date($data['tr_plan_date'],$id);
	
		if($get_date > 0){
			send_json_error('Simpan gagal. Plan di Tanggal '.$data['tr_plan_date'].' Sudah ada');
		}
		//	send_json($get_date);
		if(empty($id)){
			
			$error = $this->ransom_model->create($data,$items_purchase);
			send_json_action($error, "Data telah ditambah", "Data gagal ditambah");
		}else{
		
			$error = $this->ransom_model->update($id, $data,$items_purchase);
			send_json_action($error, "Data telah direvisi", "Data gagal direvisi",$id);		
		}
		
	}

	function detail_list_loader($row_id=0){
		if($row_id == 0)
			send_json(make_datatables_list(null)); 
						
		$data = $this->ransom_model->detail_list_loader($row_id);
		$sort_id = 0;
		foreach($data as $key => $value) 
			{
				$data[$key] = array(
						form_transient_pair('transient_detail_purchase_id', $value['location_id'],$value['tr_plan_purchase_id']),
						form_transient_pair('transient_detail_location_name', $value['location_name'],$value['location_name'],
												array(
													  'transient_detail_location_id'=>$value['location_id'],$value['location_id'],
												)
												),
						form_transient_pair('transient_detail_qty',$value['tr_plan_purchase_qty'],$value['tr_plan_purchase_qty']),
			);
				
						
		}		
		send_json(make_datatables_list($data)); 
	}
	
	function detail_form($row_id = 0) // jika id tidak diisi maka dianggap create, else dianggap edit
		{		
			$this->load->library('render');
			$index = $this->input->post('transient_index');
			if (strlen(trim($index)) == 0) {
						
				// TRANSIENT CREATE - isi form dengan nilai default / kosong
					
					$data['index']							= '';
					$data['tr_plan_id']						= $row_id ;
					$data['transient_detail_purchase_id'] 	= '';
					$data['transient_detail_location_name'] = '';
					$data['transient_detail_location_id'] 	= '';
					$data['transient_detail_qty'] 			= '';
		
			} else {
					$data['index']						= $index;
					$data['tr_plan_id'] 				= $row_id;
					$data['transient_detail_purchase_id'] 	= array_shift($this->input->post('transient_detail_purchase_id'));;
					$data['transient_detail_location_name'] = array_shift($this->input->post('transient_detail_location_name'));
					$data['transient_detail_location_id'] 	= array_shift($this->input->post('transient_detail_location_id'));
					$data['transient_detail_qty'] 			= array_shift($this->input->post('transient_detail_qty'));
					
					
					
			}
		
			$this->render->add_form('app/ransom/transient_form', $data);
			$this->render->show_buffer();
	}
	function detail_form_action()
	{		
			$this->load->library('form_validation');
			$this->form_validation->set_rules('i_spbe_id', 'SPBE', 'trim|required');
			$this->form_validation->set_rules('i_qty', 'Jumlah Tebusan', 'trim|required|integer|min_value[0]');
		
			$index = $this->input->post('i_index');		
			// cek data berdasarkan kriteria
			if ($this->form_validation->run() == FALSE) send_json_validate();
		
			$no 						= $this->input->post('i_index');
			$transient_detail_location_id 	= $this->input->post('i_spbe_id');
			$transient_detail_location_name 	= $this->input->post('i_location_name');
			$transient_detail_purchase_id 	= $this->input->post('i_purchase_id');
			$transient_detail_qty 	= $this->input->post('i_qty');
			
		
			
			$data = array(
			
				form_transient_pair('transient_detail_purchase_id', $no,$transient_detail_purchase_id),
												
				form_transient_pair('transient_detail_location_name', $transient_detail_location_name,$transient_detail_location_name,
												array(
													  'transient_detail_location_id'=>$transient_detail_location_id,$transient_detail_location_id,
												)
												),
				form_transient_pair('transient_detail_qty',$transient_detail_qty,$transient_detail_qty),
			
					
				);
		
		send_json_transient($index, $data);
	}
	
		
	function load_data_spbe()
	{
		$id 	= $this->input->post('id');
		
		$query = $this->ransom_model->load_data_spbe($id);
		$data = array();
		
		foreach($query->result_array() as $row)
		{
			$data['location_name'] 		= $row['location_name'];
		
		}
		send_json_message('SPBE', $data);
	}
		
}