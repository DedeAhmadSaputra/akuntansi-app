<?php
	include ("conn-db.php");

	//	mengambil data barang yang akan diedit
	$q = "SELECT * FROM barang WHERE brg_id = '".$_GET['kode']."'";
	$r = mysql_query($q) or die ($q);
	$d = mysql_fetch_array ($r);

	// proses penyimpanan update
		$kode = $_POST['kode'];
		$nama = $_POST['nama'];
		$stok = $_POST['stok'];
		$jns  = $_POST['jns'];
	if ($kode!='') {
		$q = "UPDATE barang SET brg_kode = '".$kode."', brg_nama = '".$nama."', brg_stok = '".$stok."', jns_id = '".$jns."' 
          WHERE brg_id = '".$_GET['kode']."'";
		$r = mysql_query($q) or die (mysql_error());
		if($r) {
			$msg = "Data sudah diedit";
		}
		else {
			$msg = "Data tidak bisa diedit";
		}
	}

	$vkode =  $_POST['kode'] ? $_POST['kode'] : $d['brg_kode'];
	$vnama =  $_POST['nama'] ? $_POST['nama'] : $d['brg_nama'];
	$vstok =  $_POST['stok'] ? $_POST['stok'] : $d['brg_stok'];
	$vjns  =  $_POST['jns'] ? $_POST['jns'] : $d['jns_id'];
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
<legend> Form Ubah Barang </legend>
	<div align="right"><img id="close" src="images/close.png" title="Close Form" /></div>
	<table>
		<?
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
			<td> Kode </td>
			<td> : </td>
			<td> <input type='text' name='kode' value='<?=$vkode;?>'> </td>
		</tr>
		<tr>
			<td> Nama </td>
			<td> : </td>
			<td> <input type='text' name='nama' value='<?=$vnama;?>'> </td>
		</tr>
		<tr>
			<td> Stok </td>
			<td> : </td>
			<td> <input type='text' name='stok' value='<?=$vstok;?>'> </td>
		</tr>
		<tr>
			<td> Jenis Barang </td>
			<td> : </td>
			<td> 
				<select name="jns">
					<?php
						$jns = mysql_query("SELECT * FROM jns_brg");
						while ($djns = mysql_fetch_array($jns)) {
							echo "<option value='".$djns[jns_id]."' ";
							if($djns[jns_id] == $vjns) echo "selected"; 
							echo">".$djns[jns_nama]."</option>";
						}
					?>
				</select>
			</td>
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
