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

				<a href="<?= base_url('pasien/add') ?>" class="btn btn-info"><i class="fa fa-plus"> </i> Data Pasien Baru</a>
				<a href="<?= base_url('pendaftaran/edit/' . $kunj['id_kunjungan']) ?>" class="btn btn-info"><i class="fa fa-pencil"> </i> Edit Data Pendaftaran</a>
				<a href="<?= base_url('pendaftaran/auto/' . $kunj['no_rm']) ?>" class="btn btn-primary"><i class="fa fa-plus"> </i> Pendaftaran</a>
				<a href="<?= base_url('pendaftaran/list_pendaftaran') ?>" class="btn btn-primary"><i class="fa fa-eye"> </i> Lihat Pendaftaran</a>

				<br>
				<br>

			</div>

			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title"><i class="fa fa-user"> </i> Data Pendaftaran</h3>
					</div>
					<div class="box-body">
						<table class="table table-hover table-striped ">
							<tr>
								<td width="250">No. RM</td>
								<td width="1">:</td>
								<td><a href="<?= base_url('pasien/detail/' . $kunj['no_rm']) ?>"><?= $kunj['no_rm'] ?></a></td>
							</tr>
							<tr>
								<td width="200">Nama Pasien</td>
								<td width="1">:</td>
								<td><?= $kunj['nama_px'] ?></td>
							</tr>
							<tr>
								<td width="200">Jenis Kelamin</td>
								<td width="1">:</td>
								<td><?php if ($kunj['jk_px'] == 1) {
											echo 'Laki-laki';
										} else {
											echo 'Perempuan';
										} ?></td>
							</tr>
							<tr>
								<td width="200">Tempat, Tanggal Lahir</td>
								<td width="1">:</td>
								<td><?= $kunj['tempat_lahir_px'] . ', ' . $kunj['tgl_lahir_px'] ?></td>
							</tr>

							<tr>
								<td width="200">Pembayaran</td>
								<td width="1">:</td>
								<td><?php if ($kunj['asuransi_px'] == 1) {
											echo 'Umum';
										} elseif ($kunj['asuransi_px'] == 2) {
											echo 'BPJS Kesehatan';
										} else {
											echo $kunj['asuransi_lain_px'];
										} ?></td>
							</tr>

							<?php if ($kunj['asuransi_px'] == 2) : ?>
								<tr>
									<td width="200">No. BPJS</td>
									<td width="1">:</td>
									<td><?= $kunj['no_asuransi_px'] ?></td>
								</tr>
							<?php endif ?>

							<tr>
								<td width="200">Tanggal Pendaftaran</td>
								<td width="1">:</td>
								<td><?= $kunj['tgl_kunjungan'] ?></td>
							</tr>

							<tr>
								<td width="200">Waktu Pendaftaran</td>
								<td width="1">:</td>
								<td><?= $kunj['waktu_kunjungan'] ?></td>
							</tr>

							<tr>
								<td width="200">Status</td>
								<td width="1">:</td>
								<td>

									<?php
									if ($kunj['status_kunjungan'] ==  0) {
										echo 'Menunggu';
									} elseif ($kunj['status_kunjungan'] ==  1) {
										echo 'Diperiksa';
									} elseif ($kunj['status_kunjungan'] ==  2) {
										echo 'Menunggu Obat';
									} elseif ($kunj['status_kunjungan'] ==  3) {
										echo 'Menunggu Pembayaran';
									} elseif ($kunj['status_kunjungan'] ==  4) {
										echo 'Selesai';
									}
									?>

								</td>
							</tr>

							<tr>
								<td width="200">Petugas</td>
								<td width="1">:</td>
								<td><?= $kunj['nama_user'] ?></td>
							</tr>

						</table>
					</div>
				</div>

				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title"><i class="fa fa-stethoscope"> </i> Data Pemeriksaan Fisik</h3>
					</div>
					<div class="box-body">
						<table class="table table-hover table-striped ">
							<tr>
								<td width="250">Anamnesa</td>
								<td width="1">:</td>
								<td><?= $kunj['anamnesa'] ?></td>
							</tr>
							<tr>
								<td width="200">Tekanan Darah</td>
								<td width="1">:</td>
								<?php
								if ($kunj['td'] == 1) {
									$td = 'Hypotesi';
								} elseif ($kunj['td'] == 2) {
									$td = 'Normal';
								} elseif ($kunj['td'] == 3) {
									$td = 'Pre Hypertensi';
								} elseif ($kunj['td'] == 4) {
									$td = 'Hypertensi';
								} else {
									$td = '';
								}
								?>
								<td><?= $kunj['sistol'] . '/' . $kunj['diastol'] . ' mmHg &nbsp; &nbsp; <b>(' . $td . ')</b>' ?></td>
							</tr>
							<tr>
								<td width="200">Tinggi/Berat Badan</td>
								<td width="1">:</td>
								<?php
								if ($kunj['imt'] == 1) {
									$imt = 'Kurus';
								} elseif ($kunj['imt'] == 2) {
									$imt = 'Normal';
								} elseif ($kunj['imt'] == 3) {
									$imt = 'Berat Badan Lebih';
								} elseif ($kunj['imt'] == 4) {
									$imt = 'Gemuk';
								} else {
									$imt = '';
								}
								?>
								<td><?= $kunj['tb'] . ' m/' . $kunj['bb'] . ' Kg  &nbsp; &nbsp; <b>(' . $imt . ')</b>' ?></td>
							</tr>

							<tr>
								<td width="200">Merokok</td>
								<td width="1">:</td>
								<td><?php if ($kunj['merokok'] == 1) {
											echo 'Jarang/Tidak Pernah';
										} elseif ($kunj['merokok'] == 2) {
											echo 'Kadang-kadang';
										} else {
											echo 'Sering';
										} ?></td>
							</tr>

							<tr>
								<td width="200">Aktivitas Fisik</td>
								<td width="1">:</td>
								<td><?php if ($kunj['aktivitas_fisik'] == 1) {
											echo 'Jarang/Tidak Pernah';
										} elseif ($kunj['aktivitas_fisik'] == 2) {
											echo 'Kadang-kadang';
										} else {
											echo 'Sering';
										} ?></td>
							</tr>

							<tr>
								<td width="200">Riwayat Keluarga dengan Stroke</td>
								<td width="1">:</td>
								<td><?php if ($kunj['riwayat_kel_stroke'] == 1) {
											echo 'Ya';
										} else {
											echo 'Tidak';
										} ?></td>
							</tr>

							<tr>
								<td width="200">Riwayat Keluarga dengan DM</td>
								<td width="1">:</td>
								<td><?php if ($kunj['riwayat_kel_dm'] == 1) {
											echo 'Ya';
										} else {
											echo 'Tidak';
										} ?></td>
							</tr>

							<tr>
								<td width="200">Risiko Stroke</td>
								<td width="1">:</td>
								<td><?php if ($kunj['risiko_stroke'] == 1) {
											echo '<span class="text-success"><i class="fa fa-check"> </i> <b>Resiko Rendah Sroke</b></span>';
										} elseif ($kunj['risiko_stroke'] == 2) {
											echo '<span class="text-warning"><i class="fa fa-warning"> </i> <b>Resiko Sedang Sroke</b></span>';
										} elseif ($kunj['risiko_stroke'] == 3) {
											echo '<span class="text-red"><i class="fa fa-warning"> </i> <b>Resiko Tinggi Sroke</b></span>';
										} else {
											echo '';
										} ?></td>
							</tr>
							<tr>
								<td width="200">Risiko DM</td>
								<td width="1">:</td>
								<td><?php if ($kunj['risiko_dm'] == 1) {
											echo '<span class="text-red"><i class="fa fa-warning"> </i> <b>Resiko Tinggi DM</b></span>';
										} else {
											echo '<span class="text-success"><i class="fa fa-check"> </i> <b>Resiko Rendah DM</b></span>';
										} ?></td>
							</tr>


						</table>
					</div>
				</div>

				<div class="box box-primary <?php if ($status_lab > 0) {
																			echo 'hidden';
																		} ?>">
					<div class="box-header with-border">
						<h3 class="box-title"><i class="fa fa-stethoscope"> </i> Data Pemeriksaan Lab</h3>
					</div>
					<div class="box-body">
						<table class="table table-hover table-striped ">
							<tr>
								<td width="250">Kolesterol</td>
								<td width="1">:</td>
								<td><?= $kunj['kolesterol'] ?></td>
							</tr>

							<tr>
								<td width="250">Gula Darah Acak</td>
								<td width="1">:</td>
								<td><?= $kunj['gda'] ?></td>
							</tr>

							<tr>
								<td width="250">Gula Darah Puasa</td>
								<td width="1">:</td>
								<td><?= $kunj['gdp'] ?></td>
							</tr>

							<tr>
								<td width="250">Gula Darah Setelah Makan</td>
								<td width="1">:</td>
								<td><?= $kunj['gdsm'] ?></td>
							</tr>
						</table>
					</div>
				</div>

				<div class="box box-primary  <?php if ($status_rad > 0) {
																				echo 'hidden';
																			} ?>">
					<div class="box-header with-border">
						<h3 class="box-title"><i class="fa fa-stethoscope"> </i> Data Pemeriksaan Radiologi</h3>
					</div>
					<div class="box-body">
						<table class="table table-hover table-striped ">
							<tr>
								<td width="250">Jenis Pemeriksaan</td>
								<td width="1">:</td>
								<td><?= $kunj['jenis_pemeriksaan'] ?></td>
							</tr>
							<tr>
								<td width="250">Hasil Pemeriksaan</td>
								<td width="1">:</td>
								<td><?= $kunj['hasil'] ?></td>
							</tr>
						</table>
					</div>
				</div>

				<div class="box box-primary  <?php if ($status_diag == 0) {
																				echo 'hidden';
																			} ?>">
					<div class="box-header with-border">
						<h3 class="box-title"><i class="fa fa-stethoscope"> </i> Diagnosa</h3>
					</div>
					<div class="box-body">
						<table class="table table-hover table-striped ">
							<thead>
								<tr>
									<th>#</th>
									<th>Kode</th>
									<th>Nama Diagnosa</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($dx as $d) : ?>
									<tr>
										<td><?php if ($d->jenis == 1) {
													echo 'Diagnosis Primer';
												} elseif ($d->jenis == 2) {
													echo 'Diagnosis Sekunder';
												} else {
													echo 'Diagnosis Lainnya';
												} ?></td>
										<td><?= $d->kode_diagnosa ?></td>
										<td><?= $d->nama_diagnosa ?></td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>

				<div class="box box-primary  <?php if ($status_resep == 0) {
																				echo 'hidden';
																			} ?>">
					<div class="box-header with-border">
						<h3 class="box-title"><i class="fa fa-flask"> </i> Data Resep</h3>
					</div>
					<div class="box-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr style="background-color: #A8CDFF;">
									<th>Nama Obat</th>
									<th>Jumlah</th>
									<th>Aturan Pakai</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($resep as $r) : ?>
									<tr>
										<td><?= $r->nama_obat ?></td>
										<td><?= $r->jumlah ?></td>
										<td><?= $r->aturan_pakai ?></td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>


			</div>
			<!-- /.col (RIGHT) -->
		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php $this->load->view('footer') ?>

<script>
	$(document).ready(function() {

		$('#pasien').addClass('active');



	});
</script>
