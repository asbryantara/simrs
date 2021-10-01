<?php 
  $this->load->view('header');
  $this->load->view('leftbar');
?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-user"></i> &nbsp; User
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
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
          <div class="box box-primary">
            <div class="box-header">
              <!-- <h3 class="box-title">Hover Data Table</h3> -->
              <a href="<?= base_url('user/create_user') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> &nbsp; Tambah</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Foto</th>
                    <th>Nama User</th>
                    <th>Username</th>
                    <th>Level</th>
                    <th>Hak Akses</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody id="body_table">
                  <?php $no=1; foreach($rows as $row) : ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><img src="<?= base_url('uploads/'.$row->foto) ?>" class="img-circle" width="70"></td>
                      <td><?= $row->nama_user ?></td>
                      <td><?= $row->username ?></td>
                      <td><?php if($row->level==1){echo 'Admin';}else{echo 'User';} ?></td>
                      <td><?= $row->hak_akses ?></td>
                      <td>
                        <a href="<?= base_url('user/edit/'.$row->id_user) ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="<?= base_url('user/delete/'.$row->id_user) ?>" class="btn btn-danger btn-sm" onclick="return konfirmasi();">Hapus</a>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
                <tbody id="hasil_filter" class="hidden">
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <?= form_open('user/update', array('class'=>'form-horizontal')) ?>
            <input type="hidden" name="id_user" id="id_pinjam">
            <div class="modal-header">
              <h4 class="modal-title">Edit Data user</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label class="control-label col-md-3">No. Rekam Medis</label>
                <div class="col-md-8">
                  <input type="text" name="no_rm" id="no_rm" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Nama Pasien</label>
                <div class="col-md-8">
                  <input type="text" name="nama_pasien" id="nama_pasien" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Nama Peminjam</label>
                <div class="col-md-8">
                  <input type="text" name="nama_peminjam" id="nama_peminjam" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Instansi</label>
                <div class="col-md-8">
                  <input type="text" name="instansi" id="instansi" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Tujuan</label>
                <div class="col-md-8">
                  <select name="tujuan" class="form-control" required="" id="tujuan">
                    <option value="">-- pilih tujuan --</option>
                    <option value="penelitian">penelitian</option>
                    <option value="klaim">klaim</option>
                    <option value="visum">visum</option>
                    <option value="hukum">hukum</option>
                    <option value="surat keterangan">surat keterangan</option>
                    <option value="lain-lain">lain-lain</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Tanggal Pinjam</label>
                <div class="col-md-8">
                  <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control tanggal_modal" autocomplete="off">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Tanggal Kembali</label>
                <div class="col-md-6">
                  <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control tanggal_modal" autocomplete="off">
                </div>
                <div class="col-md-2">
                  <input type="checkbox" name="batal_kembali" class="flat-red cek" id="btl_kembali" value="1">
                  <span id="label_batal">Batal kembali</span> 
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Nama Petugas</label>
                <div class="col-md-8">
                  <input type="text" name="nama_user" id="nama_user" class="form-control" disabled="">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <center>
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <input type="submit" name="submit" id="tombol_modal" class="btn btn-primary" value="">
              </center>
            </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view('footer') ?>
<script>
  function konfirmasi(){
    return confirm('Apakah anda yakin ingin menghapus data ini ?');
  }
  $(document).ready(function(){
    $('#user').addClass('active');
    $('#master').addClass('active');

    
    // $(document).on('click', '.edit_data', function(){
    //   var id_user = $(this).attr('id');
    //   $.ajax({
    //     url:'<?= base_url('user/edit') ?>',
    //     method:'POST',
    //     data:{id_user:id_user},
    //     dataType:'json',
    //     success:function(data){
    //       $('#id_pinjam').val(data.id_user);
    //       $('#no_rm').val(data.no_rm);
    //       $('#nama_pasien').val(data.nama_pasien);
    //       $('#nama_peminjam').val(data.nama_peminjam);
    //       $('#instansi').val(data.instansi);
    //       $('#tujuan').val(data.tujuan);
    //       $('#tanggal_pinjam').val(data.tanggal_pinjam);
    //       $('#tanggal_kembali').val(data.tanggal_kembali);
    //       $('#nama_user').val(data.nama_user);
    //       $('#tombol_modal').val('Update');
    //       $('.bd-example-modal-lg').modal('show');
    //     }
    //   });
    // });
   
    //Initialize Select2 Elements
    $('.select2').select2()

    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-blue'
    });

    //Flat red color scheme for iCheck
    $('#tdk_kbl').on('ifChecked', function(){
      $('#tanggalkembali').val('');
    });

    $('#tdk_kbl').on('ifChecked', function(){
      $('#tanggalkembali').val('');
    });

    $('#btl_kembali').on('ifChecked', function(){
      $('#tanggal_kembali').val('');
    });
    
  });
</script>