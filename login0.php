<?php
session_start();
?>
<table width=100% border=0 cellspacing=0 cellpadding=1 bgcolor=#B19B68 class="table table-striped table-bordered table-hover">
<tr><td class=textp>&nbsp;&nbsp;Otentikasi</td></tr>
<tr><td><table width=100% cellspacing=5 cellpadding=0 bgcolor=#F8EED7 class="table table-striped table-bordered table-hover">
<tr><td class=textblack>
<b>Otentikasi Data </b> 
<form name="formLogin" method="post" action="">
  <table width="284" border="0" class="table table-striped table-bordered table-hover">
    <tr>
      <th colspan="2"  bgcolor="#FF00FF"><marquee>
      Silakan Tulis Data Login Anda / Register untuk membuat Acoount Baru
      </marquee></th>
    </tr>

    <tr>
      <td width="67">Username</td>
      <td width="207">:
      <input type="text" name="user" id="user" /></td>
    </tr>
   
    <tr>
      <td>Password:</td>
      <td>:
      <input type="password" name="pass" id="pass">
      </td>
    </tr>

    <tr>
      <td colspan="2" align="right" valign="middle">
      <input type="submit" name="Login" id="Login" value="Login"> 
      <input type="Reset" name="Reset" id="Reset" value="Reset">
      </td>
    </tr>
  </table>
</form>
</table></td></tr></table><br>
<?php
if(isset($_POST["Login"])){
	$usr=$_POST["user"];
	$pas=$_POST["pass"];
	
		$sql1="select * from `$tbadmin` where `username`='$usr' and `password`='$pas' and `status`='Aktif'";
		$sql2="select * from `$tbuser` where `username`='$usr' and `password`='$pas' and `status`='Aktif'";
		//$sql3="select * from `$tbadmin` where `username`='$usr' and `password`='$pas' and `status`='Aktif'";
		
		if(getJum($conn,$sql1)>0){
			$d=getField($conn,$sql1);
				$kode=$d["kode_admin"];
				$nama=$d["username"];
				   $_SESSION["cid"]=$kode;
				   $_SESSION["cnama"]=$nama;
				   $_SESSION["cstatus"]="Administrator";
		echo "<script>alert('Otentikasi ".$_SESSION["cnama"]." (".$_SESSION["cid"].") berhasil Login!');
		document.location.href='index.php?mnu=home';</script>";
		}//Hak akses Administrator
		
		else if(getJum($conn,$sql2)>0){
			$d=getField($conn,$sql2);
				$kode=$d["id_user"];
				$nama=$d["nama_user"];
				   $_SESSION["cid"]=$kode;
				   $_SESSION["cnama"]=$nama;
				   $_SESSION["cstatus"]="User";
		echo "<script>alert('Otentikasi ".$_SESSION["cnama"]." (".$_SESSION["cid"].") berhasil Login!');
		document.location.href='index.php?mnu=home';</script>";
		}//Hak akses User

		else{
			session_destroy();
			echo "<script>alert('Otentikasi Login GAGAL !,Silakan cek data Anda kembali...');
			document.location.href='index.php?mnu=login';</script>";
		}
}


?>