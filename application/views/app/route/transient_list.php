<script type="text/javascript">	
$(function(){
	createTableFormTransient({
		id 				: "#transient_contact",
		listSource 		: "route/detail_list_loader/<?=$row_id?>",
		formSource 		: "route/detail_form/<?=$row_id?>",
		controlTarget	: "route/detail_form_action",
		onAdd		: function (){perhitungan();},	
		onTargetLoad: function (){perhitungan();} 
	});
	
	function perhitungan()
	{
		var tm_total = 0;
		$('input[name="transient_rd_price[]"]').each(function()
		{
			tm_total += parseFloat($(this).val());
		});
		$('input#tr_total').val(formatMoney(tm_total));
		
	}
});</script>
<div class="transient_category">Data Biaya Route</div>
<div>
<form id="tform">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="transient_contact"> 
	<thead>
		<tr>
            <th>Nama Biaya</th>
            <th>Biaya</th>
           <!--<th>Harga Approved</th>-->
		</tr> 
	</thead> 
	<tbody> 	
	</tbody>
</table>
<div class="command_table" style="text-align:left;">
 <table align="right">
          <tr>
            <td><span class="summary_total"> Total Biaya</span></td>
            <td><input id="tr_total" value="<?= $location_total_cost?>" type="text" readonly="readonly" class="format_money" size="50" />
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