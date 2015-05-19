<script type="text/javascript">	
$(function(){
	otable = createTable({
		id 				: "#table",
		listSource 		: "tr_realization_shipment/table_controller",
		formTarget 		: "tr_realization_shipment/form",
		actionTarget	: "tr_realization_shipment/form_action",
		column_id		: 0,
		filter_by 		: [ {id : "tanggal", label : "Tanggal"}, {id : "total", label : "Total"}, {id : "kulak", label : "Jumlah Kulak"}, {id : "kirim", label : "Jumlah Kirim"},]
	});
	otable.fnSetColumnVis(0, false, false);
	createDatePicker();
});
</script>
<div id="example">
<tr>
      <td>Tanggal Plan </td>
      <td>:</td>
      <td><input type="text" name="i_create_date" class="date_input" size="15" value="" /></td>
</tr>
	<input type="button" id="add" value="Search"/>

<table cellpadding="0" cellspacing="0" border="0" class="display" id="table"> 
	<thead>
		<tr>
        	<th width="10%">ID</th>
            <th width="10%">Tgl Plan</th>
            <th width="10%">Route</th>
			<th width="20%">Jumlah Kirim</th>
			<th width="10%">Total</th>
            <th width="10%">Tgl Realisasi</th>	
            <th width="10%">Detail</th>		
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

