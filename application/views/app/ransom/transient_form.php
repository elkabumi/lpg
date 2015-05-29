<script type="text/javascript">	
$(function(){
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

	function load_data_spbe()
	{
		var id 	= $('input[name="i_spbe_id"]').val();
		
		if(id == ""){
			return;
		}
		var data ='id='+id; 
		
		$.ajax({
			type: 'POST',
			url: '<?=site_url('ransom/load_data_spbe')?>',
			data: data,
			dataType: 'json',
			success: function(data){	
				$('input[name="i_location_name"]').val(data.content['location_name']);	
			
			}	
		});
	}

	createDatePicker();
});
</script>
<form class="subform_area">
<div class="form_area_frame">
<table width="100%" cellpadding="4" class="form_layout">
	<tr>
    <td width="196">Tanggal</td>
    <td width="651"><input type="text" name="i_purchase_date" class="date_input" size="15" value="<?=$transient_detail_purchase_date?>" /> 
   
    </tr>
     <tr>
     <td req= "req">SPBE</td>
        <td><span class="lookup" id="lookup_spbe">
				<input type="hidden" name="i_spbe_id" id="i_spbe_id" class="com_id" value="<?=$transient_detail_location_id?>" />
				<input type="text" class="com_input"/>
				<div class="iconic_base iconic_search com_popup"></div>
                 <span class="com_desc"></span>
				
				</span>	
                <input type="hidden" name="i_index" value="<?=$index?>" />
   
                <input type="hidden" name="i_location_name" id="i_location_name" value="<?=$transient_detail_location_name?>"/>
       			
       </td>
    </tr>
    <tr>
    	 <td width="196">Jumlah Tebusan</td>
    	 <td width="651"><input name="i_qty" type="text" id="i_qty" value="<?=$transient_detail_qty ?>" size="10"/></td>
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