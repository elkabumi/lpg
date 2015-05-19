<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
			class tr_payment extends CI_Controller{
			function __construct(){
			parent::__construct();
			$this->load->library('render');
			$this->load->model('tr_payment_model');
			$this->load->library('access');
			$this->access->set_module('tr_payment.tr_payment');
			$this->access->user_page();
			}
			function index(){
			$this->render->add_view('app/tr_payment/list');
			$this->render->build('Pembayaran');
			$this->render->show('Pembayaran');
		}
		function table_controller(){
			$data = $this->tr_payment_model->list_controller();
			send_json($data);
		}
	
		function form($registration_id = 0)
		{
			$data = array();
			$this->load->model('global_model');

			$result = $this->tr_payment_model->read_id($registration_id);
			if($result){
				$data = $result;
				$data['row_id'] = $registration_id;
				$data['check_in'] = format_new_date($data['check_in']);
				$data['registration_estimation_date'] = format_new_date($data['registration_estimation_date']);
				$data['spk_date'] = format_new_date($data['spk_date']);
				$data['tr_payment_plain_first_date'] = format_new_date($result['tr_payment_plain_first_date']);
				$data['tr_payment_plain_last_date'] = $result['tr_payment_plain_last_date'];
				$data['tr_payment_actual_date'] = $result['tr_payment_actual_date'];
				$data['tr_payment_target_date'] = $result['tr_payment_target_date'];
				
			}
				
			$this->load->helper('form');
			$this->render->add_form('app/tr_payment/form', $data);
			$this->render->build('Registrasi');
			
			// List sparepart
			$this->render->add_view('app/tr_payment/transient_list_sparepart', $data);
			$this->render->build('Data Sparepart');
			
			// list panel asuransi
			$this->render->add_view('app/tr_payment/transient_list_panel', $data);
			$this->render->build('Data Panel Asuransi');

			// list jasa
			$this->render->add_view('app/tr_payment/transient_list', $data);
			$this->render->build('Data Jasa');
			// list bahan
			$this->render->add_view('app/tr_payment/transient_list_bahan', $data);
			$this->render->build('Data Bahan');
			// list cat
			$this->render->add_view('app/tr_payment/transient_list_cat', $data);
			$this->render->build('Data Cat');
			

			// list foto
			$this->render->add_view('app/tr_payment/transient_list_foto');
			$this->render->build('Photo');
			
			$this->render->add_js('ajaxfileupload');
			$this->render->show('Transaksi');
		}
		
		
		
			
		function form_action($is_delete = 0) // jika 0, berarti insert atau update, bila 1 berarti delete
		{
			$this->load->library('form_validation');
			// bila operasinya DELETE -----------------------------------------------------------------------------------------
			if($is_delete)
			{
				$this->load->model('tr_payment_model');
				$id = $this->input->post('i_tr_payment_id');
				$is_process_error = $this->tr_payment_model->delete($id);
				send_json_action($is_process_error, "Data telah dihapus", "Data gagal dihapus");
			}
		// bila bukan delete, berarti create atau update ------------------------------------------------------------------
		// definisikan kriteria data
				
				$this->form_validation->set_rules('i_employee_group_id','Tim Kerja','trim|required');
				$this->form_validation->set_rules('i_first_date','Tanggal awal plain','trim|required|valid_date|sql_date');
				$this->form_validation->set_rules('i_last_date','Tanggal akhir plain','trim|required|valid_date|sql_date');
				$this->form_validation->set_rules('i_actual_date','Tanggal Aktual','trim|required|valid_date|sql_date');
				$this->form_validation->set_rules('i_target_date','Tanggal target selesai','trim|required|valid_date|sql_date');
			
		// cek data berdasarkan kriteria
			if ($this->form_validation->run() == FALSE) send_json_validate();

				$tr_payment_id = $this->input->post('i_tr_payment_id');

				$data['registration_id'] = $this->input->post('row_id');
				$data['employee_group_id'] = $this->input->post('i_employee_group_id');
				$data['tr_payment_plain_first_date'] = $this->input->post('i_first_date');
				$data['tr_payment_plain_last_date'] = $this->input->post('i_last_date');
				$data['tr_payment_actual_date'] = $this->input->post('i_actual_date');
				$data['tr_payment_target_date'] = $this->input->post('i_target_date');
				$data['employee_group_id2'] = $this->input->post('i_employee_group_id2');
				$data['tr_payment_gabungan_lain'] = $this->input->post('i_gabungan_lain');
				$data['tr_payment_las_lain'] = $this->input->post('i_las_lain');
				
				// simpan transient jasa
				$list_tr_payment_detail_date		= $this->input->post('transient_tr_payment_detail_date');
				$list_workshop_service_id			= $this->input->post('transient_workshop_service_id');
				$list_workshop_service_price		= $this->input->post('transient_workshop_service_price');
				$list_workshop_service_job_price	= $this->input->post('transient_workshop_service_job_price');
				$list_tr_payment_detail_progress	= $this->input->post('transient_tr_payment_detail_progress');

			if(!$list_tr_payment_detail_date) send_json_error('Simpan gagal. Data Pembayaran masih kosong');
				$total_price = 0;
				$total_progress = 0;
				$jumlah_jasa = 0;
				$items = array();

				// jasa
				if($list_tr_payment_detail_date){
					foreach($list_tr_payment_detail_date as $key => $value)
					{
				//$get_purchase_price = $this->registration_model->get_purchase_price($list_product_id[$key]);
						$items[] = array(
							'tr_payment_detail_date' => ($list_tr_payment_detail_date[$key]),
							'tr_payment_detail_progress' => $list_tr_payment_detail_progress[$key],
							'workshop_service_id' => $list_workshop_service_id[$key],
							'workshop_service_price' => $list_workshop_service_price[$key],
							'workshop_service_job_price' => $list_workshop_service_job_price[$key]
							);
						$total_price += $list_workshop_service_job_price[$key];
						$total_progress += $list_tr_payment_detail_progress[$key];
						$jumlah_jasa++;
					}
				}

				// simpan transient cat/bahan
				$list_bahan_name	= ($this->input->post('transient_bahan_name'));
				$list_bahan_qty =  ($this->input->post('transient_bahan_qty'));
				$list_bahan_qty_form =  ($this->input->post('transient_bahan_qty_form'));
				$list_bahan_desc  =  ($this->input->post('transient_bahan_description'));
				$list_bahan_price	=  ($this->input->post('transient_bahan_price'));
				$list_bahan_unit_name  	=   ($this->input->post('transient_bahan_unit_name'));
				$list_bahan_stock_id  	=  ($this->input->post('transient_bahan_stock_id'));
				$list_bahan_stock_qty 	=   ($this->input->post('transient_bahan_stock_qty'));
				$list_bahan_edit	=   ($this->input->post('transient_bahan_edit'));
				$list_bahan_tmb_id 	=   ($this->input->post('transient_tmb_id'));
				
				$total_material = 0;
				$items_material = array();
		
				if($list_bahan_name){
					foreach($list_bahan_name as $key => $value)
					{
						//send_json($list_bahan_tmb_id[$key].''.$list_bahan_edit[$key]);
						$check = 0;
						$check_product = 0;
						$bahan_stock_id_original = $list_tm_stock_id[$key];
						foreach($list_tm_stock_id as $key_check => $value)
							{
						
								if($bahan_stock_id_original == $list_tm_stock_id[$key_check]){
									$check++;
								}
						
							}
						if($check > 1){
							
							$get_data_materails = $this->tr_payment_model->get_data_material($tm_stock_id_original);
							send_json_error("Simpan gagal. Bahan item tidak boleh sama [".$get_data_materails[0]."]");
						}
						if($list_bahan_tmb_id[$key] > 0 and $list_bahan_edit[$key] == '0'){
							if($list_bahan_qty_form[$key]  > $list_bahan_qty[$key]){
								
							}else if($list_bahan_qty_form[$key] < $list_bahan_qty[$key]){
								send_json('kurang');
							}
						}
						$items_material[] = array(
							'tm_name' 			=> ($list_tm_name[$key]),
							'tm_qty' 			=> $list_tm_qty[$key],
							'tm_description' 	=> $list_tm_description[$key],
							'tm_price'			=> $list_tm_price[$key]
							);
						$total_material += $list_tm_price[$key];
						}
					
				}
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				//simpan transient spareparts
				$list_rs_part_number	= ($this->input->post('transient_rs_part_number'));	
				$list_rs_qty_received 	= ($this->input->post('transient_rs_qty_received'));	
				$list_rs_qty_install_form= ($this->input->post('transient_rs_qty_install_form'));
				$list_rs_tpd_id				= ($this->input->post('transient_tpd_id'));
			
				$list_rs_name			= ($this->input->post('transient_rs_name'));
				$list_rs_qty 			= ($this->input->post('transient_rs_qty'));	
				$list_rs_qty_install 	= ($this->input->post('transient_rs_qty_install'));
				$list_rs_qty_stock 	= ($this->input->post('transient_rs_qty_stock'));
				$list_rs_qty_stock_form 	= ($this->input->post('transient_rs_qty_stock_form'));
				$list_rs_repair 	= ($this->input->post('transient_rs_repair'));
				$list_rs_install_date 	= ($this->input->post('transient_install_date'));
				$list_rs_install_desc	= ($this->input->post('transient_install_desc'));
		
				
				
				if($list_rs_name){
					foreach($list_rs_name as $key => $value)
					{
					if($list_rs_qty_install_form  > '0'){
							$items_sparepats[] = array(
							'tpd_detail_install'  =>$list_rs_qty_install[$key] + $list_rs_qty_install_form[$key],
							'tpd_id'  => $list_rs_tpd_id[$key],
							'tpdh_type'  => 3,
							'tpdh_date'  => $list_rs_install_date[$key],
							'tpdh_qty'  => $list_rs_qty_install_form[$key],
							'tpdh_desc'  => $list_rs_install_desc[$key]
							);
					}else{
						$items_sparepats[] = array(
							'tpd_detail_install'  => 0,
							'tpd_id'  => 0,
							'tpdh_type'  => 0,
							'tpdh_date'  => 0,
							'tpdh_qty'  =>0,
							'tpdh_desc'  =>''
							
						);
					}
					}
				}
				
				
				
				
				
				
				
				
				
				
				// simpan transient foto
				$list_registration_photo_name	 	= $this->input->post('transient_photo_name');
				$list_registration_photo_type	 	= $this->input->post('transient_photo_type');
				$list_registration_photo_file		= $this->input->post('transient_photo_file');
				$list_registration_photo_edit		= $this->input->post('transient_photo_edit');

				$items_foto = array();
				if($list_registration_photo_name){
				foreach($list_registration_photo_name as $key => $value)
				{
					$path = "";
					if($list_registration_photo_edit[$key] == 1){
						
						$storage = "img_mobil/";
						$path = $this->access->info['employee_id']."_".date("ymdhms")."_".$list_registration_photo_type[$key]."_";
					
					rename($this->config->item('upload_tmp').$list_registration_photo_file[$key],
					$this->config->item('upload_storage').$storage.$path.$list_registration_photo_file[$key]);	
					}

					$items_foto[] = array(				
						'photo_name'  => $list_registration_photo_name[$key],
						'photo_type_id'  => $list_registration_photo_type[$key],
						'photo_file'  => $path.$list_registration_photo_file[$key]
						
					);
					
					
					
				}
				}


				$data['tr_payment_material_total'] = $total_material;
				$data['tr_payment_progress'] = $total_progress / $jumlah_jasa;
				$data['tr_payment_total'] = $total_price;

				if(empty($tr_payment_id)) // jika tidak ada id maka create
				{
			//$data['registration_code'] = format_code('registrations','registration_code','PU',7);
				//$error = $this->tr_payment_model->create($data, $items, $items_material, $items_foto,$items_sparepats);
				send_json_action($error, "Data telah ditambah", "Data gagal ditambah");
				}
				else // id disebutkan, lakukan proses UPDATE
				{
					//$error = $this->tr_payment_model->update($tr_payment_id, $data, $items,$items_material, $items_foto,$items_sparepats);
					send_json_action($error, "Data telah direvisi", "Data gagal direvisi");
				}
			}
			function detail_list_loader($registration_id=0)
			{
				if($registration_id == 0)send_json(make_datatables_list(null));

				$data = $this->tr_payment_model->detail_list_loader($registration_id);
				$sort_id = 0;

				foreach($data as $key => $value)
				{
				$data[$key] = array(
					form_transient_pair('transient_tr_payment_detail_date', format_new_date($value['tr_payment_detail_date']), $value['tr_payment_detail_date'],
							array(
									'transient_tr_payment_detail_id' => $value['tr_payment_detail_id'],
									
									)),
					
						form_transient_pair('transient_workshop_service_id', $value['workshop_service_name'], $value['workshop_service_id']),
						form_transient_pair('transient_workshop_service_price', tool_money_format($value['workshop_service_price']), $value['workshop_service_price']),
						form_transient_pair('transient_workshop_service_job_price', tool_money_format($value['workshop_service_job_price']),$value['workshop_service_job_price']),
						form_transient_pair('transient_tr_payment_detail_progress', $value['tr_payment_detail_progress'])
					);
				}
				send_json(make_datatables_list($data));
			}
			
			function detail_form($registration = 0) // jika id tidak diisi maka dianggap create, else dianggap edit
			{
				$this->load->library('render');
				$index = $this->input->post('transient_index');
				if (strlen(trim($index)) == 0) {
					// TRANSIENT CREATE - isi form dengan nilai default / kosong
					$data['index'] = '';
					$data['tr_payment_detail_id'] = '';
					$data['tr_payment_detail_date'] = '';
					$data['workshop_service_id'] = '';
					$data['workshop_service_price'] = '';
					$data['workshop_service_name'] = '';
					$data['workshop_service_job_price'] = '';
					$data['tr_payment_detail_progress'] = '';
				} else {
					$data['index'] = $index;
					//$data['workshop_service_name'] = array_shift($this->input->post('transient_workshop_service_name'));
					$data['tr_payment_detail_id'] = array_shift($this->input->post('transient_tr_payment_detail_id'));
					$data['tr_payment_detail_date'] = array_shift($this->input->post('transient_tr_payment_detail_date'));
					$data['workshop_service_id'] = array_shift($this->input->post('transient_workshop_service_id'));
					$data['workshop_service_price'] = array_shift($this->input->post('transient_workshop_service_price'));
					$data['workshop_service_job_price'] = array_shift($this->input->post('transient_workshop_service_job_price'));
					$data['tr_payment_detail_progress'] = array_shift($this->input->post('transient_tr_payment_detail_progress'));
					
				}
				$data['progress']=array('25'=>'25%','50'=>'50%','70'=>'70%','90'=>'90%','100'=>'100%');
				
					$this->load->helper('form');
					$this->render->add_form('app/tr_payment/transient_form', $data);
					$this->render->show_buffer();
			}
			
			
			function detail_form_action()
			{
				$this->load->library('form_validation');
				//$this->form_validation->set_rules('i_detail_registration_id', 'Harga', 'trim|required');
				$this->form_validation->set_rules('i_tr_payment_detail_date', 'Tanggal', 'trim|required|valid_date|sql_date');
				$this->form_validation->set_rules('i_workshop_service_id', 'Jasa', 'trim|required');
				$this->form_validation->set_rules('i_tr_payment_detail_progress', 'Progress', 'trim|required|max_value[100]');
				$index = $this->input->post('i_index');
			// cek data berdasarkan kriteria
			if ($this->form_validation->run() == FALSE) send_json_validate();
				$no = $this->input->post('i_index');
				
				$tr_payment_detail_id = $this->input->post('i_tr_payment_detail_id');
				$tr_payment_detail_date = ($this->input->post('i_tr_payment_detail_date'));
				$workshop_service_id = $this->input->post('i_workshop_service_id');
				$workshop_service_price	= $this->input->post('i_workshop_service_price');
				$workshop_service_name	= $this->input->post('i_workshop_service_name');
				$workshop_service_job_price	= $this->input->post('i_workshop_service_job_price');
				$tr_payment_detail_progress	= $this->input->post('i_tr_payment_detail_progress');
				//send_json_error($no);
				$data = array(
				form_transient_pair('transient_tr_payment_detail_date', format_new_date($tr_payment_detail_date), $tr_payment_detail_date,
							array(
									'transient_tr_payment_detail_id' => $tr_payment_detail_id)),
					
						form_transient_pair('transient_workshop_service_id', $workshop_service_name, $workshop_service_id),
						form_transient_pair('transient_workshop_service_price', tool_money_format($workshop_service_price), $workshop_service_price),
						form_transient_pair('transient_workshop_service_job_price', tool_money_format($workshop_service_job_price),$workshop_service_job_price),
						form_transient_pair('transient_tr_payment_detail_progress', $tr_payment_detail_progress)
					);
			send_json_transient($index, $data);
		}
			
	function detail_list_loader_sparepart($registration_id=0)
	{
		if($registration_id == 0)send_json(make_datatables_list(null)); 
				
		$data = $this->tr_payment_model->detail_list_loader_sparepart($registration_id);
		$sort_id = 0;
		foreach($data as $key => $value) 
		{	
		$value['tpd_detail_install'] = $value['tpd_detail_install']?$value['tpd_detail_install'] :0;
		$value['tpd_detail_received'] = $value['tpd_detail_received']?$value['tpd_detail_received'] :0;
		$stock = $value['tpd_detail_received']- $value['tpd_detail_install'];
		$data[$key] = array(
				form_transient_pair('transient_rs_part_number', $value['rs_part_number'], $value['rs_part_number'],
									array('transient_rs_qty_received'=>$value['tpd_detail_received'],
										  'transient_rs_qty_install_form'=>'0',
										  'transient_tpd_id'=>$value['tpd_id'],
										  'transient_install_date'=>'',
										  'transient_install_desc'=>'',
										  'transient_rs_qty_stock'=>$stock,
										  )
				),
				form_transient_pair('transient_rs_name', $value['rs_name']),
				form_transient_pair('transient_rs_qty',$value['rs_qty']),
				form_transient_pair('transient_rs_qty_install',$value['tpd_detail_install']),
				form_transient_pair('transient_rs_qty_stock_form',$stock),
				form_transient_pair('transient_rs_repair', tool_money_format($value['rs_repair']), $value['rs_repair'])
				//,form_transient_pair('transient_rs_approved_repair', tool_money_format($value['rs_approved_repair']), $value['rs_approved_repair'])
		);
		
		
		
		}		
		send_json(make_datatables_list($data)); 
	}
	
	function detail_list_loader_panel($row_id=0)
			{
				if($row_id == 0)
				
				send_json(make_datatables_list(null)); 
						
				$data = $this->tr_payment_model->detail_list_loader_panel($row_id);
				$sort_id = 0;
				foreach($data as $key => $value) 
				{
				$data[$key] = array(
						form_transient_pair('transient_product_code', $value['product_code'],$value['product_code'],
									array(
											'transient_product_price_id' => $value['product_price_id'],
											'transient_detail_registration_id' =>$value['detail_registration_id'])),
											
						form_transient_pair('transient_product_name', $value['product_name']." (".$value['product_type_name']." - ".$value['pst_name'].")", $value['product_name']),
						form_transient_pair('transient_reg_price',	$value['detail_registration_price'],$value['detail_registration_price'])
						//,form_transient_pair('transient_reg_aproved_price',	$value['detail_registration_approved_price'],$value['detail_registration_approved_price'])
						
				);
		
		
	
		}		
		send_json(make_datatables_list($data)); 
	}
	function detail_list_loader_bahan($registration_id=0)
	{
		if($registration_id == 0)send_json(make_datatables_list(null)); 
				
		$data = $this->tr_payment_model->detail_list_loader_bahan($registration_id);
		$sort_id = 0;
		foreach($data as $key => $value) 
		{	
		
		$data[$key] = array(
				form_transient_pair('transient_bahan_name', $value['material_name'], $value['material_name'],
						array('transient_bahan_stock_id'=>$value['material_stock_id'],
						 	  'transient_bahan_unit_name'=>$value['unit_name'],
							  'transient_tmb_id'=>$value['tm_id'],
					     	  'transient_bahan_stock_qty'=>$value['material_stock_qty'],
							  'transient_bahan_edit'=>'1',
							  'transient_bahan_qty'=>$value['tm_qty'])
				),
				form_transient_pair('transient_bahan_qty_form', $value['tm_qty']),
				form_transient_pair('transient_bahan_description',$value['tm_description']),
				form_transient_pair('transient_bahan_price', tool_money_format($value['tm_price']), $value['tm_price'])
		);
		
		
		
		}		
		send_json(make_datatables_list($data)); 
	}

	function detail_form_bahan($registration_id = 0) // jika id tidak diisi maka dianggap create, else dianggap edit
	{		
		$this->load->library('render');
		$index = $this->input->post('transient_index');
		if (strlen(trim($index)) == 0) {
					
			// TRANSIENT CREATE - isi form dengan nilai default / kosong
			$data['index']			= '';
			$data['registration_id'] 				= $registration_id;
			
			$data['bahan_qty'] = 0;
			$data['bahan_qty_form'] = 0;
			$data['bahan_description'] = '';			
			$data['bahan_price'] 	= '';
			$data['bahan_unit_name'] 	= '';
			$data['bahan_name'] 	= '';
			$data['bahan_stock_id'] 	= '';
			$data['bahan_stock_qty'] 	= '';
			$data['tmb_id'] 	= '';
			$data['bahan_edit'] 	= '0';
			
		
		} else {
			
			$data['index']			= $index;
			$data['registration_id'] 				= $registration_id;
			$data['bahan_name']	= array_shift($this->input->post('transient_bahan_name'));
			$data['bahan_qty'] = array_shift($this->input->post('transient_bahan_qty'));
			$data['bahan_qty_form'] = array_shift($this->input->post('transient_bahan_qty_form'));
			$data['bahan_description'] = array_shift($this->input->post('transient_bahan_description'));
			$data['bahan_price'] 	= array_shift($this->input->post('transient_bahan_price'));
			$data['bahan_unit_name'] 	=  array_shift($this->input->post('transient_bahan_unit_name'));
			$data['bahan_stock_id'] 	= array_shift($this->input->post('transient_bahan_stock_id'));
			$data['bahan_stock_qty'] 	=  array_shift($this->input->post('transient_bahan_stock_qty'));
			$data['bahan_edit'] 	=  array_shift($this->input->post('transient_bahan_edit'));
			$data['tmb_id'] 	=  array_shift($this->input->post('transient_tmb_id'));
		}		
			
		$this->render->add_form('app/tr_payment/transient_form_bahan', $data);
		$this->render->show_buffer();
	}
	
	
	function detail_form_action_bahan()
	{		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('i_material_stock_id', 'Nama Bahan', 'trim|required');
		//$this->form_validation->set_rules('i_tm_qty', 'Qty', 'trim|required|numeric|min_value[1]');
		//$this->form_validation->set_rules('i_tm_description', 'Keterangan', 'trim|required|numeric');
		$this->form_validation->set_rules('i_tm_price', 'Harga', 'trim|required|numeric');
		$index = $this->input->post('i_index');		
		// cek data berdasarkan kriteria
		if ($this->form_validation->run() == FALSE) send_json_validate(); 
		
		$this->load->model('global_model');	
		
		$no 		= $this->input->post('i_index');
		$bahan_name 	= $this->input->post('i_name');
		$bahan_qty 	= $this->input->post('i_tm_qty');
		$bahan_qty_form 	= $this->input->post('i_tm_qty_form');
		$bahan_description = $this->input->post('i_tm_description');
		$bahan_price 	= $this->input->post('i_tm_price');
		$bahan_unit_name 	= $this->input->post('i_unit');
		$bahan_stock_id 	= $this->input->post('i_material_stock_id');
		$bahan_stock_qty 	= $this->input->post('i_stock_qty');
		$bahan_edit 	= $this->input->post('i_edit');
		$tmb_id 	= $this->input->post('i_tmb_id');
		if($bahan_stock_qty < $bahan_qty){
				send_json_error("Qty tidak poleh melebihi Stock Bahan");
		}
		//send_json_error($no);
		
		$data = array(
				form_transient_pair('transient_bahan_name', $bahan_name, $bahan_name,
					array('transient_bahan_stock_id'=>$bahan_stock_id,
						  'transient_bahan_unit_name'=>$bahan_unit_name,
					      'transient_bahan_stock_qty'=>$bahan_stock_qty,
						  'transient_tmb_id'=>$tmb_id ,
						  'transient_bahan_edit'=>'0' ,
						 'transient_bahan_qty'=>$bahan_qty)
				),
				form_transient_pair('transient_bahan_qty_form', $bahan_qty_form ),
				form_transient_pair('transient_bahan_description',$bahan_description),
				form_transient_pair('transient_bahan_price', tool_money_format($bahan_price), $bahan_price)
		);
		 
		send_json_transient($index, $data);
	}
	
		
	function detail_list_loader_cat($registration_id=0)
	{
		if($registration_id == 0)send_json(make_datatables_list(null)); 
				
		$data = $this->tr_payment_model->detail_list_loader_cat($registration_id);
		$sort_id = 0;
		foreach($data as $key => $value) 
		{	
		
		$data[$key] = array(
				form_transient_pair('transient_tm_name', $value['material_name'], $value['material_name'],
								array('transient_tm_stock_id'=>$value['material_stock_id'],
						 		 	  'transient_tm_unit_name'=>$value['unit_name'],
					     		 	  'transient_tm_stock_qty'=>$value['material_stock_qty'],)
				),
				form_transient_pair('transient_tm_name', $value['tm_qty']),
				form_transient_pair('transient_tm_description',$value['tm_description']),
				form_transient_pair('transient_tm_price', tool_money_format($value['tm_price']), $value['material_name'])
				);
		
		
		
		}		
		send_json(make_datatables_list($data)); 
	}

	function detail_list_loader_foto($registration_id=0)
	{
		if($registration_id == 0)
		
		send_json(make_datatables_list(null)); 
				
		$data = $this->tr_payment_model->detail_list_loader_foto($registration_id);
		
		$sort_id = 0;
		foreach($data as $key => $value) 
		{	
			$storage = "storage/img_mobil/";

			$foto='<img width="50px;" height="50px;" src='.base_url().$storage.form_transient_pair('transient_photo', $value['photo_file'], $value['photo_file']).'';
				

		$data[$key] = array(
				form_transient_pair('transient_photo_name', $value['photo_name'],$value['photo_name'],
					array(
											'transient_photo_type_id' => $value['photo_type_id'],
											'transient_photo_file' => $value['photo_file'],
											'transient_photo_edit' => 0
											)
				),
				form_transient_pair('transient_photo_type', $value['photo_type_name'], $value['photo_type_id']),
				$foto
				
		);
		
		
	
		}		
		send_json(make_datatables_list($data)); 
	}
	function detail_form_sparepart()
	{		
		$this->load->library('render');
		$index = $this->input->post('transient_index');
		
		if (strlen(trim($index)) == 0) {
		
			// TRANSIENT CREATE - isi form dengan nilai default / kosong
			$data['index']			= '';
			$data['rs_part_number']	= '';	
			$data['rs_qty_received'] = '';
			$data['rs_qty_install_form'] = '';	
			$data['rs_name']	= '';
			$data['rs_qty'] = '';	
			$data['rs_qty_install'] = '';			
			$data['rs_qty_stock'] 	= '';
					
			$data['rs_qty_stock_form'] 	= '';
			$data['rs_repair'] 	= '';
			$data['rs_install_date'] 	= '';
			$data['rs_install_desc'] 	= '';	
			
		} else {
			
			$data['index']				= $index;
			$data['rs_part_number']		= array_shift($this->input->post('transient_rs_part_number'));	
			$data['rs_qty_received'] 	= array_shift($this->input->post('transient_rs_qty_received'));	
			$data['rs_qty_install_form']= array_shift($this->input->post('transient_rs_qty_install_form'));
			$data['tpd_id']				= array_shift($this->input->post('transient_tpd_id'));
			
			$data['rs_name']			= array_shift($this->input->post('transient_rs_name'));
			$data['rs_qty'] 			= array_shift($this->input->post('transient_rs_qty'));	
			$data['rs_qty_install'] 	= array_shift($this->input->post('transient_rs_qty_install'));
			$data['rs_qty_stock'] 		= array_shift($this->input->post('transient_rs_qty_stock'));
			$data['rs_qty_stock_form'] 	= array_shift($this->input->post('transient_rs_qty_stock_form'));
		
			$data['rs_repair'] 			= array_shift($this->input->post('transient_rs_repair'));
			
			$data['rs_install_date'] 	= array_shift($this->input->post('transient_install_date'));
			$data['rs_install_desc'] 	= array_shift($this->input->post('transient_install_desc'));
		}		
			
		$this->render->add_form('app/tr_payment/transient_form_sparepart', $data);
		$this->render->show_buffer();
	}
	function detail_form_action_sparepart()
	{		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('i_rs_install_form', 'Jumlah Pemasangan', 'trim|required|numeric|min_value[1]');
		$this->form_validation->set_rules('i_rs_install_date','Tanggal Pemasangan','trim|required|valid_date|sql_date');
		
		$index = $this->input->post('i_index');		
		// cek data berdasarkan kriteria
		if ($this->form_validation->run() == FALSE) send_json_validate(); 
		
		$this->load->model('global_model');	
		
		$no 		= $this->input->post('i_index');
		$rs_part_number 	= $this->input->post('i_rs_no');
		$rs_qty_received 	= $this->input->post('i_rs_qty_received');
		$rs_qty_install_form= $this->input->post('i_rs_install_form');
		$tpd_id 				= $this->input->post('i_tpd_id');
		$rs_name 			= $this->input->post('i_rs_name');
		$rs_qty 			= $this->input->post('i_rs_qty');
		$rs_qty_install 	= $this->input->post('i_rs_qty_install');
		$rs_qty_stock		= $this->input->post('i_rs_stock');	
		$rs_qty_stock_form	= $this->input->post('i_rs_qty_stock_form');
		$rs_repair			= $this->input->post('i_rs_repair');
		$rs_install_date 	= $this->input->post('i_rs_install_date');
		$rs_install_desc 	= $this->input->post('i_rs_install_desc');
		
		//send_json_error($no);
		if($rs_qty_stock < $rs_qty_install_form){
				send_json_error("Jumlah Pemasangan tidak Boleh melebihi Jumlah Stock");
		}
		$install = $rs_qty_install + $rs_qty_install_form;
		$stock = $rs_qty_stock -  $rs_qty_install_form;
		$data = array(
				form_transient_pair('transient_rs_part_number',$rs_part_number,$rs_part_number,
									array('transient_rs_qty_received'=> $rs_qty_received,
										  'transient_rs_qty_install_form'=> $rs_qty_install_form,
										  'transient_tpd_id'=> $tpd_id ,
										  'transient_install_date'=> $rs_install_date,
										  'transient_install_desc'=> $rs_install_desc,
										  'transient_rs_qty_stock'=> $rs_qty_stock)
				),
				form_transient_pair('transient_rs_name', $rs_name),
				form_transient_pair('transient_rs_qty',$rs_qty),
				form_transient_pair('transient_rs_qty_install',$install,$rs_qty_install),
				form_transient_pair('transient_rs_qty_stock_form',$stock),
				form_transient_pair('transient_rs_repair', tool_money_format($rs_repair), $rs_repair)
				);
		 
		send_json_transient($index, $data);
	}
	
	
	function detail_form_cat($registration_id = 0) // jika id tidak diisi maka dianggap create, else dianggap edit
	{		
		$this->load->library('render');
		$index = $this->input->post('transient_index');
		if (strlen(trim($index)) == 0) {
					
			// TRANSIENT CREATE - isi form dengan nilai default / kosong
			$data['index']			= '';
			$data['registration_id'] 				= $registration_id;
			
			$data['tm_qty'] = '';
			$data['tm_description'] = '';			
			$data['tm_price'] 	= '';
			$data['tm_unit_name'] 	= '';
			$data['tm_name'] 	= '';
			$data['tm_stock_id'] 	= '';
			$data['tm_stock_qty'] 	= '';
		
		} else {
			
			$data['index']			= $index;
			$data['registration_id'] 				= $registration_id;
			$data['tm_name']	= array_shift($this->input->post('transient_tm_name'));
			$data['tm_qty'] = array_shift($this->input->post('transient_tm_qty'));
			$data['tm_description'] = array_shift($this->input->post('transient_tm_description'));
			$data['tm_price'] 	= array_shift($this->input->post('transient_tm_price'));
			$data['tm_unit_name'] 	=  array_shift($this->input->post('transient_tm_unit_name'));
			
			$data['tm_stock_id'] 	= array_shift($this->input->post('transient_tm_stock_id'));
			$data['tm_stock_qty'] 	=  array_shift($this->input->post('transient_tm_stock_qty'));
		}		
			
		$this->render->add_form('app/tr_payment/transient_form_cat', $data);
		$this->render->show_buffer();
	}
	
	
	function detail_form_action_cat()
	{		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('i_material_stock_id', 'Nama cat', 'trim|required');
		$this->form_validation->set_rules('i_tm_qty', 'Qty', 'trim|required|numeric|min_value[1]');
		//$this->form_validation->set_rules('i_tm_description', 'Keterangan', 'trim|required|numeric');
		$this->form_validation->set_rules('i_tm_price', 'Harga', 'trim|required|numeric');
		$index = $this->input->post('i_index');		
		// cek data berdasarkan kriteria
		if ($this->form_validation->run() == FALSE) send_json_validate(); 
		
		$this->load->model('global_model');	
		
		$no 		= $this->input->post('i_index');
		$tm_name 	= $this->input->post('i_name');
		$tm_qty 	= $this->input->post('i_tm_qty');
		$tm_description = $this->input->post('i_tm_description');
		$tm_price 	= $this->input->post('i_tm_price');
		$tm_unit_name 	= $this->input->post('i_unit');
		$tm_stock_id 	= $this->input->post('i_material_stock_id');
		$tm_stock_qty 	= $this->input->post('i_stock_qty');
		if($tm_stock_qty < $tm_qty){
				send_json_error("Qty tidak poleh melebihi Stock Cat");
		}
		//send_json_error($no);
		
		$data = array(
				form_transient_pair('transient_tm_name', $tm_name, $tm_name,
					array('transient_tm_stock_id'=>$tm_stock_id,
						  'transient_tm_unit_name'=>$tm_unit_name,
					      'transient_tm_stock_qty'=>$tm_stock_qty,)
				),
				form_transient_pair('transient_tm_qty', $tm_qty),
				form_transient_pair('transient_tm_description',$tm_description),
				form_transient_pair('transient_tm_price', tool_money_format($tm_price), $tm_price)
		);
		 
		send_json_transient($index, $data);
	}
	
	function detail_form_foto($registration_id = 0) // jika id tidak diisi maka dianggap create, else dianggap edit
	{		
		$this->load->library('render');
		$index = $this->input->post('transient_index');
		$this->load->model('global_model');
		if (strlen(trim($index)) == 0) {
					
			// TRANSIENT CREATE - isi form dengan nilai default / kosong
			$data['index']			= '';
			$data['registration_id'] 				= $registration_id;
			$data['photo_name']	= '';
			$data['photo_type']	= '2';
			$data['photo_edit']	= '1';	
			$data['photo_type_id'] = "";
			$data['photo_file'] = '';
		} else {
			
			$data['index']			= $index;
			$data['registration_id'] 				= $registration_id;
			$data['photo_name'] = array_shift($this->input->post('transient_photo_name'));
			$data['photo_type'] = array_shift($this->input->post('transient_photo_type'));
			$data['photo_type_id'] = array_shift($this->input->post('transient_photo_type'));
			$data['photo_file'] = array_shift($this->input->post('transient_photo_file'));
			$data['photo_edit'] = array_shift($this->input->post('transient_photo_edit'));

			
		}		
		$data['cbo_photo_type_id'] 		= $this->global_model->get_type_photo(2);
		$this->load->helper('form');
		$this->render->add_form('app/tr_payment/transient_form_foto', $data);
		
		$this->render->show_buffer();
	}
	function detail_form_action_foto()
	{		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('i_photo_name', 'nama foto', 'trim|required');
		$this->form_validation->set_rules('i_photo_file','foto', 'trim|required');
	
		$index = $this->input->post('i_index');		
		// cek data berdasarkan kriteria
		if ($this->form_validation->run() == FALSE) send_json_validate(); 
	
		
		$no 		= $this->input->post('i_index');
		
		$photo_name	= $this->input->post('i_photo_name');
		$photo_type	= $this->input->post('i_photo_type');
		$photo_type_id	= $this->input->post('i_photo_type_id');
		$photo_file	= $this->input->post('i_photo_file');
		$photo_edit	= $this->input->post('i_photo_edit');
		
		$photo_type_name = $this->tr_payment_model->get_photo_type_name($photo_type_id);
		
		
		$foto='<img   width="50px;" height="50px;" src='.base_url().'tmp/'.form_transient_pair('transient_photo', $photo_file,$photo_file).'';
		form_transient_pair('transient_photo', $photo_file,$photo_file);
		$data = array(
	
				form_transient_pair('transient_photo_name', $photo_name, $photo_name, 
					array(
											'transient_photo_type_name' => $photo_type_name,
											'transient_photo_file' => $photo_file,
											'transient_photo_edit' => $photo_edit
											)
				),
				form_transient_pair('transient_photo_type', $photo_type_name, $photo_type_id),
				form_transient_pair('transient_photo',	$foto, $photo_file),
				
					
					
		);
		 
		send_json_transient($index, $data);
	}

	function load_workshop_service()
	{
		$id 	= $this->input->post('workshop_service_id');
		
		$query = $this->tr_payment_model->load_workshop_service($id);
		$data = array();
		
		foreach($query->result_array() as $row)
		{
			$data['workshop_service_price'] = $row['workshop_service_price'];
			$data['workshop_service_job_price'] = $row['workshop_service_job_price'];
			$data['workshop_service_name'] = $row['workshop_service_name'];
		}
		send_json_message('workshop_service', $data);
	}
			
	
		function do_upload()
		{		
			//$this->load->library('blob');
			//$blob = $this->blob->send('fileToUpload', BLOB_ALLOW_IMAGES, 1);
			$config['upload_path'] = 'tmp/';
			$config['allowed_types'] = 'gif|jpg|png';
			//$config['max_size']	= '1000';
			//$config['max_width']  = '1024';
			//$config['max_height']  = '768';
			$this->load->library('upload', $config);
		
			if ( ! $this->upload->do_upload('fileToUpload'))
			{
				$output = array('error' => strip_tags($this->upload->display_errors()));
				debug($output);
				//$output = array('error' => print_r($error,1), 'msg'=>'test');
				send_json($output);
				//$this->load->view('upload_form', $error);
			}	
			else
			{
				$data = $this->upload->data();
				$output = array('error' => '', 'value' => $data['file_name']);
				send_json($output);
				//$this->load->view('upload_success', $data);
			}
		}
		function load_detail_material()
	{
		$id 	= $this->input->post('id');
		
		$query = $this->tr_payment_model->load_detail_material($id);
		$data = array();
		
		foreach($query->result_array() as $row)
		{
		
			$data['tm_unit_name'] 	= $row['unit_name'];
			$data['tm_name'] 		= $row['material_name'];
			$data['tm_stock_qty'] 		= $row['material_stock_qty'];
			
		
			
		}
		send_json_message('detail_material', $data);
	}
	}
			
