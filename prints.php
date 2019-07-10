<?php
session_start();

?>
<style type="text/css">body {width: 100%;} </style> 
<body OnLoad="window.print()" OnFocus="window.close()"> 
<?php
echo"<link href='ypathcss/amazon.css' rel='stylesheet' type='text/css' />";
?>

<?php

echo $_SESSION["cprint"];
?>