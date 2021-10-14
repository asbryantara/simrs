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

				<a href="<?= base_url('pasien') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"> </i> &nbsp; Kembali</a>

				<br>
				<br>

			</div>

			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Identitas Pasien</h3>
					</div>
					<?= form_open(base_url('pasien/save'), ['class' => 'form-horizontal']) ?>
					<div class="box-body">
						<div class="col-md-6 col-xl-6 col-sm-6">
							<div class="form-group">
								<label class="col-md-4 control-label">No. RM</label>
								<div class="col-md-8">
									<input type="text" name="no_rm" class="form-control" id="no_rm" disabled="">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Nama Pasien <small class="text-red">*</small></label>
								<div class="col-md-8">
									<input type="text" name="nama_px" class="form-control" id="nama_px" required="">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Tempat Lahir <small class="text-red">*</small></label>

								<div class="col-sm-8">
									<select name="tempat_lahir_px" class="form-control select2" id="tempat_lahir_px" style="width: 100%" required="">
										<option value="">-- silahkan pilih --</option>
										<?php foreach ($kota_kab as $kk) : ?>
											<option><?= str_replace('KABUPATEN ', '', str_replace('KOTA ', '', $kk->nama_kota_kab)) ?></option>
										<?php endforeach ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Alamat <small class="text-red">*</small></label>

								<div class="col-sm-8">
									<textarea name="alamat_px" class="form-control" required="" style="width: 100%"></textarea>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">No. Telp</label>
								<div class="col-sm-8">
									<input type="text" name="telp_px" id="telp_px" class="form-control" autocomplete="off">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Pendidikan Terakhir</label>

								<div class="col-sm-8">
									<select name="pendidikan_px" class="form-control select2" style="width:100%;">
										<option value=""> -- pilih pendidikan --</option>
										<option value="0">Tidak Sekolah</option>
										<option value="1">SD</option>
										<option value="2">SMP</option>
										<option value="3">SMA</option>
										<option value="4">D-III</option>
										<option value="5">D-IV / S1</option>
										<option value="6">S2</option>
										<option value="7">S3</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Pekerjaan</label>

								<div class="col-sm-8">
									<select name="pekerjaan_px" class="form-control">
										<option value="">-- pilih pekerjaan --</option>
										<option value="0">Tidak Bekerja</option>
										<option value="1">Tani</option>
										<option value="2">PNS</option>
										<option value="3">TNI / Polri</option>
										<option value="4">Karyawan</option>
										<option value="5">Buruh</option>
										<option value="6">Wirausaha</option>
									</select>
								</div>
							</div>


							<div class="form-group">
								<label class="col-sm-4 control-label">Agama</label>

								<div class="col-sm-8">
									<select name="agama_px" class="form-control">
										<option value="">-- pilih agama --</option>
										<option value="ISLAM">ISLAM</option>
										<option value="HINDU">HINDU</option>
										<option value="KRISTEN">KRISTEN</option>
										<option value="BUDHA">BUDHA</option>
										<option value="KATHOLIK">KATHOLIK</option>
										<option value="KHONGHUCU">KHONGHUCU</option>
									</select>
								</div>
							</div>



						</div>

						<div class="col-md-6 col-xl-6 col-sm-6">

							<div class="form-group">
								<label class="col-md-4 control-label">NIK</label>
								<div class="col-md-8">
									<input type="text" name="nik_px" class="form-control" id="nik" placeholder="NIK">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Jenis Kelamin <small class="text-red">*</small></label>

								<div class="col-sm-8">
									<input type="radio" name="jk_px" class="flat-red" value="1" required=""> Laki-laki &nbsp; &nbsp; &nbsp; &nbsp;
									<input type="radio" name="jk_px" class="flat-red" value="2" required=""> Perempuan
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Tanggal Lahir <small class="text-red">*</small></label>

								<div class="col-sm-8">
									<input type="text" name="tgl_lahir_px" class="form-control" id="tgl_lahir_px" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask required="">
									<small id="umur" style="font-weight: 700;"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Provinsi</label>

								<div class="col-sm-8">
									<select name="id_provinsi" id="id_provinsi" class="form-control select2" style="width:100%;">
										<option value="">-- pilih provinsi --</option>
										<?php foreach ($provinsi as $pro) : ?>
											<option value="<?= $pro->id_provinsi ?>"><?= $pro->nama_provinsi ?></option>
										<?php endforeach ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Kota/Kabupaten</label>

								<div class="col-sm-8">
									<select name="id_kota_kab" id="id_kota_kab" class="form-control select2" style="width:100%;" disabled=""></select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Kecamatan</label>

								<div class="col-sm-8">
									<select name="id_kecamatan" id="id_kecamatan" class="form-control select2" style="width:100%;" disabled=""></select>
								</div>
							</div>


							<div class="form-group">
								<label class="col-sm-4 control-label">Desa/Kelurahan</label>

								<div class="col-sm-8">
									<select name="id_desa" id="id_desa" class="form-control select2" style="width:100%;" disabled=""></select>
								</div>
							</div>


							<div class="form-group">
								<label class="col-sm-4 control-label">Pembayaran</label>

								<div class="col-sm-8">
									<select name="asuransi_px" id="asuransi_px" class="form-control">
										<option value="1">Umum/Tunai</option>
										<option value="2">BPJS Kesehatan</option>
										<option value="3">Asuransi Lain</option>
									</select>
								</div>
							</div>
							<div class="form-group">

								<div id="no_asuransi" class="hidden">
									<label class="col-sm-4 control-label">No. Kartu BPJS</label>

									<div class="col-sm-8">
										<input type="text" name="no_asuransi_px" class="form-control" autocomplete="off">
									</div>
								</div>

								<div id="nama_asuransi_lain" class="hidden">
									<label class="col-sm-4 control-label">Nama Asuransi</label>

									<div class="col-sm-8">
										<input type="text" name="asuransi_lain_px" class="form-control">
									</div>
								</div>

							</div>
						</div>



					</div>

				</div>



				<!-- <label class="col-sm-2 control-label">Alergi</label>
							<div class="col-sm-4">
								<input type="text" name="alergi_px" id="alergi_px" class="form-control" autocomplete="off">
							</div> -->

			</div>

		</div>
		<div class="box-footer">
			<center>
				<button type="submit" class="btn btn-primary btn-sm">Simpan</button>
				<button type="reset" class="btn btn-default btn-sm">Reset</button>
			</center>
		</div>
		<?= form_close() ?>

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

		// ACTIVE LEFTBAR
		$('#pasien').addClass('active');

		// SELECT2
		$('.select2').select2();

		// ICHECK
		$('.flat-red').iCheck({
			checkboxClass: 'icheckbox_flat-blue',
			radioClass: 'iradio_flat-blue'
		});

		// INPUT MASK
		$('#tgl_lahir_px').inputmask('dd/mm/yyyy', {
			'placeholder': 'dd/mm/yyyy'
		});

		// UMUR
		$('#tgl_lahir_px').on('change', function() {
			umur();
		});

		$('#alergi_px').autocomplete({
			source: "<?php echo site_url('pasien/alergi'); ?>",

			select: function(event, ui) {
				$('#alergi_px').val(ui.item.nama_konten);
			}
		});


		function umur() {
			var today = new Date();
			var a = $('#tgl_lahir_px').val();
			var b = a.split('/');
			var tt = b[2] + '-' + b[1] + '-' + b[0];
			var birthday = new Date(tt);
			var year = 0;

			// console.log(today);
			// console.log(birthday);
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

		// MENAMPILKAN KOTA KETIKA MEMILIH PROVINSI
		$('#id_provinsi').on('change', function() {
			var id_provinsi = $('#id_provinsi').val();
			if (id_provinsi != '') {
				$('#id_kota_kab').removeAttr('disabled');
				var id_provinsi = $('#id_provinsi').val();
				$.ajax({
					type: 'POST',
					url: '<?= base_url('master/kota_prov') ?>',
					dataType: 'JSON',
					data: {
						id_provinsi: id_provinsi,
					},
					success: function(data) {
						var html = '';
						html += `<option value="">--pilih kota/kab--</option>`;
						for (i = 0; i < data.length; i++) {
							html += `<option value=` + data[i].id_kota_kab + `>` + data[i].nama_kota_kab + `</option>`;
						}
						$('#id_kota_kab').html(html);
					}
				});
			} else {
				$('#id_kota_kab, #id_kecamatan, #id_desa').attr('disabled', '');
				$('#id_kota_kab, #id_kecamatan, #id_desa').val('').trigger('change');
			}
		});


		// MENAMPILKAN KECAMATAN KETIKA MEMILIH KOTA
		$('#id_kota_kab').on('change', function() {
			var id_kota_kab = $('#id_kota_kab').val();
			if (id_kota_kab != '') {
				$('#id_kecamatan').removeAttr('disabled');
				$.ajax({
					type: 'POST',
					url: '<?= base_url('master/kec_kota') ?>',
					dataType: 'JSON',
					data: {
						id_kota_kab: id_kota_kab,
					},
					success: function(data) {
						var html = '';
						html += `<option value="">--pilih kecamatan--</option>`;
						for (i = 0; i < data.length; i++) {
							html += `<option value=` + data[i].id_kecamatan + `>` + data[i].nama_kecamatan + `</option>`;
						}
						$('#id_kecamatan').html(html);
					}
				});
			} else {
				$('#id_kecamatan, #id_desa').attr('disabled', '');
				$('#id_kecamatan, #id_desa').val('').trigger('change');

			}
		});

		// MENAMPILKAN DESA KETIKA MEMILIH KECAMATAN
		$('#id_kecamatan').on('change', function() {
			var id_kecamatan = $('#id_kecamatan').val();
			if (id_kecamatan != '') {
				$('#id_desa').removeAttr('disabled');
				$.ajax({
					type: 'POST',
					url: '<?= base_url('master/des_kec') ?>',
					dataType: 'JSON',
					data: {
						id_kecamatan: id_kecamatan,
					},
					success: function(data) {
						var html = '';
						html += `<option value="">--pilih desa--</option>`;
						for (i = 0; i < data.length; i++) {
							html += `<option value=` + data[i].id_desa + `>` + data[i].nama_desa + `</option>`;
						}
						$('#id_desa').html(html);
					}
				});
			} else {
				$('#id_desa').attr('disabled', '');
				$('#id_desa').val('').trigger('change');
			}
		});


		// MENAMPILKAN KOLOM NO BPJS KETIKA MEMILIH BPJS
		$('#asuransi_px').on('change', function() {
			var asu = $('#asuransi_px').val();
			if (asu == 1) {
				$('#no_asuransi').addClass('hidden');
				$('#nama_asuransi_lain').addClass('hidden');
			} else if (asu == 2) {
				$('#no_asuransi').removeClass('hidden');
				$('#nama_asuransi_lain').addClass('hidden');
			} else if (asu == 3) {
				$('#nama_asuransi_lain').removeClass('hidden');
				$('#no_asuransi').addClass('hidden');
			}
		});

	});
</script>
