<?php
	include "conn-db.php";

	$q = "SELECT * FROM v_stok";
	$r = mysql_query($q);

	$content = "
	<table width='390' border='1' style='border-collapse:collapse'>
		<tr>
			<td>No</td>
			<td>KODE BARANG</td>
			<td>NAMA BARANG</td>
			<td>STOK</td>
		</tr>";
	$no = 1;
	while ($d = mysql_fetch_array ($r)) {
		$content .= "
		<tr>
			<td>".$no."</td>
			<td>".$d['brg_kode']."</td>
			<td>".$d['brg_nama']."</td>
			<td>".$d['stok']."</td>
		</tr>";
		$no++;
	}
	$content .= "</table>";

	if($_POST['format']=='1') {
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=lap_tau.doc");
		header("Pragma: no-cache");
		header("Expires: 0");
		echo $content;
	}
	elseif($_POST['format']=='2') {
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=lap_tau.xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		echo $content;
	}
	elseif($_POST['format']=='3') {
		define('FPDF_FONTPATH','pdftable/font/');
		require('pdftable/pdftable.inc.php');
		$pdf=new PDFTable('P');

		$pdf->AddFont('vni_times');
		$pdf->AddFont('vni_times', 'B');
		$pdf->AddFont('vni_times', 'I');
		$pdf->AddFont('vni_times', 'BI');

		$pdf->SetMargins(0,0,0,0);
		$pdf->AddPage();
		$pdf->defaultFontFamily = 'arial';
		$pdf->defaultFontStyle  = '';
		$pdf->defaultFontSize   = 11;

		$pdf->SetFont($pdf->defaultFontFamily, $pdf->defaultFontStyle, $pdf->defaultFontSize);
		$pdf->htmltable($content);
		$pdf->Output('LaporanSTOK.pdf', 'I');
	}
?>
