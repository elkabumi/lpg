<style type="text/css" title="currentStyle"> 
.form_layout a:link  {
	color: #515EA6 !important;
	text-decoration: none;
}
.form_layout a:visited  {
	color: #515EA6 !important;
	text-decoration: none;
}
.form_layout a:hover  {
	color: #ff0000 !important;
	text-decoration: underline;
}
.higlight_box
{
color: #fff;
background-color: #515EA6;
}
</style>

     <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        13/05/2015
                                    </h3>
                                    <p>
                                        Tanggal
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                   
                                </a>
                            </div>
                        </div><!-- ./col -->
                        
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        <sup style="font-size: 16px">Rp </sup>6.468.000
                                    </h3>
                                    <p>
                                        Setoran
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        <sup style="font-size: 16px">Rp </sup>19.473
                                    </h3>
                                    <p>
                                        Pajak
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                   
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                       <sup style="font-size: 16px">Rp </sup>6.487.479
                                    </h3>
                                    <p>
                                        Tebusan
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                   
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->
 
 <div class="row">
<div class="col-lg-12 col-xs-12">                   
<div class="otbox">

<div class="otcontent">
<img src="<?=base_url()?>storage/home.jpg" style="width:100%;"/>
<form id="id_form_nya">
<div class="form_area">
<div class="form_area_frame">
<table class="form_layout" cellspacing="10" style="border-spacing:10px !important; padding:50px;" cellpadding="5" >
	<tr>
	<td><img src="<?=base_url()?>assets/images/smicon_person.png" align="left" /></td>
     <td width="150"><b>Nama pengguna</b></td>
     <td><?=$user_name?> (<?=$group_name?>)
</td>
   </tr>
   <?php
   /*if($approval_count)
   {
   ?>
    <tr>
     <td><img src="<?=base_url()?>assets/images/approval.png" align="left" /></td><td><b>Jumlah approval</b></td>
     <td>
     <?php 
     <a class="lnk" href="<?=site_url('approval')?>"><b class="higlight_box"><?=$approval_count?></b> Transaksi sedang menunggu persetujuan</a>
	  ?>
	 </td>
   </tr>
  <?php
  }*/
  ?>
    <tr>
     <td><img src="<?=base_url()?>assets/images/smicon_group.png" align="left" /></td><td><b>Login terakhir</b></td>
     <td><?=date('d/m/Y', $last_login)?> <?=date('H:i:s', $last_login)?></td>
   </tr>
   <tr>
     <td><img src="<?=base_url()?>images/clock-history-frame-icon.png" align="left" /></td><td><b>Aktifitas terakhir</b></td>
     <td><?=$last_activity?></td>
   </tr>
</table>
</div>
</div>
</form>

</div>
</div>
</div>
</div>