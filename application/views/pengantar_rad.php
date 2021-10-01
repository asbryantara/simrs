<!DOCTYPE html>
<html>
<head>
  <title>Pengantar Radiologi</title>
  <!-- jquery-ui -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>custom/jquery-ui.css">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/iCheck/all.css">
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
		<div class="col-md-6" style="border-width: 2px; border-color: #000000;">

			<center>
			<h3><?= $nama_klinik['isi_config'] ?></h3>
			<p><?= $alamat_klinik['isi_config'].', '.$telp_klinik['isi_config'] ?></p>
			<p><?= $email_klinik['isi_config'] .', '.$website_klinik['isi_config'] ?></p>
			<hr>
			<h4>Pengantar Pemeriksaan Radiologi</h4> <br>
			</center>

			<table>
				<tr>
					<td>Nama</td>
					<td class="tengah"> : </td>
					<td><?= $kunj['nama_px'] ?></td>
				</tr>
				<tr>
					<td>No. RM</td>
					<td class="tengah"> : </td>
					<td><?= $kunj['no_rm'] ?></td>
				</tr>
				<tr>
					<td>Tempat, Tanggal Lahir</td>
					<td class="tengah"> : </td>
					<td><?= $kunj['tempat_lahir_px'].', '.$kunj['tgl_lahir_px'] ?></td>
				</tr>
				<tr>
					<td>Telepon</td>
					<td class="tengah"> : </td>
					<td><?= $kunj['telp_px'] ?></td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td class="tengah"> : </td>
					<td><?= $kunj['alamat_px'] ?></td>
				</tr>
			</table>

			<br>
			<br>
			<input type="checkbox" name=""> &nbsp; <label> X-Ray Umum</label> <br>
			<input type="checkbox" name=""> &nbsp; <label> USG</label> <br>
			<input type="checkbox" name=""> &nbsp; <label> CT Scan</label> <br>
			<input type="checkbox" name=""> &nbsp; <label> MRI</label> <br>
			<input type="checkbox" name=""> &nbsp; <label> Mamografi</label> <br>
			<input type="checkbox" name=""> &nbsp; <label> Angiografi</label> <br>

			<div class="pull-right">
				<center>
					<span> Dokter yang meminta,</span>
					<br>
					<br>
					<br>
					<br>	
					<?php $user = $this->db->get_where('user', ['id_user'=>$this->session->userdata('id_user') ])->row_array(); ?>
					<span>(<?= $user['nama_user'] ?>)</span>
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
<script src="<?= base_url('assets/') ?>plugins/iCheck/icheck.min.js"></script>
<script>
	$(document).ready(function() {

		$('.flat-red').iCheck({
	      checkboxClass: 'icheckbox_minimal-red',
	      radioClass   : 'iradio_flat-blue',
	    });

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