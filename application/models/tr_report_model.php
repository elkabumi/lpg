<?php

class Tr_report_model extends CI_Model{
	var $trans_type = 5;
	var $insert_id = NULL;
	var $insert_id2 = NULL;
	
	function __construct(){
		
	}
	function detail_table_loader($date_1,$date_2)
	{
		// buat array kosong
		$sql = "
		SELECT  a.tr_plan_date,
				c.*,
				d.*,
				group_concat(REPLACE(d.tr_plan_detail_shipment_qty, ',', '')  ORDER BY d.tr_plan_detail_shipment_id ASC) as jumlah,
				group_concat(REPLACE(d.tr_plan_detail_shipment_realization_date, ',', '')  ORDER BY d.tr_plan_detail_shipment_id ASC) as tgl_kirim,
				group_concat(REPLACE(f.location_name, ',', '')  ORDER BY d.tr_plan_detail_shipment_id ASC) as pangakalan,
				group_concat(REPLACE(d.tr_plan_detail_shipment_total_price , ',', '0') ORDER BY d.tr_plan_detail_shipment_id ASC) as total,
				group_concat(REPLACE(d.tr_plan_detail_shipment_total_paid, ',', '')  ORDER BY d.tr_plan_detail_shipment_id ASC) as dibayar,
				group_concat(REPLACE(d.tr_plan_detail_shipment_total_price - d.tr_plan_detail_shipment_total_paid , ',', '0') ORDER BY d.tr_plan_detail_shipment_id ASC) as sisa,
				group_concat(REPLACE(d.tr_plan_detail_shipments_paid_date, ',', '')  ORDER BY d.tr_plan_detail_shipment_id ASC) as tgl_dibayar,
				g.truck_nopol,
				h.employee_name
		FROM tr_plans a
		JOIN tr_plan_purchases b ON b.tr_plan_id = a.tr_plan_id 
		JOIN tr_plan_details c ON c.tr_plan_purchase_id = b.tr_plan_purchase_id
		JOIN tr_plan_detail_shipments d ON c.tr_plan_detail_id = d.tr_plan_detail_id 
		JOIN routes e ON e.route_id = d.route_id 
		JOIN locations f ON f.location_id = e.location_to_id 
		JOIN trucks g ON c.truck_id = g.truck_id 
		JOIN employees h ON h.employee_id = c.driver_id 
		LEFT JOIN (select max(tr_payment_id) as pay_id, max(tr_payment_date) AS DATE,tr_plan_detail_shipment_id
					from  tr_payments z 
					group by tr_plan_detail_shipment_id) as i
				on i.tr_plan_detail_shipment_id = d.tr_plan_detail_shipment_id
		WHERE 	tr_plan_detail_date_realization	 BETWEEN '".$date_1."' AND '".$date_2."'
		group by c.tr_plan_detail_id
		order by c.tr_plan_detail_id";
		$query = $this->db->query($sql);
		//debug();
		//query();
		$result = ''; // inisialisasi variabel. biasakanlah, untuk mencegah warning dari php.
		
		foreach($query->result_array() as $row)
		{	
			$result[] = format_html($row);
		}
		return $result;
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