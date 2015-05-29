<script type="text/javascript">	
$(function(){
	createTableFormTransient({
		id 				: "#transient_contact",
		listSource 		: "tr_plan/detail_list_loader_shipment/<?=$row_id?>",
		formSource 		: "tr_plan/detail_form_shipment/<?=$row_id?>",
		controlTarget	: "tr_plan/detail_form_action_shipment",
		onAdd		: function (){perhitungan();},	
		onTargetLoad: function (){perhitungan();} 
	});
	
	function perhitungan()
	{
		var tm_total = 0;
		$('input[name="transient_shipment_detail_qty[]"]').each(function()
		{
			tm_total += parseFloat($(this).val());
		});
		$('input#tsd_total').val((tm_total));
		
	}
});</script>
<div class="transient_category">Data pengiriman</div>
<div>
<form id="tform">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="transient_contact"> 
	<thead>
		<tr>
       		<th>Dari</th>
            <th>Ke Pangakalan</th>
            <th>Jumlah Kirim</th>
            <th>Total Harga Kirim</th>
            <th>BIaya Kirim</th>
          	<th>Tanggal Kirim</th>
      </tr> 
	</thead> 
	<tbody> 	
	</tbody>
</table>
<div class="command_table" style="text-align:left;">
 <table align="right">
          <tr>
            <td><span class="summary_total">Jumlah Pengiriman</span></td>
            <td><input id="tsd_total" value="<?= $tr_plan_detail_qty_shipment?>" type="text" readonly="readonly" class="format_money_new" size="50" />
           </td>
          </tr>
        </table>
      <input type="button" id="add" value="Tambah"/>
	<input type="button" id="edit" value="Revisi"/>
    <input type="button" id="delete" value="Hapus"/>
   
</div>
<div id="editor"></div>
</form>
</div>