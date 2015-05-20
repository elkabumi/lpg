<script type="text/javascript">	
$(function(){
	createForm({
		id 				: "#id_form_nya", 
		actionTarget	: "route/form_action",
		backPage		: "route",
		nextPage		: "route"
	});
	
	createLookUp({
		table_id		: "#lookup_table_location_from",
		table_width		: 400,
		listSource 		: "lookup/location_table_control/",
		dataSource		: "lookup/location_lookup_id",
		column_id 		: 0,
		component_id	: "#lookup_location_from",
		filter_by		: [{id : "p1", label : "Nama"},{id : "p2", label : "Alamat"}]
	});
	createLookUp({
		table_id		: "#lookup_table_location_to",
		table_width		: 400,
		listSource 		: "lookup/location_table_control/",
		dataSource		: "lookup/location_lookup_id",
		column_id 		: 0,
		component_id	: "#lookup_location_to",
		filter_by		: [{id : "p1", label : "Nama"},{id : "p2", label : "Alamat"}]
	});
	
	createDatePicker();
});

</script>

<form id="id_form_nya">
<div class="form_area">
<div class="form_area_frame">
<table  width="100%" cellpadding="4" class="form_layout">

     <tr>
     <td req= "req">Dari Lokasi</td>
        <td><span class="lookup" id="lookup_location_from">
				<input type="hidden" name="i_from_id" class="com_id" value="<?=$location_from_id?>" />
				<input type="text" class="com_input" name="i_employee_name"/>
          	   <input type="hidden" name="row_id" value="<?=$row_id?>" />	
				<div class="iconic_base iconic_search com_popup"></div>
				<span class="com_desc"></span>
                </span>	
       </td>
     </tr>
     <tr>
     <td req= "req">Ke Lokasi</td>
        <td><span class="lookup" id="lookup_location_to">
				<input type="hidden" name="i_to_id" class="com_id" value="<?=$location_to_id?>" />
				<input type="text" class="com_input" name="i_employee_name"/>
				<div class="iconic_base iconic_search com_popup"></div>
				<span class="com_desc"></span>
                </span>	
       </td>
     <!--</tr>
		 <td width="196">Total Biaya</td>
     	 <td width="651"><input name="i_total" type="text" id="i_total" value="<?//=$location_total_cost ?>" size="10"/></td>
     </tr>-->
  	<tr>
    	<td width="196">Keterangan</td>
    	<td width="651"><textarea name="i_description" id="i_description" cols="45" rows="5"><?= $location_desc ?></textarea></td>
    </tr>

</table>
</div>
<div class="command_bar">
	<input type="button" id="submit" value="Simpan"/>
	<input type="button" id="enable" value="Edit"/>
	<input type="button" id="cancel" value="Batal" /> 
</div>
</div>
</form>

<div id="">
	<table id="lookup_table_location_from" cellpadding="0" cellspacing="0" border="0" class="display" > 
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
<div id="">
	<table id="lookup_table_location_to" cellpadding="0" cellspacing="0" border="0" class="display" > 
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