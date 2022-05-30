<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<title>// Sistem Informasi Inventory \\</title>
<script type="text/javascript" src="jquery.js"></script>
<script>
$(document).ready(function(){
	$(".sub").mouseenter(function(){
		var id=$(this).attr("id");
		$("#sublist"+id).show("fast");
	});
	$(".sub").mouseleave(function(){
		var id=$(this).attr("id");
		$("#sublist"+id).hide("fast");
	});
});
</script>
<style>
	#menu ul {
		list-style:none;
	}
	#menu li {
		float:left;
		position: relative;
		left:-40px;
	}
	.sub {
		background-image: url('images/arrow.png');
	}
	.lisublist {
		top:0;
		z-index:600;
		float:left;
		position: absolute;
		left:150px;
		display:none;
	}
	.sublist {
		z-index:500;
		display:none;
		width:149px;
	}
	#menu li, .link {
		font-family: Tahoma;
		font-size:12px;
		background-color:#7A952B;
		height: 30px;
		width: 149px;
		display: block;
		border: 0.1em solid #dcdce9;
		color: #ffffff;
		text-decoration: none;
		text-align: center;
	}
</style>
</head>
<body>
<div id="menu">
<ul>
	<li><a class='link' href="index.php">Home</a></li>
	<?php if ($_SESSION['s_level']=='0') { ?>
	<li class="sub" id="1">
		<a class='link' href="#">Master</a>
		<ul class='sublist' id='sublist1'>
			<li>
				<a class='link' href="javascript:void(0)" onclick="$.get('tampil_jenis_barang.php', function(data) {$('#menuContent').html(data);});">
					Jenis Barang
				</a>
			</li>
			<li>
				<a class='link' href="javascript:void(0)" onclick="$.get('tampil_barang.php', function(data) {$('#menuContent').html(data);});">
					Barang
				</a>
			</li>
			<li><a class='link' href="#">Supplyer</a></li>
			<li><a class='link' href="#">User</a></li>
			<li><a class='link' href="#">Unit</a></li>
		</ul>
	</li>
	<?php }
	elseif ($_SESSION['s_level']=='1') { ?>
	<li class="sub" id="2">
		<a class='link' href="#">Transaksi</a>
		<ul class='sublist' id='sublist2'>
			<li>
				<a class='link' href="javascript:void(0)" onclick="$.get('tampil_pengadaan.php', function(data) {$('#menuContent').html(data);});"> 
					Pengadaan 
				</a> 
			</li>
			<li>
				<a class='link' href="javascript:void(0)" onclick="$.get('tampil_tau.php', function(data) {$('#menuContent').html(data);});"> 
					T.A.U
				</a>
			</li>
		</ul>
	</li>
	<?php }
	elseif ($_SESSION['s_level']=='2') { ?>
	<li class="sub" id="3">
		<a class='link' href="#">Laporan</a>
		<ul class='sublist' id='sublist3'>
			<li>
				<a class='link' href="javascript:void(0)" onclick="$.get('tampil_laporan_pengadaan.php', function(data) {$('#menuContent').html(data);});"> 
					Laporan Pengadaan
				</a>
			</li>
			<li>
				<a class='link' href="javascript:void(0)" onclick="$.get('tampil_laporan_tau.php', function(data) {$('#menuContent').html(data);});"> 
					Laporan T.A.U
				</a>
			</li>
			<li>
				<a class='link' href="javascript:void(0)" onclick="$.get('tampil_laporan_stok.php', function(data) {$('#menuContent').html(data);});"> 
					Laporan Stok
				</a>
			</li>
		</ul>
	</li>
	<?php } ?>
	<li class="sub" id="4">
		<a class='link' href="logout.php">Keluar</a>
	</li>
</ul>
</div>
</body>
</html>
