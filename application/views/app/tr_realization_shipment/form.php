<script type="text/javascript">	
$(function(){
	createForm({
		id 				: "#id_form_nya", 
		actionTarget	: "tr_realization_shipment/form_action",
		backPage		: "tr_realization_shipment",
		nextPage		: "tr_realization_shipment"
	});
	var otb = createTableFormTransient({
		id 				: "#transient_contact",
		listSource 		: "tr_realization_shipment/detail_table_loader_shipment/0",
		formSource 		: "tr_realization_shipment/detail_form_shipment/<?=$row_id?>",
		controlTarget	: "tr_realization_shipment/detail_form_action_shipment",
		onAdd		: function (){perhitungan();},	
		onTargetLoad: function (){perhitungan();} 
	});
	$('#preview').click(function(){
	
			var date 		= ($('input[name="i_date"]').val()) ? $('input[name="i_date"]').val() : "0";
			
			if(date == 0){
					alert('Tanggal Pengambilan tidak boleh kosong');
			}else{
					var explode  = date.split('/');
					var new_date  = explode[2]+"-"+explode[1]+"-"+explode[0];
				
					otb.fnSettings().sAjaxSource = site_url + "tr_realization_shipment/detail_table_loader_shipment/"+new_date;
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
     <td>Tanggal Pengambilan</td>
     <td width="1%">:</td>
     <td><input name="i_date" type="text" id="i_date" value="<?=$tr_plan_detail_date_realization ?>" class="date_input" size="10"/>
     </td>
     </tr>
  </table>
</div>
<div class="command_bar">
  <input type="button" id="preview" value="preview"   />
</div>

</div>
</form>