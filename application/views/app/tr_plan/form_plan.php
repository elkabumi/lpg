<script type="text/javascript">	
$(function(){
	createForm({
		id 				: "#id_form_nya", 
		actionTarget	: "tr_plan/form_plan_action",
		backPage		: "tr_plan",
		nextPage		: "tr_plan/form_plan"
	});


	createDatePicker();
});

</script>

<form id="id_form_nya">
<div class="form_area">
<div class="form_area_frame">
<table  width="100%" cellpadding="4" class="form_layout">

<tr>
    <td width="196">Truck Nopol	</td>
    <td width="651">
    <input name="i_nopol" type="text" id="i_nopol" value="<?=$truck_nopol ?>" size="10"/></td>
    <input type="hidden" name="row_id" value="<?=$row_id?>" /></td>
</tr>
<tr>
    <td width="196">Nama Sopir	</td>
    <td width="651">
    <input name="i_driver" type="text" id="i_driver" value="<?=$driver_name ?>" size="10"/></td>
  	
   </td>
</tr>

<tr>
    <td width="196">Nama Kernet	</td>
    <td width="651">
    <input name="i_co_driver" type="text" id="i_co_driver" value="<?=$co_driver_name ?>" size="10"/></td>
   </td>
</tr>

<tr>
    <td width="196">Nama SPBE	</td>
    <td width="651">
    <input name="i_spbe" type="text" id="i_spbe" value="<?=$location_name ?>" size="10"/></td>
   </td>
</tr>
<tr>
    <td width="196">Jumlah Kulak</td>
    <td width="651">
    <input name="i_qty_kulak" type="text" id="i_qty_kulak" value="<?=$tr_plan_detail_qty ?>" size="10"/></td>
</td>
<tr>
    <td width="196">Jumlah Kirim</td>
    <td width="651">
    <input name="i_send" type="text" id="i_send" value="<?=$tr_plan_detail_qty_shipment ?>" size="10"/></td>
</td>
<tr>
    <td width="196">Jumlah sisa</td>
    <td width="651">
    <input name="i_sisa" type="text" id="i_sisa" value="<?=$tr_plan_detail_qty_sisa ?>" size="10"/></td>
</td>
<tr>
    <td width="196">Harga Satuan</td>
    <td width="651">
    <input name="i_purchase" type="text" id="i_purchase" value="<?=$tr_plan_detail_purchase ?>" size="10"/></td>
   </td>
</tr>
<tr>
    <td width="196">Total Harga</td>
    <td width="651">
    <input name="i_purchase_total" type="text" id="i_purchase_total" value="<?=$tr_plan_detail_total_purchase ?>" size="10"/></td>
   </td>
</tr>
</table>
<div class="form_category">Biaya Tambahan</div>
	<table width="100%" cellpadding="4" class="form_layout">
	
     <tr>
   	 <td width="196">Biaya Sopir</td>
    	 <td width="651"><input name="i_cost_driver" type="text" id="i_cost_driver" value="<?=$tr_plan_detail_cost_driver ?>" size="10"/></td>
     </tr>
 	 <tr>
   	 	<td width="196">Biaya Kernet</td>
     	<td width="651"><input name="i_cost_co_driver" type="text" id="i_cost_co_driver" value="<?=$tr_plan_detail_cost_co_driver ?>" size="10"/></td>
 	 </tr>
       <tr>
   	 <td width="196">Biaya Lain-Lain</td>
    	 <td width="651"><input name="i_cost_lain" type="text" id="i_cost_lain" value="<?=$tr_plan_detail_cost_lain ?>" size="10"/></td>
     </tr>
 	
</table>
</div>

<div class="command_bar">
	   <input type="button" id="submit" value="Simpan"/>
	<input type="button" id="enable" value="Edit"/>
    <!---
 
	<input type="button" id="cancel" value="Batal" /> 
    -->
    <a href="<?=site_url('tr_plan/form/'.$tr_plan_id.'')?>" class='link_button'>Back</a>
</div>

</div>
</form>

