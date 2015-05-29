<?php

class Tr_cost_detail_report_model extends CI_Model{
	var $trans_type = 5;
	var $insert_id = NULL;
	var $insert_id2 = NULL;
	
	function __construct(){
		
	}
	function detail_table_loader($date)
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
			$row['get_cost_driver'] = $this->get_cost_driver($row['employee_id'],$date);
			$row['get_cost_co_driver'] = $this->get_cost_co_driver($row['employee_id'],$date);
			$row['total_cost'] = $row['get_cost_driver'] + $row['get_cost_co_driver'];
			$result[] = format_html($row);
		}
		return $result;
	}
	function detail_table_loader2($date)
	{
		// buat array kosong
		$sql = "
		select b.*, a.tr_cost_type_name,a.tr_cost_types_status
		from tr_cost_types a
		LEFT JOIN tr_costs b on b.tr_cost_type_id = a.tr_cost_type_id	
		where tr_cost_date ='$date' OR a.tr_cost_types_status ='0'";

		$query = $this->db->query($sql);
		//debug();
		//query();
		$result = array(); // inisialisasi variabel. biasakanlah, untuk mencegah warning dari php.
		foreach($query->result_array() as $row)
		{	
			if($row['tr_cost_types_status'] == 0){
				$row['total_shipment_lain'] = $this->get_total_cost_shipment_lain($date);
				$row['total_shipment_route'] = $this->get_total_cost_shipment_route($date);
				$row['total'] = $row['total_shipment_route'] + $row['total_shipment_lain'];
			}else{
				$row['total'] = $row['tr_cost_price'];
			}
			$result[] = format_html($row);
		}
		return $result;
	}
	
	function get_cost_driver($employee_id,$date){
		
				$sql = "SELECT SUM( tr_plan_detail_cost_driver ) AS cost_driver
						FROM tr_plan_details
					where driver_id = $employee_id and tr_plan_detail_date_realization = '$date' and tr_plan_detail_status_realization = '1'
				
				
				";

		$query = $this->db->query($sql);
		//query();
		$result = null;
		foreach ($query->result_array() as $row)
		 $result = format_html($row);
		return $result['cost_driver'];
	}
	function get_cost_co_driver($employee_id,$date){
		
				$sql = "SELECT SUM(tr_plan_detail_cost_co_driver) AS cost_co_driver
						FROM tr_plan_details
						where co_driver_id = $employee_id and 
						tr_plan_detail_date_realization = '$date' and tr_plan_detail_status_realization = '1'
				
				";

		$query = $this->db->query($sql);
		//query();
		$result = null;
		foreach ($query->result_array() as $row)
		$result = format_html($row);
		return $result['cost_co_driver'];
	}
	function get_total_cost_driver_co($date)
	{
		$sql = "
			SELECT SUM(tr_plan_detail_cost_driver + tr_plan_detail_cost_co_driver) AS total_cost_driver_co
						FROM tr_plan_details
						where 	tr_plan_detail_date_realization = '$date' and tr_plan_detail_status_realization = '1'
				";
	
		$query = $this->db->query($sql);
	//	query();
		$result = null;
		foreach ($query->result_array() as $row)
		$result = format_html($row);
		return $result['total_cost_driver_co'];
	}
	function get_total_cost($date)
	{
		$sql = "
			select SUM(a.tr_cost_price) total_cost
			from tr_costs a
			join tr_cost_types b on b.tr_cost_type_id = a.tr_cost_type_id	
			where tr_cost_date ='$date'";
	
		$query = $this->db->query($sql);
	//	query();
		$result = null;
		foreach ($query->result_array() as $row)
		$result = format_html($row);
		return $result['total_cost'];
	}
	function get_total_cost_shipment_lain($date)
	{
		$sql = "
			SELECT SUM(tr_plan_detail_cost_lain) AS cost_shipment_lain
						FROM tr_plan_details
						where tr_plan_detail_date_realization = '$date' and tr_plan_detail_status_realization = '1'
				";
	
		$query = $this->db->query($sql);
		//query();
		$result = null;
		foreach ($query->result_array() as $row)
		$result = format_html($row);
		return $result['cost_shipment_lain'];
	}
	function get_total_cost_shipment_route($date)
	{
		$sql = "
			SELECT SUM(tr_plan_detail_shipment_cost) AS cost_shipment_route
						FROM  tr_plan_detail_shipments
						where 	tr_plan_detail_shipment_realization_date = '$date' and 	tr_plan_detail_shipment_status_realization = '1'
				";
	
		$query = $this->db->query($sql);
		//query();
		$result = null;
		foreach ($query->result_array() as $row)
		$result = format_html($row);
		return $result['cost_shipment_route'];
	}
}