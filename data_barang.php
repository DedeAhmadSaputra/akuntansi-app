<?php
   // untuk memanggil file koneksi
   include "conn-db.php"; 

   // mendefinisikan nilai limit
   $lim = 5;

   // mendefinisikan halaman pertama, jika tidak ada klik halaman maka diisi 0
   $hal	= $_GET['hal'] ? $_GET['hal'] : 0;

   // query untuk mendapatkan jumlah seluruh row
   $sql = "SELECT * FROM jns_brg inner join barang on(barang.jns_id = jns_brg.jns_id) "; 
   $res = mysql_query($sql) or die (mysql_error()); 
   $jml = mysql_num_rows($res);

   // menghitung maksimal halaman
   $max = ceil($jml/$lim);

   // melakukan query limit
   $sqlLimit = "SELECT * FROM jns_brg inner join barang on(barang.jns_id = jns_brg.jns_id)  LIMIT $hal, $lim"; 
   $resLimit = mysql_query($sqlLimit) or die (mysql_error());
?>
<table border='1' width='100%' cellpadding='3' cellspacing='0' style='border-collapse:collapse'>
	<tr align='center'>
		<th>No</th>
		<th>Kode</th>
		<th>Nama</th>
		<th>Stok</th>
		<th>Jenis</th>
		<th>Edit</th>
		<th>Hapus</th>
	</tr>   
<?php
	// nomor urut ditambah dengan halaman
  $i = 1+$hal;
	while ($data = mysql_fetch_array($resLimit)) {
		if($i%2==0) $bg = '#CCCCCC'; else $bg = '#FFFFFF';
		echo 
			"<tr bgcolor = '".$bg."'>
				<td align='center'>".$i."</td>
				<td>".$data['brg_kode']."</td>
				<td>".$data['brg_nama']."</td>
				<td align='right'>".number_format($data['brg_stok'],0,',','.')."</td>
				<td>".$data['jns_nama']."</td>
				<td align='center'><a href='javascript:void(0)' onClick=\"edit_form('$data[brg_id]')\"> Edit </a></td>
				<td align='center'><a href='javascript:void(0)' onClick=\"delete_data('$data[brg_id]')\"> Hapus </a></td>
			</tr>";
		$i++;
	}
?>
</table>
<table width='100%'>
	<tr>
		<td>Jumlah Data : <?=$jml;?></td>
		<td align="right">
			Halaman :
			<?php
				for ($h = 1; $h <= $max; $h++) {
					$list[$h] = $lim * $h - $lim;
					echo " <a href='javascript:void(0)' ";?> onClick="$.get('data_barang.php?hal=<?=$list[$h]?>', null, function(data) {$('#data').html(data);})" <? echo">".$h."</a> ";
				}
			?>
		</td>
	</tr>
</table>
