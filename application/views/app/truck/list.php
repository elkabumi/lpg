<script type="text/javascript">	
$(function(){
	var otable = createTable({
		id 		: "#table",
		listSource 	: "truck/table_controller",
		formTarget 	: "truck/form",
		actionTarget: "truck/form_action",
		column_id	: 0,
		
		filter_by 	: [ 
		{id : "truck_nopol2", label : "Nopol"}, 
		{id : "truck_stnk", label : "No Stnk"}, 
		{id : "truck_owner", label : "Pemilik Kendaraan"},
		{id : "truck_color", label : "Warna"},
		{id : "truck_manufacture_date", label : "Tahun Pembuatan"},
        {id : "truck_merk", label : "Merk"},
		{id : "truck_type_id", label : "Jenis Armada"}, 
		{id : "driver_name", label : "Supir"}, 
		{id : "co_driver_name", label : "Kernet"}],
		
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
            <th>Nopol</th>
            <th>No STNK</th>
			<th>Pemilik Kendaraan</th>
            <th>Warna</th>
            <th>Tahun Pembuatan</th>
            <th>Merk</th>
            <th>Jenis Armada</th>
            <th>Sopir</th>
            <th>Kernet</th>
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
