
<?php
$pro="simpan";
$tanggal=WKT(date("Y-m-d"));
$jumlah=0;

?>
<link type="text/css" href="<?php echo "$PATH/base/";?>ui.all.css" rel="stylesheet" />   
<script type="text/javascript" src="<?php echo "$PATH/";?>jquery-1.3.2.js"></script>
<script type="text/javascript" src="<?php echo "$PATH/";?>ui/ui.core.js"></script>
<script type="text/javascript" src="<?php echo "$PATH/";?>ui/ui.datepicker.js"></script>
<script type="text/javascript" src="<?php echo "$PATH/";?>ui/i18n/ui.datepicker-id.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>   <!-- INCLUDE jQuery -->
    
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
<script src="js/jquery-1.12.4.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#accordion" ).accordion({
      collapsible: true
    });
  } );
  </script>    

<script type="text/javascript"> 
function PRINT(){ 
win=window.open('pengeluaran/print.php','win','width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, telepon=0'); } 
</script>
<script language="JavaScript">
function buka(url) {window.open(url, 'window_baru', 'width=800,height=600,left=320,top=100,resizable=1,scrollbars=1');}
</script>



<?php
if($_GET["pro"]=="ubah"){
	$id_pengeluaran=$_GET["kode"];
	$sql="select * from `$tbpengeluaran` where `id_pengeluaran`='$id_pengeluaran'";
	$d=getField($conn,$sql);
				$id_pengeluaran=$d["id_pengeluaran"];
				$id_pengeluaran0=$d["id_pengeluaran"];
				$tanggal=WKT($d["tanggal"]);
				$id_bahan=$d["id_bahan"];
				$jumlah=$d["jumlah"];
				
				$stok=$d["stok"];
				$pro="ubah";		
}
?>

<div id="accordion">
  <h3>Input Data Pengeluaran</h3>
  <div>
<form action="" method="post" enctype="multipart/form-data">
<table width="470" class="table table-striped table-bordered table-hover">



<tr>
<td><label for="tanggal">Tanggal</label>
<td valign="top">:
<td colspan="2"><input name="tanggal" type="text" id="tanggal" value="<?php echo $tanggal;?>" size="15" /></td>
</tr>

<tr>
<td><label for="id_bahan">Pilih Bahan Baku</label>
<td valign="top">:
<td colspan="2">
  <select name="id_bahan" id="id_bahan" class="cbb">
    <option value="show-all" selected="selected">-- Pilih --</option>
    <?php
	  $s="select * from `tb_bahan_baku`";
	$q=getData($conn,$s);
		foreach($q as $d){							
				$id_bahan0=$d["id_bahan"];
				$nama_bahan=$d["nama_bahan"];
	echo"<option value='$id_bahan0' ";if($id_bahan0==$id_bahan){echo"selected";} echo">$nama_bahan  |$id_bahan0</option>";
	}
	?>

  </select></td>
</tr>

<tr>
<td height="24"><label for="jumlah">Jumlah</label>
<td valign="top">:
<td><input name="jumlah" type="text" id="jumlah" value="<?php echo $jumlah;?>" size="10" />
</tr>



<tr>
<td height="24"><label for="stok">Stok</label>
<td valign="top">:
<td>
<div class="idbhn">

</div>
</tr>

<tr>
<td>
<td valign="top">
<td colspan="2">	
	<button type="submit" name="Simpan" class="btn btn-info" type="submit" value="submit"> Simpan </button>
        <input name="pro" type="hidden" id="pro" value="<?php echo $pro;?>" />
        <input name="id_pengeluaran" type="hidden" id="id_pengeluaran" value="<?php echo $id_pengeluaran;?>" />
        <input name="id_pengeluaran0" type="hidden" id="id_pengeluaran0" value="<?php echo $id_pengeluaran0;?>" />
        <a href="?mnu=pengeluaran">
        	<button type="button" name="Batal" class="btn btn-danger" type="button" value="Batal"> Batal </button></a>
		 <!-- <a href="?mnu=pengeluaran&pro=gen"><input name="Batal" class="btn btn-success" type="button" id="Batal" value="Generate"
onClick="return confirm('Apakah Anda benar-benar akan Mengenerate Data Latih Secara Random ? WARNING Data Lama Aan Hilang')"
		  /></a> -->
</td></tr>
</table>
</form>

</div>
  <?php  
  $sqlq="select distinct(id_bahan) from `$tbpengeluaran` order by `id_bahan` asc";
  $jumq=getJum($conn,$sqlq);
		if($jumq <1){
			echo"<h1>Maaf data belum tersedia...</h1>";
			}								
	$arrq=getData($conn,$sqlq);
		foreach($arrq as $dq) {							
				$id_bahan=$dq["id_bahan"];

?>     
   <h3>Data Pengeluaran <?php echo $id_bahan;?></h3>
  <div>
<br />
Data  Pengeluaran <?php echo getBahan($conn,$id_bahan);?>:
| <a href="pengeluaran/pdf.php"><img src='ypathicon/pdf.png' alt='PDF'></a> 
| <a href="pengeluaran/xls.php"><img src='ypathicon/xls.png' alt='XLS'></a> 
| <a href="pengeluaran/xml.php"><img src='ypathicon/xml.png' alt='XML'></a> 
| <img src='ypathicon/print.png' alt='PRINT' OnClick="PRINT()"> |
<br>

<table width="100%" class="table table-striped table-bordered table-hover">
  <tr bgcolor="#036">
    <th width="3%"><center>No</center></th>
    <th width="10%"><center>Nota Out</center></th>
    <th width="20%"><center>Tanggal</center></th>
    <th width="20%"><center>ID Bahan</center></th>
    <th width="10%"><center>Jumlah</center></th>
    <th width="40%"><center>Stok</center></th>
    <th width="10%"><center>Menu</center></th>
  </tr>
<?php  
  $sql="select * from `$tbpengeluaran` where id_bahan='$id_bahan' order by `tanggal` asc";
  $jum=getJum($conn,$sql);
		if($jum > 0){
	//--------------------------------------------------------------------------------------------
	$batas   = 5;
	$page = $_GET['page'];
	if(empty($page)){$posawal  = 0;$page = 1;}
	else{$posawal = ($page-1) * $batas;}
	
	$sql2 = $sql." LIMIT $posawal,$batas";
	$no = $posawal+1;
	//--------------------------------------------------------------------------------------------									
	$arr=getData($conn,$sql2);
		foreach($arr as $d) {							
				$id_pengeluaran=$d["id_pengeluaran"];
				$tanggal=WKT($d["tanggal"]);
				$jumlah=$d["jumlah"];
				$stok=$d["stok"];
				$pola=$id_pemasukan;
				if($id_pengeluaran<10){$pola="00000".$id_pengeluaran;}
				elseif($id_pengeluaran<100){$pola="0000".$id_pengeluaran;}
				elseif($id_pengeluaran<1000){$pola="000".$id_pengeluaran;}
				elseif($id_pengeluaran<10000){$pola="00".$id_pengeluaran;}
				elseif($id_pengeluaran<100000){$pola="0".$id_pengeluaran;}
				
					$color="#dddddd";	
					if($no %2==0){$color="#eeeeee";}
echo"<tr bgcolor='$color'>
				<td>$no</td>
				<td>OUT-$pola</td>
				<td>$tanggal</td>
				<td>$id_bahan</td>
				<td>$jumlah</td>
				
				<td>$stok</td>
				<td align='center'>
<a href='?mnu=pengeluaran&pro=ubah&kode=$id_pengeluaran'><img src='ypathicon/u.png' alt='ubah'></a>
<a href='?mnu=pengeluaran&pro=hapus&kode=$id_pengeluaran'><img src='ypathicon/h.png' alt='hapus' 
onClick='return confirm(\"Apakah Anda benar-benar akan menghapus $tanggal pada data pengeluaran ?..\")'></a></td>
				</tr>";
			
			$no++;
			}//while
		}//if
		else{echo"<tr><td colspan='7'><blink>Maaf, Data pengeluaran belum tersedia...</blink></td></tr>";}
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
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$prev&mnu=pengeluaran'>« Prev</a></span> ";
	}
	else{echo "<span class=disabled>« Prev</span> ";}

	// Tampilkan link page 1,2,3 ...
	for($i=1;$i<=$jmlhal;$i++)
	if ($i != $page){echo "<a href='$_SERVER[PHP_SELF]?page=$i&mnu=pengeluaran'>$i</a> ";}
	else{echo " <span class=current>$i</span> ";}

	// Link kepage berikutnya (Next)
	if($page < $jmlhal){
		$next=$page+1;
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$next&mnu=pengeluaran'>Next »</a></span>";
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
	$id_pengeluaran=strip_tags($_POST["id_pengeluaran"]);
	$id_pengeluaran0=strip_tags($_POST["id_pengeluaran0"]);
	$tanggal=BAL(strip_tags($_POST["tanggal"]));
	$id_bahan=strip_tags($_POST["id_bahan"]);
	$jumlah=strip_tags($_POST["jumlah"]);

	$stok=strip_tags($_POST["stok"]);
	
if($pro=="simpan"){
	$tambah=$stok - $jumlah;
$sql=" INSERT INTO `$tbpengeluaran` (
`id_pengeluaran` ,
`tanggal` ,
`id_bahan` ,
`jumlah` ,
`stok`
) VALUES (
'$id_pengeluaran', 
'$tanggal', 
'$id_bahan',
'$jumlah',
'$tambah'
)";

$query = "update tb_bahan_baku set stok='$tambah' where id_bahan='$id_bahan'";
$upda = process($conn,$query);
	
$simpan=process($conn,$sql);
		if($simpan) {echo "<script>alert('Data $id_pengeluaran berhasil disimpan !');document.location.href='?mnu=pengeluaran';</script>";}
		else{echo"<script>alert('Data $id_pengeluaran gagal disimpan...');document.location.href='?mnu=pengeluaran';</script>";}
	}
	else{
	$tambah=$stok - $jumlah;
$sql="update `$tbpengeluaran` set 
`tanggal`='$tanggal',
`id_bahan`='$id_bahan' ,
`jumlah`='$jumlah',
`telepon`='$telepon',
`stok`='$tambah'
where `id_pengeluaran`='$id_pengeluaran0'";
$ubah=process($conn,$sql);
	if($ubah) {echo "<script>alert('Data $id_pengeluaran berhasil diubah !');document.location.href='?mnu=pengeluaran';</script>";}
	else{echo"<script>alert('Data $id_pengeluaran gagal diubah...');document.location.href='?mnu=pengeluaran';</script>";}
	}//else simpan
}
?>

<?php
if($_GET["pro"]=="hapus"){
$id_pengeluaran=$_GET["kode"];
$sql="delete from `$tbpengeluaran` where `id_pengeluaran`='$id_pengeluaran'";
$hapus=process($conn,$sql);
if($hapus) {echo "<script>alert('Data pengeluaran $id_pengeluaran berhasil dihapus !');document.location.href='?mnu=pengeluaran';</script>";}
else{echo"<script>alert('Data pengeluaran $id_pengeluaran gagal dihapus...');document.location.href='?mnu=pengeluaran';</script>";}
}


if($_GET["pro"]=="gen"){
	
	$sql="truncate `$tbpengeluaran`";
	$up=process($conn,$sql);
$cth=300;
$BB=array(0=> "BHN01", "BHN02", "BHN03", "BHN04", "BHN05", "BHN06", "BHN07", "BHN08", "BHN09", "BHN10", "BHN11", "BHN12");


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
		
$sql=" INSERT INTO `$tbpengeluaran` (
`id_pengeluaran` ,
`tanggal` ,
`id_bahan` ,
`jumlah` ,

`stok`
) VALUES (
'', 
'$tanggal', 
'$id_bahan',
'$jumlah',

'$stok'
)";
	
$simpan=process($conn,$sql);
}


echo "<script>alert('Generate Data Latih Pengeluaran sebanyak $cth Berhasil... !');document.location.href='?mnu=pengeluaran';</script>";	
}
?>

