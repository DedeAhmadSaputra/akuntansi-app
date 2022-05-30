<?php
	include "cekSession.php";
	if ($_SESSION['s_level']=='0') $hakakses = 'ADMIN';
	elseif ($_SESSION['s_level']=='1') $hakakses = 'OPERATOR';
	elseif ($_SESSION['s_level']=='2') $hakakses = 'MANAGER';
?>
<img src="images/logo.jpg"><br />
SELAMAT DATANG, <b><?=$_SESSION['s_user'];?></b>. Anda login sebagai <b><?=$hakakses;?></b>.
<?php
	include "menu.php";
?>
<br />
<div id="menuContent" />
<?php
include 'info.php';
?>
