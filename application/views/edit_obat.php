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
          
          <a href="<?= base_url('master/obat') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"> </i> &nbsp; Kembali</a>
         
          <br>
          <br>
          
        </div>

        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Data obat</h3>
            </div>
            <?= form_open(base_url('master/perbarui_obat'), ['class'=>'form-horizontal']) ?>
              <div class="box-body">
                
                <div class="form-group">
                  <label class="col-sm-2 control-label">Suplier</label>

                  <div class="col-sm-4">
                    <select name="id_suplier" class="form-control select2" style="width: 100%;">
                      <option value="">--pilih suplier--</option>
                      <?php foreach($suplier as $row): ?>
                        <option value="<?= $row->id_suplier ?>" <?php if($row->id_suplier == $obat['id_suplier']){echo 'selected';} ?>><?= $row->nama_suplier ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
               
                  <label class="col-sm-2 control-label">Nama Obat</label>

                  <div class="col-sm-4">
                    <input type="text" name="nama_obat" value="<?= $obat['nama_obat'] ?>" class="form-control">
                    <input type="hidden" name="id_obat" value="<?= $obat['id_obat'] ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Konten Obat</label>

                  <div class="col-sm-4">
                    <select name="konten[]" id="konten" class="form-control select2" multiple="multiple" data-placeholder="Tambah Konten Obat" style="width: 100%">

                      <?php foreach($konten as $k): ?>
                        <option value="<?= $k->nama_konten ?>" <?php $ex = explode(', ', $obat['konten_obat']); if(in_array($k->nama_konten, $ex)){echo 'selected';}?> ><?= $k->nama_konten ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
               
                  <label class="col-sm-2 control-label">Harga Obat</label>

                  <div class="col-md-4 ">
                    <input type="text" name="harga" id="harga" class="form-control" value="<?= $obat['harga'] ?>" autocomplete="off">
                  </div>
                </div>

                <div class="form-group">
                  
                  <label class="col-sm-2 control-label">Stok Obat</label>

                  <div class="col-md-4 ">
                    <input type="text" name="stok" id="stok" class="form-control" value="<?= $obat['stok'] ?>" autocomplete="off">
                  </div>
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

<script src="<?= base_url('assets/') ?>dist/js/jquery.mask.min.js"></script>
<script>
  $(document).ready(function () {

    // ACTIVE LEFTBAR
    $('#obat').addClass('active');

    // SELECT2
    $('.select2').select2();

    // ICHECK
    $('.flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass   : 'iradio_flat-blue'
    });

    $( '#harga, #u_harga' ).mask('000.000.000.000', {reverse: true});

  });
</script>