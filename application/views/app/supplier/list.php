<script type="text/javascript">	
$(function(){
	var otable = createTable({
		id 		: "#table",
		listSource 	: "supplier/table_controller",
		formTarget 	: "supplier/form",
		actionTarget: "supplier/form_action",
		column_id	: 0,
		
		filter_by 	: [ 

		{id : "location_name", label : "Nama SPBE"},
		{id : "location_phone", label : "Telepon"},
        {id : "location_address", label : "Alamat"}],
		"aLengthMenu"		: [[50, 100, 250, 500], [50, 100, 250, 500]],
	});
	otable.fnSetColumnVis(0, false, false);
});
</script>
<div id="example">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="table"> 
	<thead>
		<tr>
			<th>ID</th>
            <th>Nama SPBE</th>
            <th>Telepon</th>
			<th>Alamat</th>
		</tr> 
	</thead> 
	<tbody> 	
	</tbody>
</table>
<div id="panel" class="command_table">
	<input type="button" id="add" value="Tambah"/>
	<input type="button" id="edit" value="Revisi"/>
	<input type="button" id="delete" value="Hapus"/>
	<input type="button" id="refresh" value="Refresh"/>
</div>
<div id="editor"></div>
</div>
