<?php
$pro="simpan";
?>
<link type="text/css" href="<?php echo "$PATH/base/";?>ui.all.css" rel="stylesheet" />   
<script type="text/javascript" src="<?php echo "$PATH/";?>jquery-1.3.2.js"></script>
<script type="text/javascript" src="<?php echo "$PATH/";?>ui/ui.core.js"></script>
<script type="text/javascript" src="<?php echo "$PATH/";?>ui/ui.datepicker.js"></script>
<script type="text/javascript" src="<?php echo "$PATH/";?>ui/i18n/ui.datepicker-id.js"></script>
    
  <script type="text/javascript"> 
      $(document).ready(function(){
        $("#tgl_lahir").datepicker({
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
win=window.open('user/print.php','win','width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, telepon=0'); } 
</script>
<script language="JavaScript">
function buka(url) {window.open(url, 'window_baru', 'width=800,height=600,left=320,top=100,resizable=1,scrollbars=1');}
</script>

<?php
  $sql="select * from `$tbuser` order by `id_user` desc";
  $q=mysqli_query($conn, $sql);
  $jum=mysqli_num_rows($q);
  $kd="USR";
		if($jum > 0){
			$d=mysqli_fetch_array($q);
			$idmax=$d["id_user"];
			$urut=substr($idmax,3,2)+1;//01
				if($urut<10){$idmax="$kd"."0".$urut;}
				else{$idmax="$kd".$urut;}
			}
		else{$idmax="$kd"."01";}
		$id_user=$idmax;
?>

<?php
if($_GET["pro"]=="ubah"){
	$id_user=$_GET["kode"];
	$sql="select * from `$tbuser` where `id_user`='$id_user'";
	$d=getField($conn,$sql);
				$id_user=$d["id_user"];
				$id_user0=$d["id_user"];
				$nama_user=$d["nama_user"];
				$alamat=$d["alamat"];
				$telepon=$d["telepon"];
				$email=$d["email"];
				$username=$d["username"];
				$password=$d["password"];
				$status=$d["status"];
				$keterangan=$d["keterangan"];
				$pro="ubah";		
}
?>
<div id="accordion">
  <h3>Input Data User</h3>
  <div>
<form action="" method="post" enctype="multipart/form-data">
<table width="497" class="table table-striped table-bordered table-hover">


<tr>
<th width="131"><label for="id_user">Kode User</label>
<th width="10" valign="top">:
<th width="341" colspan="2"><b><?php echo $id_user;?></b>
</tr>

<tr>
<td><label for="nama_user">Nama User</label>
<td valign="top">:
<td colspan="2"><input name="nama_user" type="text" id="nama_user" value="<?php echo $nama_user;?>" size="30" /></td>
</tr>

<tr>
<td height="24"><label for="alamat">Alamat</label>
<td valign="top">:<td colspan="2"><textarea name="alamat" cols="30" id="alamat"><?php echo $alamat;?></textarea>
</td>
</tr>

<tr>
<td><label for="telepon">Telepon</label>
<td valign="top">:<td colspan="2"><input name="telepon" type="text" id="telepon" value="<?php echo $telepon;?>" size="15" /></td></tr>

<tr>
<td><label for="email">Email</label>
<td valign="top">:<td colspan="2"><input name="email" type="text" id="email" value="<?php echo $email;?>" size="30" /></td></tr>

<tr>
<td><label for="username">Username</label>
<td valign="top">:<td colspan="2"><input name="username" type="text" id="username" value="<?php echo $username;?>" size="30" /></td></tr>

<tr>
<td><label for="password">Password</label>
<td valign="top">:<td colspan="2"><input name="password" type="password" id="password" value="<?php echo $password;?>" size="30" /></td></tr>

<tr>
<td><label for="status">Status</label>
<td valign="top">:<td colspan="2">
<input type="radio" name="status" id="status"  checked="checked" value="Aktif" <?php if($status=="Aktif"){echo"checked";}?>/>Aktif 
<input type="radio" name="status" id="status" value="Tidak Aktif" <?php if($status=="Tidak Aktif"){echo"checked";}?>/>Tidak Aktif
</td></tr>

<tr>
<td><label for="keterangan">Keterangan</label>
<td valign="top">:<td colspan="2"><textarea name="keterangan" cols="30" id="keterangan"><?php echo $keterangan;?></textarea></td></tr>

<tr>
<td>
<td valign="top">
<td colspan="2">	
	<button type="submit" name="Simpan" class="btn btn-info" type="submit" value="submit"> Simpan </button>
        <input name="pro" type="hidden" id="pro" value="<?php echo $pro;?>" />
        <input name="id_user" type="hidden" id="id_user" value="<?php echo $id_user;?>" />
        <input name="id_user0" type="hidden" id="id_user0" value="<?php echo $id_user0;?>" />
        <a href="?mnu=user"><button type="button" name="Batal" class="btn btn-danger" type="button" value="Batal"> Batal </button></a>
</td></tr>
</table>
</form>
</div>
  <?php  
  $sqlq="select distinct(status) from `$tbuser` order by `status` asc";
  $jumq=getJum($conn,$sqlq);
		if($jumq <1){
			echo"<h1>Maaf data belum tersedia...</h1>";
			}								
	$arrq=getData($conn,$sqlq);
		foreach($arrq as $dq) {							
				$status=$dq["status"];

?>     
   <h3>Data User Status <?php echo"$status";?></h3>
  <div>
<br />
Data User Status <?php echo"$status";?>: 
| <a href="user/pdf.php"><img src='ypathicon/pdf.png' alt='PDF'></a> 
| <a href="user/xls.php"><img src='ypathicon/xls.png' alt='XLS'></a> 
| <a href="user/xml.php"><img src='ypathicon/xml.png' alt='XML'></a> 
| <img src='ypathicon/print.png' alt='PRINT' OnClick="PRINT()"> |
<br>

<table width="100%" class="table table-striped table-bordered table-hover">
  <tr bgcolor="#036">
    <th width="3%"><center>no</th>
    <th width="5%"><center>kode</th>
    <th width="20%"><center>nama_user</th>
    <th width="30%"><center>alamat</th>
    <th width="30%"><center>username</th>
    <th width="30%"><center>password</th>
    <th width="10%"><center>status</th>
    <th width="30%"><center>keterangan</th>
    <th width="10%"><center>menu</th>
  </tr>
<?php  
  $sql="select * from `$tbuser` where status='$status' order by `id_user` desc";
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
				$id_user=$d["id_user"];
				$nama_user=$d["nama_user"];
				$alamat=$d["alamat"];
				$telepon=$d["telepon"];
				$email=$d["email"];
				$username=$d["username"];
				$password=$d["password"];
				$status=$d["status"];
				$keterangan=$d["keterangan"];
					$color="#dddddd";	
					if($no %2==0){$color="#eeeeee";}
echo"<tr bgcolor='$color'>
				<td>$no</td>
				<td>$id_user</td>
				<td><a href='mailto:$email'>$nama_user</a></td>
				<td>$alamat </td>
				<td>$username</td>
				<td>$password</td>
				<td>$status</td>
				<td>$keterangan</td>
				<td align='center'>
<a href='?mnu=user&pro=ubah&kode=$id_user'><img src='ypathicon/u.png' alt='ubah'></a>
<a href='?mnu=user&pro=hapus&kode=$id_user'><img src='ypathicon/h.png' alt='hapus' 
onClick='return confirm(\"Apakah Anda benar-benar akan menghapus $nama_user pada data user ?..\")'></a></td>
				</tr>";
			
			$no++;
			}//while
		}//if
		else{echo"<tr><td colspan='7'><blink>Maaf, Data user belum tersedia...</blink></td></tr>";}
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
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$prev&mnu=user'>« Prev</a></span> ";
	}
	else{echo "<span class=disabled>« Prev</span> ";}

	// Tampilkan link page 1,2,3 ...
	for($i=1;$i<=$jmlhal;$i++)
	if ($i != $page){echo "<a href='$_SERVER[PHP_SELF]?page=$i&mnu=user'>$i</a> ";}
	else{echo " <span class=current>$i</span> ";}

	// Link kepage berikutnya (Next)
	if($page < $jmlhal){
		$next=$page+1;
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$next&mnu=user'>Next »</a></span>";
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
	$id_user=strip_tags($_POST["id_user"]);
	$id_user0=strip_tags($_POST["id_user0"]);
	$nama_user=strip_tags($_POST["nama_user"]);
	$alamat=strip_tags($_POST["alamat"]);
	$telepon=strip_tags($_POST["telepon"]);
	$email=strip_tags($_POST["email"]);
	$username=strip_tags($_POST["username"]);
	$password=strip_tags($_POST["password"]);
	$status=strip_tags($_POST["status"]);
	$keterangan=strip_tags($_POST["keterangan"]);
	
if($pro=="simpan"){
$sql=" INSERT INTO `$tbuser` (
`id_user` ,
`nama_user` ,
`alamat` ,
`telepon`,
`email` ,
`username` ,
`password` ,
`status`,
`keterangan`
) VALUES (
'$id_user', 
'$nama_user', 
'$alamat',
'$telepon',
'$email', 
'$username',
'$password',
'$status',
'$keterangan'
)";
	
$simpan=process($conn,$sql);
		if($simpan) {echo "<script>alert('Data $id_user berhasil disimpan !');document.location.href='?mnu=user';</script>";}
		else{echo"<script>alert('Data $id_user gagal disimpan...');document.location.href='?mnu=user';</script>";}
	}
	else{
$sql="update `$tbuser` set 
`nama_user`='$nama_user',
`telepon`='$telepon',
`alamat`='$alamat',
`email`='$email',
`username`='$username',
`password`='$password',
`status`='$status',
`keterangan`='$keterangan'
where `id_user`='$id_user0'";
$ubah=process($conn,$sql);
	if($ubah) {echo "<script>alert('Data $id_user berhasil diubah !');document.location.href='?mnu=user';</script>";}
	else{echo"<script>alert('Data $id_user gagal diubah...');document.location.href='?mnu=user';</script>";}
	}//else simpan
}
?>

<?php
if($_GET["pro"]=="hapus"){
$id_user=$_GET["kode"];
$sql="delete from `$tbuser` where `id_user`='$id_user'";
$hapus=process($conn,$sql);
if($hapus) {echo "<script>alert('Data user $id_user berhasil dihapus !');document.location.href='?mnu=user';</script>";}
else{echo"<script>alert('Data user $id_user gagal dihapus...');document.location.href='?mnu=user';</script>";}
}
?>

