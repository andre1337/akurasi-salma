<?php
header("Content-type: text/xml");

include "../konmysqli.php";
$sql = "select * from `$tbpengeluaran`";
if(getJum($conn,$sql)>0){
	print "<pengeluaran>\n";
		$arr=getData($conn,$sql);
		foreach($arr as $d) {		
				$id_pengeluaran=$d["id_pengeluaran"];
				$tanggal=$d["tanggal"];
				$id_bahan=$d["id_bahan"];
				$jumlah=$d["jumlah"];
			    $keterangan=$d["keterangan"];
			    $stok=$d["stok"];
												
				print "<record>\n";
				print "  <tanggal>$tanggal</tanggal>\n";
				print "  <id_bahan>$id_bahan</id_bahan>\n";
				print "  <jumlah>$jumlah</jumlah>\n";
				print "  <keterangan>$keterangan</keterangan>\n";
				print "  <stok>$stok</stok>\n";
				print "  <id_pengeluaran>$id_pengeluaran</id_pengeluaran>\n";
				print "</record>\n";
			}
	print "</pengeluaran>\n";
}
else{
	$null="null";
	print "<pengeluaran>\n";
		print "<record>\n";
				print "  <tanggal>$null</tanggal>\n";
				print "  <id_bahan>$null</id_bahan>\n";
				print "  <jumlah>$null</jumlah>\n";
				print "  <keterangan>$null</keterangan>\n";
				print "  <stok>$null</stok>\n";
				print "  <id_pengeluaran>$null</id_pengeluaran>\n";
		print "</record>\n";
	print "</pengeluaran>\n";
	}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

function getJum($conn,$sql){
  $rs=$conn->query($sql);
  $jum= $rs->num_rows;
	$rs->free();
	return $jum;
}

function getData($conn,$sql){
	$rs=$conn->query($sql);
	$rs->data_seek(0);
	$arr = $rs->fetch_all(MYSQLI_ASSOC);
	
	$rs->free();
	return $arr;
}
?>
	