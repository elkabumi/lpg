<script type="text/javascript">	
$(function(){
	var otable = createTable({
		id 		: "#table",
		listSource 	: "customer/table_controller",
		formTarget 	: "customer/form",
		actionTarget: "customer/form_action",
		column_id	: 0,
		
		filter_by 	: [ 
		{id : "location_name", label : "Nama"},
		{id : "location_address", label : "Alamat"},
		{id : "location_phone", label : "Telepon"},
		{id : "location_rt_rw", label : "RT/RW"},
		{id : "location_kelurahan", label : "Kelurahan"},
        {id : "location_kecamatan", label : "Kecamatan"},
        {id : "location_kota", label : "Kota"}],
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
            <th>Nama</th>
            <th>Alamat</th>
			<th>Telepon</th>
            <th>RT/RW</th>
            <th>Kelurahan</th>
            <th>Kecamatan</th>
            <th>Kota</th>
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
