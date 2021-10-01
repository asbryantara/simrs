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
          
          <a href="<?= base_url('kasir/selesai_bayar') ?>" class="btn btn-primary"><i class="fa fa-eye"> </i> Selesai Pembayaran</a>
          <!-- <a href="<?= base_url('pendaftaran') ?>" class="btn btn-primary"><i class="fa fa-plus"> </i> Data Pendaftaran Baru</a> -->
         
          <br>
          <br>
          
        </div>

        <div class="col-md-12">
          <div class="box box-primary">
           <!-- <div class="box-header">
            
          </div> -->
          <div class="box-body">
            <table class="table table-hover table-striped table-bordered" id="example1">
              <thead>
                <tr>
                  <th>No RM</th>
                  <th>Nama</th>
                  <th>JK</th>
                  <th>Tgl Daftar</th>
                  <th>Pembayaran</th>
                  <th>Status</th>
                  <th width="50">#</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($pendaftaran as $p):

                ?>
                  <tr>
                    <td><?= $p->no_rm ?></td>
                    <td><?= $p->nama_px ?></td>
                    <td><?php if($p->jk_px ==  1){echo 'L';}else{echo 'P';} ?></td>
                    <td><?= $p->tgl_kunjungan.' '.$p->waktu_kunjungan ?></td>
                    <td><?php if($p->asuransi_px ==  1){echo 'Umum';}elseif($p->asuransi_px ==  2){echo 'BPJS';}else{echo $p->asuransi_lain_px;} ?></td>
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
                    <td>
                      
                      <a href="<?= base_url('kasir/bayar/'.$p->id_kunjungan) ?>" class="btn btn-primary btn-xs"><i class="fa fa-money"> </i> Bayar</a>
                      <!-- <a href="<?= base_url('apotek/detail/'.$p->id_kunjungan) ?>" class="btn btn-info btn-xs"><i class="fa fa-eye"></i></a>
                      <a href="<?= base_url('apotek/edit/'.$p->id_kunjungan) ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
                      <a href="<?= base_url('apotek/delete/'.$p->id_kunjungan) ?>" class="btn btn-danger btn-xs" onclick="return konfirmasi()"><i class="fa fa-trash"></i></a> -->
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

  function konfirmasi(){
    return confirm('Apakah anda yakin ?');
  }

  $(document).ready(function () {

    $('#kasir').addClass('active');
   
    

  });
</script>