<!DOCTYPE html>
<html>
<head>
  <title>Pengantar Laboratorium</title>
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
			<h4>Pengantar Pemeriksaan Laboratorium</h4> <br>
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
		</div>
	</div>

	<br>
	<br>
	<div class="row">
		<div class="col-md-3">
			<input type="checkbox" class="" name=""> &nbsp; <label> Kolesterol</label> <br>
			<input type="checkbox" class="" name=""> &nbsp; <label> Gula Darah Puasa</label> <br>
			<input type="checkbox" class="" name=""> &nbsp; <label> Gula Darah 2 Jam Setelah Makan</label> <br>
			<input type="checkbox" class="" name=""> &nbsp; <label> Gula Darah Acak</label> <br>
			<input type="checkbox" class="" name=""> &nbsp; <label> Hemoglobin</label> <br>
		</div>
		<div class="col-md-3">
			<input type="checkbox" class="" name=""> &nbsp; <label> Trombosit</label> <br>
			<input type="checkbox" class="" name=""> &nbsp; <label> SGOT</label> <br>
			<input type="checkbox" class="" name=""> &nbsp; <label> SGPT</label> <br>
			<input type="checkbox" class="" name=""> &nbsp; <label> Asam Urat</label> <br>
			<input type="checkbox" class="" name=""> &nbsp; <label> Widal</label> <br>
			<input type="checkbox" class="" name=""> &nbsp; <label> Lainnya</label> <br>
		</div>
	</div>
	<br>
	<br>
	<br>

	<div class="row">
		<div class="col-md-6">
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