<script type="text/javascript">	
$(function(){
	
});
</script>
<form class="subform_area">
<div class="form_area_frame">
<table width="100%" cellpadding="4" class="form_layout">

    <tr>
     <td width="196">Nama Biaya</td> 
       <td width="651"><input name="i_name" type="text" id="i_name" value="<?=$transient_rd_name?>"  size="10"/>
	  </td>
     </tr>

      <tr>
     <td>Biaya</td> 
       <td><input name="i_cost" type="text" id="i_cost" value="<?=$transient_rd_price?>" size="10"/>
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
