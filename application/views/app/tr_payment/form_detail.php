<script type="text/javascript">	
$(function(){

	createForm({
		id 				: "#id_form_nya", 
		actionTarget	: "tr_payment/form_action",
		backPage		: "tr_payment",
		nextPage		: "tr_payment/index"
	});
	
	$('input[name="i_status"]').change(function(){
		
		var i_cek_status =  $('input[name="i_cek_status"]').val();
		var i_broken_qty_frame = document.getElementById("i_broken_qty");
		var i_broken_total_frame = document.getElementById("i_broken_total");
		
		if(i_cek_status == "0"){
			i_broken_qty_frame.style.display = 'inline';
			i_broken_total_frame.style.display = 'inline';
			$('input[name="i_cek_status"]').val("1");
		}else{
			i_broken_qty_frame.style.display = 'none';
			i_broken_total_frame.style.display = 'none';
			$('input[name="i_broken_qty"]').val("0");
			$('input[name="i_broken_total"]').val("0");
			$('input[name="i_cek_status"]').val("0");
			
		}
	});
	
	$('input[name="i_broken_qty"]').change(function(){
		
		var i_broken_qty =  $('input[name="i_broken_qty"]').val();
		var i_location_price = $('input[name="i_location_price"]').val();
		var total = i_broken_qty * i_location_price;
		
		$('input[name="i_broken_total"]').val(total);
		
	});
	createDatePicker();
	//updateAll(); 
});

</script>
<form class="form_class" id="id_form_nya">	
<div class="form_area">
<div class="form_area_frame">
		<table width="100%" cellpadding="4" class="form_layout">
        <tr>
          <td width="17%">Tanggal Realisasi</td>
          <td width="1%">:</td>
          <td width="82%"><input readonly="readonly" type="text" id="i_pic_asuransi" name="i_pic_asuransi" value="<?=$tr_plan_detail_shipment_realization_date?>" />
          <input type="hidden" name="row_id" value="<?=$row_id?>" /></td>
        </tr>
      <tr>
     <td>
        <tr>
          <td width="23%">Pangkalan</td>
          <td width="1%">:</td>
          <td width="82%"><input readonly="readonly" type="text" id="i_location" name="i_location" value="<?=$location_name?>"/></td>
        </tr>
            <tr>
     <td>
        <tr>
          <td width="17%">Jumlah</td>
          <td width="1%">:</td>
          <td width="82%"><input readonly="readonly" type="text" id="i_registration_dp" name="i_registration_dp" value="<?=$tr_plan_detail_shipment_qty?>" /></td>
      </tr>
       <tr>
          <td width="17%">Tagihan</td>
          <td width="1%">:</td>
          <td width="82%"><input readonly="readonly" type="text" id="i_tagiahn" name="i_tagiahn"  value="<?=$tr_plan_detail_shipment_total_price?>" /></td>
        </tr>
        <tr>
          <td width="17%">Dibayar</td>
          <td width="1%">:</td>
          <td width="82%"><input readonly="readonly" type="text" id="i_pkb_no" name="i_pkb_no" value="<?=$tr_plan_detail_shipment_total_paid?>" /></td>
        </tr>
		<tr>
		<td width="17%">Kembali Karena Rusak</td>
         <td width="1%">:</td>
	  <td width="41%"><input name="i_broken_qty" type="text" id="i_broken_qty" style="text-align:right; <?php if($broken_status == 0){ ?> display:none;<?php }?>" value="<?=$broken_qty ?>" size="15" <?php if($broken_status == 1){ ?> readonly="readonly"<?php }?>  />
      <input name="i_broken_total" type="text" id="i_broken_total" style="text-align:right; <?php if($broken_status == 0){ ?> display:none;<?php }?>" value="<?=$broken_total ?>" size="15"  readonly="readonly"  />
      <input name="i_status" type="checkbox" id="i_status" value="1" <?php if($broken_status == 1){ ?> checked="checked" style="display:none;" <?php }?> />
      <input type="hidden" name="i_cek_status" value="<?=$broken_status ? $broken_status:0?>"/>
      <input type="hidden" name="i_location_price" value="<?=$location_price ?>"/>
      </td>
	</tr>
    <tr>
          <td width="17%">Kode Verifikasi</td>
          <td width="1%">:</td>
          <td width="82%"><input type="text" id="i_verifikasi" name="i_verifikasi" value="" /></td>
          </tr>
 </table>
    <table width="100%" cellpadding="1">
    <tr>
    <td>