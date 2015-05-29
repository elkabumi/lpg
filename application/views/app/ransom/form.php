<script type="text/javascript">	
$(function(){
	createForm({
		id 				: "#id_form_nya", 
		actionTarget	: "ransom/form_action",
		backPage		: "ransom",
		nextPage		: "ransom/form"
	});


	createDatePicker();
});

</script>

<form id="id_form_nya">
<div class="form_area">
<div class="form_area_frame">
<table  width="100%" cellpadding="4" class="form_layout">

<tr>
    <td width="196">Tanggal Tebusan</td>
    <td width="651"><input type="text" name="i_date" class="date_input" size="15" value="<?=$tr_plan_date?>" /> 
    <input type="hidden" name="row_id" value="<?=$row_id?>" /></td>
    </tr>
 </table>
     </table>
    <table width="100%" cellpadding="1">
    <tr>
    <td>

