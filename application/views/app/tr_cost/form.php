<script type="text/javascript">	
$(function(){
	createForm({
		id 				: "#id_form_nya", 
		actionTarget	: "tr_cost/form_action",
		backPage		: "tr_cost",
		nextPage		: "tr_cost"
	});
	
	createLookUp({
		table_id		: "#lookup_table_cost_type",
		table_width		: 400,
		listSource 		: "lookup/cost_type_table_control/",
		dataSource		: "lookup/cost_type_lookup_id",
		column_id 		: 0,
		component_id	: "#lookup_cost_type",
		filter_by		: [{id : "p1", label : "Kode"},{id : "p2", label : "Nama"},{id : "p3", label : "posisi"}]
	});

	createDatePicker();
});

</script>

<form id="id_form_nya">
<div class="form_area">
<div class="form_area_frame">
<table  width="100%" cellpadding="4" class="form_layout">
	 <tr>
    	<td width="196">Tanggal</td>
    	<td width="651"><input type="text" name="i_date" class="date_input" size="15" value="<?=$tr_cost_date?>" /></td>
    </tr>
     	<tr>
     <td req= "req">Kategori Biaya</td>
        <td><span class="lookup" id="lookup_cost_type">
				<input type="hidden" name="i_cost_type_id" class="com_id" value="<?=$tr_cost_type_id?>" />
				<input type="text" class="com_input">
				<div class="iconic_base iconic_search com_popup"></div>
                 <span class="com_desc"></span>
			</span>	
       <input type="hidden" name="row_id" value="<?=$row_id?>" /></td>
     </tr>
   	<tr>
     	<td width="196">Jumlah Biaya</td>
     	<td width="651"><input name="i_price" type="text" id="i_manufacture_year" value="<?=$tr_cost_price	 ?>" size="10"/></td>
    </tr>
    </tr>
 	<td>Keterangan</td>
       <td><textarea name="i_description" type="text" id="i_description"><?=$tr_cost_desc ?></textarea></td>
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
	<table id="lookup_table_cost_type" cellpadding="0" cellspacing="0" border="0" class="display" > 
		<thead>
			<tr>
			<th>ID</th>
				<th>Nama</th>
            	<th>Keterangan</th>
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