<?php
$pro="simpan";
$tanggal=WKT(date("Y-m-d"));
$stok=0;
?>
    
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
win=window.open('bahan/print.php','win','width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, keterangan=0'); } 
</script>
<script language="JavaScript">
function buka(url) {window.open(url, 'window_baru', 'width=800,height=600,left=320,top=100,resizable=1,scrollbars=1');}
</script>



<?php
  $sql="select id_bahan from `$tbbahan` order by `id_bahan` desc";
 $q=mysqli_query($conn, $sql);
  $jum=mysqli_num_rows($q);
  $kd="BHN";
		if($jum > 0){
			$d=mysqli_fetch_array($q);
			$idmax=$d["id_bahan"];
			$urut=substr($idmax,3,2)+1;//01
				if($urut<10){$idmax="$kd"."0".$urut;}
				else{$idmax="$kd".$urut;}
			}
		else{$idmax="$kd"."01";}
		$kode_admin=$idmax;
  $id_bahan=$idmax;
?>

<?php
if($_GET["pro"]=="ubah"){
	$id_bahan=$_GET["kode"];
	$sql="select * from `$tbbahan` where `id_bahan`='$id_bahan'";
	$d=getField($conn,$sql);
				$id_bahan=$d["id_bahan"];
				$id_bahan0=$d["id_bahan"];
				$nama_bahan=$d["nama_bahan"];
				$satuan=$d["satuan"];
				$warna=$d["warna"];
				$stok=$d["stok"];
				$keterangan=$d["keterangan"];
				$pro="ubah";		
}
?>
<div id="accordion">
  <h3>Input Data Bahan Baku</h3>
  <div>
<form action="" method="post" enctype="multipart/form-data">
<table width="511" class="table table-striped table-bordered table-hover">


<tr>
<th width="116"><label for="id_bahan">Kode Bahan</label>
<th width="10" valign="top">:
<th width="370" colspan="2"><b><?php echo $id_bahan;?></b>
</tr>

   <tr>
<td height="24"><label for="nama_bahan">Nama Bahan Baku</label>
<td valign="top">:</td>
<td colspan="2">
    <div class="col-sm-15">
      <input type="text" class="form-control" id="nama_bahan" name="nama_bahan" placeholder="Masukkan Nama Bahan Baku">
    </div>
 </td></tr>

 <tr>
<td height="24"><label for="satuan">Satuan</label>
<td valign="top">:</td>
<td colspan="2">
    <div class="col-sm-15">
      <input type="text" class="form-control" id="satuan" name="satuan" placeholder="Masukkan Satuan Bahan Baku">
    </div>
 </td></tr>

<tr>
<td height="24"><label for="warna">Warna</label>
<td valign="top">:</td>
<td colspan="2">
	<div class="col-sm-15">
<select class="form-control" id="warna" name="warna" >
		<option>-- Pilih Warna --</option>
        <option value="Hitam" <?php if($warna=="Hitam"){echo"selected";}?>>Hitam</option>
        <option value="Putih" <?php if($warna=="Putih"){echo"selected";}?>>Putih</option>
        <option value="Krem" <?php if($warna=="Krem"){echo"selected";}?>>Krem</option>
        </select>
    </div></td>
</tr>

 <tr>
<td height="24"><label for="stok">Stok</label>
<td valign="top">:</td>
<td colspan="2">
    <div class="col-sm-15">
      <input type="text" class="form-control" id="stok" name="stok" placeholder="0">
    </div>
 </td></tr>

<tr>
<td height="24"><label for="keterangan">Keterangan</label>
<td valign="top">:</td>
<td colspan="2">
   <div class="col-sm-15">
  <textarea class="form-control" rows="5" id="keterangan" name="keterangan" placeholder="Masukkan Keterangan Bahan Baku"></textarea>
</div>
</div>


<tr>
<td>
<td valign="top">
<td colspan="2">	
		<button type="submit" name="Simpan" class="btn btn-info" type="submit" value="submit"> Simpan </button>
        <input name="pro" type="hidden" id="pro" value="<?php echo $pro;?>" />
        <input name="id_bahan" type="hidden" id="id_bahan" value="<?php echo $id_bahan;?>" />
        <input name="id_bahan0" type="hidden" id="id_bahan0" value="<?php echo $id_bahan0;?>" />
        <a href="?mnu=bahan">
        	<button type="button" name="Batal" class="btn btn-danger" type="button" value="Batal"> Batal </button></a>
</td></tr>
</table>
</form>
</div>
  <?php  
  $sqlq="select distinct(satuan) from `$tbbahan` order by `id_bahan` desc";
  $jumq=getJum($conn,$sqlq);
		if($jumq <1){
			echo"<h1>Maaf data belum tersedia...</h1>";
			}								
	$arrq=getData($conn,$sqlq);
		foreach($arrq as $dq) {							
				$satuan=$dq["satuan"];

?>     
   <h3>Data Bahan Baku Satuan <?php echo"$satuan";?></h3>
  <div>
<br />
Data bahan: 
| <a href="bahan/pdf.php"><img src='ypathicon/pdf.png' alt='PDF'></a> 
| <a href="bahan/xls.php"><img src='ypathicon/xls.png' alt='XLS'></a> 
| <a href="bahan/xml.php"><img src='ypathicon/xml.png' alt='XML'></a> 
| <img src='ypathicon/print.png' alt='PRINT' OnClick="PRINT()"> |
<br>

<table width="100%" class="table table-striped table-bordered table-hover">
  <tr bgcolor="#036">
    <th width="3%"><center>No</center></th>
    <th width="5%"><center>Kode</center></th>
    <th width="20%"><center>Nama Bahan</center></th>
    <th width="10%"><center>Satuan</center></th>
    <th width="10%"><center>Warna</center></th>
    <th width="5%"><center>Stok</center></th>
    <th width="30%"><center>Keterangan</center></th>
    <th width="10%"><center>Menu</center></th>
  </tr>
<?php  
  $sql="select * from `$tbbahan` where satuan='$satuan' order by `id_bahan` desc";
  $jum=getJum($conn,$sql);
		if($jum > 0){
	//--------------------------------------------------------------------------------------------
	$batas   = 10;
	$page = $_GET['page'];
	if(empty($page)){$posawal  = 0;$page = 1;}
	else{$posawal = ($page-1) * $batas;}
	
	$sql2 = $sql." LIMIT $posawal,$batas";
	$no = $posawal+1;
	//--------------------------------------------------------------------------------------------									
	$arr=getData($conn,$sql2);
		foreach($arr as $d) {							
				$id_bahan=$d["id_bahan"];
				$nama_bahan=$d["nama_bahan"];
				$satuan=$d["satuan"];
				$warna=$d["warna"];
				$stok=$d["stok"];
				$keterangan=$d["keterangan"];
					$color="#dddddd";	
					if($no %2==0){$color="#eeeeee";}
echo"<tr bgcolor='$color'>
				<td>$no</td>
				<td>$id_bahan</td>
				<td>$nama_bahan</td>
				<td>$satuan</td>
				<td>$warna</td>
				<td>$stok</td>
				<td>$keterangan</td>
				<td align='center'>
<a href='?mnu=bahan&pro=ubah&kode=$id_bahan'><img src='ypathicon/u.png' alt='ubah'></a>
<a href='?mnu=bahan&pro=hapus&kode=$id_bahan'><img src='ypathicon/h.png' alt='hapus' 
onClick='return confirm(\"Apakah Anda benar-benar akan menghapus $nama_bahan pada data bahan ?..\")'></a></td>
				</tr>";
			
			$no++;
			}//while
		}//if
		else{echo"<tr><td colspan='7'><blink>Maaf, Data bahan belum tersedia...</blink></td></tr>";}
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
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$prev&mnu=bahan'>« Prev</a></span> ";
	}
	else{echo "<span class=disabled>« Prev</span> ";}

	// Tampilkan link page 1,2,3 ...
	for($i=1;$i<=$jmlhal;$i++)
	if ($i != $page){echo "<a href='$_SERVER[PHP_SELF]?page=$i&mnu=bahan'>$i</a> ";}
	else{echo " <span class=current>$i</span> ";}

	// Link kepage berikutnya (Next)
	if($page < $jmlhal){
		$next=$page+1;
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$next&mnu=bahan'>Next »</a></span>";
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
	$id_bahan=strip_tags($_POST["id_bahan"]);
	$id_bahan0=strip_tags($_POST["id_bahan0"]);
	$nama_bahan=strip_tags($_POST["nama_bahan"]);
	$satuan=strip_tags($_POST["satuan"]);
	$warna=strip_tags($_POST["warna"]);
	$stok=strip_tags($_POST["stok"]);
	$keterangan=strip_tags($_POST["keterangan"]);
	
if($pro=="simpan"){
$sql=" INSERT INTO `$tbbahan` (
`id_bahan` ,
`nama_bahan` ,
`satuan` ,
`warna` ,
`stok` ,
`keterangan`
) VALUES (
'$id_bahan', 
'$nama_bahan', 
'$satuan',
'$warna',
'$stok',
'$keterangan'
)";
	
$simpan=process($conn,$sql);
		if($simpan) {echo "<script>alert('Data $id_bahan berhasil disimpan !');document.location.href='?mnu=bahan';</script>";}
		else{echo"<script>alert('Data $id_bahan gagal disimpan...');document.location.href='?mnu=bahan';</script>";}
	}
	else{
$sql="update `$tbbahan` set 
`nama_bahan`='$nama_bahan',
`satuan`='$satuan' ,
`warna`='$warna',
`stok`='$stok',
`keterangan`='$keterangan'
where `id_bahan`='$id_bahan0'";
$ubah=process($conn,$sql);
	if($ubah) {echo "<script>alert('Data $id_bahan berhasil diubah !');document.location.href='?mnu=bahan';</script>";}
	else{echo"<script>alert('Data $id_bahan gagal diubah...');document.location.href='?mnu=bahan';</script>";}
	}//else simpan
}
?>

<?php
if($_GET["pro"]=="hapus"){
$id_bahan=$_GET["kode"];
$sql="delete from `$tbbahan` where `id_bahan`='$id_bahan'";
$hapus=process($conn,$sql);
if($hapus) {echo "<script>alert('Data bahan $id_bahan berhasil dihapus !');document.location.href='?mnu=bahan';</script>";}
else{echo"<script>alert('Data bahan $id_bahan gagal dihapus...');document.location.href='?mnu=bahan';</script>";}
}
?>

