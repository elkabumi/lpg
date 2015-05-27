
<? $format; ?>

<style>
body{
	font-size:8px;
	letter-spacing:1;
	font-family:calibri;
	text-transform:uppercase;
}
</style>
<body>
<table>
  <tr>
  	<th>&nbsp;</th>
  	<th>&nbsp;</th>
  	<th>&nbsp;</th>
  	<th>&nbsp;</th>
  </tr>
  </table>
<table width="155%"cellspacing="0" cellpadding="0" class="tab" border="1">
  <tr align="center" valign="middle"   bgcolor="#00B0f0">
 	<th>No</th>
            <th>Nomor DO</th>
            <th>Tanggal Pengambilan</th>
			<th>Truck Nopol</th>
            <th>SPBE</th>
       		<th>Tanggal Kirim</th>
            <th>Dari</th>
            <th>Ke Pangakalan</th>
            <th>Jumlah Kirim</th>
            <th>Total Harga Kirim</th>
            <th>BIaya Kirim</th>
  </tr>
   </table>
  <table>
<?php $no=1;
   foreach($data as $item): 
	?>
    <tr valign="middle" >
    <td width="25" height="20" <?= $style?>>&nbsp;<?=$no;?>&nbsp;</td>
    <td width="25" <?= $style?>>&nbsp;<?=$item['tr_plan_detail_code']?>&nbsp;</td>
    <td width="25" <?= $style?>>&nbsp;<?=$item['tr_plan_detail_date_realization']?>&nbsp;</td>
    <td width="25" <?= $style?>>&nbsp;<?=$item['truck_nopol']?>&nbsp;</td>
    <td width="25" <?= $style?>>&nbsp;<?=$item['spbe']?>&nbsp;</td>
    <td width="25" <?= $style?>>&nbsp;<?=$item['tr_plan_detail_shipment_realization_date']?>&nbsp;</td>
   <td width="25" <?= $style?>>&nbsp;<?=$item['route_from']?>&nbsp;</td>
    <td width="25" <?= $style?>>&nbsp;<?=$item['route_to']?>&nbsp;</td>
    <td width="25" <?= $style?>>&nbsp;<?=$item['tr_plan_detail_shipment_qty']?>&nbsp;</td>
   <td width="25" <?= $style?>>&nbsp;<?=$item['tr_plan_detail_shipment_total_price']?>&nbsp;</td>
   <td width="25" <?= $style?>>&nbsp;<?=$item['tr_plan_detail_shipment_cost']?>&nbsp;</td>
   


  
   </tr>
    <?php $no++; 
	 endforeach; ?>
     
</table>

</body>
