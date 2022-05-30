<?
	include "conn-db.php";

	$q = "SELECT
		  d.unit_id AS unit_id,
		  d.unit_nama AS unit_nama,
		  a.brg_id   AS brg_id,
		  a.brg_kode AS brg_kode,
		  a.brg_nama AS brg_nama,
		  IFNULL(SUM(b.dtau_qty),0) AS total_qty
		FROM barang a
		INNER JOIN detail_tau b ON (a.brg_id = b.brg_id)
		INNER JOIN tau c ON(b.tau_id = c.tau_id)
		INNER JOIN unit d ON(c.unit_id = d.unit_id) 
		AND (d.unit_id = '$_POST[unit]') 
		GROUP BY a.brg_id";
	$r = mysql_query($q);

	$content = "
	<table width='390' border='1' style='border-collapse:collapse'>
		<tr>
			<td>No</td>
			<td>NAMA UNIT</td>
			<td>KODE BARANG</td>
			<td>NAMA BARANG</td>
			<td>TOTAL QTY</td>
		</tr>";
	$no = 1;
	while ($d = mysql_fetch_array ($r)) {
		$content .= "
		<tr>
			<td>".$no."</td>
			<td>".$d['unit_nama']."</td>
			<td>".$d['brg_kode']."</td>
			<td>".$d['brg_nama']."</td>
			<td>".$d['total_qty']."</td>
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
		$pdf->Output('LaporanTAU.pdf', 'I');
	}
?>
