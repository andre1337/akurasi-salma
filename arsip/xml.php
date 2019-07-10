<?php
header("Content-type: text/xml");

include "../konmysqli.php";
$sql = "select * from `$tbpemasukan`";
if(getJum($conn,$sql)>0){
	print "<pemasukan>\n";
		$arr=getData($conn,$sql);
		foreach($arr as $d) {		
				$idin=$d["idin"];
				$periode=$d["periode"];
				$periode=$d["periode"];
			    $prediksi=$d["prediksi"];
				$keterangan=$d["keterangan"];
				$stok=$d["stok"];
												
				print "<record>\n";
				print "  <periode>$periode</periode>\n";
				print "  <periode>$periode</periode>\n";
				print "  <prediksi>$prediksi</prediksi>\n";
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
				print "  <periode>$null</periode>\n";
				print "  <periode>$null</periode>\n";
				print "  <prediksi>$null</prediksi>\n";
				print "  <keterangan>$null</keterangan>\n";
				print "  <stok>$null</stok>\n";
				print "  <idin>$null</idin>\n";
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
	