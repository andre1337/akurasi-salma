<?php
require_once"../konmysqli.php";
session_start();

	$group1 = $_POST['data1'];
	if($group1 == "show-all"){
		$stok2=0;
	}else{
		$sql = mysqli_query($conn, "select * from tb_prediksi_in where id_bahan='$group1'");
		$sql1 = mysqli_fetch_array($sql);
		$jumlah1=$sql1['prediksi'];
		
		$sql2 = mysqli_query($conn, "select * from tb_bahan_baku where id_bahan='$group1'");
		$sql3 = mysqli_fetch_array($sql2);
		$stok=$sql3['stok'];
		
		$stok2 = $jumlah1 - $stok;
		
	}
?>
<input name="stok2" type="text" id="stok2" value="<?php echo $stok2;?>" size="10" />
