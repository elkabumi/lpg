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
			
			
			function index($date=0){
				
			$data = array();
				if($date==0){
					$data['row_id'] = '';
					$data['date'] =0;
					$data['tr_plan_detail_shipment_realization_date'] = '';
				
				}else{
					$data['row_id'] = '';
					$data['date'] = $date;
					$data['tr_plan_detail_shipment_realization_date'] = format_new_date($date);
				}
				$this->load->helper('form');
					
				$this->render->add_form('app/tr_payment/form', $data);
				$this->render->build('Pembayaran');
				
				
				$this->render->add_view('app/tr_payment/transient_list');
				$this->render->build('Detail');
			
				
				$this->render->show('Pembayaran');
			}
		
			function detail_table_loader($date_1 = 0) {
			if($date_1 == 0){
					send_json(make_datatables_list(null));
			}else{
				
				$data = $this->tr_payment_model->detail_list_loader($date_1);
				
				
				$sort_id = 0;
				foreach($data as $key => $value) 
				{
					if($value['tr_plan_detail_shipment_status_id'] != 1){	
					$link = "<a href=".site_url('tr_payment/form/'.$value['tr_plan_detail_shipment_id'])." class='link_input'> Bayar </a>";
					$status = "<p align='center' style='color:#F00;'><strong>BELUM LUNAS</strong></p>";
					}else{
					$link = "<a href=".site_url('tr_payment/form/'.$value['tr_plan_detail_shipment_id'])." class='link_input'> View </a>";
					$status = "<p align='center' style='color:#00C;'><strong>LUNAS</strong></p>";
					}
					
				$tanggal_tebusan = format_new_date($value['tr_plan_date']);
				$tanggal_jatah = format_new_date($value['tr_plan_detail_date_realization']);
				$tanggal_pengiriman = format_new_date($value['tr_plan_detail_shipment_realization_date']);
				$data[$key] = array(
			
						form_transient_pair('transient_tr_plan__date', $tanggal_tebusan),
						form_transient_pair('transient_tr_plan_detail_realization_date', $tanggal_jatah),
						form_transient_pair('transient_tr_plan_detail_shipment_realization_date', $tanggal_pengiriman),
						form_transient_pair('transient_tr_plan_detail_code',$value['tr_plan_detail_code']),
						form_transient_pair('transient_truck_nopol',$value['truck_nopol']),
						form_transient_pair('transient_nama_spbe',$value['nama_spbe']),
						form_transient_pair('transient_sopir',$value['sopir']),
						form_transient_pair('transient_kernet',$value['kernet']),
						form_transient_pair('transient_location_name',$value['location_name']),
						form_transient_pair('transient_tr_plan_detail_shipment_qty',$value['tr_plan_detail_shipment_qty']),
						form_transient_pair('transient_tr_plan_detail_shipment_total_price', tool_money_format($value['tr_plan_detail_shipment_total_price']),$value['tr_plan_detail_shipment_total_price']),
						form_transient_pair('transient_tr_plan_detail_shipment_total_paid', tool_money_format($value['tr_plan_detail_shipment_total_paid']),$value['tr_plan_detail_shipment_total_paid']),
						form_transient_pair('transient_config', $status),
						form_transient_pair('transient_config', $link)
						
					);
				}
			}
			send_json(make_datatables_list($data));
		}
		
		function detail_list_loader_bayar($row_id = 0) {
			if($row_id == 0){
					send_json(make_datatables_list(null));
			}else{
				
				$data = $this->tr_payment_model->detail_list_loader_bayar($row_id);
				
				
				$sort_id = 0;
				foreach($data as $key => $value) 
				{	
				$payment_date = format_new_date($value['tr_payment_date']);
				$data[$key] = array(
			
						form_transient_pair('transient_tr_payment_date', $payment_date,$value['tr_payment_date']),
						form_transient_pair('transient_tr_payment_description',$value['tr_payment_description']),
						form_transient_pair('transient_tr_payment_pembayaran', tool_money_format($value['tr_payment_pembayaran']),$value['tr_payment_pembayaran'])
						
					);
				}
			}
			send_json(make_datatables_list($data));
		}
	
		function form($tr_plan_detail_shipment_id = 0)
		{
			$data = array();
			$this->load->model('global_model');
			$result = $this->tr_payment_model->read_id($tr_plan_detail_shipment_id);
			if($result){
				$data = $result;
				$data['row_id'] = $tr_plan_detail_shipment_id;
				
			}
				
			$this->load->helper('form');
			$this->render->add_form('app/tr_payment/form_detail', $data);
			$this->render->build('Registrasi');
			
			// List bayar
			$this->render->add_view('app/tr_payment/transient_list_bayar');
			$this->render->build('Data Sparepart');
			
			$this->render->add_form('app/tr_payment/form_detail_save', $data);
			$this->render->build('Registrasi');
						
			$this->render->show('Transaksi');
		}
		
		function form_action($is_delete = 0) // jika 0, berarti insert atau update, bila 1 berarti delete
		{
			$id = $this->input->post('row_id');
			
			if($is_delete){
				$is_proses_error = $this->tr_payment_model->delete($id);
				send_json_action($is_proses_error, "Data telah dihapus");
			}
			
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('row_id','Dari Lokasi', 'trim|required');
			$this->form_validation->set_rules('i_location','Ke Lokasi', 'trim|required');
			$this->form_validation->set_rules('i_verifikasi','Kode Verifikasi', 'trim|required');
			
			if($this->form_validation->run() == FALSE) send_json_validate();
			
			$kode_verifikasi  					= $this->input->post('i_verifikasi');
			$data['tr_plan_detail_shipment_id'] = $id;
			$data['broken_qty']  				= $this->input->post('i_broken_qty');
			$data['broken_total']  				= $this->input->post('i_broken_total');
			$data['broken_status'] 				= $this->input->post('i_status');
			
			$pass = md5($kode_verifikasi);
			$user_id = $this->access->user_id;
			$code = $this->tr_payment_model->read_code($user_id);
			if($pass != $code){
				send_json_error("Simpan gagal,kode verifikasi salah");
				}
			// simpan transient biaya Route
			$list_tr_payment_date  				= ($this->input->post('transient_tr_payment_date'));
			$list_tr_payment_pembayaran			= ($this->input->post('transient_tr_payment_pembayaran'));
			$list_tr_payment_description  		= ($this->input->post('transient_tr_payment_description'));
			
			
			$total_biaya = 0;
			$items = array();
			
			if($list_tr_payment_date){
				foreach($list_tr_payment_date as $key => $value)
				{
				$items[] = array(
						'tr_payment_date' 				=> $list_tr_payment_date[$key],
						'tr_payment_pembayaran'			=> $list_tr_payment_pembayaran[$key],
						'tr_payment_description' 		=> $list_tr_payment_description[$key],
				);
					$total_biaya += $list_tr_payment_pembayaran[$key];
				}		
			}
						
			//echo $items_biaya;
					
			if(empty($id)){
				$error = $this->route_model->create($data,$items);
				send_json_action($error, "Data telah ditambah", "Data gagal ditambah");
			}else{
				$error = $this->tr_payment_model->update($id,$data,$items,$total_biaya);
				send_json_action($error, "Data telah direvisi", "Data gagal direvisi");
			}
		}
			
			
			function detail_form($row_id = 0) // jika id tidak diisi maka dianggap create, else dianggap edit
			{
				$this->load->library('render');
				$index = $this->input->post('transient_index');
				if (strlen(trim($index)) == 0) {
					// TRANSIENT CREATE - isi form dengan nilai default / kosong
					$data['index'] = '';
					$data['tr_plan_detail_shipment_id'] = $row_id;
					$data['tr_payment_date'] = '';
					$data['tr_payment_description'] = '';
					$data['tr_payment_pembayaran'] = '';
				} else {
					$data['index'] = $index;
					$data['tr_payment_date'] = (array_shift($this->input->post('transient_tr_payment_date')))? array_shift($this->input->post('transient_tr_payment_date')) : date('d/m/Y');
					$data['tr_payment_description'] = array_shift($this->input->post('transient_tr_payment_description'));
					$data['tr_payment_pembayaran'] = array_shift($this->input->post('transient_tr_payment_pembayaran'));					
				}
				
					$this->load->helper('form');
					$this->render->add_form('app/tr_payment/transient_form', $data);
					$this->render->show_buffer();
			}
			
			
			function detail_form_action()
			{
				$this->load->library('form_validation');
				//$this->form_validation->set_rules('i_detail_registration_id', 'Harga', 'trim|required');
				$this->form_validation->set_rules('i_date', 'Tanggal', 'trim|required|valid_date|sql_date');
				$this->form_validation->set_rules('i_price', 'Progress', 'trim|required');
				$index = $this->input->post('i_index');
			// cek data berdasarkan kriteria
			if ($this->form_validation->run() == FALSE) send_json_validate();
				$no = $this->input->post('i_index');
				
				$tr_plan_detail_shipment_id = $this->input->post('row_id');
				$tr_payment_date = ($this->input->post('i_date'));
				$tr_payment_description = $this->input->post('i_description');
				$tr_payment_pembayaran	= $this->input->post('i_price');
				//send_json_error($no);
				$data = array(
						form_transient_pair('transient_tr_payment_date', format_new_date($tr_payment_date), $tr_payment_date),
						form_transient_pair('transient_tr_payment_description', $tr_payment_description, $tr_payment_description),
						form_transient_pair('transient_tr_payment_pembayaran', tool_money_format($tr_payment_pembayaran), $tr_payment_pembayaran)
					);
			send_json_transient($index, $data);
		}
			
	}
