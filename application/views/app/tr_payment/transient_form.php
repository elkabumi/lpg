<script type="text/javascript">	
$(function(){
	createDatePicker();
});
</script>
<form class="subform_area">
<div class="form_area_frame">
<table width="100%" cellpadding="4" class="form_layout">

    <tr>
     <td width="196">Tanggal</td> 
       <td width="651"><input name="i_date" type="text" id="i_date" class="date_input" size="10" value="<?=$tr_payment_date ?>" />
     <input type="hidden" name="i_index" value="<?=$index?>" />
	  </td>
     </tr>

      <tr>
     <td>Keterangan</td> 
       <td><input name="i_description" type="text" id="i_description" size="10" value="<?=$tr_payment_description ?>" />
       </td>
    </tr>
    
    <tr>
     <td>Bayar</td> 
       <td><input name="i_price" type="text" id="i_price" size="10" value="<?=$tr_payment_pembayaran ?>" />
       </td>
    </tr>

</table>
</div>
<div class="command_bar">
	<input type="button" id="submit" value="Save" />
	<input type="reset" id="reset"  value="Reset" />
	<input type="button" id="cancel" value="Cancel"  />
</div>
</form>

