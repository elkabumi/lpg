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
		select a.*,b.tr_cost_type_name
		from tr_costs a
		join tr_cost_types b on b.tr_cost_type_id = a.tr_cost_type_id	
		where tr_cost_date ='$date'";

		$query = $this->db->query($sql);
		//debug();
		//query();
		$result = array(); // inisialisasi variabel. biasakanlah, untuk mencegah warning dari php.
		foreach($query->result_array() as $row)
		{	
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

}