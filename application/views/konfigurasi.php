<?php 
  $this->load->view('header');
  $this->load->view('leftbar');
?>

  <div class="content-wrapper">
    <!-- Main content -->
    
    <section class="content-header">
      <h1>
        <i class="fa fa-gear"></i> &nbsp; Konfigurasi
        <small></small>
      </h1>
    </section>

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
          <div class="box box-primary">
           <!-- <div class="box-header">
            
          </div> -->
          <div class="box-body">
            <table class="table table-hover table-striped table-bordered">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>Value</th>
                  <th>#</th>

                </tr>
              </thead>
              <tbody>
                <?php foreach($config as $p): ?>
                  <tr>
                    <td><?= $p->nama_config ?></td>
                    <td><?= $p->isi_config ?></td>
                    <td>
                      <a href="<?= base_url('home/edit_konfigurasi/'.$p->id_config) ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil"> </i> Ubah</a>
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

    $('#konfigurasi').addClass('active');
   
    

  });
</script>