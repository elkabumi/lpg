<?php

class truck_model extends CI_Model{

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
		
		<th>ID</th>
            <th>Nopol</th>
            <th>No STNK</th>
			<th>Pemilik Kendaraan</th>
            <th>Warna</th>
            <th>Tahun Pembuatan</th>
            <th>Merk</th>
            <th>Jenis Armada</th>
            <th>Supir</th>
            <th>Kernet</th>
		
		$columns['truck_nopol'] 		= 'truck_nopol';
		$columns['truck_stnk'] 			= 'truck_stnk';
        $columns['truck_leader']        = 'employee_name';
		$columns['truck_phone']			= 'truck_phone';
		$columns['truck_address']	    = 'truck_address';
		
		$sort_column_index = $params['sort_column'];
		$sort_dir = $params['sort_dir'];
		
		$order_by_column[] = 'truck_id';
		$order_by_column[] = 'truck_code';
		$order_by_column[] = 'truck_name';
		$order_by_column[] = 'employee_name';
		$order_by_column[] = 'truck_phone';
		$order_by_column[] = 'truck_address';
        
		$order_by = " order by ".$order_by_column[$sort_column_index] . $sort_dir;
		if (array_key_exists($category, $columns) && strlen($keyword) > 0) 
		{
			
				$where = " where ".$columns[$category]." like '%$keyword%'";
			
			
		}
		if ($limit > 0) {
			$limit = " limit $limit offset $offset";
		};	

		$sql = "
		select a.* , b.employee_name
		
		from trucks a
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
				$row['truck_id'], 
				$row['truck_code'],
				$row['truck_name'],
				$row['employee_name'],
				$row['truck_phone'],
                $row['truck_address']
			); 
		}
		
		// kembalikan nilai dalam format datatables_control
		return make_datatables_control($params, $data, $total);
	}
	
	function read_id($id){
		$this->db->select('*', 1);
		$this->db->where('truck_id', $id);
		$query = $this->db->get('trucks', 1);
		$result = null;
		foreach($query->result_array() as $row)
		{
			$result = format_html($row);
		}
		return $result;
	}
	
	function create($data){
		$this->db->trans_start();
		$this->db->insert('trucks', $data);
		$id = $this->db->insert_id();
		
		$data_market['market_id'] = $id;
		$data_market['market_code'] = $data['truck_code'];
		$data_market['market_name'] = $data['truck_name'];
		$this->db->insert('markets', $data_market);
		
		$this->access->log_insert($id, "Cabang [".$data['truck_name']."]");
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	function update($id, $data){
		$this->db->trans_start();
		$this->db->where('truck_id', $id);
		$this->db->update('trucks', $data);
		
		$data_market['market_code'] = $data['truck_code'];
		$data_market['market_name'] = $data['truck_name'];
		
		$this->db->where('market_id', $id);
		$this->db->update('markets', $data_market);
		
		$this->access->log_update($id, "Cabang[".$data['truck_name']."]");
		
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	function delete($id){
		$this->db->trans_start();
		$this->db->where('truck_id', $id);
		$this->db->delete('trucks');
		
		$this->db->where('market_id', $id);
		$this->db->delete('markets');
		
		$this->access->log_delete($id, 'truck');
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	
	
	
}