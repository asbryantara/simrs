  <?php $this->load->view('header') ?>
  <?php $this->load->view('leftbar') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-user"></i> &nbsp User
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url('peminjaman') ?>">Peminjaman</a></li>
        <li class="active">Tambah User</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-primary">
        <div class="box-header">
          <a href="<?= base_url('user/edit') ?>" class="btn btn-info"><i class="fa fa-arrow-left"></i>&nbsp; Kembali</a>
        </div>
        <div class="box-body">
          <?= form_open_multipart(base_url('user/create_user'), ['class'=>'form-horizontal']) ?>
            <div class="form-group">
              <label class="control-label col-md-2">NIP/NIK</label>
              <div class="col-md-4">
                <?= form_input('id_user', set_value('id_user'), ['class'=>'form-control', 'autocomplete'=>'off']) ?>
                <?= form_error('id_user', '<small class="text-danger">', '</small>') ?>
              </div>
              <label class="control-label col-md-2">Nama Lengkap</label>
              <div class="col-md-4">
                <?= form_input('nama_user', set_value('nama_user'), ['class'=>'form-control', 'autocomplete'=>'off']) ?>
                <?= form_error('nama_user', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-2">Username</label>
              <div class="col-md-4">
                <?= form_input('username', set_value('username'), ['class'=>'form-control', 'autocomplete'=>'off']) ?>
                <?= form_error('username', '<small class="text-danger">', '</small>') ?>
              </div>
              <label class="control-label col-md-2">Password</label>
              <div class="col-md-4">
                <?= form_password('password1', '', ['class'=>'form-control']) ?>
                <?= form_error('password1', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-2">Ulangi Password</label>
              <div class="col-md-4">
                <?= form_password('password2', '', ['class'=>'form-control']) ?>
              </div>
              <label class="control-label col-md-2">Foto</label>
              <div class="col-md-4">
                <?= form_upload('foto', set_value('foto'), ['class'=>'form-control']) ?>
                <?= form_error('nip', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-2">Level</label>
              <div class="col-md-4">
                <input type="radio" name="level" value="1" class="flat-red" id="admin"> Admin &nbsp;
                <input type="radio" name="level" value="2" class="flat-red" id="user1" checked> User
              </div>
              
            </div>
            <div class="form-group" id="hak_akses">
              <label class="control-label col-md-2">Hak Akses</label>
              <div class="col-md-10">
                <input type="checkbox" name="hak_akses[]" class="flat-red" value="Pasien"> Pasien &nbsp;
                <input type="checkbox" name="hak_akses[]" class="flat-red" value="Pendaftaran"> Pendaftaran &nbsp;
                <!-- <input type="checkbox" name="hak_akses[]" class="flat-red" value="Antrian"> Antrian &nbsp; -->
                <input type="checkbox" name="hak_akses[]" class="flat-red" value="Klinik"> Klinik &nbsp;
                <input type="checkbox" name="hak_akses[]" class="flat-red" value="Apotek"> Apotek &nbsp;
                <input type="checkbox" name="hak_akses[]" class="flat-red" value="Kasir"> Kasir &nbsp;
                <input type="checkbox" name="hak_akses[]" class="flat-red" value="Lab"> Lab &nbsp;
                <input type="checkbox" name="hak_akses[]" class="flat-red" value="Radiologi"> Radiologi &nbsp;
              </div>
            </div>
            <div class="form-group">
              <center>
              <input type="submit" name="submit" class="btn btn-primary" value="Simpan" >
              <input type="reset" name="reset" class="btn" value="Reset">
              </center>
            </div>
          <?= form_close() ?>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view('footer') ?>
<script>
  $(document).ready(function(){
    $('#user').addClass('active');
    
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass   : 'iradio_flat-blue'
    });

    $('#admin').on('ifChecked', function(){
      $('#hak_akses').hide();
    });

    $('#user1').on('ifChecked', function(){
      $('#hak_akses').show();
    });

  });
</script>