<?php

class Tr_income_report_model extends CI_Model{
	var $trans_type = 5;
	var $insert_id = NULL;
	var $insert_id2 = NULL;
	
	function __construct(){
		
	}

	function detail_table_loader_income($date)
	{
		
		$sql = "SELECT a.*
				FROM tr_plans a
				WHERE tr_plan_date = '".$date."'
		";
		$query = $this->db->query($sql);
		//debug();
		//query();
		$result = array(); // inisialisasi variabel. biasakanlah, untuk mencegah warning dari php.
		foreach($query->result_array() as $row)
		{	
			$row['total_purcahse']	= $this->get_total_purcahse($date);
			$row['total_price']		= $this->get_total_price($date);
			
			$row['total_cost_purcahse'] = $this->get_total_cost_purcahse($date);
			$row['total_cost_shipment'] = $this->get_total_cost_shipment($date);
			$row['total_cost'] = $row['total_cost_purcahse']+ $row['total_cost_shipment'];
			$row['total_income']	= $this->get_total_income($date);
			$result[] = format_html($row);
		}
		return $result;
	
	}
	function get_total_purcahse($date){
		
				$sql = 
				 "SELECT SUM(c.tr_plan_detail_total_purchase) AS total_purcahse
					FROM tr_plans a
					JOIN tr_plan_purchases b ON a.tr_plan_id = b.tr_plan_id
 					JOIN tr_plan_details c ON b.tr_plan_purchase_id = c.tr_plan_purchase_id
					WHERE tr_plan_date = '".$date."'
				
				";
		$query = $this->db->query($sql);
		//query();
		$result = null;
		foreach ($query->result_array() as $row)
		$result = format_html($row);
		return $result['total_purcahse'];
	}
	function get_total_price($date){
		
				$sql = 
				 "SELECT SUM(d.tr_plan_detail_shipment_total_price) AS total_price
					FROM tr_plans a
					JOIN tr_plan_purchases b ON a.tr_plan_id = b.tr_plan_id
 					JOIN tr_plan_details c ON b.tr_plan_purchase_id = c.tr_plan_purchase_id
					JOIN tr_plan_detail_shipments d ON c.tr_plan_detail_id =d.tr_plan_detail_id 
					WHERE tr_plan_date = '".$date." AND tr_plan_detail_shipment_status_realization =1' 
				
				";
		$query = $this->db->query($sql);
		//query();
		$result = null;
		foreach ($query->result_array() as $row)
		$result = format_html($row);
		return $result['total_price'];
	}
	function get_total_cost_purcahse($date){
		
				$sql = 
				 "SELECT SUM(c.	tr_plan_detail_cost_driver + c.tr_plan_detail_cost_co_driver +	c.tr_plan_detail_cost_lain) AS total_cost_purcahse
					FROM tr_plans a
					JOIN tr_plan_purchases b ON a.tr_plan_id = b.tr_plan_id
 					JOIN tr_plan_details c ON b.tr_plan_purchase_id = c.tr_plan_purchase_id
					WHERE tr_plan_date = '".$date."'
				
				";
		$query = $this->db->query($sql);
		//query();
		$result = null;
		foreach ($query->result_array() as $row)
		$result = format_html($row);
		return $result['total_cost_purcahse'];
	}
	function get_total_cost_shipment($date){
		
				$sql = 
				 "SELECT SUM(d.	tr_plan_detail_shipment_cost) AS total_cost_shipment
					FROM tr_plans a
					JOIN tr_plan_purchases b ON a.tr_plan_id = b.tr_plan_id
 					JOIN tr_plan_details c ON b.tr_plan_purchase_id = c.tr_plan_purchase_id
					JOIN tr_plan_detail_shipments d ON c.tr_plan_detail_id =d.tr_plan_detail_id 
					WHERE tr_plan_date = '".$date." AND tr_plan_detail_shipment_status_realization =1' 
				
				";
		$query = $this->db->query($sql);
		//query();
		$result = null;
		foreach ($query->result_array() as $row)
		$result = format_html($row);
		return $result['total_cost_shipment'];
	}
	function get_total_income($date){
		
				$sql = 
				 "SELECT SUM(d.tr_plan_detail_shipment_total_paid) AS total_income
					FROM tr_plans a
					JOIN tr_plan_purchases b ON a.tr_plan_id = b.tr_plan_id
 					JOIN tr_plan_details c ON b.tr_plan_purchase_id = c.tr_plan_purchase_id
					JOIN tr_plan_detail_shipments d ON c.tr_plan_detail_id =d.tr_plan_detail_id 
					WHERE tr_plan_date = '".$date." AND tr_plan_detail_shipment_status_realization =1' 
				
				";
		$query = $this->db->query($sql);
		//query();
		$result = null;
		foreach ($query->result_array() as $row)
		$result = format_html($row);
		return $result['total_income'];
	}
}