<script type="text/javascript">	
$(function(){

	createForm({
		id 				: "#id_form_nya", 
		actionTarget	: "tr_payment/form_action",
		backPage		: "tr_payment",
		nextPage		: "tr_payment/form/<?=$row_id?>"
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
          <td width="82%"><input readonly="readonly" type="text" id="i_spk_no" name="i_spk_no"  value="<?=$tr_plan_detail_shipment_total_price?>" /></td>
        </tr>
        <tr>
          <td width="17%">Dibayar</td>
          <td width="1%">:</td>
          <td width="82%"><input readonly="readonly" type="text" id="i_pkb_no" name="i_pkb_no" value="<?=$tr_plan_detail_shipment_total_paid?>" /></td>
        </tr>
     </table>
     </div>
	<div class="command_bar">
		<input type="button" id="submit" value="Simpan"/>
		<input type="button" id="enable" value="Edit"/>
	
		<input type="button" id="cancel" value="Batal"/>
	</div>
</div>
<!-- table contact -->

</form>

