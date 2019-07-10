<?php
require_once"../konmysqli.php";
session_start();

	$group1 = $_POST['data1'];
	if($group1 == "show-all"){
		$stok=0;
	}else{
		$sql = mysqli_query($conn, "select * from tb_bahan_baku where periode='$group1'");
		$sql1 = mysqli_fetch_array($sql);
		$stok=$sql1['stok'];
	}
?>
<input name="stok" type="text" id="stok" value="<?php echo $stok;?>" size="10" />