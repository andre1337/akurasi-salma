<?php
header("Content-type: text/xml");

include "../konmysqli.php";
$sql = "select * from `$tbpemasukan`";
if(getJum($conn,$sql)>0){
	print "<pemasukan>\n";
		$arr=getData($conn,$sql);
		foreach($arr as $d) {		
				$id_pemasukan=$d["id_pemasukan"];
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
				print "</record>\n";
			}
	print "</pemasukan>\n";
}
else{
	$null="null";
	print "<pemasukan>\n";
		print "<record>\n";
				print "  <tanggal>$null</tanggal>\n";
				print "  <id_bahan>$null</id_bahan>\n";
				print "  <jumlah>$null</jumlah>\n";
				print "  <keterangan>$null</keterangan>\n";
				print "  <stok>$null</stok>\n";
				print "  <id_pemasukan>$null</id_pemasukan>\n";
		print "</record>\n";
	print "</pemasukan>\n";
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
	