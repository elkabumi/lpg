
<? $format; ?>


<body>
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
                                             	<th>&nbsp;&nbsp;&nbsp; No &nbsp;&nbsp;&nbsp;</th>
                                                                                       
                                                    <th>Tanggal Tebusan</th>
                                                    <th>Nomor DO</th>
                                                    <th>Tanggal Pengambilan</th>
                                        
                                                    <th>Truck Nopol</th>
                                                    <th>SPBE</th>
                                                    <th>Jumlah Kulak</th>
                                                    <th>Total Harga Kulak</th>
                                                    <th>Biaya Sopir</th>
                                                    <th>Biaya Kernet</th>
                                                    <th>Biaya Lain-Lain</th>
                                                    <th>Status</th>
           
                                            </tr>
                                        
  
		<?php $no=1;
           foreach($detail as $item):
		  
      		if($item['tr_plan_detail_status_realization'] == 0){
					$status='Belum Terealisasi';
				}else{
					$status='Telah Terealisasi';
				}

		 
		 ?>
        								  <tr>
          		
                                               <th><?=$no?></th>
                                               <th><?=$item['tr_plan_date']?></th>
                                               <th><?=$item['tr_plan_detail_code']?></th>
                                               <th><?=$item['tr_plan_detail_date_realization']?></th>
                                               <th><?=$item['truck_nopol']?></th>
                                               <th><?=$item['location_name']?></th>
                                               <th><?=$item['tr_plan_detail_qty']?></th>
                                              
                                               <th><?=tool_money_format($item['tr_plan_detail_total_purchase'])?></th>
                                               <th><?=tool_money_format($item['tr_plan_detail_cost_driver'])?></th>
                                               <th><?=tool_money_format($item['tr_plan_detail_cost_co_driver'])?></th>
                                               <th><?=tool_money_format($item['tr_plan_detail_cost_lain'])?></th>
                                                <th><? $status?></th>
                                           
          
          </tr>
            <?php $no++; 
             endforeach; ?>
             
        </table>

</body>
