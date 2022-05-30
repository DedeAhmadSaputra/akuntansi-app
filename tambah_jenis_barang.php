<?
	include ("conn-db.php");
		$nama = $_POST['nama'];		
	if ($nama!='') {
		$q = "INSERT INTO jns_brg VALUES (null, '".$nama."')";
		$r = mysql_query($q) or die (mysql_error());
		if($r) {
			$msg = "Data sudah ditambahkan";
		}
		else {
			$msg = "Data tidak bisa dimasukkan";
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tambah Data</title>
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
<form id="forms" method="POST" onSubmit="return submitForm('<?=$_SERVER['PHP_SELF'];?>')">
<fieldset>
<legend> Form Tambah Jenis Barang </legend>
	<div align="right"><img id="close" src="images/close.png" title="Close Form" onMouseOver="this.style.cursor = 'cursor'" /></div>
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
			<td> Nama </td>
			<td> : </td>
			<td> <input type='text' name='nama'> </td>
		</tr>
		<tr>
			<td> </td>
			<td> </td>
			<td> 
				<input type='Submit' name='simpan' value=' Simpan '>  
				<input type='Reset' name='reset' value=' Reset '> 
			</td>
		</tr>
	</table>
</form>
</fieldset>
</body>
</html>
