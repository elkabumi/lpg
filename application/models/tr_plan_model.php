<?php

class Tr_plan_model extends CI_Model{
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
		$order_by_column[] = 'tr_plan_id';
		$order_by_column[] = 'tr_plan_total_order';
		$order_by_column[] = 'tr_plan_id';
		
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
			$get_jumlah_kulak= $this->get_jumlah_kulak($row['tr_plan_id']);
			$get_total_kirim = $this->get_total_kirim($row['tr_plan_id']);
			$link = "<a href=".site_url('tr_plan/form/'.$row['tr_plan_id'])." class='link_input'> Detail </a>";
			$data[] = array(
				$row['tr_plan_id'], 
				$plan_date,
				$get_jumlah_kulak,
				$row['tr_plan_total_order'],
				$get_total_kirim,
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
		$this->db->where('tr_plan_detail_id', $id);
		$query = $this->db->get('tr_plan_details a', 1);
		$result = null;
		foreach($query->result_array() as $row)
		{
			$result = format_html($row);
		}
		return $result;
	}
	function create($data,$items_plan_detail){
		$this->db->trans_start();
		$this->db->insert('tr_plans', $data);
		$id = $this->db->insert_id();
		
		// Detail Biaya Route
		$index = 0;
		foreach($items_plan_detail as $row)
		{		
			$row['tr_plan_id'] = $id;
			$this->db->insert('tr_plan_details', $row);
			$index++;
		}
		/*
		$data_market['market_id'] = $id;
		$data_market['market_code'] = $data['supplier_code'];
		$data_market['market_name'] = $data['supplier_name'];
		$this->db->insert('markets', $data_market);
		*/
		
		$this->access->log_insert($id, "Plan [".$id."]");
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	function update($id, $data,$items_plan_detail){
		$this->db->trans_start();
		$this->db->where('tr_plan_id', $id);
		$this->db->update('tr_plans', $data);
		
		$this->db->where('tr_plan_id', $id);
		$this->db->delete('tr_plan_details');
		
		
		$index = 0;
		foreach($items_plan_detail as $row)
		{			
			$row['tr_plan_id'] = $id;
		
				$this->db->insert('tr_plan_details', $row);
			
			
			$index++;
		}
		
		$this->access->log_update($id, "Plan [".$id."]");
		
		$this->db->trans_complete();
		return $this->db->trans_status();
	
	}
	
	
	///create shipments
	function create_plan($data,$items_shipment){
		$this->db->trans_start();
		$this->db->insert('tr_plan_details', $data);
		$id = $this->db->insert_id();
		
		// Detail Biaya Route
		$index = 0;
		foreach($items_shipment as $row)
		{		
			$row['tr_plan_detail_id'] = $id;
			$this->db->insert('tr_plan_detail_shipments', $row);
			$index++;
		}
		/*
		$data_market['market_id'] = $id;
		$data_market['market_code'] = $data['supplier_code'];
		$data_market['market_name'] = $data['supplier_name'];
		$this->db->insert('markets', $data_market);
		*/
		
		$this->access->log_insert($id, "Detail Plan [".$id."]");
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	function update_plan($id, $data,$items_shipment){
		$this->db->trans_start();
		$this->db->where('tr_plan_detail_id', $id);
		$this->db->update('tr_plan_details', $data);
		/*
		$data_market['market_code'] = $data['supplier_code'];
		$data_market['market_name'] = $data['supplier_name'];
		
		$this->db->where('market_id', $id);
		$this->db->update('markets', $data_market);
		*/
		
		$this->db->where('tr_plan_detail_id', $id);
		$this->db->delete('tr_plan_detail_shipments');
		
		
		$index = 0;
		foreach($items_shipment as $row)
		{			
				$row['tr_plan_detail_id'] = $id;
				$this->db->insert('tr_plan_detail_shipments', $row);
			$index++;
		}
		
		
		
		$this->access->log_update($id, "Plan [".$id."]");
		
		$this->db->trans_complete();
		return $this->db->trans_status();
	
	}
	
	function delete($id){
		$this->db->trans_start();
		/*$this->db->where('employee_id', $id);
		$this->db->delete('employees');
		*/
		//$data['employee_active_status'] = 0;
		$this->db->where('tr_plan_id', $id);
		$this->db->delete('tr_plans');
		
		$this->access->log_delete($id, "Pegawai");
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	function detail_list_loader_kulak($id)
	{
		// buat array kosong
		$result = array(); 		
		$this->db->select('a.*,b.truck_nopol,c.employee_name AS driver_name,d.employee_name AS co_driver_name
					, e.location_name', 1);
		$this->db->from('tr_plan_details a');
		$this->db->join('trucks b', 'b.truck_id = a.truck_id');
		$this->db->join('employees c', 'c.employee_id = a.driver_id');
		$this->db->join('employees d', 'd.employee_id = a.co_driver_id');
		$this->db->join('locations e', 'e.location_id = a.location_id');
		
		$this->db->where('a.tr_plan_id', $id);
		$query = $this->db->get(); debug();
		//query();
		foreach($query->result_array() as $row)
		{
			$result[] = format_html($row);
		}
		return $result;
	}
	function detail_list_loader_shipment($id)
	{
		// buat array kosong
		$result = array(); 		
		$this->db->select('a.*,b.*,c.location_name AS route_from,d.location_name AS route_to', 1);
		$this->db->from('tr_plan_detail_shipments a');
		$this->db->join('routes b', 'b.route_id = a.route_id');
		$this->db->join('locations c', 'c.location_id = b.location_from_id');
		$this->db->join('locations d', 'd.location_id = b.location_to_id');
		$this->db->where('a.tr_plan_detail_id', $id);
		$query = $this->db->get(); debug();
		//query();
		foreach($query->result_array() as $row)
		{
			$result[] = format_html($row);
		}
		return $result;
	}
	function load_data_truck($id)
	{
		$sql = "
		select a.*,
				b.employee_id AS driver_id,
				c.employee_id AS co_driver_id,
				b.employee_name AS driver_name,
				c.employee_name AS co_driver_name
		FROM trucks a
		JOIN employees b ON b.employee_id = a.driver_id 
		JOIN employees c ON c.employee_id = a.co_driver_id 
		WHERE a.truck_id = $id";
		$query = $this->db->query($sql);
		//query();
		return $query;
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
	function load_data_route($id)
	{
		$sql = "
		select a.*,
			b.location_name as location_from_name,
			c.location_name as location_to_name,
			c.location_price as harga
		from routes a
		join locations b on b.location_id = a.location_from_id
		join locations c on c.location_id = a.location_to_id
		WHERE a.route_id = $id";
		$query = $this->db->query($sql);
		//query();
		return $query;
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
	function get_total_kulak($id)
	{
		$sql = "select tr_plan_detail_qty
				from tr_plan_details
				WHERE tr_plan_detail_id = $id
				";
		
		$query = $this->db->query($sql);
		
		$result = null;
		foreach ($query->result_array() as $row) $result = format_html($row);
		return $result['tr_plan_detail_qty'];
	}

	function get_jumlah_kulak($id)
	{
		$sql = "SELECT COUNT(tr_plan_detail_qty) as id
				FROM tr_plan_details
				WHERE tr_plan_id = $id
				";
		
		$query = $this->db->query($sql);
		
		$result = null;
		foreach ($query->result_array() as $row) $result = format_html($row);
		return $result['id'];
	}
	function get_total_kirim($id)
	{
		$sql = "SELECT SUM(c.tr_plan_detail_shipment_qty) AS kirim
				FROM tr_plans a
				JOIN tr_plan_details b ON b.tr_plan_id = a.tr_plan_id
				JOIN tr_plan_detail_shipments c ON c.tr_plan_detail_id = c.tr_plan_detail_id
				WHERE a.tr_plan_id = $id
				";
		
		$query = $this->db->query($sql);
		
		$result = null;
		foreach ($query->result_array() as $row) $result = format_html($row);
		return $result['kirim'];
	}
	function cek_date($date)
	{
		$sql = "select COUNT(tr_plan_id) AS id
				FROM tr_plans
				WHERE 	tr_plan_date = '$date'
				";
		
		$query = $this->db->query($sql);
		
		$result = null;
		foreach ($query->result_array() as $row) $result = format_html($row);
		return $result['id'];
	}
	
	
}