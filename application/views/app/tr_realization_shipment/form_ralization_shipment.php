<script type="text/javascript">	
$(function(){
	createForm({
		id 				: "#id_form_nya", 
		actionTarget	: "tr_realization_shipment/form_action",
		backPage		: "tr_realization_shipment",
		nextPage		: "tr_realization_shipment/index"
	});


	createDatePicker();
});

</script>

<form id="id_form_nya">
<div class="form_area">
<div class="form_area_frame">
<table  width="100%" cellpadding="4" class="form_layout">

<tr>
    <td width="196">Dari Lokasi</td>
    <td width="651">
    <input  readonly="readonly" name="i_from" type="text" id="i_nopol" value="<?=$route_from ?>" size="10"/></td>
    <input type="hidden" name="row_id" value="<?=$row_id?>" />
    <input type="hidden" name="date_back" value="<?=$tr_plan_detail_date_realization?>" /></td>
</tr>
<tr>
    <td width="196">Menuju Lokasi	</td>
    <td width="651">
    <input  readonly="readonly" name="i_to" type="text" id="i_driver" value="<?=$route_to ?>" size="10"/></td>
  	
   </td>
</tr>

<tr>
    <td width="196">Biaya Route</td>
    <td width="651">
    <input  readonly="readonly" name="i_co_driver" type="text" id="i_co_driver" value="<?=$tr_plan_detail_shipment_cost ?>" size="10"/></td>
   </td>
</tr>

    <tr>
    	 <td width="196">Jumlah Kirim</td>
    	 <td width="651"><input name="i_qty" type="text" id="i_qty" value="<?=$tr_plan_detail_shipment_qty ?>" size="10"/></td>
    </tr>
     <tr>
    	 <td width="196">Harga</td>
    	 <td width="651"><input name="i_price" type="text" id="i_price" value="<?=$tr_plan_detail_shipment_price ?>" size="10"/></td>
    </tr>
      <tr>
    	 <td width="196">Total Harga</td>
    	 <td width="651"><input readonly="readonly" name="i_total_price" type="text" id="i_total_price" value="<?=$tr_plan_detail_shipment_total_price ?>" size="10"/></td>
    </tr>
  </table>
 <div class="form_category">Realisasi</div>
	<table width="100%" cellpadding="4" class="form_layout">
	
    <tr>
      <td width="196">Tanggal Realisasi Pengiriman </td>
   	 <td width="651">	<input type="text" name="i_date" class="date_input" size="15" value="<?=$tr_plan_detail_shipment_realization_date	?>" />
      
      </td>
        
   </tr>
 	 <tr>
      	<td>Status</td>
      	<td><label>
        	 <input name="i_status_type"  type="radio"  value="0" <?php if($tr_plan_detail_shipment_status_realization	 == 0){ ?> checked="checked"<?php } ?> />
        			Belum Terealisai</label>
     		<br />
       		<label>
         	<input name="i_status_type"   type="radio"  value="1" <?php if($tr_plan_detail_shipment_status_realization	 == 1){ ?> checked="checked"<?php } ?>/>
         	 	Terealisasi
             </label>
        </td>
    </tr>
  </table>
 </div>
	
	<div class="command_bar">
<input type="button" id="submit" value="Simpan"/>
	<input type="button" id="enable" value="Edit"/>

	 	<a href="<?=site_url('tr_realization_shipment/index/'.$tr_plan_detail_date_realization.'')?>" style="text-align: center;font-size: 12px;
          font-weight:bold;
        width: 70px;
        background: #1CBB9B;
        padding: 12px 20px;
        line-height: 18px !important;
        line-height: 16px;
        height:80px;
        border-radius:3px;
        margin: 1px;
        cursor:pointer;
        border:1px solid #1CBB9B;
        color:#fff;
        text-shadow:0 -1px 0 rgba(0, 0, 0, 0.2);">Close</a>
 
	 
	</div>
</div>

</form>
    
  
   