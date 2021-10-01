<!DOCTYPE html>
<html>
<head>
  <title>Faktur Pembayaran</title>
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
		<div class="col-md-8">

			<center>
			<h3><?= $nama_klinik['isi_config'] ?></h3>
			<p><?= $alamat_klinik['isi_config'].', '.$telp_klinik['isi_config'] ?></p>
			<p><?= $email_klinik['isi_config'] .', '.$website_klinik['isi_config'] ?></p>
			<hr>
			<h4>Faktur Pembayaran</h4>
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

			<table class="table table-bordered table-hover">
                <thead>
                  <tr style="background-color: #A8CDFF;">
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Jumlah</th>
                    <th>Mata Uang</th>
                    <th>Harga</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no=1; $total=0; foreach($tindakan as $tx): ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $tx->nama_tindakan ?></td>
                      <td>1</td>
                      <td>IDR</td>
                      <td style="text-align: right;" class='money'><?= $tx->harga_tindakan ?></td>
                      <td style="text-align: right;" class='money'><?= $tx->harga_tindakan ?></td>
                    </tr>
                    <?php $total = $total+$tx->harga_tindakan; ?>
                  <?php endforeach ?>

                  <?php foreach($resep as $ob): ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $ob->nama_obat ?></td>
                      <td><?= $ob->jumlah ?></td>
                      <td>IDR</td>
                      <td style="text-align: right;" class='money'><?= $ob->harga ?></td>
                      <td style="text-align: right;" class='money'><?= ($ob->harga*$ob->jumlah) ?></td>
                    </tr>
                  <?php $total = $total+($ob->harga*$ob->jumlah); endforeach ?>

                  <tr>
                    <td colspan="5" style="text-align: right; font-weight: 700;"><b>Total</b></td>
                    <td style="text-align: right; font-weight: 700;" class='money'><b><?= $total ?></b></td>
                  </tr>

                  <?php if($status > 0): ?>
                    <tr>
                      <td colspan="5" style="text-align: right; font-weight: 700;">Bayar</td>
                      <td style="text-align: right; font-weight: 700;" class='money'><?= $bayar['bayar'] ?></td>
                    </tr>
                    <tr>
                      <td colspan="5" style="text-align: right; font-weight: 700;">Kembali</td>
                      <td style="text-align: right; font-weight: 700;" class='money'><?= $bayar['kembali'] ?></td>
                    </tr>
                  <?php endif ?>
                </tbody>
              </table>

			<br>
			<div class="pull-right">
				<center>
					<span>Petugas,</span>
					<br>
					<br>
					<br>
					<span>(<?= $bayar['nama_user'] ?>)</span>
				</center>
			</div>	
			<div class="pull-left">
				<center>
					<span>Pasien/Keluarga,</span>
					<br>
					<br>
					<br>
					<span>(______________________)</span>
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
	     symbol: '',
	    });
		 
		window.print();
	});
</script>

</body>
</html>