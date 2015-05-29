<?php

class Tr_cost_model extends CI_Model{

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

		
		$columns['tr_cost_date'] 		= 'tr_cost_date';
		$columns['tr_cost_type_name'] 	= 'tr_cost_type_name'; 
		$columns['tr_cost_price'] 		= 'tr_cost_price';
		$columns['tr_cost_desc'] 		= 'tr_cost_desc'; 

		

		$sort_column_index = $params['sort_column'];
		$sort_dir = $params['sort_dir'];
		
		$order_by_column[] = 'tr_cost_id';
		$order_by_column[] = 'tr_cost_date';
		$order_by_column[] = 'tr_cost_type_name';
		$order_by_column[] = 'tr_cost_price';
		$order_by_column[] = 'tr_cost_desc';
		
		$order_by = " order by ".$order_by_column[$sort_column_index] . $sort_dir;
		if (array_key_exists($category, $columns) && strlen($keyword) > 0) 
		{
			
				$where = " where ".$columns[$category]." like '%$keyword%'";
			
			
		}
		if ($limit > 0) {
			$limit = " limit $limit offset $offset";
		};	

		$sql = "
		select a.*,b.tr_cost_type_name
		from tr_costs a
		join tr_cost_types b on b.tr_cost_type_id = a.tr_cost_type_id	
		 $where   $order_by
			
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
				$row['tr_cost_id'], 
				$row['tr_cost_date'],
				$row['tr_cost_type_name'],
				$row['tr_cost_price'],
				$row['tr_cost_desc'],
			); 
		}
		
		// kembalikan nilai dalam format datatables_control
		return make_datatables_control($params, $data, $total);
	}
	
	function read_id($id){
		$this->db->select('*', 1);
		$this->db->where('tr_cost_id', $id);
		$query = $this->db->get('tr_costs', 1);
		$result = null;
		foreach($query->result_array() as $row)
		{
			$result = format_html($row);
		}
		return $result;
	}
	
	function create($data){
		$this->db->trans_start();
		$this->db->insert('tr_costs', $data);
		$id = $this->db->insert_id();
		/*
		$data_market['market_id'] = $id;
		$data_market['market_code'] = $data['truck_code'];
		$data_market['market_name'] = $data['truck_name'];
		$this->db->insert('markets', $data_market);
		*/
		$this->access->log_insert($id, "Biaya [".$id."]");
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	function update($id, $data){
		$this->db->trans_start();
		$this->db->where('tr_cost_id', $id);
		$this->db->update('tr_costs', $data);
	
		/*
		$data_market['market_code'] = $data['truck_code'];
		$data_market['market_name'] = $data['truck_name'];
		
		$this->db->where('market_id', $id);
		$this->db->update('markets', $data_market);
		*/
		$this->access->log_update($id, "Biaya[".$id."]");
		
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	function delete($id){
		$this->db->trans_start();

		$this->db->where('tr_cost_id', $id);
		$this->db->delete('tr_costs');
		/*
		$this->db->where('market_id', $id);
		$this->db->delete('markets');
		*/
		$this->access->log_delete($id, 'truck');
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	
	
	
}