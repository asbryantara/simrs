<?php
$this->load->view('header');
$this->load->view('leftbar');
?>

<div class="content-wrapper">
	<!-- Main content -->
	<section class="content">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-md-12">
				<?php if ($this->session->flashdata('warning')) : ?>
					<div class="alert alert-warning alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-warning"></i> <?= $this->session->flashdata('warning') ?> </h4>
					</div>
				<?php elseif ($this->session->flashdata('success')) : ?>
					<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> <?= $this->session->flashdata('success') ?> </h4>
					</div>
				<?php endif ?>
			</div>

			<div class="col-md-12">
				<a href="<?= base_url('penunjang/riwayat_rad') ?>" class="btn btn-primary"><i class="fa fa-eye"> </i> Sudah Diperiksa</a>
				<!-- <a href="<?= base_url('pendaftaran/list_pendaftaran') ?>" class="btn btn-primary"><i class="fa fa-eye"> </i> Lihat Pendaftaran</a> -->

				<br>
				<br>

			</div>

			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Daftar Pasien Belum Diperiksa</h3>
					</div>
					<div class="box-body">
						<table class="table table-hover table-striped table-bordered" id="example1">
							<thead>
								<tr>
									<th>No RM</th>
									<th>Nama</th>
									<th>JK</th>
									<th>Tgl Daftar</th>
									<th>Keterangan</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($data as $p) : ?>
									<tr>
										<td><?= $p->no_rm ?></td>
										<td><?= $p->nama_px ?></td>
										<td><?php if ($p->jk_px ==  1) {
												echo 'L';
											} else {
												echo 'P';
											} ?></td>
										<td><?= $p->tgl_kunjungan . ' ' . $p->waktu_kunjungan ?></td>
										<td><?= $p->ket_rad ?></td>
										<?php
										if ($p->status_kunjungan ==  0) {
											echo 'Menunggu';
										} elseif ($p->status_kunjungan ==  1) {
											echo 'Diperiksa';
										} elseif ($p->status_kunjungan ==  2) {
											echo 'Menunggu Obat';
										} elseif ($p->status_kunjungan ==  3) {
											echo 'Menunggu Pembayaran';
										} elseif ($p->status_kunjungan ==  4) {
											echo 'Selesai';
										} elseif ($p->status_kunjungan ==  5) {
											echo 'Transfer Lab';
										} elseif ($p->status_kunjungan ==  6) {
											echo 'Transfer Radiologi';
										}
										?>
										</td>
										<td>
											<a href="<?= base_url('penunjang/addRad/' . $p->id_kunjungan) ?>" class="btn btn-primary btn-xs"><i class="fa fa-stethoscope"> </i> Periksa</a>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>



			</div>
			<!-- /.col (RIGHT) -->
			<!-- /.col (RIGHT) -->
		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php $this->load->view('footer') ?>

<script>
	function konfirmasi() {
		return confirm('Apakah anda yakin ?');
	}

	$(document).ready(function() {

		$('#left_rad').addClass('active');



	});
</script>
