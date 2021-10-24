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

				<!-- <a href="<?= base_url('pasien/add') ?>" class="btn btn-info"><i class="fa fa-plus"> </i> Data Pasien Baru</a>
          <a href="<?= base_url('pendaftaran/list_pendaftaran') ?>" class="btn btn-primary"><i class="fa fa-eye"> </i> Lihat Pendaftaran</a> -->
				<a href="<?= base_url('penunjang/riwayat_rad') ?>" class="btn btn-primary"><i class="fa fa-eye"> </i> Riwayat Pemeriksaan</a>


				<br>
				<br>

			</div>

			<?= form_open(base_url('penunjang/save_rad'), ['class' => 'form-horizontal']) ?>
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Identitas Pasien</h3>
					</div>
					<div class="box-body">

						<div class="form-group">
							<label class="col-sm-2 control-label">No. RM</label>

							<div class="col-sm-4">
								<input type="text" name="no_rm" class="form-control" id="no_rm" value="<?= $pasien['no_rm'] ?>" autofocus="" required="" readonly>
							</div>

							<label class="col-sm-2 control-label">Nama Pasien </label>

							<div class="col-sm-4">
								<input type="text" name="nama_px" class="form-control" id="nama_px" value="<?= $pasien['nama_px'] ?>" disabled>
								<input type="hidden" name="id_kunjungan" class="form-control" id="id_kunjungan" value="<?= $pasien['id_kunjungan'] ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Jenis Kelamin </label>
							<div class="col-sm-4">
								<input type="text" id="jk_px" class="form-control" value="<?php if ($pasien['jk_px'] == 1) {
																																						echo 'Laki-laki';
																																					} else {
																																						echo 'Perempuan';
																																					} ?>" disabled>
							</div>

							<label class="col-sm-2 control-label">Alamat</label>
							<div class="col-sm-4">
								<textarea class="form-control" id="alamat_px" disabled=""><?= $pasien['alamat_px'] ?></textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Tempat Tanggal Lahir </label>

							<div class="col-sm-4">
								<input type="text" id="ttl" value="<?= $pasien['tempat_lahir_px'] . ', ' . $pasien['tgl_lahir_px'] ?>" class="form-control" disabled="">
								<input type="hidden" id="biday" value="<?= $pasien['tgl_lahir_px'] ?>">

								<small id="umur" style="font-weight: 700;"> </small>
							</div>

							<label class="col-sm-2 control-label">Pembayaran</label>

							<div class="col-sm-4">
								<input type="text" id="pembayaran" class="form-control" value="<?php if ($pasien['asuransi_px'] == 1) {
																																									echo 'Umum';
																																								} elseif ($pasien['asuransi_px'] == 2) {
																																									echo 'BPJS Kesehatan';
																																								} else {
																																									echo $pasien['asuransi_lain_px'];
																																								} ?>" disabled>
							</div>

						</div>

					</div>

				</div>
				<!--- // BOX -->


				<div class="box box-primary" id="rad">
					<div class="box-header with-border">
						<h3 class="box-title">Data Pemeriksaan Radiologi</h3>
					</div>
					<div class="box-body">
						<div class="form-group">

							<label class="col-sm-2 control-label">Jenis Pemeriksaan</label>

							<div class="col-sm-4">
								<select name="jenis_pemeriksaan" class="form-control">
									<option>X-Ray Umum</option>
									<option>USG</option>
									<option>CT-Scan</option>
									<option>MRI</option>
									<option>Mamografi</option>
									<option>Angiografi</option>
								</select>
							</div>

							<label class="col-sm-2 control-label">Hasil Pemeriksaan Radiologi</label>

							<div class="col-sm-4">
								<textarea class="form-control" name="hasil" id="hasilRad" rows="4" required=""></textarea>

							</div>


						</div>
					</div>
				</div>


				<!-- <div class="box-footer"> -->
				<center>
					<h3 id="res-str"></h3>
				</center>
				<input type="hidden" name="risiko_stroke" id="risiko_stroke" value="0">
				<!-- </div> -->

				<center>
					<button type="submit" class="btn btn-primary btn-sm">Simpan</button>
					<!-- <button type="button" id="btn-lab" class="btn btn-info btn-sm">Tambah Data Lab</button> -->
					<!-- <button type="button" id="btn-lab-del" class="btn btn-danger btn-sm hidden">Hapus Data Lab</button> -->
					<!-- <button type="button" id="btn-rad" class="btn btn-info btn-sm">Tambah Data Radiologi</button> -->
					<!-- <button type="button" id="btn-rad-del" class="btn btn-danger btn-sm hidden">Hapus Data Radiologi</button> -->
					<button type="reset" class="btn btn-default btn-sm">Reset</button>
				</center>

			</div>
			<?= form_close() ?>

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
	$(document).ready(function() {

		$('#left_rad').addClass('active');

		$('#no_rm').autocomplete({
			source: "<?php echo site_url('penunjang/autocomplete_rad'); ?>",

			select: function(event, ui) {
				var jk;
				var as;
				if (ui.item.jk_px == 1) {
					jk = 'Laki-Laki';
				} else {
					jk = 'Perempuan';
				}

				if (ui.item.asuransi_px == 3) {
					as = ui.item.asuransi_lain_px;
				} else if (ui.item.asuransi_px == 2) {
					as = 'BPJS Kesehatan';
				} else {
					as = 'Umum';
				}

				$('#nama_px').val(ui.item.nama_px);
				$('#no_rm').val(ui.item.no_rm);
				$('#jk_px').val(jk);
				$('#alamat_px').val(ui.item.alamat_px);
				$('#pembayaran').val(as);
				$('#id_kunjungan').val(ui.item.id_kunjungan);
				$('#ttl').val(ui.item.tempat_lahir_px + ', ' + ui.item.tgl_lahir_px);
				umur(ui.item.tgl_lahir_px);
			}
		});

		// UMUR
		function umur(bd) {
			var today = new Date();
			var birthday = new Date(bd);
			var year = 0;
			if (today.getMonth() < birthday.getMonth()) {
				year = 1;
			} else if ((today.getMonth() == birthday.getMonth()) && today.getDate() < birthday.getDate()) {
				year = 1;
			}
			var age = today.getFullYear() - birthday.getFullYear() - year;

			if (age < 0) {
				age = 0;
			}
			$('#umur').html(age + ' Tahun');
		}


		$('#no_rm').on('change', function() {
			var no = $('#no_rm').val();
			var no_rm = no.substr(0, 6);
			$('#no_rm').val(no_rm);
		});




	});
</script>
