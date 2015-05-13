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

		
		$columns['supplier_nopol'] 		= 'supplier_nopol';
		 
		
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
		select a.*,(select location_name from locations z where z.location_id = a.location_from_id) as asal,(select location_name from locations z where z.location_id = a.location_to_id) as keluar
		from routes a
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
				$row['asal'],
				$row['keluar'],
				$row['location_total_cost'],
				$row['location_desc']
			); 
		}
		
		// kembalikan nilai dalam format datatables_control
		return make_datatables_control($params, $data, $total);
	}
	
	function read_id($id){
		$this->db->select('*', 1);
		$this->db->where('supplier_id', $id);
		$query = $this->db->get('suppliers', 1);
		$result = null;
		foreach($query->result_array() as $row)
		{
			$result = format_html($row);
		}
		return $result;
	}
	
	function create($data){
		$this->db->trans_start();
		$this->db->insert('suppliers', $data);
		$id = $this->db->insert_id();
		
		$data_market['market_id'] = $id;
		$data_market['market_code'] = $data['supplier_code'];
		$data_market['market_name'] = $data['supplier_name'];
		$this->db->insert('markets', $data_market);
		
		$this->access->log_insert($id, "Cabang [".$data['supplier_name']."]");
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	function update($id, $data){
		$this->db->trans_start();
		$this->db->where('supplier_id', $id);
		$this->db->update('suppliers', $data);
		
		$data_market['market_code'] = $data['supplier_code'];
		$data_market['market_name'] = $data['supplier_name'];
		
		$this->db->where('market_id', $id);
		$this->db->update('markets', $data_market);
		
		$this->access->log_update($id, "Cabang[".$data['supplier_name']."]");
		
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	function delete($id){
		$this->db->trans_start();
		$this->db->where('supplier_id', $id);
		$this->db->delete('suppliers');
		
		$this->db->where('market_id', $id);
		$this->db->delete('markets');
		
		$this->access->log_delete($id, 'supplier');
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	
	
	
}