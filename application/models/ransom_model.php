<?php

class Ransom_model extends CI_Model{
	var $trans_type = 5;
	var $insert_id = NULL;
	var $insert_id2 = NULL;
	
	function __construct(){
		
	}
	function list_controller()
	{		
		$where = '';
		$params 	= get_datatables_control();
		$limit 		= $params['limit'];
		$offset 	= $params['offset'];
		$category 	= $params['category'];
		$keyword 	= $params['keyword'];
		
		// map value dari combobox ke table
		// daftar kolom yang valid
		
		$columns['tanggal'] = 'tr_plan_date';
		$columns['kulak']	= 'tr_plan_total_order';
		
		$sort_column_index = $params['sort_column'];
		$sort_dir = $params['sort_dir'];
		
		$order_by_column[] = 'tr_plan_id';
		$order_by_column[] = 'tr_plan_date';
		//$order_by_column[] = 'tr_plan_id';
		//$order_by_column[] = 'tr_plan_total_order';
		//$order_by_column[] = 'tr_plan_id';
		
		$order_by = " order by ".$order_by_column[$sort_column_index] . $sort_dir;
		if (array_key_exists($category, $columns) && strlen($keyword) > 0) 
		{
			
				$where = " WHERE ".$columns[$category]." like '%$keyword%'";
			
			
		}
		if ($limit > 0) {
			$limit = " limit $limit offset $offset";
		};	

		$sql = "
		select * 
		from tr_plans
		$where  $order_by
			
			";

		$query_total = $this->db->query($sql);
		$total = $query_total->num_rows();
		
		$sql = $sql.$limit;
		
		$query = $this->db->query($sql);
		//query();
		
		$data = array(); // inisialisasi variabel. biasakanlah, untuk mencegah warning dari php.
		foreach($query->result_array() as $row) {
			$row = format_html($row);
			$plan_date = format_new_date($row['tr_plan_date']);
			//$get_jumlah_kulak= $this->get_jumlah_kulak($row['tr_plan_id']);
			//$get_total_kirim = $this->get_total_kirim($row['tr_plan_id']);
			$link = "<a href=".site_url('ransom/form/'.$row['tr_plan_id'])." class='link_input'> Detail </a>";
			$data[] = array(
				$row['tr_plan_id'], 
				$plan_date,
				//$row['tr_plan_total_order	'],
				//$row['tr_plan_total_order'],
				//$get_total_kirim,
				$link
				
			); 
		}
		
		// kembalikan nilai dalam format datatables_control
		return make_datatables_control($params, $data, $total);
	}
	
	function read_id($id){
		$this->db->select('*', 1);
		$this->db->where('tr_plan_id', $id);
		$query = $this->db->get('tr_plans', 1);
		$result = null;
		foreach($query->result_array() as $row)
		{
			$result = format_html($row);
		}
		return $result;
	}
	function read_plan_id($id){
		$this->db->select('a.*,b.truck_nopol,c.employee_name AS driver_name,d.employee_name AS co_driver_name
					, e.location_name', 1);
		$this->db->join('trucks b', 'b.truck_id = a.truck_id');
		$this->db->join('employees c', 'c.employee_id = a.driver_id');
		$this->db->join('employees d', 'd.employee_id = a.co_driver_id');
		$this->db->join('locations e', 'e.location_id = a.location_id');
		$query = $this->db->get('tr_plan_details a', 1);
		$result = null;
		foreach($query->result_array() as $row)
		{
			$result = format_html($row);
		}
		return $result;
	}
	function create($data,$items_purchase){
		$this->db->trans_start();
		$this->db->insert('tr_plans', $data);
		$id = $this->db->insert_id();
		
		// Detail Biaya Route
		$index = 0;
		foreach($items_purchase as $row)
		{		
			
			$date_purchase = explode("/", $row['tr_plan_purchase_date']);
			$date_purchase_month  = 	$date_purchase['1'];
			$date_purchase_year   = 	$date_purchase['0'];	
			$start_nomer_urut =$this->get_start_nomer($date_purchase_year,$date_purchase_month);
			if($start_nomer_urut == ''){
				$start_nomer_urut =1;
			}else{
				$start_nomer_urut +=1;
			}
			$row['tr_plan_id'] = $id;
			$this->db->insert('tr_plan_purchases', $row);
			$id_purchase = $this->db->insert_id();
			$cost =$this->get_cost();
			
			for($i=1; $i<= $row['tr_plan_purchase_qty']; $i++){
				
				
				$row_detail['tr_plan_purchase_id'] = $id_purchase;
				$row_detail['tr_plan_detail_no'] = $start_nomer_urut;
				$row_detail['location_id'] = $row['location_id'];
				$row_detail['tr_plan_detail_date_realization'] = '';//$data['tr_plan_date'];
				$row_detail['tr_plan_detail_qty']			 = 560;
				$row_detail['tr_plan_detail_purchase'] 		 =$cost[0];
				$row_detail['tr_plan_detail_total_purchase']=$cost[0] * 560;
				$row_detail['tr_plan_detail_cost_driver'] 	 =$cost[1];
				$row_detail['tr_plan_detail_cost_co_driver'] =$cost[2];
				$this->db->insert('tr_plan_details', $row_detail);	
				$start_nomer_urut++;
			}
			$index++;
		}
		/*
		$data_market['market_id'] = $id;
		$data_market['market_code'] = $data['supplier_code'];
		$data_market['market_name'] = $data['supplier_name'];
		$this->db->insert('markets', $data_market);
		
		*/
		$this->access->log_insert($id, "Tebusan [".$id."]");
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	function update($id,$data,$items_purchase){
		$this->db->trans_start();
		$this->db->where('tr_plan_id', $id);
		$this->db->update('tr_plans', $data);
		
		// Detail Biaya Route
		$this->db->where('tr_plan_id', $id);
		$this->db->delete('tr_plan_purchases');
		$index = 0;
		foreach($items_purchase as $row)
		{		
		
			$row['tr_plan_id'] = $id;
			$this->db->insert('tr_plan_purchases', $row);
			$id_purchase = $this->db->insert_id();
			if($row['tr_plan_purchase_id'] == ''){
				$cost =$this->get_cost();
				for($i=1; $i<= $row['tr_plan_purchase_qty']; $i++){
					$row_detail['tr_plan_purchase_id'] = $id_purchase;
					$row_detail['location_id'] = $row['location_id'];
					$row_detail['tr_plan_detail_qty']			 = 560;
					$row_detail['tr_plan_detail_purchase'] 		 =$cost[0];
					$row_detail['tr_plan_detail_total_purchase']=$cost[0] * 560;
					$row_detail['tr_plan_detail_cost_driver'] 	 =$cost[1];
					$row_detail['tr_plan_detail_cost_co_driver'] =$cost[2];
					$this->db->insert('tr_plan_details', $row_detail);	
				}
			}
			$index++;
		}
		$this->access->log_update($id, "Tebusan [".$id."]");
		
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	function delete($id){
		$this->db->trans_start();
		$this->db->where('tr_plan_id', $id);
		$this->db->delete('tr_plans');
		
		$this->access->log_delete($id, "Pegawai");
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	function detail_list_loader($id)
	{
		// buat array kosong
		$result = array(); 		
		$this->db->select('a.*,b.*,c.*', 1);
		$this->db->from('tr_plans a');
		$this->db->join('tr_plan_purchases b', 'b.tr_plan_id = a.tr_plan_id');
		$this->db->join('locations c', 'c.location_id = b.location_id');
		
		$this->db->where('a.tr_plan_id', $id);
		$query = $this->db->get(); debug();
		//query();
		foreach($query->result_array() as $row)
		{
			$result[] = format_html($row);
		}
		return $result;
	}
	function get_start_nomer($year,$month)
	{
		$sql = "SELECT MAX(c.tr_plan_detail_no) AS no_urut
			 	FROM tr_plans a
				JOIN tr_plan_purchases b ON a.tr_plan_id = b.tr_plan_id
				JOIN tr_plan_details c ON c.tr_plan_purchase_id  = b.tr_plan_purchase_id
			WHERE YEAR(tr_plan_purchase_date) = ".$year." AND MONTH(tr_plan_purchase_date) = ".$month."
			";
		
		$query = $this->db->query($sql);
		
		$result = null;
		foreach ($query->result_array() as $row) $result = format_html($row);
		return $result['no_urut'];
	}
	function load_data_spbe($id)
	{
		$sql = "
		select *
		FROM locations
		WHERE location_id = $id";
		$query = $this->db->query($sql);
		//query();
		return $query;
	}
	function get_data_spbe($id)
	{
		$sql = "
		select *
		FROM locations
		WHERE location_id = $id";
		$query = $this->db->query($sql);
		
		$result = null;
		foreach ($query->result_array() as $row) $result = format_html($row);
		return $result['location_name'];
	}
	
	function get_cost()
	{
		$sql = "select *
				from cost
				";
		
		$query = $this->db->query($sql);
		
		$result = null;
		foreach ($query->result_array() as $row) $result = format_html($row);
		return array($result['cost_purchase'], $result['cost_driver'], $result['cost_co_driver']);
	}
	function cek_date($date,$id=0)
	{
		if($id){
			$where ='AND tr_plan_id <> '.$id.'';
		}else{
			$where ='';
		}
		$sql = "select COUNT(tr_plan_id) AS id
				FROM tr_plans
				WHERE 	tr_plan_date = '$date' $where
				";
		
		$query = $this->db->query($sql);
		//query();
		$result = null;
		foreach ($query->result_array() as $row) $result = format_html($row);
		return $result['id'];
	}

	function get_total_tebusan($id)
	{
		$sql = "
		select sum(tr_plan_purchase_qty) as jumlah
		FROM tr_plan_purchases
		WHERE tr_plan_id = $id";
		$query = $this->db->query($sql);
		
		$result = null;
		foreach ($query->result_array() as $row) $result = format_html($row);
		return $result['jumlah'];
	}
}