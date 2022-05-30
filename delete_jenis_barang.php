<?php
	include ("conn-db.php");
	$q = "DELETE FROM jns_brg WHERE jns_id = '".$_GET['kode']."'";
	$r = mysql_query($q) or die (mysql_error());
	header("location:data_jenis_barang.php");
?>
