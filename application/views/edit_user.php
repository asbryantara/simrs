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
        <li class="active">Edit User</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
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
      </div>
      <div class="row" style="min-height: 750px;">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('uploads/'.$user['foto']) ?>" alt="User profile picture" style="object-fit: cover; height: 100px;">

              <h3 class="profile-username text-center"><?php echo $user['nama_user'] ?></h3>

              <p class="text-muted text-center">SIM Klinik</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Username</b> <a class="pull-right"><?php echo $user['username'] ?></a>
                </li>
                <li class="list-group-item">
                  <b>Level</b> <a class="pull-right"><?php if($user['level'] == 1){echo 'Admin';}else{echo 'User';} ?></a>
                </li>
              </ul>
              <?php 
                echo form_open('user/hapus_foto', array('class'=>'form-horizontal'));
                echo form_hidden('id_user',$user['id_user']);
                if($user['foto']=='default.png') { ?>
                <input type="reset" class="btn btn-danger btn-block disabled" value="Hapus Foto">
              <?php }else{ ?>
                <input type="submit" class="btn btn-danger btn-block" value="Hapus Foto">
              <?php } ?>
              <?php echo form_close() ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          
          <!-- Alert -->
          <div class="flashdata-success" data-flashdata="<?php echo $this->session->flashdata('info') ?>"></div>
            <div class="flashdata-warning" data-flashdata="<?php echo $this->session->flashdata('peringatan') ?>"></div>
            <!-- /Alert -->

          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#edit" data-toggle="tab">Edit</a></li>
              <li><a href="#password" data-toggle="tab">Password</a></li>
              <li><a href="#foto" data-toggle="tab">Foto</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="edit">
                <?php 
                  echo form_open('user/update', array('class'=>'form-horizontal'));
                  echo form_hidden('id_user',$user['id_user']);
                ?>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Nama</label>

                    <div class="col-sm-10">
                      <input type="text" name="nama_user" value="<?= $user['nama_user'] ?>" class="form-control" <?php  if($this->session->userdata('level') !='1'){echo 'disabled';} ?>>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Username</label>

                    <div class="col-sm-10">
                      <?php echo form_input('username', $user['username'], array('class'=>'form-control')) ?>
                    </div>
                  </div>
                  <?php if($this->session->userdata('level') =='1'){  ?>

                  <div class="form-group">
                    <label class="control-label col-md-2">Level</label>
                    <div class="col-md-10">
                      <input type="radio" name="level" value="1" class="flat-red" id="admin" <?php if($user['level']=='1'){echo 'checked';} ?>> Admin &nbsp;
                      <input type="radio" name="level" value="2" class="flat-red" id="user_check" <?php if($user['level']=='2'){echo 'checked';} ?>> User
                    </div>
                  </div>
                  
                  <div class="form-group <?php if($user['level']=='1'){echo 'hidden';} ?>" id="hak_akses">
                    <label class="control-label col-md-2">Hak Akses</label>
                    <div class="col-md-10">
                      <?php $hak=explode(', ', $user['hak_akses']); ?>
                      <input type="checkbox" name="hak_akses[]" class="flat-red" value="Pasien" <?php if(in_array('Pasien', $hak)){echo 'checked';} ?>> Pasien &nbsp;
                      <input type="checkbox" name="hak_akses[]" class="flat-red" value="Pendaftaran" <?php if(in_array('Pendaftaran', $hak)){echo 'checked';} ?>> Pendaftaran &nbsp;
                      <input type="checkbox" name="hak_akses[]" class="flat-red" value="Klinik" <?php if(in_array('Klinik', $hak)){echo 'checked';} ?>> Klinik &nbsp;
                      <input type="checkbox" name="hak_akses[]" class="flat-red" value="Apotek" <?php if(in_array('Apotek', $hak)){echo 'checked';} ?>> Apotek &nbsp;
                      <input type="checkbox" name="hak_akses[]" class="flat-red" value="Kasir" <?php if(in_array('Kasir', $hak)){echo 'checked';} ?>> Kasir &nbsp;
                      <input type="checkbox" name="hak_akses[]" class="flat-red" value="Lab" <?php if(in_array('Lab', $hak)){echo 'checked';} ?>> Lab &nbsp;
                      <input type="checkbox" name="hak_akses[]" class="flat-red" value="Radiologi" <?php if(in_array('Radiologi', $hak)){echo 'checked';} ?>> Radiologi &nbsp;
                    </div>
                  </div>

                  <?php 

                  } 

                  ?>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Simpan</button>
                    </div>
                  </div>
                <?php echo form_close() ?>
              </div>
              <!-- /.tab-pane -->
              
              <div class="tab-pane" id="password">
                <?php 
                  echo form_open('user/update_password', array('class'=>'form-horizontal'));
                  echo form_hidden('id_user',$user['id_user']);
                ?>
                  <div class="form-group">
                    <label class="col-sm-3 control-label">Password Baru</label>

                    <div class="col-sm-9">
                      <input type="password" class="form-control" name="passwordBaru" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label">Ulangi Password Baru</label>

                    <div class="col-sm-9">
                      <input type="password" class="form-control" name="passwordBaru1" />
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                      <button type="submit" class="btn btn-danger">Simpan</button>
                    </div>
                  </div>
                <?php echo form_close() ?>
              </div>
              <!-- /.tab-pane -->
  
              <div class="tab-pane" id="foto">
                <?php 
                  echo form_open_multipart('user/update_foto', array('class'=>'form-horizontal'));
                  echo form_hidden('id_user',$user['id_user']);
                ?>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Foto</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" name="foto" required />
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Simpan</button>
                    </div>
                  </div>
                <?php echo form_close() ?>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      
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
      $('#hak_akses').addClass('hidden');
    });

    $('#user_check').on('ifChecked', function(){
      $('#hak_akses').removeClass('hidden');
    });
  });
</script>