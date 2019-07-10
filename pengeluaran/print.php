<style type="text/css">body {width: 100%;} </style> 
<body OnLoad="window.print()" OnFocus="window.close()"> 
<?php
include "../konmysqli.php";
echo"<link href='../ypathcss/$css' rel='stylesheet' type='text/css' />";
?>


<h3><center>Laporan data pengeluaran:</h3>
 

<table width="100%" border="0">
  <tr>
    <th width="5%"><center>No</center></td>
    <th width="10%"><center>Id Pengeluaran</center></td>
    <th width="25%"><center>Tanggal</center></td>
    <th width="25%"><center>id Bahan</center></td>
    <th width="20%"><center>Jumlah</center></td>
    <th width="10%"><center>Keterangan</center></td>
  </tr>
<?php  
  $sql="select * from `$tbpengeluaran` order by `id_pengeluaran` desc";
  $jum=getJum($conn,$sql);
  $no=0;
		if($jum > 0){
	$arr=getData($conn,$sql);
		foreach($arr as $d) {								
		$no++;
				$id_pengeluaran=$d["id_pengeluaran"];
				$tanggal=$d["tanggal"];
				$id_bahan=$d["id_bahan"];
				$jumlah=$d["jumlah"];
				$keterangan=$d["keterangan"];
						
if($no %2==1){
echo"<tr bgcolor='#999999'>
				<td>$no</td>
				<td>$id_pengeluaran</td>
				<td>$tanggal</td>
				<td>$id_bahan</td>
				<td>$jumlah</td>
				<td>$keterangan</td>
				</tr>";
				}//no==1
else if($no %2==0){
echo"<tr bgcolor='#cccccc'>
				<td>$no</td>
				<td>$id_pengeluaran</td>
				<td>$tanggal</td>
				<td>$id_bahan</td>
				<td>$jumlah</td>
				<td>$keterangan</td>
				</tr>";
				}
			}//while
		}//if
		else{echo"<tr><td colspan='7'><blink>Maaf, Data pengeluaran belum tersedia...</blink></td></tr>";}
		
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

