<?php
	include ("conn-db.php");
	$q = "DELETE FROM barang WHERE brg_id = '".$_GET['kode']."'";
	$r = mysql_query($q) or die (mysql_error());
	header("location:data_barang.php");
?>
