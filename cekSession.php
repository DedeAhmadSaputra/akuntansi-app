<?php
	session_start();
	if($_SESSION['s_id']=='' && $_SESSION['s_pass']=='' && 
        $_SESSION['s_level']=='' && $_SESSION['s_user']=='') {
		header("location:login.php");
	}
?>
