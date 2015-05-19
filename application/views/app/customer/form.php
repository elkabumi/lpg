<script type="text/javascript">	
$(function(){
	createForm({
		id 				: "#id_form_nya", 
		actionTarget	: "customer/form_action",
		backPage		: "customer",
		nextPage		: "customer"
	});
	
	
	
	createDatePicker();
});

</script>

<form id="id_form_nya">
<div class="form_area">
<div class="form_area_frame">
<table  width="100%" cellpadding="4" class="form_layout">
	<tr>
     <td width="196">Nama Pangkalan</td>
     <td width="651"><input name="i_name" type="text" id="i_name" value="<?=$location_name ?>" />
     <input type="hidden" name="row_id" value="<?=$row_id?>" /></td>
   </tr>
   
  <tr>
     <td width="196">No.Telpn Pangakalan</td>
     <td width="651"><input name="i_phone" type="text" id="i_phone" value="<?=$location_phone ?>" size="10"/></td>
     </tr>
  
 <tr>
  	 <td width="196">Alamat</td>
     <td width="651"><textarea name="i_address" id="i_address" cols="45" rows="5"><?= $location_address ?></textarea></td>
 </tr>
  <tr>
     <td width="196">RT/RW</td>
     <td width="651"><input name="i_rt" type="text" id="i_rt" value="<?=$location_rt_rw ?>" size="10"/></td>
     </tr>
  
 <tr>
  <tr>
     <td width="196">Kelurahan</td>
     <td width="651"><input name="i_kel" type="text" id="i_kel" value="<?=$location_kelurahan ?>" size="10"/></td>
     </tr>
 <tr>
   <tr>
     <td width="196">Kecamatan</td>
     <td width="651"><input name="i_kec" type="text" id="i_kec" value="<?=$location_kecamatan ?>" size="10"/></td>
     </tr>
 <tr>
 <tr>
   	 <td width="196">Kota</td>
     <td width="651"><input name="i_city" type="text" id="i_city" value="<?=$location_kota ?>" size="10"/></td>
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
