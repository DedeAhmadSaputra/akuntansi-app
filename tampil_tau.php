<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tampil Data JQuery</title>
<style>
</style>
<script language="JavaScript" src="jquery.js"></script>
<script>
	// ketika halaman pertama kali diload, maka akan memanggil file data_jenis_barang.php dan dimasukkan pada div id='data'
	$(document).ready(function(){
		$("#form").load("tau.php");
	});

	// function untuk proses tambah atau edit data
	function submitForm(url) {
		var thisPost = $('#forms').serialize();
		$.post(url, thisPost, function(data) {$('#form').html(data);} );
		return false;
	}
</script>
</head>

<body>
<h3>Transaksi Transfer Antar Unit (T.A.U)</h3>
<div id="form"></div>
</body>
</html>