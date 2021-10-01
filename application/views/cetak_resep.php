<!DOCTYPE html>
<html>
<head>
  <title>Cetak Resep</title>
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
		<div class="col-md-6">

			<center>
			<h3><?= $nama_klinik['isi_config'] ?></h3>
			<p><?= $alamat_klinik['isi_config'].', '.$telp_klinik['isi_config'] ?></p>
			<p><?= $email_klinik['isi_config'] .', '.$website_klinik['isi_config'] ?></p>
			<hr>
			<h4>Resep</h4>
			</center>

			<table>
				<tr>
					<td>Tanggal</td>
					<td class="tengah"> : </td>
					<td><?= date('d-m-Y') ?></td>
				</tr>
				<tr>
					<td>No. RM / Jenis Pasien</td>
					<td class="tengah"> : </td>
					<?php if($kunj['asuransi_px'] == 1){$pem = 'Umum';}elseif($kunj['asuransi_px'] == 2){$pem = 'BPJS Kesehatan';}else{$pem = $kunj['asuransi_lain_px'];} ?>
					<td><?= $kunj['no_rm'].' / '.$pem ?></td>
				</tr>
				<tr>
					<td>Nama</td>
					<td class="tengah"> : </td>
					<td><?= $kunj['nama_px'] ?></td>
				</tr>
				<tr>
					<td>Tempat, Tgl Lahir</td>
					<td class="tengah">:</td>
					<td><?= $kunj['tempat_lahir_px'].', '.$kunj['tgl_lahir_px'] ?></td>
				</tr>
			</table>

			<br> <br>

			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Obat</th>
						<th>Jumlah</th>
						<th>Aturan Pakai</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; foreach($obat as $o): ?>
						<tr>
							<td><?= $no++ ?></td>
							<td><?= $o->nama_obat ?></td>
							<td><?= $o->jumlah ?></td>
							<td><?= $o->aturan_pakai ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>

			<br>
			<br>
			<div class="pull-right">
				<span>ttd.</span>
			</div>	
		</div>
	</div>
</div>


<!-- jQuery 3 -->
<script src="<?= base_url('assets/') ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url('assets/') ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script>
	$(document).ready(function() {
		window.print();
	});
</script>

</body>
</html>