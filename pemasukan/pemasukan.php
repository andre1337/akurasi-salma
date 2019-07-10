<?php
$pro="simpan";
$tanggal=WKT(date("Y-m-d"));
$jumlah=0;
$keterangan="-";
?>
<link type="text/css" href="<?php echo "$PATH/base/";?>ui.all.css" rel="stylesheet" />   
<script type="text/javascript" src="<?php echo "$PATH/";?>jquery-1.3.2.js"></script>
<script type="text/javascript" src="<?php echo "$PATH/";?>ui/ui.core.js"></script>
<script type="text/javascript" src="<?php echo "$PATH/";?>ui/ui.datepicker.js"></script>
<script type="text/javascript" src="<?php echo "$PATH/";?>ui/i18n/ui.datepicker-id.js"></script>
    
  <script type="text/javascript"> 
      $(document).ready(function(){
        $("#tanggal").datepicker({
					dateFormat  : "dd MM yy",        
          changeMonth : true,
          changeYear  : true					
        });
      });
    </script>
    
    <link rel="stylesheet" href="js/jquery-ui.css">
  <link rel="stylesheet" href="resources/demos/style.css">
<!-- <script src="js/jquery-1.12.4.js"></script>
  <script src="js/jquery-ui.js"></script> -->
  <script>
  $( function() {
    $( "#accordion" ).accordion({
      collapsible: true
    });
  } );
  </script>    

<script type="text/javascript"> 
function PRINT(){ 
win=window.open('pemasukan/print.php','win','width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, keterangan=0'); } 
</script>
<script language="JavaScript">
function buka(url) {window.open(url, 'window_baru', 'width=800,height=600,left=320,top=100,resizable=1,scrollbars=1');}
</script>


<?php
if($_GET["pro"]=="ubah"){
	$id_pemasukan=$_GET["kode"];
	$sql="select * from `$tbpemasukan` where `id_pemasukan`='$id_pemasukan'";
	$d=getField($conn,$sql);
				$id_pemasukan=$d["id_pemasukan"];
				$id_pemasukan0=$d["id_pemasukan"];
				$bulan=WKT($d["bulan"]);
				$tanggal=WKT($d["tanggal"]);
				$id_bahan=$d["id_bahan"];
				$jumlah=$d["jumlah"];
				$stok2=$d["stok2"];
				$stok3=$d["stok3"];
				$pro="ubah";		
}
?>
<div id="accordion">
  <h3>Input Data Pemasukan</h3>
  <div>
<form action="" method="post" enctype="multipart/form-data">
<table width="499" class="table table-striped table-bordered table-hover">

<tr>
<td><label for="id_bahan">Bulan</label>
<td valign="top">:
<td colspan="2"><label for="bulan"></label>
  <select name="bulan" id="bulan" class="cbb">
    <option value="show-all" selected="selected">-- Pilih --</option>
    <?php
	  $s="select * from `tb_prediksi_in` group by periode order by idin";
	$q=getData($conn,$s);
		foreach($q as $d){							
				$periode=$d["periode"];
				$kategori=$d["kategori"];
		echo"<option value='$periode' ";if($periode==$kategori){echo"selected";} echo">$periode </option>";
	}
	?>

  </select></td>
</tr>

<tr>
<td><label for="tanggal">Tanggal</label>
<td valign="top">:
<td colspan="2"><input readonly  name="tanggal" type="text" id="tanggal" value="<?php echo $tanggal;?>" size="15" /></td>
</tr>

<tr>
<td><label for="id_bahan">Pilih Bahan Baku</label>
<td valign="top">:
<td colspan="2"><label for="id_bahan"></label>
<div class="cek_bulan">
<?php
//tampil data id
?>
</div>
</td>
</tr>

<tr>
<td height="24"><label for="stok">Stok</label>
<td valign="top">:<td colspan="2">
<div class="idbhn">

</div>
</td>
</tr>

<tr>
<td height="24"><label for="jumlah">Stok yang direkomendasi</label>
<td valign="top">:<td colspan="2">
<div class="jmlah2">

</div>
</td>
</tr>

<tr>
<td height="24"><label for="stok2">Rekomendasi yang harus dibeli</label>
<td valign="top">:<td colspan="2">
<div class="jmlah">

</div>
</td>
</tr>

<tr>
<td height="24"><label for="stok3">Stok yang dibeli</label>
<td valign="top">:
<td><input name="stok3" type="text" id="stok3" value="<?php echo $stok3;?>" size="10" />
</tr>

<tr>
<td>
<td valign="top">
<td colspan="2">
		<button type="submit" name="Simpan" class="btn btn-info" type="submit" value="submit"> Simpan </button>
        <input name="pro" type="hidden" id="pro" value="<?php echo $pro;?>" />
        <input name="id_pemasukan" type="hidden" id="id_pemasukan" value="<?php echo $id_pemasukan;?>" />
        <input name="id_pemasukan0" type="hidden" id="id_pemasukan0" value="<?php echo $id_pemasukan0;?>" />

        <a href="?mnu=pemasukan">
        <button type="button" name="Batal" class="btn btn-danger" type="button" value="Batal"> Batal </button></a>
		 <!--  <a href="?mnu=pemasukan&pro=gen"><input name="Batal" class="btn btn-success" type="button" id="Batal" value="Generate"
onClick="return confirm('Apakah Anda benar-benar akan Mengenerate Data Latih Secara Random ? WARNING Data Lama Akan Hilang')"
		  /></a> -->
</td></tr>
</table>
</form>
</div>
  <?php  
  $sqlq="select distinct(id_bahan) from `$tbpemasukan` order by `id_bahan` asc";
  $jumq=getJum($conn,$sqlq);
		if($jumq <1){
			echo"<h1>Maaf data belum tersedia...</h1>";
			}								
	$arrq=getData($conn,$sqlq);
		foreach($arrq as $dq) {							
				$id_bahan=$dq["id_bahan"];

?>     
   <h3>Data Pemasukan Bahan Baku <?php echo getBahan($conn,$id_bahan);?></h3>
  <div>
<br />
Data Pemasukan Bahan Baku <?php echo getBahan($conn,$id_bahan);?>: 
| <a href="pemasukan/pdf.php"><img src='ypathicon/pdf.png' alt='PDF'></a> 
| <a href="pemasukan/xls.php"><img src='ypathicon/xls.png' alt='XLS'></a> 
| <a href="pemasukan/xml.php"><img src='ypathicon/xml.png' alt='XML'></a> 
| <img src='ypathicon/print.png' alt='PRINT' OnClick="PRINT()"> |
<br>

<table width="100%" class="table table-striped table-bordered table-hover">
  <tr bgcolor="#036">
    <th width="3%"><center>No</th>
	 <th width="10%"><center>Nota IN</center></th>
	<th width="20%"><center>Bulan</center></th>
    <th width="20%"><center>Tanggal</center></th>
    <th width="20%"><center>ID Bahan</center></th>
    <th width="5%"><center>Stok saat ini</center></th>
    <th width="5%"><center>Stok yang direkomendasi</center></th>
    <th width="5%"><center>Rekomendasi yang harus dibeli</center></th>
    <th width="5%"><center>Stok yang dibeli</center></th>
    <th width="10%"><center>Menu</center></th>
  </tr>
<?php  
  $sql="select * from `$tbpemasukan` where id_bahan='$id_bahan' order by `tanggal` asc";
  $jum=getJum($conn,$sql);
		if($jum > 0){
	//--------------------------------------------------------------------------------------------
	$batas   = 3;
	$page = $_GET['page'];
	if(empty($page)){$posawal  = 0;$page = 1;}
	else{$posawal = ($page-1) * $batas;}
	
	$sql2 = $sql." LIMIT $posawal,$batas";
	$no = $posawal+1;
	//--------------------------------------------------------------------------------------------									
	$arr=getData($conn,$sql2);
		foreach($arr as $d) {							
				$id_pemasukan=$d["id_pemasukan"];
				$bulan=$d["bulan"];
				$tanggal=WKT($d["tanggal"]);
				$stok=$d["stok"];
				$jumlah=$d["jumlah"];
				$stok2=$d["stok2"];
				$stok3=$d["stok3"];
				$pola=$id_pemasukan;
				if($id_pemasukan<10){$pola="00000".$id_pemasukan;}
				elseif($id_pemasukan<100){$pola="0000".$id_pemasukan;}
				elseif($id_pemasukan<1000){$pola="000".$id_pemasukan;}
				elseif($id_pemasukan<10000){$pola="00".$id_pemasukan;}
				elseif($id_pemasukan<100000){$pola="0".$id_pemasukan;}
				
					$color="#dddddd";	
					if($no %2==0){$color="#eeeeee";}
echo"<tr bgcolor='$color'>
				<td>$no</td>
				<td>INP-$pola</td>
				<td>$bulan</td>
				<td>$tanggal</td>
				<td>$id_bahan</td>
				<td>$stok</td>
				<td>$jumlah</td>
				<td>$stok2</td>
				<td>$stok3</td>
				<td align='center'>
<a href='?mnu=pemasukan&pro=ubah&kode=$id_pemasukan'><img src='ypathicon/u.png' alt='ubah'></a>
<a href='?mnu=pemasukan&pro=hapus&kode=$id_pemasukan'><img src='ypathicon/h.png' alt='hapus' 
onClick='return confirm(\"Apakah Anda benar-benar akan menghapus $tanggal pada data pemasukan ?..\")'></a></td>
				</tr>";
			
			$no++;
			}//while
		}//if
		else{echo"<tr><td colspan='7'><blink>Maaf, Data pemasukan belum tersedia...</blink></td></tr>";}
?>
</table>

<?php
//Langkah 3: Hitung total data dan page 
$jmldata = $jum;
if($jmldata>0){
	if($batas<1){$batas=1;}
	$jmlhal  = ceil($jmldata/$batas);
	echo "<div class=paging>";
	if($page > 1){
		$prev=$page-1;
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$prev&mnu=pemasukan'>« Prev</a></span> ";
	}
	else{echo "<span class=disabled>« Prev</span> ";}

	// Tampilkan link page 1,2,3 ...
	for($i=1;$i<=$jmlhal;$i++)
	if ($i != $page){echo "<a href='$_SERVER[PHP_SELF]?page=$i&mnu=pemasukan'>$i</a> ";}
	else{echo " <span class=current>$i</span> ";}

	// Link kepage berikutnya (Next)
	if($page < $jmlhal){
		$next=$page+1;
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$next&mnu=pemasukan'>Next »</a></span>";
	}
	else{ echo "<span class=disabled>Next »</span>";}
	echo "</div>";
	}//if jmldata

$jmldata = $jum;
	echo "<p align=center>Total Data <b>$jmldata</b> Item</p>";
?>
</div>
<?php }?>
</div>

</body>
<?php
if(isset($_POST["Simpan"])){
	$pro=strip_tags($_POST["pro"]);
	$id_pemasukan=strip_tags($_POST["id_pemasukan"]);
	$id_pemasukan0=strip_tags($_POST["id_pemasukan0"]);
	$bulan=BAL(strip_tags($_POST["bulan"]));
	$tanggal=BAL(strip_tags($_POST["tanggal"]));
	$id_bahan=strip_tags($_POST["id_bahan"]);
	$stok=strip_tags($_POST["stok"]);
	$jumlah=strip_tags($_POST["jumlah"]);
	$stok2=strip_tags($_POST["stok2"]);
	$stok3=strip_tags($_POST["stok3"]);

if($pro=="simpan"){
	$tambah=$stok + $stok3;
$sql=" INSERT INTO tb_pemasukan (
`id_pemasukan` ,
`bulan` ,
`tanggal` ,
`id_bahan` ,
`stok`,
`jumlah` ,
`stok2`,
`stok3`
) VALUES (
'', 
'$bulan',
'$tanggal', 
'$id_bahan',
'$tambah',
'$jumlah',
'$stok2',
'$stok3'
)";

$query = "update tb_bahan_baku set stok='$tambah' where id_bahan='$id_bahan'";
$upda = process($conn,$query);	
$simpan=process($conn,$query);
$simpan1=process($conn,$sql);
		if($simpan) {echo "<script>alert('Data $id_pemasukan berhasil disimpan !');document.location.href='?mnu=pemasukan';</script>";}
		else{echo"<script>alert('Data $id_pemasukan gagal disimpan...');document.location.href='?mnu=pemasukan';</script>";}
	}
	else{
	$tambah=$stok + $stok3;
$sql="update `$tbpemasukan` set 
`bulan`='$bulan',`tanggal`='$tanggal',`jumlah`='$jumlah',
`id_bahan`='$id_bahan' ,
`stok`='$tambah', `stok2`='$stok2', `stok3`='$stok3'
where `id_pemasukan`='$id_pemasukan0'";
$ubah=process($conn,$sql);
	if($ubah) {echo "<script>alert('Data $id_pemasukan berhasil diubah !');document.location.href='?mnu=pemasukan';</script>";}
	else{echo"<script>alert('Data $id_pemasukan gagal diubah...');document.location.href='?mnu=pemasukan';</script>";}
	}//else simpan
}
?>

<?php
if($_GET["pro"]=="hapus"){
$id_pemasukan=$_GET["kode"];
$sql="delete from `$tbpemasukan` where `id_pemasukan`='$id_pemasukan'";
$hapus=process($conn,$sql);
if($hapus) {echo "<script>alert('Data pemasukan $id_pemasukan berhasil dihapus !');document.location.href='?mnu=pemasukan';</script>";}
else{echo"<script>alert('Data pemasukan $id_pemasukan gagal dihapus...');document.location.href='?mnu=pemasukan';</script>";}
}


if($_GET["pro"]=="gen"){
	
	$sql="truncate `$tbpemasukan`";
	$up=process($conn,$sql);
$cth=500;
$BB=array(0=> "BHN01", "BHN02", "BHN03", "BHN04", "BHN05", "BHN06", "BHN07", "BHN08", "BHN09", "BHN10", "BHN11", "BHN12");
$keterangan="-";

for($i=0;$i<$cth;$i++){
	$jumlah=rand(2,30);

	$JM=count($BB);
	$r=rand(0,$JM);
	$thn=rand(2018,2019);
	$bln=rand(1,12);
	$tgl=rand(1,30);
	if($thn==2019 && $bln>6){$bln=$bln-6;}
	if($bln<10){$bln="0".$bln;}
	if($tgl<10){$tgl="0".$tgl;}
	
		$tanggal="$thn-$bln-$tgl";
		$id_bahan=$BB[$r];
		
$sql=" INSERT INTO `$tbpemasukan` (
`id_pemasukan` ,
`bulan` ,
`tanggal` ,
`id_bahan` ,
`stok`,
`jumlah` ,
`stok2`,
`stok3`
) VALUES (
'', 
'$bulan',
'$tanggal', 
'$id_bahan',
'$stok',
'$jumlah',
'$stok2',
'$stok3'
)";
	
$simpan=process($conn,$sql);
}


echo "<script>alert('Generate Data Latih Pemasukan sebanyak $cth Berhasil... !');document.location.href='?mnu=pemasukan';</script>";	
}
?>

