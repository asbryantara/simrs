<!DOCTYPE html>
<html>
<head>
  <title>Kwitansi Pembayaran</title>
  <!-- jquery-ui -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>custom/jquery-ui.css">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <style>
  	.tengah{
  		padding-right: 5px;
  		padding-left: 5px;
  	}
  </style>
</head>
<body>

<div class="container">
	<div class="row">
		<div class="col-md-8" style="border-width: 2px; border-color: #000000;">

			<center>
			<h3><?= $nama_klinik['isi_config'] ?></h3>
			<p><?= $alamat_klinik['isi_config'].', '.$telp_klinik['isi_config'] ?></p>
			<p><?= $email_klinik['isi_config'] .', '.$website_klinik['isi_config'] ?></p>
			<hr>
			<h4>Kwitansi Pembayaran</h4>
			</center>

			<table>
				<tr>
					<td>Telah terima dari</td>
					<td class="tengah"> : </td>
					<td><?= $kunj['nama_px'] ?></td>
				</tr>
				<tr>
					<td>Untuk Pembayaran</td>
					<td class="tengah"> : </td>
					<td>Biaya Pengobatan rawat jalan</td>
				</tr>
				<tr>
					<td> &nbsp; &nbsp; Nama</td>
					<td class="tengah"> : </td>
					<td><?= $kunj['nama_px'] ?></td>
				</tr>
				<tr>
					<td> &nbsp; &nbsp; No. RM</td>
					<td class="tengah"> : </td>
					<td><?= $kunj['no_rm'] ?></td>
				</tr>
				<tr>
					<td>Jumlah</td>
					<td class="tengah"> : </td>
					<td class="money"><?= $bayar['jumlah_bayar'] ?></td>
				</tr>
				<tr>
					<td>Terbilang</td>
					<td class="tengah"> : </td>
					<td><?= $terbilang ?> rupiah</td>
				</tr>
			</table>

			<div class="pull-right">
				<center>
					<span>Jember, <?= date('d-m-Y') ?> <br> Petugas,</span>
					<br>
					<br>
					<br>
					<span>(<?= $bayar['nama_user'] ?>)</span>
				</center>
			</div>	
		</div>
	</div>
</div>


<!-- jQuery 3 -->
<script src="<?= base_url('assets/') ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url('assets/') ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="<?= base_url('assets/') ?>dist/js/currencyFormatter.js"></script>
<script>
	$(document).ready(function() {

		OSREC.CurrencyFormatter.formatAll(
	    {
	     selector: '.money', 
	     currency: 'IDR',
	     symbol: 'Rp ',
	    });
		 
		window.print();
	});
</script>

</body>
</html>