<script type="text/javascript">	
$(function(){
	createForm({
		id 				: "#id_form_nya", 
		actionTarget	: "tr_plan/form_action",
		backPage		: "tr_plan",
		nextPage		: "tr_plan"
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
    <td width="651"><input type="text" name="i_date" class="date_input" size="15" value="<?=$tr_plan_date?>" /> 
    <input type="hidden" name="row_id" value="<?=$row_id?>" /></td>
    </tr>
</table>
</div>
<div class="command_bar">
	<input type="button" id="submit" value="Simpan"/>
	<input type="button" id="enable" value="Edit"/>
	<input type="button" id="cancel" value="Close" /> 
</div>
</div>
</form>

