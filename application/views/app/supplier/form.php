<script type="text/javascript">	
$(function(){
	createForm({
		id 				: "#id_form_nya", 
		actionTarget	: "supplier/form_action",
		backPage		: "supplier",
		nextPage		: "supplier"
	});
	
	
	
	createDatePicker();
});

</script>

<form id="id_form_nya">
<div class="form_area">
<div class="form_area_frame">
<table  width="100%" cellpadding="4" class="form_layout">
	<tr>
     <td width="196">Nama SPBE</td>
     <td width="651"><input name="i_name" type="text" id="i_name" value="<?=$location_name ?>" />
     <input type="hidden" name="row_id" value="<?=$row_id?>" /></td>
   </tr>
   
  <tr>
     <td width="196">No.Telpn SPBE</td>
     <td width="651"><input name="i_phone" type="text" id="i_phone" value="<?=$location_phone ?>" size="10"/></td>
     </tr>
  
 <tr>
  	 <td width="196">Alamat</td>
     <td width="651"><textarea name="i_address" id="i_address" cols="45" rows="5"><?= $location_address ?></textarea></td>
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
