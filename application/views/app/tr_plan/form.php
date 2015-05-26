<script type="text/javascript">	
$(function(){
	createForm({
		id 				: "#id_form_nya", 
		actionTarget	: "tr_plan/form_action",
		backPage		: "tr_plan",
		nextPage		: "tr_plan"
	});
	var otb = createTableFormTransient({
		id 				: "#transient_contact",
		listSource 		: "tr_plan/detail_table_loader_kulak/0",
		formSource 		: "tr_plan/detail_form_kulak/<?=$row_id?>",
		controlTarget	: "tr_plan/detail_form_action_kulak",
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
	$('#preview').click(function(){
	
			var date 		= ($('input[name="i_date"]').val()) ? $('input[name="i_date"]').val() : "0";
			
			if(date == 0){
					alert('Tanggal Tebusan tidak boleh kosong');
			}else{
					var explode  = date.split('/');
					var new_date  = explode[2]+"-"+explode[1]+"-"+explode[0];
				
					otb.fnSettings().sAjaxSource = site_url + "tr_plan/detail_table_loader_kulak/"+new_date;
					otb.fnReloadAjax();
			}
	
	});
	createDatePicker();
	//updateAll(); 
});
</script>

<form class="form_class" id="id_form_nya">	
<div class="form_area">
<div class="form_area_frame">
<table>
	<tr>
	 <input type="hidden" name="row_id" value="<?=$row_id?>" /></td>
   </tr>
      <tr>
     <td>Tanggal Plan</td>
     <td width="1%">:</td>
     <td><input name="i_date" type="text" id="i_date" value="<?=$tr_plan_date ?>" class="date_input" size="10"/>
     </td>
     </tr>
  </table>
<div class="command_bar">
  <input type="button" id="preview" value="preview"   />
  </div>
     </table>
    <table width="100%" cellpadding="1">
    <tr>
    <td>
   