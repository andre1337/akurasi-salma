<?php
$koneksi = mysql_connect("localhost","root","");    // BUKA KONEKSI DENGAN DATABASE MYSQL
// host : localhost - user : root - password : kosong

$db = mysql_select_db('tb_bahan_baku'); // TENTUKAN NAMA DATABASE

$npm = $_POST['id_bahan']; // Menerima NPM dari JQuery Ajax dari form

$s = mysql_query("select * from skripsi where id_bahan='$id_bahan'"); // Ambil nama mahasiswa berdasarkan npm yang dikirim dari jquery ajax
while ($data = mysql_fetch_array($s)) {       
 echo $data[1]; // Print nama hasil perolehan dari query database
}
?>