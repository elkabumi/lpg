<script type="text/javascript">	
$(function(){
	createForm({
		id 				: "#id_form_nya", 
		actionTarget	: "tr_cost_detail_report/form_action",
		backPage		: "tr_cost_detail_report",
		nextPage		: "tr_cost_detail_report"
	});
	var otb = createTableFormTransient({
		id 				: "#transient_contact",
		listSource 		: "tr_cost_detail_report/detail_table_loader/0",
		formSource 		: "tr_cost_detail_report/detail_form/<?=$row_id?>",
		controlTarget	: "tr_cost_detail_report/detail_form_action"
	});
	var otb2 = createTableFormTransient({
		id 				: "#transient_contact2",
		listSource 		: "tr_cost_detail_report/detail_table_loader2/0",
		formSource 		: "tr_cost_detail_report/detail_form2/<?=$row_id?>",
		controlTarget	: "tr_cost_detail_report/detail_form_action2"
	});

	$('#preview').click(function(){
	
			var date 		= ($('input[name="i_date"]').val()) ? $('input[name="i_date"]').val() : "0";
			
			if(date == 0){
					alert('Tanggal  tidak boleh kosong');
			}else{
					var explode  = date.split('/');
					var new_date  = explode[2]+"-"+explode[1]+"-"+explode[0];
				
					otb.fnSettings().sAjaxSource = site_url + "tr_cost_detail_report/detail_table_loader/"+new_date;
					otb.fnReloadAjax();
					otb2.fnSettings().sAjaxSource = site_url + "tr_cost_detail_report/detail_table_loader2/"+new_date;
					otb2.fnReloadAjax();
				
				var data ='date='+date; 
				$.ajax({
				type: 'POST',
				url: '<?=site_url('tr_cost_detail_report/get_total_cost')?>',
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
			if(confirm("Download Laporan Biaya Harian?") == true){
				var date 		= ($('input[name="i_date"]').val()) ? $('input[name="i_date"]').val() : "0";
		
				if(date == 0){
						alert('Tanggal  tidak boleh kosong');
				}else{
					var explode  = date.split('/');
					var new_date  = explode[2]+"-"+explode[1]+"-"+explode[0];
				
					location.href  = site_url + "tr_cost_detail_report/report/"+new_date;
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

<form class="form_class" id="id_form_nya">	
<div class="form_area">
<div class="form_area_frame">
<table>
	<tr>
	 <input type="hidden" name="row_id" value="<?=$row_id?>" /></td>
   </tr>
      <tr>
     <td>Tanggal Biaya</td>
     <td width="1%">:</td>
     <td><input name="i_date" type="text" id="i_date" value="<?=$date ?>" class="date_input" size="10"/>
     </td>
     </tr>
  </table>
<div class="command_bar">
  <input type="button" id="preview" value="preview"   />
    <input type="button" id="print3" value="Download Xls" />
	
  </div>
     </table>
    <table width="100%" cellpadding="1">
    <tr>
    <td>
   