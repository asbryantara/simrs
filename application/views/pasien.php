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
          <a href="<?= base_url('pendaftaran/list_pendaftaran') ?>" class="btn btn-primary"><i class="fa fa-eye"> </i> Lihat Pendaftaran</a>
         
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
                  <th>Alamat</th>
                  <th>TTL</th>
                  <th>Telp</th>
                  <th>Pembayaran</th>
                  <th>#</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($px as $p): ?>
                  <tr>
                    <td><?= $p->no_rm ?></td>
                    <td><?= $p->nama_px ?></td>
                    <td><?php if($p->jk_px ==  1){echo 'L';}else{echo 'P';} ?></td>
                    <td><?= $p->alamat_px ?></td>
                    <td><?= $p->tempat_lahir_px.', '.$p->tgl_lahir_px ?></td>
                    <td><?= $p->telp_px ?></td>
                    <td><?php if($p->asuransi_px ==  1){echo 'Umum';}elseif($p->asuransi_px ==  2){echo 'BPJS Kesehatan';}else{echo $p->asuransi_lain_px;} ?></td>
                    <td>
                      <a href="<?= base_url('pasien/detail/'.$p->no_rm) ?>" class="btn btn-info btn-xs"><i class="fa fa-eye"></i></a>
                      <a href="<?= base_url('pasien/edit/'.$p->no_rm) ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
                      <a href="<?= base_url('pasien/delete/'.$p->no_rm) ?>" class="btn btn-danger btn-xs" onclick="return konfirmasi()"><i class="fa fa-trash"></i></a>
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

    $('#pasien').addClass('active');
   
    

  });
</script>