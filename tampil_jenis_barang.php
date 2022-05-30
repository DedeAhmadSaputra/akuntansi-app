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
		$("#data").load("data_jenis_barang.php");
	});

	// function untuk menampilkan form edit data dan dimasukkan pada div id='form'
	function edit_form(kode) {
		$.get('edit_jenis_barang.php?kode='+kode, null, function(data) {$('#form').html(data);});
		$('#form').show("slow");
	}

	// function untuk menampilkan form tambah data dan dimasukkan pada div id='form'
	function tambah_form() {
		$.get('tambah_jenis_barang.php', null, function(data) {$('#form').html(data);});
		$('#form').show("slow");
	}

	// function untuk mengahpus data
	function delete_data(kode) {
		var pilih = confirm('Data yang akan dihapus = '+kode+ '?');
		if (pilih==true) {
			$.get('delete_jenis_barang.php?kode='+kode, null, function(data) {$('#data').html(data);});
			//$("#data").load("data_jenis_barang.php");
		}
	}

	// function untuk proses tambah atau edit data
	function submitForm(url) {
		$("#data").load("data_jenis_barang.php");
		var thisPost = $('#forms').serialize();
		$.post(url, thisPost, function(data) {$('#form').html(data);} );
		$("#data").load("data_jenis_barang.php");
		return false;
	}
</script>
</head>

<body>
<h3>Master Jenis Barang</h3>
<a href="javascript:void(0)" onClick="tambah_form()">Tambah Baru</a>
<div id="form"></div>
<div id="data"></div>
</body>
</html>
