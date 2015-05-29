<?php

class cost_type_model extends CI_Model{

	function __construct(){
		
	}
		
	function list_loader()
	{		
		// buat array kosong
		$result = array(); 
		
		$this->db->select('*',1);
		$this->db->from('tr_cost_types ');
		$this->db->where('tr_cost_types_status', 1);
		//query();
		$query = $this->db->get();
		foreach($query->result_array() as $row)
		{
			$row = format_html($row);
			$result[] = array(
				$row['tr_cost_type_id'],
				$row['tr_cost_type_name'], 
				$row['tr_cost_type_desc']
			
				); 
		}
		return $result;
	}
	
	function read_id($id){
		$this->db->select('*', 1);
		$this->db->where('tr_cost_type_id', $id);
		$query = $this->db->get('tr_cost_types', 1);
		$result = null;
		foreach($query->result_array() as $row)
		{
			$result = format_html($row);
		}
		return $result;
	}
	
	function create($data){
		$this->db->trans_start();
		$this->db->insert('tr_cost_types', $data);
		$id = $this->db->insert_id();
				
		$this->access->log_insert($id, "Kategori Biaya [".$data['tr_cost_type_name']."]");
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	function update($id, $data){
		$this->db->trans_start();
		$this->db->where('tr_cost_type_id', $id);
		$this->db->update('tr_cost_types', $data);
		$this->access->log_update($id, "Kategori Biay [".$data['tr_cost_type_name']."]");
		
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	function delete($id){
		$this->db->trans_start();
		
		$this->db->where('tr_cost_type_id', $id);
		$this->db->delete('tr_cost_types');
		
		$this->access->log_delete($id, "Kategori Biaya");
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
}