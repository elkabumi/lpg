<script type="text/javascript">	
$(function(){

	createForm({
		id 				: "#id_form_nya", 
		actionTarget	: "tr_payment/form_action/<?=$row_id?>",
		backPage		: "tr_payment",
		nextPage		: "tr_payment/form/<?=$date?>"
	});
	
	var otb = createTableFormTransient({
		id 				: "#transient_detail",
		listSource 		: "tr_payment/detail_table_loader/<?=$date?>",
		formSource 		: "tr_payment/detail_form/<?=$row_id?>",
		controlTarget	: "tr_payment/detail_form_action",
	});
	$('#preview').click(function(){
	
			var date_1 		= ($('input[name="i_date_1"]').val()) ? $('input[name="i_date_1"]').val() : "0";
			
			if(date_1 == 0){
					alert('Tanggal Realisasi tidak boleh kosong');
			}else{
					var explode_1  = date_1.split('/');
					var new_date_1  = explode_1[2]+"-"+explode_1[1]+"-"+explode_1[0];
				
					otb.fnSettings().sAjaxSource = site_url + "tr_payment/detail_table_loader/"+new_date_1;
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
     <td>Tanggal Pengiriman</td>
     <td width="1%">:</td>
     <td><input name="i_date_1" type="text" id="i_date_1" value="<?=$tr_plan_detail_shipment_realization_date ?>" class="date_input" size="10"/></td>
     </tr>
  
   </table>
     </div>
	
	<div class="command_bar">

	<input type="button" id="preview" value="preview"   />

	 
	 
	</div>
</div>
<!-- table contact -->

</form>

