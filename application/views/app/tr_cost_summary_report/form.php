<script type="text/javascript">	
$(function(){
	createForm({
		id 				: "#id_form_nya", 
		actionTarget	: "tr_cost_summary_report/form_action",
		backPage		: "tr_cost_summary_report",
		nextPage		: "tr_cost_summary_report"
	});
	var otb = createTableFormTransient({
		id 				: "#transient_contact",
		listSource 		: "tr_cost_summary_report/detail_table_loader/0/0",
		formSource 		: "tr_cost_summary_report/detail_form/<?=$row_id?>",
		controlTarget	: "tr_cost_summary_report/detail_form_action"
	});
	var otb2 = createTableFormTransient({
		id 				: "#transient_contact2",
		listSource 		: "tr_cost_summary_report/detail_table_loader2/0/0",
		formSource 		: "tr_cost_summary_report/detail_form2/<?=$row_id?>",
		controlTarget	: "tr_cost_summary_report/detail_form_action2"
	});
	$('#preview').click(function(){
			var date_1 		= ($('input[name="i_date_1"]').val()) ? $('input[name="i_date_1"]').val() : "0";
			var date_2 		= ($('input[name="i_date_2"]').val()) ? $('input[name="i_date_2"]').val() : "0";
			if(date_1 == 0){
				alert('Tanggal Mulai tidak boleh kosong');
			}
			if(date_2 == 0){
					alert('Tanggal Sampai tidak boleh kosong');
			}else{
					var explode_1  = date_1.split('/');
					var new_date_1  = explode_1[2]+"-"+explode_1[1]+"-"+explode_1[0];
				
					
					var explode_2  = date_2.split('/');
					var new_date_2  = explode_2[2]+"-"+explode_2[1]+"-"+explode_2[0];
				
					otb.fnSettings().sAjaxSource = site_url + "tr_cost_summary_report/detail_table_loader/"+new_date_1+"/"+new_date_2;
					otb.fnReloadAjax();
					otb2.fnSettings().sAjaxSource = site_url + "tr_cost_summary_report/detail_table_loader2/"+new_date_1+"/"+new_date_2;
					otb2.fnReloadAjax();
			
			
				var data ='date='+date_1+'-'+date_2; 
				$.ajax({
				type: 'POST',
				url: '<?=site_url('tr_cost_summary_report/get_total_cost')?>',
				data: data,
				dataType: 'json',
				success: function(data){	
					$('input#tcd_total').val(formatMoney(data.content['total_cost_driver_co']));
					$('input#tc_total').val(formatMoney(data.content['total_cost']));	
				}
				
				});	
			
			
			}
	
	});
	$('#print3').click(function(){
			var date_1 		= ($('input[name="i_date_1"]').val()) ? $('input[name="i_date_1"]').val() : "0";
			var date_2 		= ($('input[name="i_date_2"]').val()) ? $('input[name="i_date_2"]').val() : "0";
			if(date_1 == 0){
				alert('Tanggal Mulai tidak boleh kosong');
			}
			if(date_2 == 0){
					alert('Tanggal Sampai tidak boleh kosong');
			}else{
				if(confirm("Download  laporan Biaya Summary ?") == true){
					var explode_1  = date_1.split('/');
					var new_date_1  = explode_1[2]+"-"+explode_1[1]+"-"+explode_1[0];
				
					
					var explode_2  = date_2.split('/');
					var new_date_2  = explode_2[2]+"-"+explode_2[1]+"-"+explode_2[0];
				
			
					location.href  = site_url + "tr_cost_summary_report/report/"+new_date_1+"/"+new_date_2;
	//}
				//location.href = site_url + 'po_reservation_summary_report/report/' + $('input[name="i_phase_id"]').val() +"/"+ $('input[name="i_project_id"]').val() +"/"+ $('input[name="i_product_category_id"]').val()+"/"+ $('input[name="i_transaction_id"]').val();
			
			
			}
			//alert(id);
	}
	});
	createDatePicker();
	//updateAll(); 
});
</script>

<<form class="form_class" id="id_form_nya">	
<div class="form_area">
<div class="form_area_frame">
		<tr>
	 <input type="hidden" name="row_id" value="<?=$row_id?>" /></td>
   </tr>
      <tr>
     <td>Mulai</td>
     <td width="1%">:</td>
     <td><input name="i_date_1" type="text" id="i_date_1" value="<?=$date_1 ?>" class="date_input" size="10"/></td>
     </tr>
     <tr>
   	<td>Sampai</td>
     <td width="1%">:</td>
       <td><input name="i_date_2" type="text" id="i_date_2" value="<?=$date_1 ?>" class="date_input" size="10"/></td>
     </tr>
  
   </table>
     </div>
	
	<div class="command_bar">

	 <input type="button" id="print3" value="download xls"  style="width:100px;" />
	<input type="button" id="preview" value="preview"   />

	 
	 
	</div>
</div>
<!-- table contact -->

</form>