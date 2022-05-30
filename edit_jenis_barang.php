<?php
	include ("conn-db.php");

	//	mengambil data jns_brg yang akan diedit
	$q = "SELECT * FROM jns_brg WHERE jns_id = '".$_GET['kode']."'";
	$r = mysql_query($q) or die ($q);
	$d = mysql_fetch_array ($r);

	// proses penyimpanan update
	$nama = $_POST['nama'];
	if ($nama!='') {
		$q = "UPDATE jns_brg SET jns_nama = '".$nama."' WHERE jns_id = '".$_GET['kode']."'";
		$r = mysql_query($q) or die (mysql_error());
		if($r) {
			$msg = "Data sudah diedit";
		}
		else {
			$msg = "Data tidak bisa diedit";
		}
	}

	$vnama =  $_POST['nama'] ? $_POST['nama'] : $d[1];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Ubah Data </title>
<script language="JavaScript" src="jquery.js"></script>
<script>
	$(document).ready(function(){
		$("#close").click(function(){
			$("#form").hide("slow");
		});
	});
</script>
</head>

<body>
<form id="forms" method="POST" onSubmit="return submitForm('<?=$_SERVER['PHP_SELF'];?>?kode=<?=$_GET['kode'];?>')">
<fieldset>
<legend> Form Ubah Jenis Barang </legend>
	<div align="right"><img id="close" src="images/close.png" title="Close Form" /></div>
	<table>
		<?php
			if ($msg!='') {
				echo "
				<tr>
					<td> </td>
					<td> </td>
					<td> $msg </td>
				</tr>";
			}
		?>
		<tr>
			<td> Nama </td>
			<td> : </td>
			<td> <input type='text' name='nama' value='<?=$vnama;?>'> </td>
		</tr>
		<tr>
			<td> </td>
			<td> </td>
			<td> 
				<input type='submit' name='ubah' value='Ubah'>  
				<input type='reset' name='reset' value='Reset'> 
			</td>
		</tr>
	</table>
</form>
</fieldset>
</body>
</html>
