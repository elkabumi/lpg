
<? $format; ?>

<table>
  <tr>
  <th colspan="11"><?= $title ?></th>
  </tr>
  <tr>
  <th colspan="11"></th>
  </tr>
  
  </table>
	 <table border="1" cellpadding="4" cellspacing="0" class="table table-bordered table-striped" id="example1">
        <tr bgcolor="#dddddd">
 			<th>&nbsp;&nbsp;No&nbsp;&nbsp;</th>
            <th>&nbsp;&nbsp;Nomor DO&nbsp;&nbsp;</th>
            <th>&nbsp;&nbsp;Tanggal Pengambilan&nbsp;&nbsp;</th>
			<th>&nbsp;&nbsp;Truck Nopol&nbsp;&nbsp;</th>
            <th>&nbsp;&nbsp;SPBE&nbsp;&nbsp;</th>
       		<th>&nbsp;&nbsp;Tanggal Kirim&nbsp;&nbsp;</th>
            <th>&nbsp;&nbsp;Dari&nbsp;&nbsp;</th>
            <th>&nbsp;&nbsp;Ke Pangakalan&nbsp;&nbsp;</th>
            <th>&nbsp;&nbsp;Jumlah Kirim&nbsp;&nbsp;</th>
            <th>&nbsp;&nbsp;Total Harga Kirim&nbsp;&nbsp;</th>
            <th>&nbsp;&nbsp;BIaya Kirim&nbsp;&nbsp;</th>
  </tr>

<?php $no=1;
   foreach($detail as $item): 
	?>
    <tr valign="middle" >
    <td width="25" height="20"><?=$no;?></td>
    <td width="25" ><?=$item['tr_plan_detail_code']?></td>
    <td width="25" align="center"><?=$item['tr_plan_detail_date_realization']?></td>
    <td width="25" ><?=$item['truck_nopol']?></td>
    <td width="25" ><?=$item['spbe']?></td>
    <td width="25" align="center"><?=$item['tr_plan_detail_shipment_realization_date']?></td>
   <td width="25" ><?=$item['route_from']?></td>
    <td width="25" ><?=$item['route_to']?></td>
    <td width="25" ><?=$item['tr_plan_detail_shipment_qty']?></td>
   <td width="25" ><?=format_money($item['tr_plan_detail_shipment_total_price'])?></td>
   <td width="25" ><?=format_money($item['tr_plan_detail_shipment_cost'])?></td>
   


  
   </tr>
    <?php $no++; 
	 endforeach; ?>
     
</table>

</body>
