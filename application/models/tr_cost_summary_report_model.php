<?php

class Tr_cost_summary_report_model extends CI_Model{
	var $trans_type = 5;
	var $insert_id = NULL;
	var $insert_id2 = NULL;
	
	function __construct(){
		
	}
	function detail_table_loader($date_1,$date_2)
	{
		// buat array kosong
		$sql = "
		SELECT * 
		FROM (`employees`) 
		WHERE `employee_position_id` = '2' OR `employee_position_id` = '4'
			
			";

		$query = $this->db->query($sql);
		//debug();
		//query();
		$result = ''; // inisialisasi variabel. biasakanlah, untuk mencegah warning dari php.
		
		foreach($query->result_array() as $row)
		{	
			$row['get_cost_driver'] = $this->get_cost_driver($row['employee_id'],$date_1,$date_2);
			$row['get_cost_co_driver'] = $this->get_cost_co_driver($row['employee_id'],$date_1,$date_2);
			$row['total_cost'] = $row['get_cost_driver'] + $row['get_cost_co_driver'];
			$result[] = format_html($row);
		}
		return $result;
	}
	function detail_table_loader2($date_1,$date_2)
	{
		// buat array kosong
		$sql = "
		SELECT *
		FROM tr_cost_types";
		

		$query = $this->db->query($sql);
		//debug();
		//query();
		$result = array(); // inisialisasi variabel. biasakanlah, untuk mencegah warning dari php.
		foreach($query->result_array() as $row)
		{	
			if($row['tr_cost_types_status'] == 1){
				$row['total_cost'] = $this->get_total_cost_detail($row['tr_cost_type_id'],$date_1,$date_2);
			}else if($row['tr_cost_types_status'] == 0){
				$row['total_shipment_lain'] = $this->get_total_cost_shipment_lain($date_1,$date_2);
				$row['total_shipment_route'] = $this->get_total_cost_shipment_route($date_1,$date_2);
				$row['total_cost']  = $row['total_shipment_lain']  +  $row['total_shipment_route'];
			}
			$result[] = format_html($row);
		}
		return $result;
	}

	function get_cost_driver($employee_id,$date_1,$date_2){
		
				$sql = "SELECT SUM( tr_plan_detail_cost_driver ) AS cost_driver
						FROM tr_plan_details
					where driver_id = $employee_id and tr_plan_detail_date_realization between '".$date_1."'  AND '".$date_2."' and tr_plan_detail_status_realization = '1'
				
				
				";

		$query = $this->db->query($sql);
		//query();
		$result = null;
		foreach ($query->result_array() as $row)
		 $result = format_html($row);
		return $result['cost_driver'];
	}
	function get_cost_co_driver($employee_id,$date_1,$date_2){
		
				$sql = "SELECT SUM(tr_plan_detail_cost_co_driver) AS cost_co_driver
						FROM tr_plan_details
						where co_driver_id = $employee_id and 
						 tr_plan_detail_date_realization between '".$date_1."'  AND '".$date_2."' and tr_plan_detail_status_realization = '1'
				
				";

		$query = $this->db->query($sql);
		//query();
		$result = null;
		foreach ($query->result_array() as $row)
		$result = format_html($row);
		return $result['cost_co_driver'];
	}
		
	function get_total_cost_detail($cost_type_id,$date_1,$date_2){
		
				$sql = "SELECT SUM( tr_cost_price ) AS total_cost
						FROM tr_costs
					where tr_cost_type_id = $cost_type_id and tr_cost_date between '".$date_1."'  AND '".$date_2."'
				
				
				";

		$query = $this->db->query($sql);
		//query();
		$result = null;
		foreach ($query->result_array() as $row)
		 $result = format_html($row);
		return $result['total_cost'];
	}
	function get_total_cost_driver_co($date1,$date2)
	{
		$sql = "
			SELECT SUM(tr_plan_detail_cost_driver + tr_plan_detail_cost_co_driver) AS total_cost_driver_co
						FROM tr_plan_details
				 where tr_plan_detail_date_realization between '".$date1."'  AND '".$date2."' and tr_plan_detail_status_realization = '1'";
	
		$query = $this->db->query($sql);
	//	query();
		$result = null;
		foreach ($query->result_array() as $row)
		$result = format_html($row);
		return $result['total_cost_driver_co'];
	}
	function get_total_cost($date1,$date2)
	{
		$sql = "
			select SUM(a.tr_cost_price) total_cost
			from tr_costs a
			join tr_cost_types b on b.tr_cost_type_id = a.tr_cost_type_id	
			where  tr_cost_date between '".$date1."'  AND '".$date2."'
				";
	
		$query = $this->db->query($sql);
	//	query();
		$result = null;
		foreach ($query->result_array() as $row)
		$result = format_html($row);
		return $result['total_cost'];
	}
	
	
	function get_total_cost_shipment_lain($date1,$date2)
	{
		$sql = "
			SELECT SUM(tr_plan_detail_cost_lain) AS cost_shipment_lain
						FROM tr_plan_details
						where tr_plan_detail_date_realization between '".$date1."'  AND '".$date2."' and  tr_plan_detail_status_realization = '1'
				";
	
		$query = $this->db->query($sql);
		//query();
		$result = null;
		foreach ($query->result_array() as $row)
		$result = format_html($row);
		return $result['cost_shipment_lain'];
	}
	function get_total_cost_shipment_route($date1,$date2)
	{
		$sql = "
			SELECT SUM(tr_plan_detail_shipment_cost) AS cost_shipment_route
						FROM  tr_plan_detail_shipments
						where 	tr_plan_detail_shipment_realization_date between '".$date1."'  AND '".$date2."'  and tr_plan_detail_shipment_status_realization = '1'
				";
	
		$query = $this->db->query($sql);
		//query();
		$result = null;
		foreach ($query->result_array() as $row)
		$result = format_html($row);
		return $result['cost_shipment_route'];
	}
	
}