<?php
require_once"../konmysqli.php";
session_start();

	$group1 = $_POST['data1'];
	if($group1 == "show-all"){
		$jumlah=0;
	}else{

		$sql = mysqli_query($conn, "select * from tb_prediksi_in where id_bahan='$group1'");
		$sql1 = mysqli_fetch_array($sql);
		$jumlah1=$sql1['prediksi'];
		
		$jumlah = $jumlah1;
		
	}
?>

<input name="jumlah" type="text" id="jumlah" value="<?php echo $jumlah;?>" size="10" />