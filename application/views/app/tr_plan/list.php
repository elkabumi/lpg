<script type="text/javascript">	
$(function(){
	otable = createTable({
		id 				: "#table",
		listSource 		: "tr_plan/table_controller",
		formTarget 		: "tr_plan/form",
		actionTarget	: "tr_plan/form_action",
		column_id		: 0,
		filter_by 		: [ {id : "tanggal", label : "Tanggal"}, {id : "total", label : "Total"}, {id : "kulak", label : "Jumlah Kulak"}, {id : "kirim", label : "Jumlah Kirim"},]
	});
	otable.fnSetColumnVis(0, false, false);
});
</script>
<div id="example">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="table"> 
	<thead>
		<tr>
        	<th width="10%">ID</th>
            <th width="10%">Tanggal</th>
			<th width="20%">Total</th>
			<th width="10%">Jumlah Kulak</th>
			<th width="30%">Jumlah Kirim</th>
			<th width="5%">Detail</th>			
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

