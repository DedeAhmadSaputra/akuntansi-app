<?php
	include "conn-db.php";

	$q = "SELECT
		  d.sup_id AS sup_id,
		  d.sup_kode AS sup_kode,
		  d.sup_nama AS sup_nama,
		  a.brg_id   AS brg_id,
		  a.brg_kode AS brg_kode,
		  a.brg_nama AS brg_nama,
		  IFNULL(SUM(b.dada_qty),0) AS total_qty
		FROM barang a
		INNER JOIN detail_pengadaan b ON (a.brg_id = b.brg_id)
		INNER JOIN pengadaan c ON(b.ada_id = c.ada_id)
		INNER JOIN supplyer d ON(c.sup_id = d.sup_id) 
		AND (d.sup_id = '$_POST[sup]') 
		GROUP BY a.brg_id";
	$r = mysql_query($q);

	$content = "
	<table width='390' border='1' style='border-collapse:collapse'>
		<tr>
			<td>No</td>
			<td>KODE SUPPLYER</td>
			<td>NAMA SUPPLYER</td>
			<td>KODE BARANG</td>
			<td>NAMA BARANG</td>
			<td>TOTAL QTY</td>
		</tr>";
	$no = 1;
	while ($d = mysql_fetch_array ($r)) {
		$content .= "
		<tr>
			<td>".$no."</td>
			<td>".$d['sup_kode']."</td>
			<td>".$d['sup_nama']."</td>
			<td>".$d['brg_kode']."</td>
			<td>".$d['brg_nama']."</td>
			<td>".$d['total_qty']."</td>
		</tr>";
		$no++;
	}
	$content .= "</table>";

	if($_POST['format']=='1') {
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=lap_pengadaan.doc");
		header("Pragma: no-cache");
		header("Expires: 0");
		echo $content;
	}
	elseif($_POST['format']=='2') {
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=lap_pengadaan.xls");
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
		$pdf->Output('LaporanPengadaan.pdf', 'I');
	}
?>
