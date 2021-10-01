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
          <?php if($this->session->flashdata('warning')) : ?>
            <div class="alert alert-warning alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-warning"></i> <?= $this->session->flashdata('warning') ?> </h4>
            </div>
          <?php elseif($this->session->flashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-check"></i> <?= $this->session->flashdata('success') ?> </h4>
            </div>
          <?php endif ?>
        </div>
        
        <div class="col-md-12">
          
          <a href="<?= base_url('pasien/add') ?>" class="btn btn-info"><i class="fa fa-plus"> </i> Data Pasien Baru</a>
          <a href="<?= base_url('pasien/edit/'.$px['no_rm']) ?>" class="btn btn-info"><i class="fa fa-pencil"> </i> Edit Data Pasien</a>
          <a href="<?= base_url('pendaftaran/auto/'.$px['no_rm']) ?>" class="btn btn-primary"><i class="fa fa-plus"> </i> Pendaftaran</a>
          <a href="<?= base_url('pendaftaran/list_pendaftaran') ?>" class="btn btn-primary"><i class="fa fa-eye"> </i> Lihat Pendaftaran</a>
         
          <br>
          <br>
          
        </div>

        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-user"> </i> Identitas Pasien</h3>
            </div>
            <div class="box-body">
              <table class="table table-hover table-striped ">
                <tr>
                  <td width="200">No. RM</td>
                  <td width="1">:</td>
                  <td><?= $px['no_rm'] ?></td>
                </tr>
                <tr>
                  <td width="200">NIK</td>
                  <td width="1">:</td>
                  <td><?= $px['nik_px'] ?></td>
                </tr>
                <tr>
                  <td width="200">Nama Pasien</td>
                  <td width="1">:</td>
                  <td><?= $px['nama_px'] ?></td>
                </tr>
                <tr>
                  <td width="200">Jenis Kelamin</td>
                  <td width="1">:</td>
                  <td><?php if($px['jk_px'] == 1){echo 'Laki-laki';}else{echo 'Perempuan';} ?></td>
                </tr>
                <tr>
                  <td width="200">Tempat, Tanggal Lahir</td>
                  <td width="1">:</td>
                  <td><?= $px['tempat_lahir_px'].', '.$px['tgl_lahir_px'] ?></td>
                </tr>
                <tr>
                  <td width="200">Alamat</td>
                  <td width="1">:</td>
                  <td><?= $px['alamat_px'].', '.$px['nama_desa'].'<br>KEC. '.$px['nama_kecamatan'].', '.$px['nama_kota_kab'].', '.$px['nama_provinsi'] ?></td>
                </tr>
                
                <tr>
                  <td width="200">Pembayaran</td>
                  <td width="1">:</td>
                  <td><?php if($px['asuransi_px'] == 1){echo 'Umum';}elseif($px['asuransi_px'] == 2){echo 'BPJS Kesehatan';}else{echo $px['asuransi_lain_px'];} ?></td>
                </tr>

                <?php if($px['asuransi_px'] == 2): ?>
                <tr>
                  <td width="200">No. BPJS</td>
                  <td width="1">:</td>
                  <td><?= $px['no_asuransi_px'] ?></td>
                </tr>
                <?php endif ?>
                <tr>
                  <td width="200">Pendidikan</td>
                  <td width="1">:</td>
                  <td><?php 

                    if($px['pendidikan_px'] == 0){
                      echo 'Tidak Sekolah';
                    }elseif($px['pendidikan_px'] == 1){
                      echo 'SD';
                    }elseif($px['pendidikan_px'] == 2){
                      echo 'SMP';
                    }elseif($px['pendidikan_px'] == 3){
                      echo 'SMA';
                    }elseif($px['pendidikan_px'] == 4){
                      echo 'D-III';
                    }elseif($px['pendidikan_px'] == 5){
                      echo 'D-IV / S1';
                    }elseif($px['pendidikan_px'] == 6){
                      echo 'S2';
                    }else{
                      echo 'S3';
                    }


                   ?></td>
                </tr>
                
                <tr>
                  <td width="200">Pekerjaan</td>
                  <td width="1">:</td>
                  <td><?php 

                    if($px['pekerjaan_px'] == 0){
                      echo 'Tidak Bekerja';
                    }elseif($px['pekerjaan_px'] == 1){
                      echo 'Tani';
                    }elseif($px['pekerjaan_px'] == 2){
                      echo 'PNS';
                    }elseif($px['pekerjaan_px'] == 3){
                      echo 'TNI / Polri';
                    }elseif($px['pekerjaan_px'] == 4){
                      echo 'Karyawan';
                    }elseif($px['pekerjaan_px'] == 5){
                      echo 'Buruh';
                    }elseif($px['pekerjaan_px'] == 6){
                      echo 'Wirausaha';
                    }


                   ?></td>
                </tr>
                <tr>
                  <td width="200">Telp</td>
                  <td width="1">:</td>
                  <td><?= $px['telp_px'] ?></td>
                </tr>

                <tr>
                  <td width="200">Agama</td>
                  <td width="1">:</td>
                  <td><?= $px['agama_px'] ?></td>
                </tr>

                <tr>
                  <td width="200">Alergi</td>
                  <td width="1">:</td>
                  <td><?= $px['alergi_px'] ?></td>
                </tr>
                
              </table>
            </div>
          </div>
          
          <div class="box box-warning">
           <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-pencil"> </i> Riwayat Kunjungan Pasien</h3>
          </div>
          <div class="box-body">
            <table class="table table-hover table-striped table-bordered">
              <thead>
                <tr>
                  <th>Tanggal Daftar</th>
                  <th>Waktu Daftar</th>
                  <th>Anamnesa</th>
                  <th>Status</th>
                  <th>Petugas</th>
                  <th>#</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($pendaftaran as $p): ?>
                  <tr>
                    <td><?= $p->tgl_kunjungan ?></td>
                    <td><?= $p->waktu_kunjungan ?></td>
                    <td><?= $p->anamnesa ?></td>
                    <td>
                      <?php 
                        if($p->status_kunjungan ==  0){
                          echo 'Menunggu';
                        }elseif($p->status_kunjungan ==  1){
                          echo 'Diperiksa';
                        }elseif($p->status_kunjungan ==  2){
                          echo 'Menunggu Obat';
                        }elseif($p->status_kunjungan ==  3){
                          echo 'Menunggu Pembayaran';
                        }elseif($p->status_kunjungan ==  4){
                          echo 'Selesai';
                        }
                      ?>
                    </td>
                    <td><?= $p->nama_user ?></td>
                    <td><a href="<?= base_url('pendaftaran/detail/'.$p->id_kunjungan) ?>" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a></td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
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
  $(document).ready(function () {

    $('#pasien').addClass('active');
   
    

  });
</script>