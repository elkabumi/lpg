<script type="text/javascript">	
$(function(){
	createTableFormTransient({
		id 				: "#transient_contact",
		listSource 		: "ransom/detail_list_loader/<?=$row_id?>",
		formSource 		: "ransom/detail_form/<?=$row_id?>",
		controlTarget	: "ransom/detail_form_action",
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
<div class="transient_category">Data Tebusan</div>
<div>
<form id="tform">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="transient_contact"> 
	<thead>
		<tr>
       		<th>No</th>
            <th>SPBE</th>
            <th>Jumlah Tebusan</th>
      </tr> 
	</thead> 
	<tbody> 	
	</tbody>
</table>
<div class="command_table" style="text-align:left;">
 <table align="right">
          <tr>
            <td><span class="summary_total"> Total Tebusan</span></td>
            <td><input id="td_total" value="<?//= $tr_plan_total_purchase?>" type="text" readonly="readonly" class="format_money" size="50" />
           </td>
          </tr>
        </table>
      <input type="button" id="add" value="Tambah"/>
	<!--<input type="button" id="edit" value="Revisi"/>-->
    <input type="button" id="delete" value="Hapus"/>
   
</div>
<div id="editor"></div>
</form>
</div>