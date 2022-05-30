<?php
	session_start(); // harus ada di bagian paling atas kode
	include 'conn-db.php';
	$user = strip_tags(trim($_POST['userid'])); #echo $user;
	$pass = strip_tags(trim($_POST['passwd'])); #echo $pass;

	if($user!='' and $pass!='') {
		$q = @mysql_query("SELECT user_id, password, level 
                 FROM user WHERE username = '".$user."'");
		$dpass = @mysql_result($q,0,1);
		$s_id  = @mysql_result($q,0,0);
		$level = @mysql_result($q,0,2);
		if(md5($pass)==$dpass) {			
			unset($_POST); // hapus post form

// mengisi session
			$_SESSION['s_id']   = $s_id; 
			$_SESSION['s_level']= $level;
			$_SESSION['s_user'] = $user;
			$_SESSION['s_pass'] = $dpass;
			header("location:.");
		}
		else {
		  $konfirmasi = 'User ID atau Password Anda Salah';
		  header("location:login.php?konfirmasi=".$konfirmasi);
		}
	}
	else {
	      $konfirmasi = 'User ID atau Password Tidak Boleh Kosong';
	      header("location:login.php?konfirmasi=".$konfirmasi);
	}
?>
