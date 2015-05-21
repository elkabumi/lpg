<script type="text/javascript">	
$(function(){
	createTableFormTransient({
		id 				: "#transient_bayar",
		listSource 		: "tr_payment/detail_list_loader_bayar/<?=$row_id?>",
		formSource 		: "tr_payment/detail_form/<?=$row_id?>",
		controlTarget	: "tr_payment/detail_form_action",
		
		onAdd		: function (){perhitungan();},	
		onTargetLoad: function (){perhitungan();} 
	});
	
	function perhitungan()
	{
		var payment_total = 0;
		$('input[name="transient_tr_payment_pembayaran[]"]').each(function()
		{
			payment_total += parseFloat($(this).val());
		});
		$('input#payment_total').val(formatMoney(payment_total));
		
	}
	
	createDatePicker();
	
});
</script>
<div class="transient_category">History Pembayaran</div>

<div>
<form id="tform">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="transient_bayar"> 
	<thead>
		<tr>
			
			<th>Tanggal</th>
			<th>Keterangan</th>
			<th>Pembayaran</th>
		</tr> 
	</thead> 
	<tbody> 	
	</tbody>
    
</table>
<div class="command_table" style="text-align:left;">
 <table align="right">
          <tr>
            <td><span class="summary_total"> Total</span></td>
            <td><input id="payment_total" value="<?= $tr_plan_detail_shipment_total_paid ?>" type="text" readonly="readonly" class="format_money" size="50" />
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