<?php
  $sql="select `id_bahan` from `$tbbahan`";
  $jum1=getJum($conn,$sql);

 $sql="select `id_pemasukan` from `$tbpemasukan`";
  $jum2=getJum($conn,$sql);

 $sql="select `id_pengeluaran` from `$tbpengeluaran`";
  $jum3=getJum($conn,$sql);

 $sql="select `id_user` from `$tbuser`";
  $jum4=getJum($conn,$sql);

?> 
 
 <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-6">
      <div class="panel panel-back noti-box"> <span class="icon-box bg-color-red set-icon"> <i class="fa fa-envelope-o"></i> </span>
        <div class="text-box" >
          <p class="main-text"><?php echo "$jum1";?></p>
          <p class="text-muted">Bahan Baku</p>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-6">
      <div class="panel panel-back noti-box"> <span class="icon-box bg-color-green set-icon"> <i class="fa fa-bars"></i> </span>
        <div class="text-box" >
          <p class="main-text"><?php echo "$jum2";?></p>
          <p class="text-muted">Pemasukan</p>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-6">
      <div class="panel panel-back noti-box"> <span class="icon-box bg-color-blue set-icon"> <i class="fa fa-bell-o"></i> </span>
        <div class="text-box" >
          <p class="main-text"><?php echo "$jum3";?></p>
          <p class="text-muted">Pengeluaran</p>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-6">
      <div class="panel panel-back noti-box"> <span class="icon-box bg-color-brown set-icon"> <i class="fa fa-rocket"></i> </span>
        <div class="text-box" >
          <p class="main-text"><?php echo "$jum4";?></p>
          <p class="text-muted">User</p>
        </div>
      </div>
    </div>
  </div>