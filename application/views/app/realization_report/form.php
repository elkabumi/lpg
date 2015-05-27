<script type="text/javascript">	
$(function(){
	createForm({
		id 				: "#id_form_nya", 
		actionTarget	: "realization_report/form_action",
		backPage		: "realization_report",
		nextPage		: "realization_report"
	});
	var otb = createTableFormTransient({
		id 				: "#transient_contact",
		listSource 		: "realization_report/detail_table_loader_kulak/0",
		formSource 		: "realization_report/detail_form_kulak/<?=$row_id?>",
		controlTarget	: "realization_report/detail_form_action_kulak",
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
				
					otb.fnSettings().sAjaxSource = site_url + "realization_report/detail_table_loader_kulak/"+new_date;
					otb.fnReloadAjax();
			}
	
	});
	
	
	$('#print_student').click(function(){
			
				
			var date_1 		= ($('input[name="i_date"]').val()) ? $('input[name="i_date"]').val() : "0";
			if(date_1 == 0){
				alert('Tanggal tidak boleh kosong');
			}
			else{
				if(confirm("Download  Pembelian ?") == true){
					var explode_1  = date_1.split('/');
					var new_date_1  = explode_1[2]+"-"+explode_1[1]+"-"+explode_1[0];
				
			
			location.href  = site_url + "realization_report/report/"+new_date_1;
			}
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
     <td>Tanggal Realisasi</td>
     <td width="1%">:</td>
     <td><input name="i_date" type="text" id="i_date" value="<?=$tr_plan_detail_date_realization ?>" class="date_input" size="10"/>
     </td>
     </tr>
  </table>
<div class="command_bar">
 <input type="button" id="print_student" value="download xls"  style="width:100px;" />
  <input type="button" id="preview" value="preview"   />
  </div>
     </table>
    <table width="100%" cellpadding="1">
    <tr>
    <td>
   