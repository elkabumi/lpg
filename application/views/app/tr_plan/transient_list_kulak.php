<script type="text/javascript">	
$(function(){
	createTableFormTransient({
		id 				: "#transient_contact",
		listSource 		: "tr_plan/detail_list_loader_kulak/<?=$row_id?>",
		formSource 		: "tr_plan/detail_form_kulak/<?=$row_id?>",
		controlTarget	: "tr_plan/detail_form_action_kulak",
		onAdd		: function (){perhitungan();},	
		onTargetLoad: function (){perhitungan();} 
	});
	
	function perhitungan()
	{
		var tm_total = 0;
		$('input[name="transient_detail_total[]"]').each(function()
		{
			tm_total += parseFloat($(this).val());
		});
		$('input#td_total').val(formatMoney(tm_total));
		
	}
});</script>
<div class="transient_category">Data Kulak</div>
<div>
<form id="tform">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="transient_contact"> 
	<thead>
		<tr>
       		<th>Kode Kulak</th>
            <th>Truck Nopol</th>
            <th>SPBE</th>
            <th>Jumlah Kulak</th>
            <th>Total Harga Kulak</th>
			<th>Biaya Sopir</th>
            <th>Biaya Kernet</th>
            <th>Biaya Lain-Lain</th>
            <th>Detail</th>
        
      </tr> 
	</thead> 
	<tbody> 	
	</tbody>
</table>
<div class="command_table" style="text-align:left;">
 <table align="right">
          <tr>
            <td><span class="summary_total"> Total Harga</span></td>
            <td><input id="td_total" value="<?= $tr_plan_total_purchase?>" type="text" readonly="readonly" class="format_money" size="50" />
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