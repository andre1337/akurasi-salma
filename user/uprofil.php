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
win=window.open('user/print.php','win','width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, telepon=0'); } 
</script>
<script language="JavaScript">
function buka(url) {window.open(url, 'window_baru', 'width=800,height=600,left=320,top=100,resizable=1,scrollbars=1');}
</script>

<?php
	$id_user=$_SESSION["cid"];
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
?>
<div id="accordion">
  <h3>Profil User</h3>
  <div>
<form action="" method="post" enctype="multipart/form-data">
<table width="497" class="table table-striped table-bordered table-hover">

<tr>
<th width="131"><label for="id_user">Id User</label>
<th width="10" valign="top">:
<th width="341" colspan="2"><b><?php echo $id_user;?></b>
</tr>

<tr>
<td><label for="nama_user">Nama User</label>
<td valign="top">:
<td colspan="2"><b><?php echo $nama_user;?></b></td>
</tr>

<tr>
<td height="24"><label for="alamat">Alamat</label>
<td valign="top">:<td colspan="2"><b><?php echo $alamat;?></b>
</td>
</tr>

<tr>
<td><label for="telepon">Telepon</label>
<td valign="top">:<td colspan="2"><b><?php echo $telepon;?></b></td></tr>

<tr>
<td><label for="email">Email</label>
<td valign="top">:<td colspan="2"><b><?php echo $email;?></b></td></tr>

<tr>
<td><label for="username">Username</label>
<td valign="top">:<td colspan="2"><b><?php echo $username;?></b></td></tr>

<tr>
<td><label for="password">Password</label>
<td valign="top">:<td colspan="2"><b><?php echo $password;?></b></td></tr>

<tr>
<td><label for="status">Status</label>
<td valign="top">:<td colspan="2"><b><?php echo $status;?></b>
</td></tr>

<tr>
<td><label for="keterangan">Keterangan</label>
<td valign="top">:<td colspan="2"><b><?php echo $keterangan;?></b></td></tr>

<tr>
<td>
<td valign="top">
<td colspan="2">
        <a href="?mnu=uprofil2"><input name="Batal" type="button" id="Batal" value="Update Profil" /></a>
</td></tr>
</table>
</form>
</div>
</div>

</body>