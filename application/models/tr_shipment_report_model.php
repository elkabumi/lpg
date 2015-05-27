<?php

class Tr_shipment_report_model extends CI_Model{
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
		$this->db->select('a.*,b.*,c.location_name AS route_from,d.location_name AS route_to', 1);
		$this->db->from('tr_plan_detail_shipments a');
		$this->db->join('routes b', 'b.route_id = a.route_id');
		$this->db->join('locations c', 'c.location_id = b.location_from_id');
		$this->db->join('locations d', 'd.location_id = b.location_to_id');
		$this->db->where('a.tr_plan_detail_shipment_id', $id);
		$query = $this->db->get(); debug();
		$result = null;
		foreach($query->result_array() as $row)
		{
			$result = format_html($row);
		}
		return $result;
	}
	function create($data,$items_plan_detail){

		$this->access->log_insert(1, "Realisasi Shipment [".$data['tr_plan_date']."]");
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	function update($id,$data){
		$this->db->trans_start();
		$this->db->where('tr_plan_detail_shipment_id', $id);
		$this->db->update('tr_plan_detail_shipments', $data);
		//query();
		
		$this->access->log_update($id, "Realisasi Shipment [".$id."]");
		
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
	function detail_table_loader_shipment($date)
	{
		// buat array kosong
		$result = array(); 		
		$this->db->select('a.*,b.*,c.location_name AS route_from,
						d.location_name AS route_to,
						g.*,j.*,k.location_name AS spbe', 1);
		$this->db->from('tr_plan_detail_shipments a');
		$this->db->join('routes b', 'b.route_id = a.route_id');
		$this->db->join('locations c', 'c.location_id = b.location_from_id');
		$this->db->join('locations d', 'd.location_id = b.location_to_id');
		$this->db->join('tr_plan_details g', 'a.tr_plan_detail_id = g.tr_plan_detail_id');
		$this->db->join('tr_plan_purchases h', 'g.tr_plan_purchase_id = h.tr_plan_purchase_id');
		$this->db->join('tr_plans i', 'i.tr_plan_id = h.tr_plan_id');
		$this->db->join('trucks j', 'g.truck_id = j.truck_id');
		$this->db->join('locations k', 'g.location_id = k.location_id');
		$this->db->where('a.tr_plan_detail_shipment_realization_date', $date);
		$this->db->where('g.tr_plan_detail_status_realization', 1);
		$query = $this->db->get(); debug();
		//query();
		foreach($query->result_array() as $row)
		{
			$result[] = format_html($row);
		}
		return $result;
	}
	
	
	
}