<script type="text/javascript">	
$(function(){
	createForm({
		id 				: "#id_form_nya", 
		actionTarget	: "tr_shipment_report/form_action",
		backPage		: "tr_shipment_report",
		nextPage		: "tr_shipment_report"
	});
	var otb = createTableFormTransient({
		id 				: "#transient_contact",
		listSource 		: "tr_shipment_report/detail_table_loader_shipment/0",
		formSource 		: "tr_shipment_report/detail_form_shipment/<?=$row_id?>",
		controlTarget	: "tr_shipment_report/detail_form_action_shipment",
		onAdd		: function (){perhitungan();},	
		onTargetLoad: function (){perhitungan();} 
	});
	$('#preview').click(function(){
	
			var date 		= ($('input[name="i_date"]').val()) ? $('input[name="i_date"]').val() : "0";
			
			if(date == 0){
					alert('Tanggal Pengiriman tidak boleh kosong');
			}else{
					var explode  = date.split('/');
					var new_date  = explode[2]+"-"+explode[1]+"-"+explode[0];
				
					otb.fnSettings().sAjaxSource = site_url + "tr_shipment_report/detail_table_loader_shipment/"+new_date;
					otb.fnReloadAjax();
			}
	
	});
	$('#print').click(function(){
			if(confirm("Download Laporan Penjualan Harian?") == true){
				var date 		= ($('input[name="i_date"]').val()) ? $('input[name="i_date"]').val() : "0";
		
			if(date == 0){
					alert('Tanggal Pengiriman tidak boleh kosong');
			}else{
					var explode  = date.split('/');
					var new_date  = explode[2]+"-"+explode[1]+"-"+explode[0];
				
					location.href  = site_url + "tr_shipment_report/report/"+new_date;
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
     <td>Tanggal Pengiriman</td>
     <td width="1%">:</td>
     <td><input name="i_date" type="text" id="i_date" value="<?=$tr_plan_detail_date_realization ?>" class="date_input" size="10"/>
     </td>
     </tr>
  </table>
<div class="command_bar">
  <input type="button" id="preview" value="preview"   />
    <input type="button" id="print" value="Download Xls"  style="width:100px;"  />
	
  </div>
     </table>
    <table width="100%" cellpadding="1">
    <tr>
    <td>
   