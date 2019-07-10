<?php
require_once"../koneksivar.php";

$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
if ($conn->connect_error) {
  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
}

 	$buffer = ""; 
    $separator = ","; //, atau ;
    $newline = "\r\n"; 
    		    
    $buffer = "id_bahan".$separator ."nama_bahan".$separator ."satuan".$separator ."warna".$separator ."stok".$separator. "keterangan".$separator ."email".$separator."nama_ortu".$separator."username".$separator."password".$separator."status".$separator."add1".$separator."add2".$separator."add3".$separator."add4".$separator; 
    $buffer .= $newline; 
    
  $sql="select `id_bahan`,`nama_bahan`,`satuan`,`warna`,`stok`,`keterangan`,`email`,`nama_ortu`,`username`,`password`,`status`,`add1`,`add2`,`add3`,`add4` from `$tbbahan` order by `id_bahan` desc";
  $jum=getJum($conn,$sql);	
  if($jum>0){						
	  $arr=getData($conn,$sql);
	  foreach($arr as $d) {		 
					$value=$d["id_bahan"];$buffer .= "\"".$value."\"".$separator; 
					$value=$d["nama_bahan"];$buffer .= "\"".$value."\"".$separator; 
					$value=$d["satuan"];$buffer .= "\"".$value."\"".$separator; 
					$value=$d["warna"];$buffer .= "\"".$value."\"".$separator; 
					$value=$d["stok"];$buffer .= "\"".$value."\"".$separator; 
					$value=$d["keterangan"];$buffer .= "\"".$value."\"".$separator;
				$buffer .= $newline; 
		}	
  }
  else{
    $buffer .= $newline; 
	  }
    header("Content-type: application/vnd.ms-excel"); 
    header("Content-Length: ".strlen($buffer)); 
    header("Content-Disposition: attachment; filename=report.csv"); 
    header("Expires: 0"); 
    header("Cache-Control: must-revalidate, post-check=0,pre-check=0"); 
    header("Pragma: public"); 

    print $buffer;
	
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