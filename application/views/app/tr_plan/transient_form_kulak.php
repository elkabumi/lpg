<script type="text/javascript">	
$(function(){
	createLookUp({
		table_id		: "#lookup_table_truck",
		table_width		: 400,
		listSource 		: "lookup/truck_table_control/",
		dataSource		: "lookup/truck_lookup_id",
		column_id 		: 0,
		component_id	: "#lookup_truck",
		filter_by		: [{id : "p1", label : "Nopol"},
							{id : "p2", label : "Sopir"},
							{id : "p3", label : "Kernet"},
							{id : "p4", label : "Merk"},
							{id : "p5", label : "Jenis Armada"}],
		onSelect		: load_data_truck
	});
	createLookUp({
		table_id		: "#lookup_table_truck_driver",
		table_width		: 400,
		listSource 		: "lookup/employee_table_control/",
		dataSource		: "lookup/employee_lookup_id",
		column_id 		: 0,
		component_id	: "#lookup_truck_driver",
		filter_by		: [{id : "p1", label : "Kode"},{id : "p2", label : "Nama"},{id : "p3", label : "posisi"}],
	});
	createLookUp({
		table_id		: "#lookup_table_truck_co_driver",
		table_width		: 400,
		listSource 		: "lookup/employee_table_control/",
		dataSource		: "lookup/employee_lookup_id",
		column_id 		: 0,
		component_id	: "#lookup_truck_co_driver",
		filter_by		: [{id : "p1", label : "Kode"},{id : "p2", label : "Nama"},{id : "p3", label : "posisi"}]
	});
	createLookUp({
		table_id		: "#lookup_table_spbe",
		table_width		: 400,
		listSource 		: "lookup/location_table_control/2",
		dataSource		: "lookup/location_lookup_id",
		column_id 		: 0,
		component_id	: "#lookup_spbe",
		filter_by		: [{id : "p1", label : "Nama"},{id : "p2", label : "Alamat"}],
		onSelect		: load_data_spbe
	});
	function load_data_truck()
	{
		var id 	= $('input[name="i_truck_id"]').val();
		
		if(id == ""){
			return;
		}
		var data ='id='+id; 
		
		$.ajax({
			type: 'POST',
			url: '<?=site_url('tr_plan/load_data_truck')?>',
			data: data,
			dataType: 'json',
			success: function(data){	
				$('input[name="i_truck_nopol"]').val(data.content['truck_nopol']);	
				$('input[name="i_driver_id"]').val(data.content['driver_id']);	
				$('input[name="i_co_driver_id"]').val(data.content['co_driver_id']);				
				$('input[name="i_driver_name"]').val(data.content['driver_name']);	
				$('input[name="i_co_driver_name"]').val(data.content['co_driver_name']);
			}
			
		});
	}
	function load_data_spbe()
	{
		var id 	= $('input[name="i_spbe_id"]').val();
		
		if(id == ""){
			return;
		}
		var data ='id='+id; 
		
		$.ajax({
			type: 'POST',
			url: '<?=site_url('tr_plan/load_data_spbe')?>',
			data: data,
			dataType: 'json',
			success: function(data){	
				$('input[name="i_location_name"]').val(data.content['location_name']);	
			
			}	
		});
	}
	$('input[name="i_qty"]').change(
		function(){
		
			var qty = $('input[name="i_qty"]').val();
			var purchase = $('input[name="i_purchase"]').val();
			var total = qty * purchase;
			$('input[name="i_total_purchase"]').val(total);
		}
	)
	$('input[name="i_purchase"]').change(
		function(){
		
			var qty = $('input[name="i_qty"]').val();
			var purchase = $('input[name="i_purchase"]').val();
			var total = qty * purchase;
			$('input[name="i_total_purchase"]').val(total);
		}
	)
	$('input[name="i_drive_type"]').change(function(){
		var asuransi = document.getElementById("asuransi");
		var no_klaim = document.getElementById("no_klaim");
		var pribadi = document.getElementById("pribadi");
		var pph = document.getElementById("pph");
		
		if($(this).val() == 1){
			default_type.style.display = 'none';
			cadangan_type.style.display = 'table';
			
	
		}else{
			default_type.style.display = 'table';
			cadangan_type.style.display = 'none';
			
			
			
		}
		
	});
	if(<?=$transient_detail_driver_type?> == '0'){
		cadangan_type.style.display = 'none';
	}
	if(<?=$transient_detail_driver_type?> == '1'){
		default_type.style.display = 'none';
	}
	createDatePicker();
});
</script>
<form class="subform_area">
<div class="form_area_frame">
<table width="100%" cellpadding="4" class="form_layout">
	 <tr>
    	 <td width="196">Nomor DO</td>
    	 <td width="651"><input name="i_code" type="text" id="i_code" value="<?=$transient_detail_code ?>" size="10"/></td>
    </tr>
    <tr>
      <td>Tanggal Pengambilan  </td>
   	  <td>
      <input type="text" name="i_date" class="date_input" size="15" value="<?=$transient_detail_date?>" />
       
      </td>
        
   </tr>
    <tr>
     	<td req= "req">Truck</td>
        <td><span class="lookup" id="lookup_truck">
				<input type="hidden" name="i_truck_id" class="com_id" value="<?=$transient_detail_truck_id?>" />
				<input type="text" class="com_input"/>
              
				<div class="iconic_base iconic_search com_popup"></div>
                <span class="com_desc"></span>
				</span>	
				<input type="hidden" name="i_index" value="<?=$index?>" />
   				 <input type="hidden" name="i_no" value="<?=$transient_detail_no ?>" />
                <input type="hidden" name="i_location_name" id="i_location_name" value="<?=$transient_detail_nopol?>"/>
       			<input type="hidden" name="i_truck_nopol" id="i_truck_nopol" value="<?=$transient_detail_nopol?>"/>
       			<input type="hidden" name="i_plan_id" id="i_plan_id" value="<?=$transient_detail_plan_id?>"/>
       		
       	</td>
     </tr>
     <tr>
      	<td>Type sopir/kenet</td>
      	<td><label>
        	 <input type="radio" name="i_drive_type" value="0" id="i_drive_type" <?php if($transient_detail_driver_type == 0){ ?> checked="checked"<?php } ?> />
        		 Default</label>
     		<br />
       		<label>
         	<input name="i_drive_type" type="radio" id="i_drive_type" value="1" <?php if($transient_detail_driver_type == 1){ ?> checked="checked"<?php } ?>/>
         		Cadangan
             </label>
        </td>
    </tr>
	<tr>
		<td colspan="2">
      	<table width="100%" border="0" cellspacing="0" cellpadding="4" id="cadangan_type" style="width:100%;">
     		<td width="196">Sopir</td>
        	<td  width="651">
     	 	<span class="lookup" id="lookup_truck_driver">
				<input type="hidden" name="i_driver_id2"  class="com_id" value="<?=$transient_detail_driver_id?>" />
				<input type="text" class="com_input">
				<div class="iconic_base iconic_search com_popup"></div>
                <span class="com_desc"></span>
			</span>
       		</td>
     </tr>
     <tr>
     		<td width="196">Kernet</td>
        	<td  width="651"> 
        	<span class="lookup" id="lookup_truck_co_driver">
				<input type="hidden" name="i_co_driver_id2"  class="com_id" value="<?=$transient_detail_co_driver_id?>" />
				<input type="text" class="com_input"/>
				<div class="iconic_base iconic_search com_popup"></div>
                 <span class="com_desc"></span>
			</span>
       		</td>
      	</table></td>
     </tr>   
       </td>
     </tr>
     <tr>
     	<td colspan="2">
     	<table width="100%" border="0" cellspacing="0" cellpadding="0" id="default_type" style="width:100%;">
        <tr>
        	 <td  width="196">Sopir</td>
       		 <td  width="651" >
        		<input type="text"  readonly="readonly"	name="i_driver_name" id="i_driver_name" value="<?=$transient_detail_driver?>"/>
       			<input type="hidden" 	name="i_driver_id" id="i_driver_id" value="<?=$transient_detail_driver_id?>"/>
      		 </td>
     		</tr>
     		<tr>
    			 <td  width="196">Kernet</td>
        		 <td  width="651">
        		 <input type="text" 	readonly="readonly"	 name="i_co_driver_name"  id="i_co_driver_name" value="<?=$transient_detail_co_driver?>"/>
      			 <input type="hidden" 	name="i_co_driver_id"  id="i_co_driver_id" value="<?=$transient_detail_co_driver_id?>"/>
  				</td>
       </table></td>
      
				
				
      </tr>
       <tr>
     <td req= "req">SPBE</td>
        <td><span class="lookup" id="lookup_spbe">
				<input type="hidden" name="i_spbe_id" id="i_spbe_id" class="com_id" value="<?=$transient_detail_spbe?>" />
				<input type="text" class="com_input"/>
				<div class="iconic_base iconic_search com_popup"></div>
                 <span class="com_desc"></span>
				
				</span>	
       </td>
    </tr>
    <tr>
    	 <td width="196">Jumlah Kulak</td>
    	 <td width="651"><input name="i_qty" type="text" id="i_qty" value="<?=$transient_detail_qty ?>" size="10"/></td>
    </tr>
      <tr>
    	 <td width="196">Harga Satuan</td>
    	 <td width="651"><input name="i_purchase" type="text" id="i_purchase" value="<?=$transient_detail_purchase ?>" size="10"/></td>
    </tr>
 	<tr>
   	 	<td width="196">Total Harga Kulak</td>
     	<td width="651"><input  readonly="readonly" name="i_total_purchase" type="text" id="i_total_purchase" value="<?=$transient_detail_total ?>" size="10"/></td>
 	 </tr>
      </table>
<div class="form_category">Biaya Tambahan</div>
	<table width="100%" cellpadding="4" class="form_layout">
	
     <tr>
   	 <td width="196">Biaya Sopir</td>
    	 <td width="651"><input name="i_cost_driver" type="text" id="i_cost_driver" value="<?=$transient_detail_cost_driver ?>" size="10"/></td>
     </tr>
 	 <tr>
   	 	<td width="196">Biaya Kernet</td>
     	<td width="651"><input name="i_cost_co_driver" type="text" id="i_cost_co_driver" value="<?=$transient_detail_cost_co_driver ?>" size="10"/></td>
 	 </tr>
       <tr>
   	 <td width="196">Biaya Lain-Lain</td>
    	 <td width="651"><input name="i_cost_lain" type="text" id="i_cost_lain" value="<?=$transient_detail_cost_lain ?>" size="10"/></td>
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
	<table id="lookup_table_truck" cellpadding="0" cellspacing="0" border="0" class="display" > 
		<thead>
			<tr>
			<th>ID</th>
			<th>Nopol</th>
			<th>Sopir</th>
			<th>Kernet</th>
			<th>Merk</th>
            <th>Jenis Armada</th>
			</tr> 
		</thead> 
		<tbody> 	
		</tbody>
	</table>
	<div id="panel">
		<input type="button" id="choose" value="Pilih Data"/>
		<input type="button" id="refresh" value="Refresh"/>
		<input type="button" id="cancel" value="Cancel" />
	</div>	
</div>
<div id="">
	<table id="lookup_table_truck_driver" cellpadding="0" cellspacing="0" border="0" class="display" > 
		<thead>
			<tr>
			<th>ID</th>
				<th>NIK </th>
				<th>Nama</th>
            	<th>Posisi</th>
			</tr> 
		</thead> 
		<tbody> 	
		</tbody>
	</table>
	<div id="panel">
		<input type="button" id="choose" value="Pilih Data"/>
		<input type="button" id="refresh" value="Refresh"/>
		<input type="button" id="cancel" value="Cancel" />
	</div>	
</div>
<div id="">
	<table id="lookup_table_truck_co_driver" cellpadding="0" cellspacing="0" border="0" class="display" > 
		<thead>
			<tr>
			<th>ID</th>
				<th>NIK </th>
				<th>Nama</th>
            	<th>Posisi</th>
			</tr> 
		</thead> 
		<tbody> 	
		</tbody>
	</table>
	<div id="panel">
		<input type="button" id="choose" value="Pilih Data"/>
		<input type="button" id="refresh" value="Refresh"/>
		<input type="button" id="cancel" value="Cancel" />
	</div>	
</div>
<div id="">
<table id="lookup_table_spbe" cellpadding="0" cellspacing="0" border="0" class="display" > 
		<thead>
			<tr>
			<th>ID</th>
				<th>Lokasi</th>
				<th>Alamat</th>
			</tr> 
		</thead> 
		<tbody> 	
		</tbody>
	</table>
	<div id="panel">
		<input type="button" id="choose" value="Pilih Data"/>
		<input type="button" id="refresh" value="Refresh"/>
		<input type="button" id="cancel" value="Cancel" />
	</div>	
</div>