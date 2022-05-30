<?php
$dbhost		= "localhost";
$dbuser		= "root";
$dbpassword	= "";
$database	= "inventory";
$db = @mysql_connect($dbhost, $dbuser, $dbpassword) or die("Connection Error: " . @mysql_error()); 
@mysql_select_db($database) or die("Error conecting to db."); 
?>
