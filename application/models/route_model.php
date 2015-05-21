<?php

class Route_model extends CI_Model{

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

		
		$columns['location_from'] 		= 'b.location_name';
		$columns['location_to'] 		= 'c.location_name';
		$columns['location_total_cost'] = 'location_total_cost';
		$columns['location_desc'] 		= 'location_desc';
		 
		
		$sort_column_index = $params['sort_column'];
		$sort_dir = $params['sort_dir'];
		
		$order_by_column[] = 'route_id';
		$order_by_column[] = 'location_from_id';
		$order_by_column[] = 'location_to_id';
		$order_by_column[] = 'location_total_cost';
		$order_by_column[] = 'location_desc';
        
		$order_by = " order by ".$order_by_column[$sort_column_index] . $sort_dir;
		if (array_key_exists($category, $columns) && strlen($keyword) > 0) 
		{
			
				$where = " and ".$columns[$category]." like '%$keyword%'";
			
			
		}
		if ($limit > 0) {
			$limit = " limit $limit offset $offset";
		};	

		$sql = "
		select a.*,
			b.location_name as location_from_name,
			c.location_name as location_to_name
		from routes a
		join locations b on b.location_id = a.location_from_id
		join locations c on c.location_id = a.location_to_id
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
			$data[] = array(
				$row['route_id'], 
				$row['location_from_name'],
				$row['location_to_name'],
				$row['location_total_cost'],
				$row['location_desc']
			); 
		}
		
		// kembalikan nilai dalam format datatables_control
		return make_datatables_control($params, $data, $total);
	}
	
	function read_id($id){
		$this->db->select('*', 1);
		$this->db->where('route_id', $id);
		$query = $this->db->get('routes', 1);
		$result = null;
		foreach($query->result_array() as $row)
		{
			$result = format_html($row);
		}
		return $result;
	}
	
	function create($data,$item_biaya){
		$this->db->trans_start();
		$this->db->insert('routes', $data);
		$id = $this->db->insert_id();
		
		// Detail Biaya Route
		$index = 0;
		foreach($item_biaya as $row)
		{			
			$row['route_id'] = $id;
			$this->db->insert('route_details', $row);
			$index++;
		}
		/*
		$data_market['market_id'] = $id;
		$data_market['market_code'] = $data['supplier_code'];
		$data_market['market_name'] = $data['supplier_name'];
		$this->db->insert('markets', $data_market);
		*/
		
		$this->access->log_insert($id, "Route [".$id."]");
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	function update($id, $data,$item_biaya){
		$this->db->trans_start();
		$this->db->where('route_id', $id);
		$this->db->update('routes', $data);
		/*
		$data_market['market_code'] = $data['supplier_code'];
		$data_market['market_name'] = $data['supplier_name'];
		
		$this->db->where('market_id', $id);
		$this->db->update('markets', $data_market);
		*/
		
		
		// DELETE Detail Biaya Route
		$this->db->where('route_id', $id);
		$this->db->delete('route_details');
		
		$index = 0;
		foreach($item_biaya as $row)
		{			
			$row['route_id'] = $id;
			$this->db->insert('route_details', $row);
			$index++;
		}
		
		$this->access->log_update($id, "Route[".$id."]");
		
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	function delete($id){
		$this->db->trans_start();
		$this->db->where('route_id', $id);
		$this->db->delete('routes');
		
		// Detail Biaya Route
		$this->db->where('route_id', $id);
		$this->db->delete('route_details');
		/*
		$this->db->where('market_id', $id);
		$this->db->delete('markets');
		*/
		$this->access->log_delete($id, 'route');
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	
	function detail_list_loader($id)
	{
		// buat array kosong
		$result = array(); 		
		$this->db->select('*', 1);
		$this->db->from('route_details');
		$this->db->where('route_id', $id);
		$this->db->order_by('route_detail_id asc');
		//$this->db->group_by('e.transaction_id');
		$query = $this->db->get(); debug();
		//query();
		
		foreach($query->result_array() as $row)
		{
			$result[] = format_html($row);
		}
		return $result;
	}
	function cek_route($from_id,$to_id)
	{
		$sql = "select COUNT(route_id) AS id
				FROM routes
				WHERE location_from_id = '$from_id' AND location_to_id = '$to_id'
				";
		
		$query = $this->db->query($sql);
		
		$result = null;
		foreach ($query->result_array() as $row) $result = format_html($row);
		return $result['id'];
	}
	
	
}