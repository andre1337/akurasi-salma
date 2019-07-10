<?php
if (version_compare(phpversion(), "5.3.0", ">=")  == 1)
  error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
else
  error_reporting(E_ALL & ~E_NOTICE);  
  ?>
<?php
session_start();
if(!isset($_SESSION["cid"]))
{
	die("<script>location.href='login.php';</script>");
}
//error_reporting(0);
require_once"konmysqli.php";

$mnu=$_GET["mnu"];
date_default_timezone_set("Asia/Jakarta");

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $tittle;?></title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href=""><div style="font-size: 20px;"><?php echo $header;?></div></a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;">  &nbsp;  </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
        <li class="text-center">
                    <img src="assets/img/admin.jpg" class="user-image img-responsive"/>
          </li>
				
					
                     <?php
//";if($mnu=="home"){echo"class='current'";} echo"
if($_SESSION["cstatus"]=="Administrator"){	
      echo"
      <li ";if($mnu=="home"){echo"class='active-menu'";} echo"><a href='index.php?mnu=home'><i class='fa fa-dashboard fa-3x'></i> Home</a><ul class='nav nav-second-level'>
      <li ";if($mnu=="admin"){echo"class='active-menu'";} echo"><a href='index.php?mnu=admin'><i class='fa fa-desktop fa-3x'></i> Admin</a></li>
	  <li ";if($mnu=="user"){echo"class='active-menu'";} echo"><a href='index.php?mnu=user'><i class='fa fa-edit fa-3x'></i> User</a></li></ul></li>
      <li ";if($mnu=="bahan"){echo"class='active-menu'";} echo"><a href='index.php?mnu=bahan'><i class='fa fa-sitemap fa-3x'></i> Bahan Baku</a></li>
	  <li ";if($mnu=="pemasukan"){echo"class='active-menu'";} echo"><a href='index.php?mnu=pemasukan'><i class='fa fa-bar-chart-o fa-3x'></i> Pemasukan</a></li>
	  <li ";if($mnu=="pengeluaran"){echo"class='active-menu'";} echo"><a href='index.php?mnu=pengeluaran'><i class='fa fa-table fa-3x'></i> Pengeluaran</a></li>
        
            <li ";if($mnu=="prediksi3"){echo"class='active-menu'";} echo"><a href='index.php?mnu=prediksi3'><i class='fa fa-table fa-3x'></i> Prediksi OUT</a></li>
            <li ";if($mnu=="arsip"){echo"class='active-menu'";} echo"><a href='index.php?mnu=akurasi'><i class='fa fa-table fa-3x'></i> Akurasi Data </a></li>
    <li ";if($mnu=="logout"){echo"class='active-menu'";} echo"><a href='index.php?mnu=logout'><i class='fa fa-square-o fa-3x'></i> Logout</a></li>
      ";
}

else if($_SESSION["cstatus"]=="User"){	
      echo"
      

      
	  <li ";if($mnu=="uprofil"){echo"class='active-menu'";} echo"><a href='index.php?mnu=uprofil'><i class='fa fa-edit fa-3x'></i> Profil</a></li>
      <li ";if($mnu=="bahan"){echo"class='active-menu'";} echo"><a href='index.php?mnu=bahan'><i class='fa fa-sitemap fa-3x'></i> Bahan Baku</a></li>
	  <li ";if($mnu=="pemasukan"){echo"class='active-menu'";} echo"><a href='index.php?mnu=pemasukan'><i class='fa fa-bar-chart-o fa-3x'></i> Pemasukan</a></li>
	  <li ";if($mnu=="pengeluaran"){echo"class='active-menu'";} echo"><a href='index.php?mnu=pengeluaran'><i class='fa fa-table fa-3x'></i> Pengeluaran</a></li>
      <li ";if($mnu=="arsip"){echo"class='active-menu'";} echo"><a href='index.php?mnu=arsip'><i class='fa fa-table fa-3x'></i> Data Prediksi </a></li>
    <li ";if($mnu=="logout"){echo"class='active-menu'";} echo"><a href='index.php?mnu=logout'><i class='fa fa-square-o fa-3x'></i> Logout</a></li>
      ";
}
else{
	 echo"<li ";if($mnu=="home"){echo"class='active-menu'";} echo"><a href='index.php?mnu=home'><i class='fa fa-dashboard fa-3x'></i> Home</a></li>";
	 echo"<li ";if($mnu=="login"){echo"class='active-menu'";} echo"><a href='login.php?mnu=login'><i class='fa fa-square-o fa-3x'></i> Login</a></li>";	 
	}
      ?>	
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
<?php 
				
if($mnu=="admin"){require_once"admin/admin.php";}
else if($mnu=="user"){require_once"user/user.php";}
else if($mnu=="akurasi"){require_once"akurasi.php";}
else if($mnu=="bahan"){require_once"bahan/bahan.php";}
else if($mnu=="pemasukan"){require_once"pemasukan/pemasukan.php";}
else if($mnu=="pengeluaran"){require_once"pengeluaran/pengeluaran.php";}
else if($mnu=="laporan"){require_once"laporan.php";}

//Profil User
else if($mnu=="arsip"){require_once"arsip/arsip.php";}

else if($mnu=="uprofil"){require_once"user/uprofil.php";}
else if($mnu=="uprofil2"){require_once"user/uprofil2.php";}

else if($mnu=="login"){require_once"login.php";}
else if($mnu=="prediksi"){require_once"prediksigabIN.php";}//prediksi
else if($mnu=="prediksi2"){require_once"prediksigabIN.php";}//prediksi2

else if($mnu=="prediksi3"){require_once"prediksigabOUT.php";}
else if($mnu=="prediksi4"){require_once"prediksigabOUT.php";}

else if($mnu=="arsip"){require_once"arsip.php";}
else if($mnu=="logout"){require_once"logout.php";}

else {require_once"admin/admin.php";}
				
 ?>
 </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <?php if($mnu=="home" || $mnu==""){?>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <?php }?>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
	<script src="app1.js"></script>
    
   
</body>
</html>

<?php function RP($rupiah){return number_format($rupiah,"2",",",".");}?>

<?php
function WKT2($sekarang){
$tanggal = substr($sekarang,8,2)+0;
$bulan = substr($sekarang,5,2);
$tahun = substr($sekarang,0,4);

$judul_bln=array(1=> "Januari", "Februari", "Maret", "April", "Mei","Juni", "Juli", "Agustus", "September","Oktober", "November", "Desember");
$wk=$tanggal." ".$judul_bln[(int)$bulan]." ".$tahun;

return $wk;
}
?>

<?php
function WKT($sekarang){
	if($sekarang=="0000-00-00"){$wk=WKT2(date("Y-m-d"));}
	else{
$tanggal = substr($sekarang,8,2)+0;
$bulan = substr($sekarang,5,2);
$tahun = substr($sekarang,0,4);

$judul_bln=array(1=> "Januari", "Februari", "Maret", "April", "Mei","Juni", "Juli", "Agustus", "September","Oktober", "November", "Desember");
$wk=$tanggal." ".$judul_bln[(int)$bulan]." ".$tahun;
	}
return $wk;
}
?>
<?php
function WKTP($sekarang){
$tanggal = substr($sekarang,8,2)+0;
$bulan = substr($sekarang,5,2);
$tahun = substr($sekarang,2,2);

$judul_bln=array(1=> "Jan", "Feb", "Mar", "Apr", "Mei","Jun", "Jul", "Agu", "Sep","Okt", "Nov", "Des");
$wk=$tanggal." ".$judul_bln[(int)$bulan]."'".$tahun;
return $wk;
}
?>
<?php
function BAL($tanggal){
	$arr=explode(" ",$tanggal);
	if($arr[1]=="Januari"||$arr[1]=="January"){$bul="01";}
	else if($arr[1]=="Februari"||$arr[1]=="February"){$bul="02";}
	else if($arr[1]=="Maret"||$arr[1]=="March"){$bul="03";}
	else if($arr[1]=="April"){$bul="04";}
	else if($arr[1]=="Mei"||$arr[1]=="May"){$bul="05";}
	else if($arr[1]=="Juni"||$arr[1]=="June"){$bul="06";}
	else if($arr[1]=="Juli"||$arr[1]=="July"){$bul="07";}
	else if($arr[1]=="Agustus"||$arr[1]=="August"){$bul="08";}
	else if($arr[1]=="September"){$bul="09";}
	else if($arr[1]=="Oktober"||$arr[1]=="October"){$bul="10";}
	else if($arr[1]=="November"){$bul="11";}
	else if($arr[1]=="Nopember"){$bul="11";}
	else if($arr[1]=="Desember"||$arr[1]=="December"){$bul="12";}
return "$arr[2]-$bul-$arr[0]";	
}
?>

<?php
function BALP($tanggal){
	$arr=explode(" ",$tanggal);
	if($arr[1]=="Jan"){$bul="01";}
	else if($arr[1]=="Feb"){$bul="02";}
	else if($arr[1]=="Mar"){$bul="03";}
	else if($arr[1]=="Apr"){$bul="04";}
	else if($arr[1]=="Mei"){$bul="05";}
	else if($arr[1]=="Jun"){$bul="06";}
	else if($arr[1]=="Jul"){$bul="07";}
	else if($arr[1]=="Agu"){$bul="08";}
	else if($arr[1]=="Sep"){$bul="09";}
	else if($arr[1]=="Okt"){$bul="10";}
	else if($arr[1]=="Nov"){$bul="11";}
	else if($arr[1]=="Nop"){$bul="11";}
	else if($arr[1]=="Des"){$bul="12";}
return "$arr[2]-$bul-$arr[0]";	
}
?>


<?php
function process($conn,$sql){
$s=false;
$conn->autocommit(FALSE);
try {
  $rs = $conn->query($sql);
  if($rs){
	    $conn->commit();
	    $last_inserted_id = $conn->insert_id;
 		$affected_rows = $conn->affected_rows;
  		$s=true;
  }
} 
catch (Exception $e) {
	echo 'fail: ' . $e->getMessage();
  	$conn->rollback();
}
$conn->autocommit(TRUE);
return $s;
}

function getJum($conn,$sql){
  $rs=$conn->query($sql);
  $jum= $rs->num_rows;
	$rs->free();
	return $jum;
}

function getField($conn,$sql){
	$rs=$conn->query($sql);
	$rs->data_seek(0);
	$d= $rs->fetch_assoc();
	$rs->free();
	return $d;
}

function getData($conn,$sql){
	$rs=$conn->query($sql);
	$rs->data_seek(0);
	$arr = $rs->fetch_all(MYSQLI_ASSOC);
	//foreach($arr as $row) {
	//  echo $row['nama_kelas'] . '*<br>';
	//}
	
	$rs->free();
	return $arr;
}

function getAdmin($conn,$kode){
$field="username";
$sql="SELECT `$field` FROM `tb_admin` where `kode_admin`='$kode'";
$rs=$conn->query($sql);	
	$rs->data_seek(0);
	$row = $rs->fetch_assoc();
	$rs->free();
    return $row[$field];
	}
	
	function getBahan($conn,$kode){
$field="nama_bahan";
$sql="SELECT `$field` FROM `tb_bahan_baku` where `id_bahan`='$kode'";
$rs=$conn->query($sql);	
	$rs->data_seek(0);
	$row = $rs->fetch_assoc();
	$rs->free();
    return $row[$field];
	}
?>