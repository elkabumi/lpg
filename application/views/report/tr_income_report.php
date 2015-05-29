
<? $format; ?>

<table>
  <tr>
  <th colspan="5"><?= $title ?></th>
  </tr>
  <tr>
  <th colspan="5"></th>
  </tr>
  
  </table>
	 <table border="1" cellpadding="4" cellspacing="0" class="table table-bordered table-striped" id="example1">
        <tr bgcolor="#dddddd">
 			<th>&nbsp;&nbsp;No&nbsp;&nbsp;</th>
            <th>&nbsp;&nbsp;Total pembelian DO&nbsp;&nbsp;</th>
            <th>&nbsp;&nbsp;Total penjualan&nbsp;&nbsp;</th>
            <th>&nbsp;&nbsp;Total biaya&nbsp;&nbsp;</th>
            <th>&nbsp;&nbsp;Total pendapatan&nbsp;&nbsp;</th>
   
  </tr>

<?php $no=1;
   foreach($detail as $item): 
	?>
    <tr valign="middle" >
    <td width="25" height="20"><?=$no;?></td>
    <td width="25" ><?=format_money($item['total_purcahse'])?></td>
   <td width="25" ><?=format_money($item['total_price'])?></td>
    <td width="25" ><?=format_money($item['total_cost'])?></td>
   <td width="25" ><?=format_money($item['total_income'])?></td>
   


  
   </tr>
    <?php $no++; 
	 endforeach; ?>
     
</table>

</body>
