<script type="text/javascript">	
$(function(){
	var otable = createTable({
		id 		: "#table",
		listSource 	: "tr_cost/table_controller",
		formTarget 	: "tr_cost/form",
		actionTarget: "tr_cost/form_action",
		column_id	: 0,
		filter_by 	: [ 
		{id : "tr_cost_date", label : "Tanggal Biaya"}, 
		{id : "tr_cost_type_name", label : "Kategori Biaya"}, 
		{id : "tr_cost_price", label : "Jumlah Biaya"},
		{id : "tr_cost_desc", label : "Keterangan"}],
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
            <th>Tanngal Biaya</th>
            <th>Kategori Biaya</th>
			<th>Jumlah Biaya</th>
            <th>Keterangan</th>
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
