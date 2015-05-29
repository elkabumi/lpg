
<? $format; ?>


<body>
<table>
  <tr>
  <th colspan="8"><?= $title ?></th>
  </tr>
  <tr>
  <th colspan="11"></th>
  </tr>
  
  </table>
<table>
 <tr>
  <th colspan="3">Gaji Driver dan kernet</th>
 </tr>
</table>
<table border="1" cellpadding="4" cellspacing="0" class="table table-bordered table-striped" id="example1">
<tr bgcolor="#dddddd">
	<th>&nbsp;&nbsp;&nbsp; No &nbsp;&nbsp;&nbsp;</th>
	<th>Nama</th>
	<th>gaji</th>                   
  	<?php 
	
		$no=1;
        $total_cost_driver_co=0;
		foreach($detail_cost_driver as $item):
	?>
	 <tr>
        <th><?=$no?></th>
        <th><?=$item['employee_name']?></th>
       	<th><?=tool_money_format($item['total_cost'])?></th>
 	</tr>
   
  <?php 
  	 $total_cost_driver_co+=($item['total_cost']);
	$no++; 
   endforeach; ?>
    <tr>
        <th colspan="2" align="right">Total:</th>
 		<th><?=tool_money_format($total_cost_driver_co) ?></th>
 	
    </tr>
</table>
<table>
 <tr>
  <th colspan="3"></th>
  </tr>
 <tr>
  <th colspan="3">Biaya Lain-Lain</th>
 </tr>

</table>
<table border="1" cellpadding="4" cellspacing="0" class="table table-bordered table-striped" id="example1">
<tr bgcolor="#dddddd">
	<th>&nbsp;&nbsp;&nbsp; No &nbsp;&nbsp;&nbsp;</th>
	<th>Biaya</th>
	<th>total</th>                  
  	<?php 
	
		$no=1;
        $total_cost=0;
		foreach($detail_cost_lain as $item2):
	?>
	 <tr>
        <th><?=$no?></th>
        <th><?=$item2['tr_cost_type_name']?></th>
       	<th><?=tool_money_format($item2['total_cost'])?></th>
 	</tr>
   
  <?php 
  	 $total_cost+=$item2['total_cost'];
	$no++; 
   endforeach; ?>
    <tr>
    	<th colspan="2" align="right">Total:</th>
 		<th><?=tool_money_format($total_cost) ?></th>
              
 	</tr>
</table>
</body>
