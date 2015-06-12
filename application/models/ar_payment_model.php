<?php

class ar_payment_model extends CI_Model{

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
		
		$columns['tanggal'] 	= 'tr_plan_detail_shipment_realization_date';
		$columns['pangkalan'] 	= 'location_name';
		
		$sort_column_index = $params['sort_column'];
		$sort_dir = $params['sort_dir'];
		
		$order_by_column[] = 'tr_plan_detail_shipment_id';
		$order_by_column[] = 'tr_plan_detail_shipment_realization_date';
		$order_by_column[] = 'location_name';
		$order_by_column[] = 'tr_plan_detail_shipment_qty';
		$order_by_column[] = 'tr_plan_detail_shipment_total_price';
		$order_by_column[] = 'tr_plan_detail_shipment_total_paid';
		
		$order_by = " order by ".$order_by_column[$sort_column_index] . $sort_dir;
		if (array_key_exists($category, $columns) && strlen($keyword) > 0) 
		{
			
				$where = " AND ".$columns[$category]." like '%$keyword%'";
			
			
		}
		if ($limit > 0) {
			$limit = " limit $limit offset $offset";
		};
		
		$selisih = -4;
		 $total = 0;
		 for($i=0; $i>=$selisih; $i--){
		 $x = mktime (0 ,0 ,0 ,date("m") , date("d") +$i, date("y"));
		 $nama_hari= date("l", $x);
		 $tg= date("Y-m-d", $x);
			 if($nama_hari == "Sunday"){
					$total-1;
				 }else{
					 $total++;
					 }
			if($total == 4){
				$output = $tg;
				}
				 
		 }	

		$sql = "
		select a.* , d.location_name
		from tr_plan_detail_shipments a
		left join routes c on a.route_id = c.route_id
		left join locations d on c.location_to_id = d.location_id
 		where tr_plan_detail_shipment_realization_date <= '$output' and tr_plan_detail_shipment_status_id = 0 and tr_plan_detail_shipment_status_realization = 1 $where  $order_by
			
			";

		$query_total = $this->db->query($sql);
		
		$total = $query_total->num_rows();
		
		$sql = $sql.$limit;
		
		$query = $this->db->query($sql);
		//query();
		
		$data = array(); // inisialisasi variabel. biasakanlah, untuk mencegah warning dari php.
		foreach($query->result_array() as $row) {
			$row = format_html($row);
			$realisasi_date = format_new_date($row['tr_plan_detail_shipment_realization_date']);
			$link = "<a href=".site_url('ar_payment/form/'.$row['tr_plan_detail_shipment_id'])." class='link_input'> Bayar </a>";
		
			$data[] = array(
				$row['tr_plan_detail_shipment_id'], 
				$realisasi_date,
				$row['location_name'],
				$row['tr_plan_detail_shipment_qty'], 
				tool_money_format($row['tr_plan_detail_shipment_total_price']),
				tool_money_format($row['tr_plan_detail_shipment_total_paid']),
				$link
				
			); 
		}
		
		// kembalikan nilai dalam format datatables_control
		return make_datatables_control($params, $data, $total);
	}
	
	function read_id($id){
		$this->db->select('a.*,b.*,d.*,e.*', 1);
		$this->db->where('a.tr_plan_detail_shipment_id', $id);
		$this->db->join('tr_payments b','b.tr_plan_detail_shipment_id = a.tr_plan_detail_shipment_id','left');
		$this->db->join('routes c','a.route_id = c.route_id','left');
		$this->db->join('locations d','c.location_to_id = d.location_id','left');
		$this->db->join('brokens e','e.tr_plan_detail_shipment_id = a.tr_plan_detail_shipment_id','left');
		$query = $this->db->get('tr_plan_detail_shipments a', 1);
		$result = null;
		//query($query);
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
	
	function update($id,$data,$items,$total){
		$this->db->trans_start();
		
		$id_update = $data['tr_plan_detail_shipment_id'];
		
		//hapus broken 
		$this->db->where('tr_plan_detail_shipment_id', $id_update);
		$this->db->delete('brokens');
		
		//insert broken
		$this->db->insert('brokens', $data);
		$id = $this->db->insert_id();
		
		//hapus history 
		$this->db->where('tr_plan_detail_shipment_id', $id_update);
		$this->db->delete('tr_payments');
		
		//insert history payment
		$index = 0;
		foreach($items as $row)
		{	
			$row['tr_plan_detail_shipment_id'] = $id_update;		
			$this->db->insert('tr_payments', $row);
			$index++;
		}
		
		//update tr_plan_detail_shipments
		$bayar = $this->read_bayar($id_update);
		
		if($bayar != $total){
			$status = 0;
			}else{
			$status = 1;	
		}
		
		$sql = "update tr_plan_detail_shipments set tr_plan_detail_shipment_total_paid = $total,tr_plan_detail_shipment_status_id = $status where tr_plan_detail_shipment_id = $id_update";
		$query = $this->db->query($sql);
		//query($query);
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
	
	function detail_list_loader($date_1)
	{
		// buat array kosong
		$result = array(); 	
		if($date_1 != 0){
			$where = "WHERE a.tr_plan_detail_shipment_realization_date = '".$date_1."' AND a.tr_plan_detail_shipment_status_id = 0 and tr_plan_detail_shipment_status_realization = 1";
		}else{
			$where = '';
		}
		$sql = "
		select a.* , d.location_name
		from tr_plan_detail_shipments a
		left join routes c on a.route_id = c.route_id
		left join locations d on c.location_to_id = d.location_id
		".$where."";
		
		
		
		$query = $this->db->query($sql); //debug();
		//query();
		foreach($query->result_array() as $row)
		{
			$result[] = format_html($row);
		}
		return $result;
	}
	
	function detail_list_loader_bayar($id)
	{
		// buat array kosong
		$result = array(); 	
		if($id != 0){
			$where = "WHERE tr_plan_detail_shipment_id = '".$id."'";
		}else{
			$where = '';
		}
		$sql = "
		select * 
		from tr_payments 
		".$where."";
		
		
		
		$query = $this->db->query($sql); //debug();
		//query();
		foreach($query->result_array() as $row)
		{
			$result[] = format_html($row);
		}
		return $result;
	}
	
	
	function read_bayar($id)
	{
		$sql = "SELECT tr_plan_detail_shipment_total_paid
				FROM tr_plan_detail_shipments
				where tr_plan_detail_shipment_id = $id";
		$query = $this->db->query($sql); // parameter limit harus 1
		//query($query);
		
		$result = null;
        foreach ($query->result_array() as $row) $result = format_html($row);
        return $result['tr_plan_detail_shipment_total_paid'];
	}
	
	function read_code($user_id)
	{
		$sql = "SELECT user_password 
				FROM users";
		$query = $this->db->query($sql); // parameter limit harus 1
		//query($query);
		
		$result = null;
        foreach ($query->result_array() as $row) $result = format_html($row);
        return $result['user_password'];
	}
	
	
}