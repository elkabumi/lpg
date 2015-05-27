<script type="text/javascript">	
$(function(){
	createLookUp({
		table_id		: "#lookup_table_route",
		table_width		: 400,
		listSource 		: "lookup/route_table_control/",
		dataSource		: "lookup/route_lookup_id",
		column_id 		: 0,
		component_id	: "#lookup_route",
		filter_by		: [{id : "p1", label : "Dari"},{id : "p2", label : "Menuju Pangkalan"},{id : "p3", label : "Biaya"}],
		onSelect		: load_data_route
	});
	
	function load_data_route()
	{
		var id 	= $('input[name="i_route_id"]').val();
		
		if(id == ""){
			return;
		}
		var data ='id='+id; 
		
		$.ajax({
			type: 'POST',
			url: '<?=site_url('tr_plan/load_data_route')?>',
			data: data,
			dataType: 'json',
			success: function(data){	
				$('input[name="i_location_from"]').val(data.content['location_from_name']);	
				$('input[name="i_location_to"]').val(data.content['location_to_name']);	
				if($('input[name="i_route_id"]').val() != <?=$transient_shipment_detail_route_id?>){
					$('input[name="i_cost_route"]').val(data.content['location_total_cost']);	
					$('input[name="i_price"]').val(data.content['harga']);	
				}else{
					$('input[name="i_cost_route"]').val(<?=$transient_shipment_detail_cost ?>);	
					$('input[name="i_price"]').val(<?=$transient_shipment_detail_price ?>);
				}
			}
			
		});
	}
	$('input[name="i_qty"]').change(
		function(){
		
			var qty = $('input[name="i_qty"]').val();
			var price = $('input[name="i_price"]').val();
			var total = qty * price ;
			$('input[name="i_total_price"]').val(total);
		}
	)
	$('input[name="i_price"]').change(
		function(){
		
			var qty = $('input[name="i_qty"]').val();
			var price  = $('input[name="i_price"]').val();
			var total = qty * price ;
			$('input[name="i_total_price"]').val(total);
		}
	)
	createDatePicker();
});
</script>
<form class="subform_area">
<div class="form_area_frame">
<table width="100%" cellpadding="4" class="form_layout">
     <!--<tr>
      <td>Tanggal Kirim  </td>
   
      <td>
      -->
      <input type="text" name="i_date" class="date_input" size="15" value="<?=$transient_shipment_detail_date?>" />
      <!--</td>
        
   </tr>-->
     <tr>
     
     <td req= "req">Route</td>
        <td><span class="lookup" id="lookup_route">
				<input type="hidden" name="i_route_id" class="com_id" value="<?=$transient_shipment_detail_route_id?>" />
				<input type="text" class="com_input"/>
              
				<div class="iconic_base iconic_search com_popup"></div>
                <span class="com_desc"></span>
				</span>	
				<input type="hidden" name="i_index" value="<?=$index?>" />
   				<input type="hidden" name="row_id" value="<?=$row_id?>" />
              >
   			    <input type="hidden" name="i_location_from" id="i_location_from" value="<?=$transient_shipment_detail_route_from?>"/>
       			<input type="hidden" name="i_location_to" id="i_location_to" value="<?=$transient_shipment_detail_route_to?>"/>
       			<input type="hidden" name="i_tr_plan_shipment_id" id="i_tr_plan_shipment_id" value="<?=$transient_tr_plan_detail_shipment_id?>"/>
       		  
       </td>
     </tr>
    <tr>
    	 <td width="196">Biaya Route</td>
    	 <td width="651"><input name="i_cost_route" type="text" id="i_cost_route" value="<?=$transient_shipment_detail_cost ?>" size="10"/>
      </td>
    </tr>
    <tr>
    	 <td width="196">Jumlah Kirim</td>
    	 <td width="651"><input name="i_qty" type="text" id="i_qty" value="<?=$transient_shipment_detail_qty ?>" size="10"/></td>
    </tr>
     <tr>
    	 <td width="196">Harga</td>
    	 <td width="651"><input name="i_price" type="text" id="i_price" value="<?=$transient_shipment_detail_price ?>" size="10"/></td>
    </tr>
      <tr>
    	 <td width="196">Total Harga</td>
    	 <td width="651"><input readonly="readonly" name="i_total_price" type="text" id="i_total_price" value="<?=$transient_shipment_detail_total_price ?>" size="10"/></td>
    </tr>
 	
 	
</table>
</div>
<div class="command_bar">
	<input type="button" id="submit" value="Save" />
	<input type="reset" id="reset"  value="Reset" />
	<input type="button" id="cancel" value="Cancel"  />
</div>
</form>
<div id="">
	<table id="lookup_table_route" cellpadding="0" cellspacing="0" border="0" class="display" > 
		<thead>
			<tr>
			<th>ID</th>
			<th>Dari</th>
			<th>Menuju Pangakalan</th>
            <th>Biaya Route/Perjalanan</th>
			</tr> 
		</thead> 
		<tbody> 	
		</tbody>
	</table>
