<?
	ob_start();
	session_start();
	include "conn-db.php";

	function nota($tabel, $digit, $kolom, $pre) {
		$urut = @mysql_result(@mysql_query("SELECT mid(".$kolom.",-".$digit.")+1 FROM ".$tabel." order by ".$kolom." DESC limit 0,1"),0,0);
		$max  = $digit - strlen($urut);
		$no_nota = $pre;
		for ($i=1;$i<=$max;$i++) {
			//if($urut=="") {
				$no_nota .= "0";
			//}
		}
		$no_nota .= $urut;
		return $no_nota;
	}
	
	$nota = nota('tau',5,'tau_nota','TAU');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script language="JavaScript" src="jquery.js"></script>
<script>
	
	function addTableRow(jQtable){
		jQtable.each(function(){
			var $table = $(this);
			var n = parseInt(document.getElementById('nomor').value) + 1;
			var brg = document.getElementById('barang').value;
			var qty = document.getElementById('qty').value;
			var brgs= brg.split('-');
			if (qty<=0) {
				alert('QTY tidak boleh kosong / minus');
			}
			else if(qty>parseInt(brgs[3])) {
				alert('QTY melebihi stok, yaitu: '+brgs[3]);
			}
			else {
				var tds = '<tr>';
				tds += '<td align=center>'+brgs[1]+'<input type="hidden" name="brg['+n+']" value="'+brgs[0]+'" /></td>';
				tds += '<td>'+brgs[2]+'</td>';
				tds += '<td align=center>'+qty+'<input type="hidden" name="qty['+n+']" id="qty['+n+']" value="'+qty+'" /></td>';
				tds += '<td align=center class="delete" onClick="$(this).parent().remove(); minTotal('+qty+')"><a href="javascript:void(0)">Hapus</a></td>';
				tds += '</tr>';
				if($('tbody', this).length > 0){
					$('tbody', this).append(tds);
				}else {
					$(this).append(tds);
				}
				document.getElementById('nomor').value =  n;
			}
		});
	}

	function hitTotal() {
		var no = parseInt(document.getElementById('nomor').value);
		var tQty = parseInt(document.getElementById('total').innerHTML);
		var lastQty = parseInt(document.getElementById('qty['+no+']').value);
		tQty += lastQty;
		document.getElementById('total').innerHTML = tQty;
	}

	function minTotal(qty) {
		var tQty = parseInt(document.getElementById('total').innerHTML);
		tQty -= parseInt(qty);
		document.getElementById('total').innerHTML = tQty;
	}
	
	function deleteAllRows() {
		$('#myTable tbody').remove();
		document.getElementById('total').innerHTML = 0;
	}
</script>
</head>

<body>
<form id="forms" method="POST" onSubmit="return submitForm('<?=$_SERVER['PHP_SELF'];?>')">
<table width="50%">
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
		<td> No. Transaksi </td>
		<td> : </td>
		<td> <input type='text' name='nota' value='<?=$nota;?>'> </td>
	</tr>
	<tr>
		<td> Tanggal </td>
		<td> : </td>
		<td> <input type='text' name='tgl' value='<?=date('Y-m-d');?>'> </td>
	</tr>
	<tr>
		<td> Unit </td>
		<td> : </td>
		<td> 
			<select name="unit">
				<?
					$unit = mysql_query("SELECT * FROM unit");
					while ($dunit = mysql_fetch_array($unit)) {
						echo "<option value='".$dunit[0]."'>".$dunit[1]."</option>";
					}
				?>
			</select>
		</td>
	</tr>
	<tr>
		<td> Barang </td>
		<td> : </td>
		<td>
			<select name="barang" id="barang">
				<?
					$q = mysql_query("SELECT * FROM barang");
					while($d = mysql_fetch_array($q)) {
						echo "<option value='".$d[0]."-".$d[1]."-".$d[2]."-".$d[3]."'>".$d[1]." | ".$d[2]."</option>";
					}
				?>
			</select> QTY <input type='text' name='qty' id='qty' size='2' > 
			<input type="button" name="tambah" value=" Tambahkan " id="tambah" onClick="addTableRow($('#myTable')); hitTotal()" />
			<input type='hidden' name='nomor' id='nomor' value='0' >
		</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td>
			<table width="100%" border="1" style="border-collapse:collapse" id="myTable">
				<thead>
				<tr align="center">
					<td>Kode</td>
					<td>Nama</td>
					<td>Qty</td>
					<td>Act</td>
				</tr>
				</thead>
				<tfoot>
				<tr align="center">
					<td colspan="2" align="right">Total</td>
					<td id="total">0</td>
				</tr>
				</tfoot>
			</table>
		</td>
	</tr>
	<tr>
		<td> </td>
		<td> </td>
		<td> 
			<input type='Submit' name='simpan' value=' Simpan '/>  
			<input type='Reset' name='reset' value=' Reset ' onClick='deleteAllRows()' /> 
		</td>
	</tr>
</table>
</form>

<?
	//if(isset($_POST['simpan'])) {
		$nota = $_POST['nota'];
		$tgl  = $_POST['tgl'];
		$unit  = $_POST['unit'];

		if ($nota!='' && $tgl!='' && $unit!='') {
			$q1 = "INSERT INTO tau VALUES (null, '".$nota."', '".$tgl."', '".$unit."', '".$_SESSION['s_id']."')";
			$r1 = mysql_query($q1) or die ($q1);;
			if($r1) {
				$tauID = mysql_result(mysql_query("SELECT tau_id FROM tau WHERE tau_nota = '".$nota."'"),0,0);
				if($_POST['brg']!='') {
					$brg = $_POST['brg']; 
					foreach($_POST['qty'] as $key => $val) {
						$q2 = "INSERT INTO detail_tau VALUES (null,'".$val."', '".$brg[$key]."', '".$tauID."')";
						$r2 = mysql_query($q2);
					}
				}
			}
			header("location:tau.php");
		}
	//}
?>
</body>
</html>