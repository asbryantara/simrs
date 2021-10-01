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
          
          <!-- <a href="<?= base_url('pasien/add') ?>" class="btn btn-info"><i class="fa fa-plus"> </i> Data Pasien Baru</a>
          <a href="<?= base_url('pendaftaran/list_pendaftaran') ?>" class="btn btn-primary"><i class="fa fa-eye"> </i> Lihat Pendaftaran</a> -->
          <a href="<?= base_url('home/konfigurasi') ?>" class="btn btn-primary"><i class="fa fa-arow-left"> </i> Kembali</a>

         
          <br>
          <br>
          
        </div>

        <?= form_open(base_url('home/save_konfigurasi'), ['class'=>'form-horizontal']) ?>
         <div class="col-md-12">
          

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?= $con['nama_config'] ?></h3>
            </div>
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-2 control-label">Value</label>

                <div class="col-sm-10">
                    <textarea class="form-control" name="isi_config" rows="4" required=""><?= $con['isi_config'] ?></textarea>
                    <input type="hidden" name="id_config" value="<?= $this->uri->segment(3) ?>">
                </div>
                
                
              </div>
            </div>
          </div>

          <center>
               <button type="submit" class="btn btn-primary btn-sm">Update</button>
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
  $(document).ready(function () {

    $('#konfigurasi').addClass('active');
  
  });
</script>