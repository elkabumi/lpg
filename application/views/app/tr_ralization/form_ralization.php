<script type="text/javascript">	
$(function(){
	createForm({
		id 				: "#id_form_nya", 
		actionTarget	: "tr_ralization/form_action",
		backPage		: "tr_ralization",
		nextPage		: "tr_ralization/index"
	});


	createDatePicker();
});

</script>

<form id="id_form_nya">
<div class="form_area">
<div class="form_area_frame">
<table  width="100%" cellpadding="4" class="form_layout">

<tr>
    <td width="196">Truck Nopol	</td>
    <td width="651">
    <input  readonly="readonly" name="i_nopol" type="text" id="i_nopol" value="<?=$truck_nopol ?>" size="10"/></td>
    <input type="hidden" name="row_id" value="<?=$row_id?>" />
    <input type="hidden" name="date_back" value="<?=$tr_plan_date?>" /></td>
</tr>
<tr>
    <td width="196">Nama Sopir	</td>
    <td width="651">
    <input  readonly="readonly" name="i_driver" type="text" id="i_driver" value="<?=$driver_name ?>" size="10"/></td>
  	
   </td>
</tr>

<tr>
    <td width="196">Nama Kernet	</td>
    <td width="651">
    <input  readonly="readonly" name="i_co_driver" type="text" id="i_co_driver" value="<?=$co_driver_name ?>" size="10"/></td>
   </td>
</tr>

<tr>
    <td width="196">Nama SPBE	</td>
    <td width="651">
    <input readonly="readonly"  name="i_spbe" type="text" id="i_spbe" value="<?=$location_name ?>" size="10"/></td>
   </td>
</tr>
<tr>
    <td width="196">Jumlah Kulak</td>
    <td width="651">
    <input  readonly="readonly"  name="i_qty_kulak" type="text" id="i_qty_kulak" value="<?=$tr_plan_detail_qty ?>" size="10"/></td>
</td>
<tr>
    <td width="196">Jumlah Kirim</td>
    <td width="651">
    <input  readonly="readonly"  name="i_send" type="text" id="i_send" value="<?=$tr_plan_detail_qty_shipment ?>" size="10"/></td>
</td>
<tr>
    <td width="196">Jumlah sisa</td>
    <td width="651">
    <input  readonly="readonly"  name="i_sisa" type="text" id="i_sisa" value="<?=$tr_plan_detail_qty_sisa ?>" size="10"/></td>
</td>
<tr>
    <td width="196">Harga Satuan</td>
    <td width="651">
    <input  readonly="readonly"  name="i_purchase" type="text" id="i_purchase" value="<?=$tr_plan_detail_purchase ?>" size="10"/></td>
   </td>
</tr>
<tr>
    <td width="196">Total Harga</td>
    <td width="651">
    <input readonly="readonly"   name="i_purchase_total" type="text" id="i_purchase_total" value="<?=$tr_plan_detail_total_purchase ?>" size="10"/></td>
   </td>
</tr>
</table>
<div class="form_category">Biaya Tambahan</div>
	<table width="100%" cellpadding="4" class="form_layout">
	
     <tr>
   	 <td width="196">Biaya Sopir</td>
    	 <td width="651"><input readonly="readonly"   name="i_cost_driver" type="text" id="i_cost_driver" value="<?=$tr_plan_detail_cost_driver ?>" size="10"/></td>
     </tr>
 	 <tr>
   	 	<td width="196">Biaya Kernet</td>
     	<td width="651"><input readonly="readonly"   name="i_cost_co_driver" type="text" id="i_cost_co_driver" value="<?=$tr_plan_detail_cost_co_driver ?>" size="10"/></td>
 	 </tr>
       <tr>
   	 <td width="196">Biaya Lain-Lain</td>
    	 <td width="651"><input  readonly="readonly"  name="i_cost_lain" type="text" id="i_cost_lain" value="<?=$tr_plan_detail_cost_lain ?>" size="10"/></td>

     </tr>
  </table>
 <div class="form_category">Realisasi</div>
	<table width="100%" cellpadding="4" class="form_layout">
	<tr>
      <td width="196">No. Do </td>
   	 <td width="651">	<input  name="i_code" type="text" id="i_code" value="<?=$tr_plan_detail_code ?>" size="10"/></td>

      </td>
        
   </tr>
    <tr>
      <td width="196">Tanggal Realisasi Pengambilan </td>
   	 <td width="651">	<input type="text" name="i_date" class="date_input" size="15" value="<?=$tr_plan_detail_date_realization?>" />
      
      </td>
        
   </tr>
 	 <tr>
      	<td>Status</td>
      	<td><label>
        	 <input name="i_status_type"  type="radio"  value="0" <?php if($tr_plan_detail_status_realization == 0){ ?> checked="checked"<?php } ?> />
        			Belum Terealisai</label>
     		<br />
       		<label>
         	<input name="i_status_type"   type="radio"  value="1" <?php if($tr_plan_detail_status_realization == 1){ ?> checked="checked"<?php } ?>/>
         	 	Terealisasi
             </label>
        </td>
    </tr>
  </table>
 </div>
	
	<div class="command_bar">
<input type="button" id="submit" value="Simpan"/>
		<input type="button" id="enable" value="Edit"/>

	 	<a href="<?=site_url('tr_ralization/index/'.$tr_plan_date.'')?>" style="text-align: center;font-size: 12px;
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
    
  
   