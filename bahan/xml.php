<?php
header("Content-type: text/xml");

include "../konmysqli.php";
$sql = "select * from `$tbbahan`";
if(getJum($conn,$sql)>0){
	print "<bahan>\n";
		$arr=getData($conn,$sql);
		foreach($arr as $d) {		
				$id_bahan=$d["id_bahan"];
				$nama_bahan=$d["nama_bahan"];
				$satuan=$d["satuan"];
				$warna=$d["warna"];
			    $stok=$d["stok"];
				$keterangan=$d["keterangan"];
												
				print "<record>\n";
				print "  <nama_bahan>$nama_bahan</nama_bahan>\n";
				print "  <satuan>$satuan</satuan>\n";
				print "  <warna>$warna</warna>\n";
				print "  <stok>$stok</stok>\n";
				print "  <keterangan>$keterangan</keterangan>\n";
				print "  <id_bahan>$id_bahan</id_bahan>\n";
				print "</record>\n";
			}
	print "</bahan>\n";
}
else{
	$null="null";
	print "<bahan>\n";
		print "<record>\n";
				print "  <nama_bahan>$null</nama_bahan>\n";
				print "  <satuan>$null</satuan>\n";
				print "  <warna>$null</warna>\n";
				print "  <stok>$null</stok>\n";
				print "  <keterangan>$null</keterangan>\n";
				print "  <id_bahan>$null</id_bahan>\n";
		print "</record>\n";
	print "</bahan>\n";
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
	