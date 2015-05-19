<script type="text/javascript">	
$(function(){
	createForm({
		id 				: "#id_form_nya", 
		actionTarget	: "cost/form_action",
		backPage		: "cost",
		nextPage		: "cost"
	});
	
	
	
	createDatePicker();
});

</script>

<form id="id_form_nya">
<div class="form_area">
<div class="form_area_frame">
<table  width="100%" cellpadding="4" class="form_layout">
	<tr>
     <td width="196">Harg Beli</td>
     <td width="651"><input name="i_purchase" type="text" id="i_purchase" value="<?=$cost_purchase ?>" />
     <input type="hidden" name="row_id" value="<?=$row_id?>" /></td>
   </tr>
   
  <tr>
     <td width="196">Gaji Sopir</td>
     <td width="651"><input name="i_cost_driver" type="text" id="i_cost_driver" value="<?=$cost_driver ?>" size="10"/></td>
     </tr>
  
 <tr>
  	 <td width="196">Gaji Kernet</td>
  	 <td width="651"><input name="i_cost_co_driver" type="text" id="i_cost_co_driver" value="<?=$cost_co_driver ?>" size="10"/></td>
  </tr>
  
</table>
</div>
<div class="command_bar">
	<input type="button" id="submit" value="Simpan"/>
	<input type="button" id="enable" value="Edit"/>
	<input type="button" id="cancel" value="Batal" /> 
</div>
</div>
</form>
