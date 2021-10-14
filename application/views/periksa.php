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

				<!-- <a href="<?= base_url('pasien/add') ?>" class="btn btn-primary"><i class="fa fa-plus"> </i> Data Pasien Baru</a> -->
				<!-- <a href="<?= base_url('pendaftaran/list_pendaftaran') ?>" class="btn btn-primary"><i class="fa fa-eye"> </i> Lihat Pendaftaran</a> -->
				<a href="<?= base_url('klinik/pengantar_lab/' . $this->uri->segment(3)) ?>" target="_blank" class="btn btn-primary"><i class="fa fa-envelope"> </i> Buat Pengantar Lab</a>
				<a href="<?= base_url('klinik/pengantar_rad/' . $this->uri->segment(3)) ?>" target="_blank" class="btn btn-primary"><i class="fa fa-envelope"> </i> Buat Pengantar Radiologi</a>

				<br>
				<br>

			</div>

			<?= form_open(base_url('klinik/save'), ['class' => 'form-horizontal']) ?>
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Identitas Pasien</h3>
						<?php if ($kunj['alergi_px']) : ?>
							<h3 class="text-red box-title pull-right" id="alergi"><i class="fa fa-warning"> </i> ALERGI <?= $kunj['alergi_px'] ?></h3>
						<?php endif ?>
					</div>
					<div class="box-body">

						<div class="form-group">
							<label class="col-sm-2 control-label">No. RM</label>

							<div class="col-sm-4">
								<input type="text" class="form-control" id="no_rm" value="<?= $kunj['no_rm'] ?>" disabled>
								<input type="hidden" name="id_kunjungan" id="id_kunjungan" value="<?= $kunj['id_kunjungan'] ?>">
								<input type="hidden" id="alergi_px" value="<?= $kunj['alergi_px'] ?>">
							</div>

							<label class="col-sm-2 control-label">Nama Pasien </label>

							<div class="col-sm-4">
								<input type="text" name="nama_px" class="form-control" id="nama_px" value="<?= $kunj['nama_px'] ?>" disabled>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Jenis Kelamin </label>
							<div class="col-sm-4">
								<input type="text" id="jk_px" class="form-control" value="<?php if ($kunj['jk_px'] == 1) {
																								echo 'Laki-laki';
																							} else {
																								echo 'Perempuan';
																							} ?>" disabled>
							</div>

							<label class="col-sm-2 control-label">Alamat</label>
							<div class="col-sm-4">
								<textarea class="form-control" id="alamat_px" disabled=""><?= $kunj['alamat_px'] ?></textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Tempat Tanggal Lahir </label>

							<div class="col-sm-4">
								<input type="text" id="ttl" class="form-control" value="<?= $kunj['tempat_lahir_px'] . ', ' . $kunj['tgl_lahir_px'] ?>" disabled="">
								<input type="hidden" id="biday" value="<?= $kunj['tgl_lahir_px'] ?>">
								<small id="umur" style="font-weight: 700;"></small>
							</div>

							<label class="col-sm-2 control-label">Pembayaran</label>

							<div class="col-sm-4">
								<input type="text" id="pembayaran" class="form-control" value="<?php if ($kunj['asuransi_px'] == 1) {
																									echo 'Umum';
																								} elseif ($kunj['asuransi_px'] == 2) {
																									echo 'BPJS Kesehatan';
																								} else {
																									echo $kunj['asuransi_lain_px'];
																								} ?>" disabled>
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

							<label class="col-sm-2 control-label">Alergi</label>
							<div class="col-sm-10">
								<input type="text" name="alergi_obat" id="alergi_obat" class="form-control text-red" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Anamnesa</label>

							<div class="col-sm-10">
								<textarea name="anamnesa" id="anamnesa" class="form-control" rows="4" required=""><?= $kunj['anamnesa'] ?></textarea>
							</div>

						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Tekanan Darah</label>

							<div class="col-sm-2">
								<input type="text" name="sistol" id="sys" class="form-control" placeholder="Systole" value="<?= $kunj['sistol'] ?>" required="" readonly>
								<input type="hidden" name="resultTd" id="resultTd" value="<?= $kunj['td'] ?>">
								<small id="td"></small>
							</div>
							<div class="col-sm-2">
								<input type="text" name="diastol" id="dias" class="form-control" placeholder="Diastole" value="<?= $kunj['diastol'] ?>" required="" readonly>
							</div>

							<label class="col-sm-2 control-label">Tinggi / Berat Badan</label>

							<div class="col-sm-2">
								<input type="text" name="tb" id="tb" class="form-control" placeholder="tinggi badan (m)" readonly="" value="<?= $kunj['tb'] ?>" required="">
								<input type="hidden" name="resultImt" id="resultImt" value="<?= $kunj['imt'] ?>">
								<small id="imt"></small>
							</div>
							<div class="col-sm-2">
								<input type="text" name="bb" id="bb" class="form-control" placeholder="berat badan (kg)" readonly="" value="<?= $kunj['bb'] ?>" required="">
							</div>

						</div>

						<div class="form-group">

							<label class="col-sm-2 control-label">Merokok</label>

							<div class="col-sm-4">
								<select name="merokok" id="merokok" class="form-control" required="" disabled>
									<option value="">--pilih--</option>
									<option value="1" <?php if ($kunj['merokok'] == 1) {
															echo 'selected';
														} ?>>Jarang/Tidak Pernah</option>
									<option value="2" <?php if ($kunj['merokok'] == 2) {
															echo 'selected';
														} ?>>Kadang-Kadang</option>
									<option value="3" <?php if ($kunj['merokok'] == 3) {
															echo 'selected';
														} ?>>Sering</option>
								</select>
							</div>
							<label class="col-sm-2 control-label">Aktifitas Fisik</label>

							<div class="col-sm-4">
								<select name="aktivitas_fisik" id="aktivitas_fisik" class="form-control" required="" disabled>
									<option value="">--pilih--</option>
									<option value="1" <?php if ($kunj['aktivitas_fisik'] == 1) {
															echo 'selected';
														} ?>>Jarang/Tidak Pernah</option>
									<option value="2" <?php if ($kunj['aktivitas_fisik'] == 2) {
															echo 'selected';
														} ?>>Kadang-Kadang</option>
									<option value="3" <?php if ($kunj['aktivitas_fisik'] == 3) {
															echo 'selected';
														} ?>>Sering</option>
								</select>
							</div>
						</div>

						<div class="form-group">

							<label class="col-sm-2 control-label">Riwayat Keluarga</label>

							<div class="col-sm-4">
								<input type="checkbox" name="riwayat_keluarga_stroke" class="flat-red" id="riwayat_keluarga_stroke" disabled="disabled" value="<?= $kunj['riwayat_kel_stroke'] ?>" <?php if ($kunj['riwayat_kel_dm'] == 1) {
																																																		echo 'checked';
																																																	} ?>> Riwayat Keluarga dengan Stroke <br>
								<input type="checkbox" name="riwayat_keluarga_dm" class="flat-red" id="riwayat_keluarga_dm" disabled="disabled" value="<?= $kunj['riwayat_kel_dm'] ?>" <?php if ($kunj['riwayat_kel_dm'] == 1) {
																																															echo 'checked';
																																														} ?>> Riwayat Keluarga dengan Diabetus Mellitus
							</div>

						</div>
					</div>
				</div>


				<div class="box box-primary <?php if ($kunj['id_lab'] == null) {
												echo 'hidden';
											} ?>" id="lab">
					<div class="box-header with-border">
						<h3 class="box-title">Data Pemeriksaan Lab</h3>
						<input type="hidden" name="dataLab" id="dataLab" value="<?php if ($kunj['id_lab'] != null) {
																					echo '1';
																				} else {
																					echo '0';
																				} ?>">
					</div>
					<div class="box-body">
						<div class="form-group">
							<label class="col-sm-2 control-label">Kolesterol</label>

							<div class="col-sm-4">
								<input type="text" name="kolesterol" id="kolesterol" class="form-control" value="<?= $kunj['kolesterol'] ?>">
								<small id="res-kol"></small>
							</div>

							<label class="col-sm-2 control-label">Gula Darah Acak</label>

							<div class="col-sm-4">
								<input type="text" name="gda" id="gda" class="form-control" value="<?= $kunj['gda'] ?>">
								<input type="hidden" name="resultGd" id="resultGd" value="<?= $kunj['gd'] ?>">
								<small id="res-gda"></small>
							</div>

						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Gula Darah Puasa</label>

							<div class="col-sm-4">
								<input type="text" name="gdp" id="gdp" class="form-control" value="<?= $kunj['gdp'] ?>">
								<small id="res-gdp"></small>
							</div>

							<label class="col-sm-2 control-label">Gula Darah Setelah Makan</label>

							<div class="col-sm-4">
								<input type="text" name="gdsm" id="gdsm" class="form-control" value="<?= $kunj['gdsm'] ?>">
								<small id="res-gdsm"></small>
							</div>

						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Hemogloin</label>

							<div class="col-sm-4">
								<input type="text" name="hb" id="hb" value="<?= $kunj['hb'] ?>" class="form-control">
								<small id="res-hb"></small>
							</div>

							<label class="col-sm-2 control-label">Trombosit</label>

							<div class="col-sm-4">
								<input type="text" name="trombosit" id="trombosit" value="<?= $kunj['trombosit'] ?>" class="form-control">
								<small id="res-trombosit"></small>
							</div>

						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">SGOT</label>

							<div class="col-sm-4">
								<input type="text" name="sgot" id="sgot" value="<?= $kunj['sgot'] ?>" class="form-control">
								<small id="res-sgot"></small>
							</div>

							<label class="col-sm-2 control-label">SGPT</label>

							<div class="col-sm-4">
								<input type="text" name="sgpt" id="sgpt" value="<?= $kunj['sgpt'] ?>" class="form-control">
								<small id="res-sgpt"></small>
							</div>

						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Asam Urat</label>

							<div class="col-sm-4">
								<input type="text" name="asamurat" id="asamurat" value="<?= $kunj['asamurat'] ?>" class="form-control">
								<small id="res-asamurat"></small>
							</div>

							<label class="col-sm-2 control-label">Widal</label>

							<div class="col-sm-4">
								<select name="widal" id="widal" class="form-control">
									<option value="" <?php if ($kunj['widal'] == '') {
															echo 'selected';
														} ?>>-- pilih --</option>
									<option value="0" <?php if ($kunj['widal'] == '0') {
															echo 'selected';
														} ?>>Negatif</option>
									<option value="1" <?php if ($kunj['widal'] == '1') {
															echo 'selected';
														} ?>>Positif</option>
								</select>
								<small id="res-widal"></small>
							</div>

						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Pemeriksaan Lainnya</label>

							<div class="col-sm-4">
								<textarea name="lain" class="form-control" rows="4"><?= $kunj['lain'] ?></textarea>
							</div>

						</div>

					</div>







				</div>

				<div class="box box-primary <?php if ($kunj['id_radiologi'] == null) {
												echo 'hidden';
											} ?>" id="rad">
					<div class="box-header with-border">
						<h3 class="box-title">Data Pemeriksaan Radiologi</h3>
						<input type="hidden" name="dataRad" id="dataRad" value="<?php if ($kunj['id_radiologi'] != null) {
																					echo '1';
																				} else {
																					echo '0';
																				} ?>">
					</div>
					<div class="box-body">
						<div class="form-group">
							<label class="col-sm-2 control-label">Jenis Pemeriksaan</label>

							<div class="col-sm-4">
								<select name="jenis_pemeriksaan" class="form-control">
									<option <?php if ($kunj['jenis_pemeriksaan'] == 'X-Ray Umum') {
												echo 'selected';
											} ?>>X-Ray Umum</option>
									<option <?php if ($kunj['jenis_pemeriksaan'] == 'USG') {
												echo 'selected';
											} ?>>USG</option>
									<option <?php if ($kunj['jenis_pemeriksaan'] == 'CT-Scan') {
												echo 'selected';
											} ?>>CT-Scan</option>
									<option <?php if ($kunj['jenis_pemeriksaan'] == 'MRI') {
												echo 'selected';
											} ?>>MRI</option>
									<option <?php if ($kunj['jenis_pemeriksaan'] == 'Mamografi') {
												echo 'selected';
											} ?>>Mamografi</option>
									<option <?php if ($kunj['jenis_pemeriksaan'] == 'Angiografi') {
												echo 'selected';
											} ?>>Angiografi</option>
								</select>
							</div>

							<label class="col-sm-2 control-label">Hasil Pemeriksaan Radiologi</label>

							<div class="col-sm-4">
								<textarea class="form-control" name="hasil" id="hasilRad" rows="4"><?= $kunj['hasil'] ?></textarea>

							</div>


						</div>
					</div>
				</div>

				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Diagnosa</h3>
					</div>
					<div class="box-body">
						<div class="form-group">
							<!--
                  <label class="col-sm-2 control-label">Diagnosis</label>

                  <div class="col-sm-3">
                    <input type="text" name="diagnosa1" class="form-control"  id="diagnosa1" placeholder="Diagnosis Primer">
                  </div>
                  <div class="col-sm-1">
                    <input type="text" name="kode_diagnosa1" class="form-control"  id="kode_diagnosa1">
                  </div>


                  <label class="col-sm-2 control-label">Diagnosis Rekomendasi</label>
                  <div class="col-sm-4" id="dx_rekomendasi"></div>

                  <label class="col-sm-2 control-label"></label>
                  <div class="col-sm-3">
                    <input type="text" name="diagnosa2" class="form-control"  id="diagnosa2" placeholder="Diagnosis Sekunder">
                  </div>
                  <div class="col-sm-1">
                    <input type="text" name="kode_diagnosa2" class="form-control" id="kode_diagnosa2">
                  </div>

                  <br>
                  <br>
                  <br>
                  <br>

                  <label class="col-sm-2 control-label"></label>
                  <div class="col-sm-3">
                    <input type="text" name="diagnosa3" class="form-control" id="diagnosa3" placeholder="Diagnosis Lainnya">
                  </div>
                  <div class="col-sm-1">
                    <input type="text" name="kode_diagnosa3" class="form-control" id="kode_diagnosa3">
                  </div>
									-->

							<label class="col-sm-2 control-label">Diagnosis</label>

							<div class="col-sm-4">

								<table>
									<tr>
										<td style="width: 70%;">
											<input type="text" name="diagnosa1" class="form-control" id="diagnosa1" placeholder="Diagnosis Primer" required="">
										</td>
										<td></td>
										<td style="width: 30%;">
											<input type="text" name="kode_diagnosa1" class="form-control" id="kode_diagnosa1">
										</td>
									</tr>

									<tr>
										<td colspan="3">&nbsp;</td>
									</tr>

									<tr>
										<td>
											<input type="text" name="diagnosa2" class="form-control" id="diagnosa2" placeholder="Diagnosis Sekunder">
										</td>
										<td></td>
										<td>
											<input type="text" name="kode_diagnosa2" class="form-control" id="kode_diagnosa2">
										</td>
									</tr>

									<tr>
										<td colspan="3">&nbsp;</td>
									</tr>

									<tr>
										<td>
											<input type="text" name="diagnosa3" class="form-control" id="diagnosa3" placeholder="Diagnosis Lainnya">
										</td>
										<td></td>
										<td>
											<input type="text" name="kode_diagnosa3" class="form-control" id="kode_diagnosa3">
										</td>
									</tr>
								</table>

							</div>

							<!-- <label class="col-sm-2 control-label">Diagnosis Rekomendasi</label>
							<div class="col-sm-4" id="dx_rekomendasi"></div> -->


						</div>
					</div>
					<div class="box-footer stroke">
						<?php
						if ($kunj['risiko_stroke'] == 1) {
							$kelas = 'text-success';
							$isi = '<i class="fa fa-check"> </i> Risiko Rendah Stroke';
						} elseif ($kunj['risiko_stroke'] == 2) {
							$kelas = 'text-warning';
							$isi = '<i class="fa fa-warning"> </i> Risiko Sedang Stroke';
						} elseif ($kunj['risiko_stroke'] == 3) {
							$kelas = 'text-red';
							$isi = '<i class="fa fa-warning"> </i> Risiko Tinggi Stroke';
						} else {
							$kelas = '';
							$isi = '';
						}
						?>
						<center>
							<h3 id="res-str" class="<?= $kelas ?>"><?= $isi ?></h3>
						</center>
						<input type="hidden" name="risiko_stroke" id="risiko_stroke" value="<?= $kunj['risiko_stroke'] ?>">
					</div>

					<div class="box-footer dm">
						<?php
						if ($kunj['risiko_dm'] == 1) {
							$kelas = 'text-danger';
							$isi = '<i class="fa fa-warning"> </i> Berisiko DM';
						} else {
							$kelas = 'text-success';
							$isi = '<i class="fa fa-check"> </i> Tidak Berisiko DM';
						}
						?>
						<center>
							<h3 id="res-str" class="<?= $kelas ?>"><?= $isi ?></h3>
						</center>
						<input type="hidden" name="risiko_dm" id="risiko_dm" value="<?= $kunj['risiko_dm'] ?>">
					</div>

				</div>

				<div class="box box-primary" id="tx">
					<div class="box-header with-border">
						<h3 class="box-title">Tindakan</h3>
					</div>
					<div class="box-body">
						<div class="form-group">

							<label class="col-sm-2 control-label">Pilih Tindakan</label>

							<div class="col-sm-10">
								<select name="tindakan[]" id="tindakan" class="form-control select2" multiple="multiple" data-placeholder="Pilih Tindakan" style="width: 100%">
									<?php foreach ($tx as $t) : ?>
										<option value="<?= $t->kode_tindakan ?>"><?= $t->nama_tindakan ?></option>
									<?php endforeach ?>
								</select>
							</div>

						</div>

					</div>
				</div>

				<div class="box box-primary hidden" id="rx">
					<div class="box-header with-border">
						<h3 class="box-title">Resep</h3>
					</div>
					<div class="box-body">
						<div class="col-md-4">
							<label>Nama Obat</label>
							<select name="id_obat" class="form-control select2" id="id_obat" style="width: 100%">
								<option value="">--pilih obat--</option>
								<?php foreach ($obat as $o) : ?>
									<option value="<?= $o->id_obat ?>"><?= $o->nama_obat ?></option>
								<?php endforeach ?>
							</select>
							<small id="res-alergi"></small>

						</div>

						<div class="col-md-2">
							<label>Jumlah</label>
							<input type="number" name="jumlah" id="jumlah" min="0" class="form-control">
						</div>

						<div class="col-md-3">
							<label>Aturan Pakai</label>
							<input type="text" name="aturan_pakai" id="aturan_pakai" class="form-control">
						</div>


						<div class="col-md-1">
							<button type="button" id="addResep" class="btn btn-success btn-xs" style="margin-top: 30px;"><i class="fa fa-plus"> </i> Tambah</button>
						</div>

						<div class="col-md-2" style="margin-top: 30px;">
							<input type="checkbox" name="cito" id="cito" class="flat-red" value="0"> Cito
						</div>

					</div>

					<div class="box-body" id="tableResep">
						<div class="col-md-12">
							<table class="table table-bordered table-hover">
								<thead>
									<tr style="background-color: #A8CDFF;">
										<th>Nama Obat</th>
										<th>Jumlah</th>
										<th>Aturan Pakai</th>
										<th width="10">#</th>
									</tr>
								</thead>
								<tbody id="rowResep">

								</tbody>
							</table>
						</div>

					</div>
				</div>


			</div>



			<center>
				<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"> </i> Simpan</button>
				<!-- <button type="button" id="addTindakan" class="btn btn-info btn-sm"><i class="fa fa-plus"> </i> Tambah Tindakan</button> -->
				<!-- <button type="button" id="deleteTindakan" class="btn btn-danger hidden btn-sm"><i class="fa fa-times"> </i> Hapus Tindakan</button> -->
				<button type="button" id="addresep" class="btn btn-info btn-sm"><i class="fa fa-plus"> </i> Tambah Resep</button>
				<button type="button" id="deleteresep" class="btn btn-danger hidden btn-sm"><i class="fa fa-times"> </i> Hapus Resep</button>
				<button type="button" id="btn-lab" class="btn btn-info btn-sm <?php if ($kunj['id_lab'] != null) {
																					echo 'hidden';
																				} ?>"><i class="fa fa-plus"> </i> Tambah Data Lab</button>
				<button type="button" id="btn-lab-del" class="btn btn-danger btn-sm <?php if ($kunj['id_lab'] == null) {
																						echo 'hidden';
																					} ?>"><i class="fa fa-times"> </i> Hapus Data Lab</button>
				<button type="button" id="btn-rad" class="btn btn-info btn-sm <?php if ($kunj['id_radiologi'] != null) {
																					echo 'hidden';
																				} ?>"><i class="fa fa-plus"> </i> Tambah Data Radiologi</button>
				<button type="button" id="btn-rad-del" class="btn btn-danger btn-sm <?php if ($kunj['id_radiologi'] == null) {
																						echo 'hidden';
																					} ?>"><i class="fa fa-times"> </i> Hapus Data Radiologi</button>
				<!-- <button type="reset" class="btn btn-default btn-sm">Reset</button> -->

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

		$('.select2').select2();

		var f = tekanan_darah();
		actTekananDarah(f);
		var g = imt();
		actImt(g);
		var h = kolesterol();
		actKolesterol(h);
		var i = gda();
		actGda(i);
		var j = gdsm();
		actGdsm(j);
		var k = gdp();
		actGdp(k);

		var l = hemoglobin();
		actHb(l);
		var m = trombosit();
		acttrombosit(m);
		var n = sgot();
		actsgot(n);
		var o = sgpt();
		actsgpt(o);
		var p = asamurat();
		actasamurat(p);
		var q = widal();
		actwidal(q);


		$('#diagnosa1').autocomplete({
			source: "<?php echo site_url('klinik/auto_diagnosa'); ?>",
			select: function(event, ui) {
				$('#diagnosa1').val(ui.item.diagnosa);
				$('#kode_diagnosa1').val(ui.item.kode_diagnosa);
				$('#kode_diagnosa1').attr('readonly', '');
			}
		});

		$('#diagnosa2').autocomplete({
			source: "<?php echo site_url('klinik/auto_diagnosa'); ?>",
			select: function(event, ui) {
				$('#diagnosa2').val(ui.item.diagnosa);
				$('#kode_diagnosa2').val(ui.item.kode_diagnosa);
				$('#kode_diagnosa2').attr('readonly', '');
			}
		});

		$('#diagnosa3').autocomplete({
			source: "<?php echo site_url('klinik/auto_diagnosa'); ?>",
			select: function(event, ui) {
				$('#diagnosa3').val(ui.item.diagnosa);
				$('#kode_diagnosa3').val(ui.item.kode_diagnosa);
				$('#kode_diagnosa3').attr('readonly', '');
			}
		});

		$('#diagnosa1').on('keyup', function() {
			var x = $('#diagnosa1').val();
			if (x == '') {
				$('#kode_diagnosa1').val('');
				$('#kode_diagnosa1').removeAttr('readonly');
			}
		});

		$('#diagnosa2').on('keyup', function() {
			var x = $('#diagnosa2').val();
			if (x == '') {
				$('#kode_diagnosa2').val('');
				$('#kode_diagnosa2').removeAttr('readonly');
			}
		});

		$('#diagnosa3').on('keyup', function() {
			var x = $('#diagnosa3').val();
			if (x == '') {
				$('#kode_diagnosa3').val('');
				$('#kode_diagnosa3').removeAttr('readonly');
			}
		});

		$('#klinik').addClass('active');

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

				$('#nama_px').val(ui.item.nama_px);
				$('#no_rm').val(ui.item.no_rm);
				$('#jk_px').val(jk);
				$('#alamat_px').val(ui.item.alamat_px);
				$('#pembayaran').val(as);
				$('#ttl').val(ui.item.tempat_lahir_px + ', ' + ui.item.tgl_lahir_px);
			}
		});
		var availableTags = "<?= site_url('pasien/alergi'); ?>";

		function split(val) {
			return val.split(/,\s*/);
		}

		function extractLast(term) {
			return split(term).pop();
		}
		$("#alergi_obat")
			// don't navigate away from the field on tab when selecting an item

			.autocomplete({
				minLength: 0,
				// source: function(request, response) {
				// 	// delegate back to autocomplete, but extract the last term
				// 	response($.ui.autocomplete.filter(
				// 		availableTags, extractLast(request.term)));
				// },
				source: "<?php echo site_url('pasien/alergi'); ?>",

				focus: function() {
					// prevent value inserted on focus
					return false;
				},
				select: function(event, ui) {
					var terms = split(this.value);
					// remove the current input
					terms.pop();
					// add the selected item
					terms.push(ui.item.value);
					// add placeholder to get the comma-and-space at the end
					terms.push("");
					this.value = terms.join(", ");
					return false;
				}
			});


		$('#no_rm').on('change', function() {
			var no = $('#no_rm').val();
			var no_rm = no.substr(0, 6);
			$('#no_rm').val(no_rm);
		});


		umur();

		// UMUR
		function umur() {
			var bd = $('#biday').val();
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
				if ((sys < 90) || (dias < 60)) {
					td = 'Hypotensi';
				} else if ((sys < 120) || (dias < 80)) {
					td = 'Normal';
				} else if ((sys < 140) || (dias < 90)) {
					td = 'Pre Hypertensi';
				} else {
					td = 'Hypertensi';
				}
			}
			return (td);
		}

		function actTekananDarah(td) {
			if (td == 'Hypotensi') {
				$('#td').removeClass().addClass('text-red').html('<b>' + td + '</b>');
				$('#resultTd').val(1);
			} else if (td == 'Normal') {
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

			if ((bb == '') || (tb == '')) {
				ket_imt = '';
			} else {
				if (imt < 18.5) {
					ket_imt = 'Kurus';
				} else if (imt <= 25) {
					ket_imt = 'Normal';
				} else if (imt <= 27) {
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
			var id = $('#id_kunjungan').val();
			$.ajax({
				url: '<?= base_url('klinik/hapus_lab') ?>',
				method: 'POST',
				data: {
					id: id
				},
				dataType: 'JSON',
				success: function(data) {
					if (data == 1) {
						$('#lab').addClass('hidden');
						$('#btn-lab').removeClass('hidden');
						$('#btn-lab-del').addClass('hidden');
						$('#kolesterol').val('');
						$('#gda').val('');
						$('#gdp').val('');
						$('#gdsm').val('');
						$('#dataLab').val(0);
					}
				}
			});
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
			var id = $('#id_kunjungan').val();
			$.ajax({
				url: '<?= base_url('klinik/hapus_rad') ?>',
				method: 'POST',
				data: {
					id: id
				},
				dataType: 'JSON',
				success: function(data) {
					if (data == 1) {
						$('#rad').addClass('hidden');
						$('#btn-rad').removeClass('hidden');
						$('#btn-rad-del').addClass('hidden');
						$('#hasilRad').val('');
						$('#dataRad').val(0);
					}
				}
			});
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

		// HEMOGLOBIN
		$('#hb').on('change', function() {
			var hb = hemoglobin();
			actHb(hb);
		});

		function hemoglobin() {
			var hb;
			var hb = $('#hb').val();
			var jk = $('#jk_px').val();

			if (hb != '') {
				if (jk == 'Laki-Laki') {
					if (hb < 14) {
						hb = 'RISK';
					} else if (hb <= 17.5) {
						hb = 'Normal';
					} else if (hb > 17.5) {
						hb = 'RISK';
					}
				} else {
					if (hb < 12.3) {
						hb = 'RISK';
					} else if (hb > 15.3) {
						hb = 'RISK';
					}
				}
			} else {
				hb = '';
			}

			return (hb);
		}

		function actHb(hb) {
			if (hb != '') {
				if (hb == 'RISK') {
					$('#res-hb').removeClass().addClass('text-red').html(hb);
				} else if (hb == 'Normal') {
					$('#res-hb').removeClass().addClass('text-blue').html(hb);
				}
			} else {
				$('#res-hb').removeClass().html(hb);
			}
		}


		// WIDAL
		function widal() {
			var widal;
			var wd = $('#widal').val();
			if (wd != '') {
				if (wd == 1) {
					widal = 'RISK';
				} else if (wd == 0) {
					widal = 'Normal';
				} else {
					widal = '';
				}
			} else {
				widal = '';
			}

			return (widal);
		}

		function actwidal(widal) {
			if (widal != '') {
				if (widal == 'RISK') {
					$('#res-widal').removeClass().addClass('text-red').html(widal);
				} else if (widal == 'Normal') {
					$('#res-widal').removeClass().addClass('text-blue').html(widal);
				}
			} else {
				$('#res-widal').removeClass().html(widal);
			}
		}

		$('#widal').on('change', function() {
			var wd = widal();
			actwidal(wd);
		});


		// ASAM URAT
		function asamurat() {
			var asamurat;
			var au = $('#asamurat').val();
			if (au != '') {
				if (au < 3) {
					asamurat = 'RISK';
				} else if (au <= 7) {
					asamurat = 'Normal';
				} else {
					asamurat = 'RISK';
				}
			} else {
				asamurat = '';
			}

			return (asamurat);
		}

		function actasamurat(asamurat) {
			if (asamurat != '') {
				if (asamurat == 'RISK') {
					$('#res-asamurat').removeClass().addClass('text-red').html(asamurat);
				} else if (asamurat == 'Normal') {
					$('#res-asamurat').removeClass().addClass('text-blue').html(asamurat);
				}
			} else {
				$('#res-asamurat').removeClass().html(asamurat);
			}
		}

		$('#asamurat').on('change', function() {
			var au = asamurat();
			actasamurat(au);
		});

		// SGPT
		function sgpt() {
			var sgpt;
			var pt = $('#sgpt').val();
			if (pt != '') {
				if (pt <= 45) {
					sgpt = 'Normal';
				} else {
					sgpt = 'RISK';
				}
			} else {
				sgpt = '';
			}

			return (sgpt);
		}

		function actsgpt(sgpt) {
			if (sgpt != '') {
				if (sgpt == 'RISK') {
					$('#res-sgpt').removeClass().addClass('text-red').html(sgpt);
				} else if (sgpt == 'Normal') {
					$('#res-sgpt').removeClass().addClass('text-blue').html(sgpt);
				}
			} else {
				$('#res-sgpt').removeClass().html(sgpt);
			}
		}

		$('#sgpt').on('change', function() {
			var pt = sgpt();
			actsgpt(pt);
		});

		// SGOT
		function sgot() {
			var sgot;
			var ot = $('#sgot').val();
			if (ot != '') {
				if (ot <= 37) {
					sgot = 'Normal';
				} else {
					sgot = 'RISK';
				}
			} else {
				sgot = '';
			}

			return (sgot);
		}

		function actsgot(sgot) {
			if (sgot != '') {
				if (sgot == 'RISK') {
					$('#res-sgot').removeClass().addClass('text-red').html(sgot);
				} else if (sgot == 'Normal') {
					$('#res-sgot').removeClass().addClass('text-blue').html(sgot);
				}
			} else {
				$('#res-sgot').removeClass().html(sgot);
			}
		}

		$('#sgot').on('change', function() {
			var ot = sgot();
			actsgot(ot);
		});

		// TROMBOSIT
		function trombosit() {
			var trombosit;
			var trom = $('#trombosit').val();
			if (trom != '') {
				if (trom < 150) {
					trombosit = 'RISK';
				} else if (trom <= 450) {
					trombosit = 'Normal';
				} else {
					trombosit = 'RISK';
				}
			} else {
				trombosit = '';
			}

			return (trombosit);
		}

		function acttrombosit(trombosit) {
			if (trombosit != '') {
				if (trombosit == 'RISK') {
					$('#res-trombosit').removeClass().addClass('text-red').html(trombosit);
				} else if (trombosit == 'Normal') {
					$('#res-trombosit').removeClass().addClass('text-blue').html(trombosit);
				}
			} else {
				$('#res-trombosit').removeClass().html(trombosit);
			}
		}

		$('#trombosit').on('change', function() {
			var trom = trombosit();
			acttrombosit(trom);
		});


		// KOLESTEROL
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
			cekGd();

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
			cekGd();
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
			cekGd();
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
				$('#resultGd').val(0);
				d = 0;
			}

			diagnosa_rekomendasi();
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

			var td = tekanan_darah();
			var rokok = $('#merokok').val();
			var kol = kolesterol1();
			var gd = cekGd();
			var aktifitas = $('#aktivitas_fisik').val();
			var imtVal = imt();
			var riwayatStroke = $('#riwayat_keluarga_stroke').val();
			var riwayatDm = $('#riwayat_keluarga_dm').val();


			if (td == 'Hypertensi') {
				r1 += 1;
			} else if (td == 'Pre Hypertensi') {
				r2 += 1;
			} else {
				r3 += 1;
			}

			if (rokok == 3) {
				r1 += 1;
			} else if (rokok == 2) {
				r2 += 1;
			} else {
				r3 += 1;
			}

			if (kol == 'Tinggi') {
				r1 += 1;
			} else if (kol == 'Sedang') {
				r2 += 1;
			} else {
				r3 += 1;
			}

			if (gd == 1) {
				r1 += 1;
			} else if (riwayatDm == 1) {
				r2 += 1;
			} else {
				r3 += 1;
			}

			if (aktifitas == 1) {
				r1 += 1;
			} else if (aktifitas == 2) {
				r2 += 1;
			} else {
				r3 += 1;
			}

			if (imtVal == 'Gemuk') {
				r1 += 1;
			} else if (imtVal == 'Berat Badan Lebih') {
				r2 += 1;
			} else {
				r3 += 1;
			}

			if (riwayatStroke == 1) {
				r1 += 1;
			} else {
				r3 += 1;
			}

			if (r1 >= 3) {
				$('#res-str').removeClass().addClass('text-red').html(`<i class="fa fa-warning"> </i> <b>Resiko Tinggi Sroke</b>`);
				$('#risiko_stroke').val(3);
			} else if (r2 >= 4) {
				$('#res-str').removeClass().addClass('text-orange').html(`<i class="fa fa-warning"> </i> <b>Resiko Sedang Sroke</b>`);
				$('#risiko_stroke').val(2);
			} else if (r3 >= 6) {
				$('#res-str').removeClass().addClass('text-success').html(`<i class="fa fa-check"> </i> <b>Resiko Rendah Sroke</b>`);
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

			console.log('Tinggi : ' + r1);
			console.log('Sedang : ' + r2);
			console.log('Rendah : ' + r3);

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


		function diagnosa_rekomendasi() {
			var td = $('#resultTd').val();
			var Gd = $('#resultGd').val();
			var namaTd;
			var namaGd;
			if (td != 2) {
				if (td == 1) {
					namaTd = 'Hypotensi';
				} else if (td == 4) {
					namaTd = 'Hypertensi';
				} else {
					$('.dxTd').remove();
				}
				$('.dxTd').remove();
				$('#dx_rekomendasi').append(`<div class="dxTd"> <input type="checkbox" name="dx_rek[]" class="flat-red" value="` + namaTd + `"> ` + namaTd + ` <br></div>`);
			} else {
				$('.dxTd').remove();
			}

			if (Gd == 1) {
				namaGd = 'Diabetus Mellitus';
				$('.dxGd').remove();
				$('#dx_rekomendasi').append(`<div class="dxGd"> <input type="checkbox" name="dx_rek[]" class="flat-red" value="` + namaGd + `"> ` + namaGd + ` <br></div>`);
			} else {
				$('.dxGd').remove();
			}

			$('.flat-red').iCheck({
				checkboxClass: 'icheckbox_flat-blue',
				radioClass: 'iradio_flat-blue'
			});
		}

		diagnosa_rekomendasi();

		$('#addResep').on('click', function() {
			var id_obat = $('#id_obat').val();
			var jumlah = $('#jumlah').val();
			var aturan_pakai = $('#aturan_pakai').val();
			if (id_obat == '') {
				alert('Pilih nama obat');
			} else if (jumlah == '') {
				alert('Masukkan jumlah obat !');
			} else if (aturan_pakai == '') {
				alert('masukkan aturan pakai');
			} else {
				saveResep();
			}
		});

		$('#cito').on('ifChecked', function() {
			$('#cito').val(1);
		});

		$('#cito').on('ifUnchecked', function() {
			$('#cito').val(0);
		});

		function saveResep() {
			var id_obat = $('#id_obat').val();
			var jumlah = $('#jumlah').val();
			var aturan_pakai = $('#aturan_pakai').val();
			var id_kunjungan = $('#id_kunjungan').val();
			var cito = $('#cito').val();
			$.ajax({
				url: '<?= base_url('klinik/save_resep') ?>',
				dataType: 'JSON',
				method: 'POST',
				data: {
					id_obat: id_obat,
					jumlah: jumlah,
					aturan_pakai: aturan_pakai,
					id_kunjungan: id_kunjungan,
					cito: cito,
				},
				success: function(data) {
					if (data == 2) {
						alert('obat yang diinputkan sudah dipilih !');
					} else if (data == 3) {
						alert('Stok Obat Habis !');
					} else if (data.status == 4) {
						alert('Stok obat tidak mencukupi, Stok obat = ' + data.sisa);
					} else {
						showResep();
						$('#id_obat').val('').trigger('change');
						$('#jumlah').val('');
						$('#aturan_pakai').val('');
					}
				}
			});
		}

		showResep();

		function showResep() {
			var id_kunjungan = $('#id_kunjungan').val();
			var html = '';
			$.ajax({
				url: '<?= base_url('klinik/show_resep') ?>',
				dataType: 'JSON',
				method: 'POST',
				data: {
					id_kunjungan: id_kunjungan
				},
				success: function(data) {
					if (data.length > 0) {
						for (a = 0; a < data.length; a++) {
							html += `

                <tr style="background-color: #D6D6D6;">
                  <td>` + data[a].nama_obat + `</td>
                  <td>` + data[a].jumlah + `</td>
                  <td>` + data[a].aturan_pakai + `</td>
                  <td><button type="button" class="btn btn-danger btn-xs fa fa-times deleteResep" dataObat="` + data[a].id_obat + `" dataJumlah="` + data[a].jumlah + `" id="` + data[a].id_resep + `"></button></td>
                </tr>

              `;

						}
						$('#tableResep').show();
					} else {
						$('#tableResep').hide();
					}

					$('#rowResep').html(html);
				}
			});
		}


		// ALERGI

		$('#id_obat').on('change', function() {
			var alergi_px = $('#alergi_px').val();
			var id_obat = $('#id_obat').val();

			// alert(id_obat);

			$.ajax({
				url: '<?= base_url('klinik/cek_alergi') ?>',
				dataType: 'JSON',
				method: 'POST',
				data: {
					alergi_px: alergi_px,
					id_obat: id_obat
				},
				success: function(data) {
					if (data.status == 0) {
						alert('Pasien alergi terhadap ' + alergi_px);
					}
				}
			});
		});

		$(document).on('click', '.deleteResep', function() {
			var id = $(this).attr('id');
			var jumlah = $(this).attr('dataJumlah');
			var id_obat = $(this).attr('dataObat');
			$.ajax({
				url: '<?= base_url('klinik/delete_resep') ?>',
				type: 'POST',
				dataType: 'JSON',
				data: {
					id: id,
					jumlah: jumlah,
					id_obat: id_obat
				},
				success: function(data) {
					if (data == 1) {
						showResep();
					}
				}
			});
		});

		// $('#addTindakan').on('click', function(){
		//   $('#tx').removeClass('hidden');
		//   $('#deleteTindakan').removeClass('hidden');
		//   $('#addTindakan').addClass('hidden');
		// });

		// $('#deleteTindakan').on('click', function(){
		//   $('#addTindakan').removeClass('hidden');
		//   $('#deleteTindakan').addClass('hidden');
		//   $('#tindakan').val(null).trigger('change');
		//   $('#tx').addClass('hidden');
		// });

		$('#addresep').on('click', function() {
			$('#rx').removeClass('hidden');
			$('#deleteresep').removeClass('hidden');
			$('#addresep').addClass('hidden');
		});

		$('#deleteresep').on('click', function() {
			$('#addresep').removeClass('hidden');
			$('#deleteresep').addClass('hidden');
			$('#rx').addClass('hidden');
			hapusResep();
		});

		function hapusResep() {
			var id = $('#id_kunjungan').val();
			$.ajax({
				url: '<?= base_url('klinik/delete_resep_all') ?>',
				type: 'POST',
				dataType: 'JSON',
				data: {
					id: id
				},
				success: function(data) {
					if (data == 1) {
						showResep();
					}
				}
			});
		}

	});
</script>
