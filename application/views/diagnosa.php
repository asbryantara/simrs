<?php 
  $this->load->view('header');
  $this->load->view('leftbar');
?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-circle-o"></i> &nbsp; Data Diagnosis
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
          <div id="box_filter" class="box box-primary hidden">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-filter"></i>&nbsp;Filter</h3>
            </div>
            <div class="box-body">
              <?= form_open(base_url('peminjaman/filter'), ['class'=>'form-horizontal', 'id'=>'form_filter']) ?>
                <div class="form-group">
                  <label class="col-md-2 control-label">No. Rekam Medis</label>
                  <div class="col-md-3">
                    <input type="text" name="f_norm" class="form-control input-sm" id="f_norm" placeholder="-semua-">
                  </div>
                  <label class="col-md-2 control-label">Nama Pasien</label>
                  <div class="col-md-3">
                    <input type="text" name="f_namapasien" class="form-control input-sm" id="f_namapasien" placeholder="-semua-">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label">Tahun Meninggal</label>
                  <div class="col-md-3">
                    <input type="text" name="f_tahunmeninggal" class="form-control input-sm" id="f_tahunmeninggal" placeholder="-semua-">
                  </div>
                  <label class="col-md-2 control-label">No Urut Simpan</label>
                  <div class="col-md-1">
                    <input type="text" name="f_nourutsimpan1" class="form-control input-sm" id="f_nourutsimpan1" placeholder="-semua-">
                  </div>
                  <div class="col-md-1" style="text-align: center;">
                    <span>sampai</span>
                  </div>
                  <div class="col-md-1">
                    <input type="text" name="f_nourutsimpan2" class="form-control input-sm" id="f_nourutsimpan2" placeholder="-semua-">
                  </div>
                </div>
                
                <center>
                  <button type="button" class="btn btn-info btn-sm" id="tombol_filter"><i class="fa fa-search"> </i> Cari</button>
                  <input type="reset" name="reset" value="Reset" class="btn btn-sm">  
                  <button type="button" class="btn btn-sm btn-danger" id="tombol_close"><i class="fa fa-times"> </i> Tutup</button>
                </center>
              <?= form_close() ?>
            </div>

            <div class="overlay" id="loading">
              <i class="fa fa-refresh fa-spin"></i>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header">
              <!-- <h3 class="box-title">Hover Data Table</h3> -->
              <!-- <a href="<?= base_url('peminjaman/create') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> &nbsp; Tambah</a> -->
              <button type="button" class="btn btn-primary btn-sm" id="add"><i class="fa fa-plus"> </i> Tambah</button>

              <div class="col-md-3 pull-right">
                <input type="text" name="search" placeholder="Cari" id="cari" class="form-control input-sm" width="30">
              </div>
            </div>
            <!-- /.box-header -->
            <?= form_open(base_url('kematian/stiker'), ['id'=>'form_cetak']) ?>
            <div class="box-body">
              <table id="dataKematian" class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Kode Diagnosis</th>
                    <th>Nama Diagnosis</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody id="isi">
                  
                </tbody>
              </table>
            </div>
            <?= form_close() ?>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      
      <!-- modal tambah -->
      <div class="modal fade bd-example-modal-lg modal-tambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="judul-modal">Tambah Data diagnosis</h4>
            </div>
            <div class="modal-body">
              
              <div class="form-group">
                <label class="control-label col-md-3">Kode diagnosis</label>
                <div class="col-md-8 input-group">
                  <input type="text" name="kode_diagnosa" id="kode_diagnosa" class="form-control" autocomplete="off">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Nama diagnosis</label>
                <div class="col-md-8 input-group">
                  <input type="text" name="nama_diagnosa" id="nama_diagnosa" class="form-control" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <center>
                <button type="button" name="simpan" id="simpan" class="btn btn-primary btn-sm">Simpan</button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Tutup</button>
              </center>
            </div>
          </div>
        </div>
      </div>

      <!-- modal tambah -->
      <div class="modal fade bd-example-modal-lg modal-edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Data diagnosa</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label class="control-label col-md-3">Kode diagnosa</label>
                <div class="col-md-8 input-group">
                  <input type="text"  id="u_kode_diagnosa" class="form-control" disabled autocomplete="off">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Nama diagnosa</label>
                <div class="col-md-8 input-group">
                  <input type="text" id="u_nama_diagnosa" class="form-control" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <center>
                <button type="button" name="update" id="update" class="btn btn-primary btn-sm">Update</button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Tutup</button>
              </center>
            </div>
          </div>
        </div>
      </div>

      <!-- modal hapus -->
      <div class="modal fade" id="modal-hapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <input type="hidden" name="d_kode_diagnosa" id="d_kode_diagnosa">
              <center>
                <h2 class="text-danger"><i class="fa fa-trash-o"></i></h2> 
                <h4 class="modal-title" id="exampleModalLabel">Apakah anda yakin akan menghapus data ini ?</h4><br>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger btn-sm" id="hapus">Ya, Hapus</button>
              </center>
            </div>
          </div>
        </div>
      </div>

     
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view('footer') ?>

<script src="<?= base_url('assets/') ?>dist/js/jquery.mask.min.js"></script>
<script>


  $(document).ready(function(){

    // $('#harga_diagnosa').inputmask({alias : "currency", prefix: 'Rp.'});

    // load tampil
    tampil();

    // mangaktifkan leftbar
    $('#diagnosa').addClass('active');
    $('#master').addClass('active');
    $('#loading').css('display','none');
    
    // menampilkan data
    function tampil(){
      $.ajax({
        type: 'GET',
        url: '<?= base_url('master/show_diagnosa') ?>',
        dataType: 'JSON',
        success: function(data){
          sukses(data);
        }
      });
    }

    // $(document).on('click', '#show_filter', function(){
    //   $('#box_filter').removeClass('hidden');
    //   $(this).hide();
    // });

    // $(document).on('click', '#tombol_close', function(){
    //   event.preventDefault();
    //   $('#box_filter').addClass('hidden');
    //   $('#show_filter').show();
    //   $('#f_norm').val('');
    //   $('#f_namapasien').val('');
    //   $('#f_tahunmeninggal').val('');
    //   $('#f_nourutsimpan1').val('');
    //   $('#f_nourutsimpan2').val('');
    // });

    // $('#tombol_filter').on('click', function(){
    //   var data = $('#form_filter').serialize();
    //   $.ajax({
    //     type: 'POST',
    //     url: '<?= base_url('kematian/filter') ?>',
    //     beforeSend: function(){
    //       $('#loading').css('display','block');
    //     },
    //     dataType: 'JSON',
    //     data: data,
    //     success: function(data){
    //       sukses(data);
    //       $('#loading').css('display','none');
    //     }
    //   });
    // });

    // menampilkan modal tambah
    $('#add').on('click', function(){
      $('.modal-tambah').modal('show');
    });

    // // simpan data
    $('#simpan').on('click', function(){
      simpan();
    });

    $('#harga_diagnosa').on('keyup', function(e){
      if(e.keyCode == 13){
        simpan();
      }
    });

    function simpan(){
      var kode_diagnosa = $('#kode_diagnosa').val();
      var nama_diagnosa = $('#nama_diagnosa').val();
      $.ajax({
        type: 'POST',
        url: '<?= base_url('master/save_diagnosa') ?>',
        dataType: 'JSON',
        data:{
          kode_diagnosa:kode_diagnosa,
          nama_diagnosa:nama_diagnosa,
        },
        success: function(data){
          if(data == 'duplikasi'){
            alert('diagnosa '+nama_diagnosa+' sudah ada di dalam database !');
          }else{
            $('#nama_diagnosa').val('');
            $('#kode_diagnosa').val('');
            $('.modal-tambah').modal('hide');
            tampil();
          }
        }
      });
      return false;
    }

    // menampilkan modal edit
    $(document).on('click', '.btn-edit', function(){
      var kode_diagnosa = $(this).attr('data');
      $.ajax({
        type: 'POST',
        url: '<?= base_url('master/detail_diagnosa') ?>',
        dataType: 'JSON',
        data: {kode_diagnosa:kode_diagnosa},
        success: function(data){
          // console.log(data);
          $('#u_kode_diagnosa').val(data.kode_diagnosa);
          $('#u_nama_diagnosa').val(data.nama_diagnosa);
          $('.modal-edit').modal('show');
        }
      });
      return false;
    });

    $('#u_nama_diagnosa, #u_harga_diagnosa').on('keyup', function(e){
      if(e.keyCode == 13){
        update();
      }
    });


    // // update data
    $('#update').on('click', function(){
      update();
    });

    function update(){
      var kode_diagnosa = $('#u_kode_diagnosa').val();
      var nama_diagnosa = $('#u_nama_diagnosa').val();
      $.ajax({
        type: 'POST',
        url: '<?= base_url('master/update_diagnosa') ?>',
        dataType: 'JSON',
        data:{
          kode_diagnosa:kode_diagnosa,
          nama_diagnosa:nama_diagnosa,
        },
        success: function(data){
          // console.log(data);
          // $('#no_rm').val('');
          // $('#nama_pasien').val('');
          $('.modal-edit').modal('hide');
          tampil();
        }
      });
      return false;
    }

    // menampilkan modal hapus 
    $(document).on('click', '.btn-hapus', function(){
      var kode_diagnosa = $(this).attr('data');
      $('#d_kode_diagnosa').val(kode_diagnosa);
      $('#modal-hapus').modal('show');
    });

   

    // // proses hapus
    $(document).on('click', '#hapus', function(){
      var kode_diagnosa = $('#d_kode_diagnosa').val()
      $.ajax({
        type: 'POST',
        url: '<?= base_url('master/delete_diagnosa') ?>',
        dataType: 'JSON',
        data:{kode_diagnosa:kode_diagnosa},
        success: function(data){
          $('#modal-hapus').modal('hide');
          console.log(data);
          tampil();
        }
      });
      return false;
    });

    // // search
    $('#cari').on('keyup', function(e){
      var search = $('#cari').val();
      $.ajax({
        type: 'POST',
        url: '<?= base_url('master/search_diagnosa') ?>',
        dataType: 'JSON',
        data:{search:search},
        success: function(data){
          sukses(data);
        }
      });
      return false;
    });

    // menampilkan html hasil jika sukses
    function sukses(data){
      if(data.length > 0){
        var no=1;
        html='';
        for(i=0; i<data.length; i++){
          html += `
            <tr>
              <td>`+data[i].kode_diagnosa+`</td>
              <td>`+data[i].nama_diagnosa+`</td>
              <td>
                <button type="button" class="btn btn-warning btn-xs btn-edit" data="`+data[i].kode_diagnosa+`">Edit</button>
                <button type="button" class="btn btn-danger btn-xs btn-hapus" data="`+data[i].kode_diagnosa+`">Hapus</button>
                
              </td>
 
            </tr>
          `;
          no++;
        }
      }else{
        html = `
          <tr>
            <td colspan="3" class="text-center"> Tidak ada data </td>
          </tr>
        `;
      }
      $('#isi').html(html);
    }

    // $('.flat-red').iCheck({
    //   checkboxClass: 'icheckbox_flat-blue'
    // });

    // //Flat red color scheme for iCheck
    // $(document).on('ifChecked','#check_all', function(){
    //   $('.check').iCheck('check');
    // });

    // $(document).on('ifUnchecked','#check_all', function(){
    //   $('.check').iCheck('uncheck');
    // });

    // $('#cetak_stiker').on('click', function(){
    //   $('#form_cetak').submit();
    // });

  });
</script>