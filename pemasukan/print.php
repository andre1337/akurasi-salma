<style type="text/css">body {width: 100%;} </style> 
<body OnLoad="window.print()" OnFocus="window.close()"> 
<?php
include "../konmysqli.php";
echo"<link href='../ypathcss/$css' rel='stylesheet' type='text/css' />";
?>


<h3><center>Laporan data pemasukan:</h3>
 

<table width="100%" border="0">
  <tr>
    <th width="5%"><center>No</td>
    <th width="10%"><center>Id Pemasukan</center></td>
    <th width="25%"><center>tanggal</center></td>
    <th width="25%"><center>id bahan</center></td>
    <th width="10%"><center>jumlah</center></td>
    <th width="5%"><center>keterangan</center></td>
  </tr>
<?php  
  $sql="select * from `$tbpemasukan` order by `id_pemasukan` desc";
  $jum=getJum($conn,$sql);
  $no=0;
		if($jum > 0){
	$arr=getData($conn,$sql);
		foreach($arr as $d) {								
		$no++;
				$id_pemasukan=$d["id_pemasukan"];
				$tanggal=$d["tanggal"];
				$id_bahan=$d["id_bahan"];
				$jumlah=$d["jumlah"];
				$keterangan=$d["keterangan"];		
if($no %2==1){
echo"<tr bgcolor='#999999'>
				<td>$no</td>
				<td>$id_pemasukan</td>
				<td>$tanggal</td>
				<td>$id_bahan</td>
				<td>$jumlah</td>
				<td>$keterangan</td>
				</tr>";
				}//no==1
else if($no %2==0){
echo"<tr bgcolor='#cccccc'>
				<td>$no</td>
				<td>$id_pemasukan</td>
				<td>$tanggal</td>
				<td>$id_bahan</td>
				<td>$jumlah</td>
				<td>$keterangan</td>
				</tr>";
				}
			}//while
		}//if
		else{echo"<tr><td colspan='7'><blink>Maaf, Data pemasukan belum tersedia...</blink></td></tr>";}
		
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

</table>

