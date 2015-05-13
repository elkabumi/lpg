<?php

class customer_model extends CI_Model{

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

		
		$columns['customer_nopol'] 		= 'customer_nopol';
		 
		
		$sort_column_index = $params['sort_column'];
		$sort_dir = $params['sort_dir'];
		
		$order_by_column[] = 'location_id';
		$order_by_column[] = 'customer_nopol';
		$order_by_column[] = 'customer_stnk';
		$order_by_column[] = 'customer_owner';
		$order_by_column[] = 'customer_color';
		$order_by_column[] = 'customer_manufacture_date';
		$order_by_column[] = 'customer_merk';
		$order_by_column[] = 'customer_type_id';
		$order_by_column[] = 'driver_id';
		$order_by_column[] = 'co_driver_id';
        
		$order_by = " order by ".$order_by_column[$sort_column_index] . $sort_dir;
		if (array_key_exists($category, $columns) && strlen($keyword) > 0) 
		{
			
				$where = " and ".$columns[$category]." like '%$keyword%'";
			
			
		}
		if ($limit > 0) {
			$limit = " limit $limit offset $offset";
		};	

		$sql = "
		select a.* 
		from locations a
		where location_category_id = '2'
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
				$row['location_id'], 
				$row['location_name'],
				$row['location_address'],
				$row['location_phone'],
				$row['location_rt_rw'],
				$row['location_kelurahan'],
				$row['location_kecamatan'],
				$row['location_kota']
				
			); 
		}
		
		// kembalikan nilai dalam format datatables_control
		return make_datatables_control($params, $data, $total);
	}
	
	function read_id($id){
		$this->db->select('*', 1);
		$this->db->where('customer_id', $id);
		$query = $this->db->get('customers', 1);
		$result = null;
		foreach($query->result_array() as $row)
		{
			$result = format_html($row);
		}
		return $result;
	}
	
	function create($data){
		$this->db->trans_start();
		$this->db->insert('customers', $data);
		$id = $this->db->insert_id();
		
		$data_market['market_id'] = $id;
		$data_market['market_code'] = $data['customer_code'];
		$data_market['market_name'] = $data['customer_name'];
		$this->db->insert('markets', $data_market);
		
		$this->access->log_insert($id, "Cabang [".$data['customer_name']."]");
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	function update($id, $data){
		$this->db->trans_start();
		$this->db->where('customer_id', $id);
		$this->db->update('customers', $data);
		
		$data_market['market_code'] = $data['customer_code'];
		$data_market['market_name'] = $data['customer_name'];
		
		$this->db->where('market_id', $id);
		$this->db->update('markets', $data_market);
		
		$this->access->log_update($id, "Cabang[".$data['customer_name']."]");
		
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	function delete($id){
		$this->db->trans_start();
		$this->db->where('customer_id', $id);
		$this->db->delete('customers');
		
		$this->db->where('market_id', $id);
		$this->db->delete('markets');
		
		$this->access->log_delete($id, 'customer');
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	
	
	
}