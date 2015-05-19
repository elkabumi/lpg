<?php

class Tr_plan_model extends CI_Model{

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
		$columns['total'] 	= 'tr_plan_qty';
		$columns['kulak']	= 'tr_plan_total_order';
		$columns['kirim']	= 'tr_plan_total_shipment';
		
		$sort_column_index = $params['sort_column'];
		$sort_dir = $params['sort_dir'];
		
		$order_by_column[] = 'tr_plan_id';
		$order_by_column[] = 'tr_plan_date';
		$order_by_column[] = 'tr_plan_qty';
		$order_by_column[] = 'tr_plan_total_order';
		$order_by_column[] = 'tr_plan_total_shipment';
		
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
			$link = "<a href=".site_url('transaction/form/'.$row['tr_plan_id'])." class='link_input'> Detail </a>";
		
			$data[] = array(
				$row['tr_plan_id'], 
				$plan_date,
				$row['tr_plan_qty'],
				tool_money_format($row['tr_plan_total_order']),
				tool_money_format($row['tr_plan_total_shipment']),
				$link
				
			); 
		}
		
		// kembalikan nilai dalam format datatables_control
		return make_datatables_control($params, $data, $total);
	}
	
	function read_id($id){
		$this->db->select('*', 1);
		$this->db->where('employee_id', $id);
		$query = $this->db->get('employees', 1);
		$result = null;
		foreach($query->result_array() as $row)
		{
			$result = format_html($row);
		}
		return $result;
	}
	
	function create($data){
		$this->db->trans_start();
		$this->db->insert('employees', $data);
		$id = $this->db->insert_id();
		$this->access->log_insert($id, "Pegawai [".$data['employee_name']."]");
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	function update($id, $data){
		$this->db->trans_start();
		$this->db->where('employee_id', $id);
		$this->db->update('employees', $data);
		$this->access->log_update($id, "Pegawai[".$data['employee_name']."]");
		
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	function delete($id){
		$this->db->trans_start();
		/*$this->db->where('employee_id', $id);
		$this->db->delete('employees');
		*/
		$data['employee_active_status'] = 0;
		$this->db->where('employee_id', $id);
		$this->db->update('employees', $data);
		
		$this->access->log_delete($id, "Pegawai");
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	
	
	
}