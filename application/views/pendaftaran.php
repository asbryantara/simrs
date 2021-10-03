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
				<a href="<?= base_url('pendaftaran/list_pendaftaran') ?>" class="btn btn-primary"><i class="fa fa-eye"> </i> Lihat Pendaftaran</a>

				<br>
				<br>

			</div>

			<?= form_open(base_url('pendaftaran/save'), ['class' => 'form-horizontal']) ?>
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Identitas Pasien</h3>

						<h3 class="text-red box-title pull-right" id="alergi"></h3>
					</div>
					<div class="box-body">

						<div class="form-group">
							<label class="col-sm-2 control-label">No. RM</label>

							<div class="col-sm-4">
								<input type="text" name="no_rm" class="form-control" id="no_rm" required="" autofocus="">
								<small class="text-red"><b>Note: </b>masukkan no. rm atau nama pasien</small>
							</div>

							<label class="col-sm-2 control-label">Nama Pasien </label>

							<div class="col-sm-4">
								<input type="text" name="nama_px" class="form-control" id="nama_px" disabled>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Jenis Kelamin </label>
							<div class="col-sm-4">
								<input type="text" id="jk_px" class="form-control" disabled>
							</div>

							<label class="col-sm-2 control-label">Alamat</label>
							<div class="col-sm-4">
								<textarea class="form-control" id="alamat_px" disabled=""></textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Tempat Tanggal Lahir </label>

							<div class="col-sm-4">
								<input type="text" id="ttl" class="form-control" disabled="">
								<small id="umur" style="font-weight: 700;"></small>
							</div>

							<label class="col-sm-2 control-label">Pembayaran</label>

							<div class="col-sm-4">
								<input type="text" id="pembayaran" class="form-control" disabled>
							</div>

						</div>

					</div>

				</div>
				<!--- // BOX -->

				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Data Pemeriksaan Fisik</h3>
					</div>
					<div class="box-body">

						<div class="form-group">
							<label class="col-sm-2 control-label">Anamnesa</label>

							<div class="col-sm-10">
								<textarea name="anamnesa" id="anamnesa" class="form-control" rows="4" required=""></textarea>
							</div>

						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Tekanan Darah</label>

							<div class="col-sm-2">
								<input type="text" name="sistol" id="sys" class="form-control" placeholder="Systole" required="">
								<input type="hidden" name="resultTd" id="resultTd" value="0">
								<small id="td"></small>
							</div>
							<div class="col-sm-2">
								<input type="text" name="diastol" id="dias" class="form-control" placeholder="Diastole" required="">
							</div>

							<label class="col-sm-2 control-label">Tinggi / Berat Badan</label>

							<div class="col-sm-2">
								<input type="text" name="tb" id="tb" class="form-control" placeholder="tinggi badan (m)" required="">
								<input type="hidden" name="resultImt" id="resultImt" value="0">
								<small id="imt"></small>
							</div>
							<div class="col-sm-2">
								<input type="text" name="bb" id="bb" class="form-control" placeholder="berat badan (kg)" required="">
							</div>

						</div>

						<div class="form-group">

							<label class="col-sm-2 control-label">Merokok</label>

							<div class="col-sm-4">
								<select name="merokok" id="merokok" class="form-control" required="">
									<option value="">--pilih--</option>
									<option value="1">Jarang/Tidak Pernah</option>
									<option value="2">Kadang-Kadang</option>
									<option value="3">Sering</option>
								</select>
							</div>
							<label class="col-sm-2 control-label">Aktifitas Fisik</label>

							<div class="col-sm-4">
								<select name="aktivitas_fisik" id="aktivitas_fisik" class="form-control" required="">
									<option value="">--pilih--</option>
									<option value="1">Jarang/Tidak Pernah</option>
									<option value="2">Kadang-Kadang</option>
									<option value="3">Sering</option>
								</select>
							</div>
						</div>

						<div class="form-group">

							<label class="col-sm-2 control-label">Riwayat Keluarga</label>

							<div class="col-sm-4">
								<input type="checkbox" name="riwayat_keluarga_stroke" class="flat-red" id="riwayat_keluarga_stroke" value="0"> Riwayat Keluarga dengan Stroke <br>
								<input type="checkbox" name="riwayat_keluarga_dm" class="flat-red" id="riwayat_keluarga_dm" value="0"> Riwayat Keluarga dengan Diabetus Mellitus
							</div>

						</div>
					</div>
				</div>


				<div class="box box-primary hidden" id="lab">
					<div class="box-header with-border">
						<h3 class="box-title">Data Pemeriksaan Lab</h3>
						<input type="hidden" name="dataLab" id="dataLab" value="0">
					</div>
					<div class="box-body">
						<div class="form-group">
							<label class="col-sm-2 control-label">Kolesterol</label>

							<div class="col-sm-4">
								<input type="text" name="kolesterol" id="kolesterol" class="form-control">
								<small id="res-kol"></small>
							</div>

							<label class="col-sm-2 control-label">Gula Darah Acak</label>

							<div class="col-sm-4">
								<input type="text" name="gda" id="gda" class="form-control">
								<input type="hidden" name="resultGd" id="resultGd" value="0">
								<small id="res-gda"></small>
							</div>

						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Gula Darah Puasa</label>

							<div class="col-sm-4">
								<input type="text" name="gdp" id="gdp" class="form-control">
								<small id="res-gdp"></small>
							</div>

							<label class="col-sm-2 control-label">Gula Darah Setelah Makan</label>

							<div class="col-sm-4">
								<input type="text" name="gdsm" id="gdsm" class="form-control">
								<small id="res-gdsm"></small>
							</div>

						</div>



					</div>




				</div>

				<div class="box box-primary hidden" id="rad">
					<div class="box-header with-border">
						<h3 class="box-title">Data Pemeriksaan Radiologi</h3>
						<input type="hidden" name="dataRad" id="dataRad" value="0">
					</div>
					<div class="box-body">
						<div class="form-group">
							<label class="col-sm-2 control-label">Hasil Pemeriksaan Radiologi</label>

							<div class="col-sm-10">
								<textarea class="form-control" name="hasil" id="hasilRad" rows="4"></textarea>

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
					<button type="button" id="btn-lab-del" class="btn btn-danger btn-sm hidden">Hapus Data Lab</button>
					<!-- <button type="button" id="btn-rad" class="btn btn-info btn-sm">Tambah Data Radiologi</button> -->
					<button type="button" id="btn-rad-del" class="btn btn-danger btn-sm hidden">Hapus Data Radiologi</button>
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

<script src="<?= base_url('assets/') ?>dist/js/jquery.mask.min.js"></script>
<script>
	$(document).ready(function() {

		$('#pendaftaran').addClass('active');

		$('#no_rm').autocomplete({
			source: "<?php echo site_url('pendaftaran/autocomplete'); ?>",

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

				if (ui.item.alergi_px) {
					$('#alergi').html('<i class="fa fa-warning"> </i> ALERGI ' + ui.item.alergi_px);
				}

				$('#nama_px').val(ui.item.nama_px);
				$('#no_rm').val(ui.item.no_rm);
				$('#jk_px').val(jk);
				$('#alamat_px').val(ui.item.alamat_px);
				$('#pembayaran').val(as);
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


		// PEMERIKSAAN HOOOO



		/*
		=================================================================================
		                      KODE
		=================================================================================
		KATEGORI              1                 2               3                   4
		=================================================================================
		TEKANAN DARAH         HYPOTENSI         NORMAL          PREHYPERTENSI       -
		IMT                   KURUS             NORMAL          BERAT BADAN LEBIH   GEMUK
		GULA DARAH            NORMAL            DM
		=================================================================================
		*/


		$('.flat-red').iCheck({
			checkboxClass: 'icheckbox_flat-blue',
			radioClass: 'iradio_flat-blue'
		});


		/*
		=======================================
		              TEKANAN DARAH
		=======================================
		KATEGORI          SYSTOLE   | DIASTOLE
		=======================================
		hypotensi       = <90       | <60
		normal          = 90 - 120  | 60 - 80
		pre hypertensi  = 120 - 140 | 80 - 90
		hypertensi      = 140 - 160 | 90 - 100
		=======================================
		*/

		function tekanan_darah() {
			var td;
			var sys = $('#sys').val();
			var dias = $('#dias').val();

			if ((sys == '') || (dias == '')) {
				td = '';
			} else {
				if ((sys < 120) && (dias < 80)) {
					console.log('1')
					td = 'Normal';
				} else if ((sys < 129) && (dias < 80)) {
					console.log('12')
					td = 'Elevated';
				} else if ((sys < 140) && (dias < 90)) {
					console.log('123')
					td = 'Hypertensi 1';
				} else if ((sys < 180) && (dias < 120)) {
					console.log('1234')
					td = 'Hypertensi 2';
				} else if ((sys < 180) && (dias < 120)) {
					console.log('12346')
					td = 'Hypertensi 2';
				} else {
					console.log('asd')

				}
			}
			return (td);
		}

		function actTekananDarah(td) {
			if (td == 'Normal') {
				$('#td').removeClass().addClass('text-red').html('<b>' + td + '</b>');
				$('#resultTd').val(1);
			} else if (td == 'Elevated') {
				$('#td').removeClass().addClass('text-blue').html('<b>' + td + '</b>');
				$('#resultTd').val(2);
			} else if (td == 'Pre Hypertensi') {
				$('#td').removeClass().addClass('text-red').html('<b>' + td + '</b>');
				$('#resultTd').val(3);
			} else if (td == 'Hypertensi') {
				$('#td').removeClass().addClass('text-red').html('<b>' + td + '</b>');
				$('#resultTd').val(4);
			} else if (td == '') {
				$('#td').removeClass().addClass('text-red').html('<b>' + td + '</b>');
				$('#resultTd').val(0);
			}
		}

		$('#dias, #sys').on('change', function() {
			var td = tekanan_darah();
			actTekananDarah(td);
		});

		/*
		=======================================
		           INDEX MASA TUBUH
		                 BB (kg)
		           IMT = --------
		                 TB^2 (m)
		=======================================
		KATEGORI          IMT
		=======================================
		kurus       = <18.5
		normal      = 18.5 - 25.0
		gemuk       = > 25
		=======================================
		*/

		function imt() {
			var imt;
			var ket_imt;
			var tb = $('#tb').val();
			var bb = $('#bb').val();
			var a = bb / (tb * tb);
			imt = a.toFixed(2);
			// console.log('tb : ', tb)
			// console.log('bb : ', bb)
			// console.log('hasil : ', a)

			if ((bb == '') || (tb == '')) {
				ket_imt = '';
			} else {
				if (imt < 18.5) {
					ket_imt = 'Kurus';
				} else if (imt <= 23) {
					ket_imt = 'Normal';
				} else if (imt <= 29.9) {
					ket_imt = 'Berat Badan Lebih';
				} else {
					ket_imt = 'Gemuk';
				}
			}


			return (ket_imt);
		}

		function actImt(ket_imt) {
			if (ket_imt == 'Kurus') {
				$('#imt').removeClass().addClass('text-red').html('<b>' + ket_imt + '</b>');
				$('#resultImt').val(1);
			} else if (ket_imt == 'Normal') {
				$('#imt').removeClass().addClass('text-blue').html('<b>' + ket_imt + '</b>');
				$('#resultImt').val(2);
			} else if (ket_imt == 'Berat Badan Lebih') {
				$('#imt').removeClass().addClass('text-red').html('<b>' + ket_imt + '</b>');
				$('#resultImt').val(3);
			} else if (ket_imt == 'Gemuk') {
				$('#imt').removeClass().addClass('text-red').html('<b>' + ket_imt + '</b>');
				$('#resultImt').val(4);
			} else if (ket_imt == '') {
				$('#imt').removeClass().addClass('text-red').html('<b>' + ket_imt + '</b>');
				$('#resultImt').val(0);
			}
		}

		$('#bb, #tb').on('change', function() {
			var ketImt = imt();
			actImt(ketImt);
		});

		// MENAMPILKAN DATA LAB
		$('#btn-lab').on('click', function() {
			$('#lab').removeClass('hidden');
			$('#btn-lab').addClass('hidden');
			$('#btn-lab-del').removeClass('hidden');
			$('#res-kol').removeClass().html('');
			$('#res-gdp').removeClass().html('');
			$('#res-gdsm').removeClass().html('');
			$('#res-gda').removeClass().html('');
			$('#dataLab').val(1);

		});

		// MENYEMBUNYIKAN DATA LAB
		$('#btn-lab-del').on('click', function() {
			$('#lab').addClass('hidden');
			$('#btn-lab').removeClass('hidden');
			$('#btn-lab-del').addClass('hidden');
			$('#kolesterol').val('');
			$('#gda').val('');
			$('#gdp').val('');
			$('#gdsm').val('');
			$('#dataLab').val(0);
			cekStroke();
		});

		// MENAMPILKAN DATA RAD
		$('#btn-rad').on('click', function() {
			$('#rad').removeClass('hidden');
			$('#btn-rad').addClass('hidden');
			$('#btn-rad-del').removeClass('hidden');
			$('#dataRad').val(1);
		});

		// MENYEMBUNYIKAN DATA RAD
		$('#btn-rad-del').on('click', function() {
			$('#rad').addClass('hidden');
			$('#btn-rad').removeClass('hidden');
			$('#btn-rad-del').addClass('hidden');
			$('#hasilRad').val('');
			$('#dataRad').val(0);
		});


		/*
		=======================================
		           PEMERIKSAAN LAB
		=======================================
		KATEGORI          NORMAL
		=======================================
		Gula Darah Puasa          = 70 - 110
		Gula Darah Setelah Makan  = 110 - 125
		Gula Darah Acak           = < 140
		Kolesterol Total          = < 200
		=======================================
		*/


		function kolesterol1() {
			var kolesterol;
			var kol = $('#kolesterol').val();
			if (kol != '') {
				if (kol < 200) {
					kolesterol = 'Normal';
				} else if (kol < 240) {
					kolesterol = 'Sedang';
				} else if (kol >= 240) {
					kolesterol = 'Tinggi';
				}
			} else {
				kolesterol = '';
			}

			return (kolesterol);
		}

		function kolesterol() {
			var kolesterol;
			var kol = $('#kolesterol').val();
			if (kol != '') {
				if (kol >= 200) {
					kolesterol = 'Tinggi';
				} else {
					kolesterol = 'Normal';
				}
			} else {
				kolesterol = '';
			}

			return (kolesterol);
		}

		function actKolesterol(kolesterol) {
			if (kolesterol != '') {
				if (kolesterol == 'Tinggi') {
					$('#res-kol').removeClass().addClass('text-red').html(kolesterol);
				} else if (kolesterol == 'Normal') {
					$('#res-kol').removeClass().addClass('text-blue').html(kolesterol);
				}
			} else {
				$('#res-kol').removeClass().html(kolesterol);
			}
		}

		$('#kolesterol').on('change', function() {
			var kol = kolesterol();
			actKolesterol(kol);
		});


		function gda() {
			var gulaDarah;
			var gda = $('#gda').val();
			if (gda != '') {
				if (gda > 140) {
					gulaDarah = 'Diabetus Mellitus';
				} else {
					gulaDarah = 'Normal';
				}
			} else {
				gulaDarah = '';
			}

			return (gulaDarah);
		}

		function actGda(gulaDarah) {
			if (gulaDarah != '') {
				if (gulaDarah == 'Diabetus Mellitus') {
					$('#res-gda').removeClass().addClass('text-red').html(gulaDarah);
				} else if (gulaDarah == 'Normal') {
					$('#res-gda').removeClass().addClass('text-blue').html(gulaDarah);
				}
			} else {
				$('#res-gda').removeClass().html(gulaDarah);
			}
		}


		$('#gda').on('change', function() {
			var gulaDarah = gda();
			actGda(gulaDarah);
		});


		function gdsm() {
			var gulaDarah;
			var gdsm = $('#gdsm').val();
			if (gdsm != '') {
				if (gdsm < 110) {
					gulaDarah = 'Rendah';
				} else if (gdsm <= 125) {
					gulaDarah = 'Normal';
				} else {
					gulaDarah = 'Diabetus Mellitus';
				}
			} else {
				gulaDarah = '';
			}
			return (gulaDarah);
		}

		function actGdsm(gulaDarah) {
			if (gulaDarah != '') {
				if (gulaDarah == 'Rendah') {
					$('#res-gdsm').removeClass().addClass('text-red').html(gulaDarah);
				} else if (gulaDarah == 'Normal') {
					$('#res-gdsm').removeClass().addClass('text-blue').html(gulaDarah);
				} else if (gulaDarah == 'Diabetus Mellitus') {
					$('#res-gdsm').removeClass().addClass('text-red').html(gulaDarah);
				}
			} else {
				$('#res-gdsm').html('');
			}
		}

		$('#gdsm').on('change', function() {
			var a = gdsm();
			actGdsm(a);
		});


		function gdp() {
			var gulaDarah;
			var gdp = $('#gdp').val();
			if (gdp != '') {
				if (gdp < 70) {
					gulaDarah = 'Rendah';
				} else if (gdp <= 110) {
					gulaDarah = 'Normal';
				} else {
					gulaDarah = 'Diabetus Mellitus';
				}
			} else {
				$('#res-gdp').html('');
			}
			return (gulaDarah);
		}

		function actGdp(gulaDarah) {
			if (gulaDarah != '') {
				if (gulaDarah == 'Rendah') {
					$('#res-gdp').removeClass().addClass('text-red').html(gulaDarah);
				} else if (gulaDarah == 'Normal') {
					$('#res-gdp').removeClass().addClass('text-blue').html(gulaDarah);
				} else if (gulaDarah == 'Diabetus Mellitus') {
					$('#res-gdp').removeClass().addClass('text-red').html(gulaDarah);
				}
			} else {
				$('#res-gdp').html('');
			}
		}

		$('#gdp').on('change', function() {
			var a = gdp();
			actGdp(a);
		});


		function cekGd() {
			var a = gda();
			var b = gdp();
			var c = gdsm();
			var d;

			if ((a == 'Diabetus Mellitus') || (b == 'Diabetus Mellitus') || (c == 'Diabetus Mellitus')) {
				d = 1;
				$('#resultGd').val(1);
			} else {
				d = 0;
			}

			return (d);
		}

		/*
		-----------------------------------------------------------------------------------
		Faktor Risiko         Risiko Tinggi         Risiko Sedang           Risiko Rendah
		-----------------------------------------------------------------------------------
		Tekanan Darah         >140/90               120-139/80-89           <120/80
		Kebiasaan Merokok     Perokok               Kadang-kadang merokok   Tidak Merokok
		Cholesterol           >240                  200-239                 <200
		Diabetes              Ya                    Ada riwayat keluarga    Tidak
		Aktivitas fisik       Malas                 Kadang-kadang           Teratur
		Berat Badan           Gemuk                 Sedikit Gemuk           Normal
		Riwayat Keluarga      Ya                    Tidak yakin             Tidak
		-----------------------------------------------------------------------------------
		JIKA JUMLAH           >=3                   4-6                     6-8
		*/

		function cekStroke() {
			var r1 = 0;
			var r2 = 0;
			var r3 = 0;

			var stroke = 0;
			var dm = 0;

			var td = tekanan_darah();
			var rokok = $('#merokok').val();
			var kol = kolesterol1();
			var gd = cekGd();
			var aktifitas = $('#aktivitas_fisik').val();
			var imtVal = imt();
			var riwayatStroke = $('#riwayat_keluarga_stroke').val();
			var riwayatDm = $('#riwayat_keluarga_dm').val();

			//penambahan rate BMI
			if (imtVal == 'Gemuk') {
				stroke += 2;
				dm += 2;
			} else if (imtVal == 'Berat Badan Lebih') {
				stroke += 1;
				dm += 1;
			}

			if (td == 'Hypertensi 2') {
				stroke += 4;
			} else if (td == 'Hypertensi 1') {
				stroke += 3;
			} else if (td == 'Pre Hypertensi') {
				stroke += 2;
			} else if (td == 'Elevated') {
				stroke += 1;
			}

			if (rokok == 3) {
				stroke += 1;
				dm += 1;
			}

			// if (kol == 'Tinggi') {
			// 	r1 += 1;
			// } else if (kol == 'Sedang') {
			// 	r2 += 1;
			// } else {
			// 	r3 += 1;
			// }

			if (aktifitas == 3) {
				stroke += 1;
				dm += 1;
			}

			if (riwayatDm == 1) {
				dm += 1;
			}
			if (riwayatStroke == 1) {
				stroke += 1;
			}

			if (r1 >= 3) {
				$('#res-str').removeClass().addClass('text-red').html(`<i class="fa fa-warning"> </i> <b>Resiko Tinggi Stroke</b>`);
				$('#risiko_stroke').val(3);
			} else if (r2 >= 4) {
				$('#res-str').removeClass().addClass('text-orange').html(`<i class="fa fa-warning"> </i> <b>Resiko Sedang Stroke</b>`);
				$('#risiko_stroke').val(2);
			} else if (r3 >= 6) {
				$('#res-str').removeClass().addClass('text-success').html(`<i class="fa fa-check"> </i> <b>Resiko Rendah Stroke</b>`);
				$('#risiko_stroke').val(1);
			} else {
				$('#res-str').removeClass().html('');
				$('#risiko_stroke').val(0);
			}

			/*
			1 : RISIKO RENDAH
			2 : RISIKO SEDANG
			3 : RISIKO TINGGI
			*/

			console.log('Stroke : ' + stroke);
			console.log('Dm : ' + dm);
			// console.log('Tinggi : ' + r1);
			// console.log('Sedang : ' + r2);
			// console.log('Rendah : ' + r3);

			// console.log(td);
			// console.log(imtVal);
			// console.log(rokok);
			// console.log(aktifitas);
			// console.log(riwayatStroke);
			// console.log(riwayatDm);
			// console.log(kol);
			// console.log(gd);
		}

		$('#dias, #sys, #bb, #tb, #merokok, #aktivitas_fisik, #kolesterol, #gda, #gdp, #gdsm').on('change', function() {
			cekStroke();
		});

		$('#riwayat_keluarga_stroke').on('ifChecked', function() {
			$('#riwayat_keluarga_stroke').val(1);
			cekStroke();
		});

		$('#riwayat_keluarga_stroke').on('ifUnchecked', function() {
			$('#riwayat_keluarga_stroke').val(0);
			cekStroke();
		});

		$('#riwayat_keluarga_dm').on('ifChecked', function() {
			$('#riwayat_keluarga_dm').val(1);
			cekStroke();
		});

		$('#riwayat_keluarga_dm').on('ifUnchecked', function() {
			$('#riwayat_keluarga_dm').val(0);
			cekStroke();
		});

		$('#tb').mask('0.00', {
			reverse: true
		});

	});
</script>
