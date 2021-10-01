<?php 
  $this->load->view('header');
  $this->load->view('leftbar');
?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-circle-o"></i> &nbsp; Data Desa
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
                    <th>No.</th>
                    <!-- <th>provinsi</th>
                    <th>Kota/Kabupaten</th> -->
                    <th>Kecamatam</th>
                    <th>Kel/Desa</th>
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
      <div class="modal fade bd-example-modal-lg modal-tambah" tabindex="false" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="judul-modal">Tambah Data desa</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label class="control-label col-md-3">Nama Provinsi</label>
                <div class="col-md-8">
                  <select name="id_provinsi" id="id_provinsi" class="form-control select2" style="width: 100%;">
                    <option value="">--pilih provinsi--</option>
                    <?php foreach($row as $r): ?>
                      <option value="<?= $r->id_provinsi ?>"><?= $r->nama_provinsi ?></option>
                    <?php endforeach ?>
                  </select>
                  <small class="text-red hidden"><b>Perhatian !</b> Nama provinsi tidak boleh kosong !</small>
                </div>
              </div>
              <br>
              <br>

              <div class="form-group">
                <label class="control-label col-md-3">Nama Kota/Kab</label>
                <div class="col-md-8">
                  <select name="id_kota_kab" id="id_kota_kab" class="form-control select2" style="width: 100%;">
                    <option value="">--pilih kota/kab--</option>
                    
                  </select>
                </div>
              </div>
              <br>
              <br>

              <div class="form-group">
                <label class="control-label col-md-3">Nama Kecamatan</label>
                <div class="col-md-8">
                  <select name="id_kecamatan" id="id_kecamatan" class="form-control select2" style="width: 100%;">
                    <option value="">--pilih kecamatan--</option>
                    
                  </select>
                </div>
              </div>
              <br>
              <br>


              <div class="form-group">
                <label class="control-label col-md-3">Nama desa</label>
                <div class="col-md-8">
                  <input type="text" name="nama_desa" id="nama_desa" class="form-control" autocomplete="off" >
                </div>
              </div>
              <br>
              <br>
              
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
      <div class="modal fade bd-example-modal-lg modal-edit" tabindex="false" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Data desa</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label class="control-label col-md-3">Nama Provinsi</label>
                <div class="col-md-8">
                  <select name="u_id_provinsi" id="u_id_provinsi" class="form-control select2" style="width: 100%;">
                    <option value="" selected>--pilih provinsi--</option>
                    <?php foreach($row as $r): ?>
                      <option value="<?= $r->id_provinsi ?>"><?= $r->nama_provinsi ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
              </div>
              <br>
              <br>
              <div class="form-group">
                <label class="control-label col-md-3">Nama Kota/Kab</label>
                <div class="col-md-8">
                  <select name="u_id_kota_kab" id="u_id_kota_kab" class="form-control select2" style="width: 100%;">
                    <option value="">--pilih kota/kab--</option>
                    
                  </select>
                </div>
              </div>
              <br>
              <br>
              <div class="form-group">
                <label class="control-label col-md-3">Nama Kecamatan</label>
                <div class="col-md-8">
                  <select name="u_id_kecamatan" id="u_id_kecamatan" class="form-control select2" style="width: 100%;">
                    <option value="">--pilih kecamatan--</option>
                    
                  </select>
                </div>
              </div>
              <br>
              <br>
              <div class="form-group">
                <label class="control-label col-md-3">Nama desa</label>
                <div class="col-md-8">
                  <input type="text" id="u_nama_desa" class="form-control" autocomplete="off">
                  <input type="hidden" name="u_id_desa" id="u_id_desa">
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
              <input type="hidden" name="d_id_desa" id="d_id_desa">
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

<script>
  $(document).ready(function(){
    
    $('.select2').select2();

    // load tampil
    tampil();

    // mangaktifkan leftbar
    $('#desa').addClass('active');
    $('#master').addClass('active');
    $('#loading').css('display','none');
    
    // menampilkan data
    function tampil(){
      $.ajax({
        type: 'GET',
        url: '<?= base_url('master/show_desa') ?>',
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

    //tampil berdasarkan provinsi untuk add
    $('#id_provinsi').on('change', function(){
      var id_provinsi = $('#id_provinsi').val();
      $.ajax({
        type: 'POST',
        url: '<?= base_url('master/kota_prov') ?>',
        dataType: 'JSON',
        data:{
          id_provinsi:id_provinsi,
        },
        success: function(data){
          var html = '';
          html += `<option value="">--pilih kota/kab--</option>`;
          for(i=0; i<data.length; i++){
            html += `<option value=`+data[i].id_kota_kab+`>`+data[i].nama_kota_kab+`</option>`;
          }
          $('#id_kota_kab').html(html);
        }
      });
    });

    $('#id_kota_kab').on('change', function(){
      var id_kota_kab = $('#id_kota_kab').val();
      var id_provinsi = $('#id_provinsi').val();
      $.ajax({
        type: 'POST',
        url: '<?= base_url('master/kec_kota') ?>',
        dataType: 'JSON',
        data:{
          id_kota_kab:id_kota_kab,
          id_provinsi:id_provinsi,
        },
        success: function(data){
          console.log(data);
          var html = '';
          html += `<option value="">--pilih kecamatan--</option>`;
          for(i=0; i<data.length; i++){
            html += `<option value=`+data[i].id_kecamatan+`>`+data[i].nama_kecamatan+`</option>`;
          }
          $('#id_kecamatan').html(html);
        }
      });
    });

    $('#u_id_provinsi').on( 'select2:select', function(e){
      var id_provinsi = $('#u_id_provinsi').val();
      $.ajax({
        type: 'POST',
        url: '<?= base_url('master/kota_prov') ?>',
        dataType: 'JSON',
        data:{
          id_provinsi:id_provinsi,
        },
        success: function(data){
          var html = '';
          html += `<option value="">--pilih kota/kabupaten--</option>`;
          for(i=0; i<data.length; i++){
            html += `<option value="`+data[i].id_kota_kab+`">`+data[i].nama_kota_kab+`</option>`;
          }
          $('#u_id_kota_kab').html(html);
        }
      });
    });

    $('#u_id_kota_kab').on( 'select2:select', function(e){
      var id_kota_kab = $('#u_id_kota_kab').val();
      var id_provinsi = $('#u_id_provinsi').val();
      $.ajax({
        type: 'POST',
        url: '<?= base_url('master/kec_kota') ?>',
        dataType: 'JSON',
        data:{
          id_kota_kab:id_kota_kab,
          id_provinsi:id_provinsi,
        },
        success: function(data){
          // console.log(id_kota_kab);
          var html3 = '';
          html3 += `<option value="">--pilih kecamatan--</option>`;
          for(i=0; i<data.length; i++){
            html3 += `<option value="`+data[i].id_kecamatan+`">`+data[i].nama_kecamatan+`</option>`;
          }
          $('#u_id_kecamatan').html(html3);
        }
      });
    });


    // // simpan data
    $('#simpan').on('click', function(){
      simpan();
    });

    $('#nama_desa').on('keyup', function(e){
        if(e.keyCode == 13){
          simpan();
        }
    });


    function simpan(){
      var nama_desa = $('#nama_desa').val();
      var id_provinsi = $('#id_provinsi').val();
      var id_kota_kab = $('#id_kota_kab').val();
      var id_kecamatan = $('#id_kecamatan').val();
      $.ajax({
        type: 'POST',
        url: '<?= base_url('master/save_desa') ?>',
        dataType: 'JSON',
        data:{
          nama_desa:nama_desa,
          id_provinsi:id_provinsi,
          id_kota_kab:id_kota_kab,
          id_kecamatan:id_kecamatan,
        },
        success: function(data){
          if(data == 'duplikasi'){
            alert(nama_desa+' sudah ada di dalam database !');
          }else{
            $('#nama_desa').val('');
            $('#id_provinsi').val('').trigger('change');
            $('#id_kota_kab').val('').trigger('change');
            $('#id_kecamatan').val('').trigger('change');
            $('.modal-tambah').modal('hide');
            tampil();
          }
          console.log(data);
        }
      });
      return false;
    }

    // menampilkan modal edit
    $(document).on('click', '.btn-edit', function(){
      var id_desa = $(this).attr('data');
      var html;
      var html2;

      $.ajax({
        type: 'POST',
        url: '<?= base_url('master/edit_desa') ?>',
        dataType: 'JSON',
        data: {id_desa:id_desa},
        success: function(data){
          $('#u_id_kota_kab').html('');
          $('#u_id_kecamatan').html('');

          $('#u_id_desa').val(data.des.id_desa);
          $('#u_nama_desa').val(data.des.nama_desa);
          $('#u_id_provinsi').val(data.prov).trigger('change');
          
          for(i=0; i<data.kec.length; i++){
            html += `<option value="`+data.kec[i].id_kecamatan+`">`+data.kec[i].nama_kecamatan+`</option>`
          }
          $('#u_id_kecamatan').append(html);
          // console.log(data);
          for(i=0; i<data.kk.length; i++){
            html2 += `<option value="`+data.kk[i].id_kota_kab+`">`+data.kk[i].nama_kota_kab+`</option>`
          }

          $('#u_id_kota_kab').append(html2);

          $('#u_id_kecamatan').val(data.des.id_kecamatan);
          $('#u_id_kota_kab').val(data.des.id_kota_kab);

          $('.modal-edit').modal('show');



          // console.log(data);
        }
      });
      return false;
    });

    $('#u_nama_desa').on('keyup', function(e){
      if(e.keyCode == 13){
        update();
      }
    });


    // // update data
    $('#update').on('click', function(){
      update();
    });

    function update(){
      var id_desa = $('#u_id_desa').val();
      var id_kota_kab = $('#u_id_kota_kab').val();
      var id_provinsi = $('#u_id_provinsi').val();
      var id_kecamatan = $('#u_id_kecamatan').val();
      var nama_desa = $('#u_nama_desa').val();
      $.ajax({
        type: 'POST',
        url: '<?= base_url('master/update_desa') ?>',
        dataType: 'JSON',
        data:{
          id_desa:id_desa,
          id_kota_kab:id_kota_kab,
          id_provinsi:id_provinsi,
          id_kecamatan:id_kecamatan,
          nama_desa:nama_desa,
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
      var id_desa = $(this).attr('data');
      $('#d_id_desa').val(id_desa);
      $('#modal-hapus').modal('show');
    });

   

    // // proses hapus
    $(document).on('click', '#hapus', function(){
      var id_desa = $('#d_id_desa').val()
      $.ajax({
        type: 'POST',
        url: '<?= base_url('master/delete_desa') ?>',
        dataType: 'JSON',
        data:{id_desa:id_desa},
        success: function(data){
          $('#modal-hapus').modal('hide');
          // console.log(data);
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
        url: '<?= base_url('master/search_desa') ?>',
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
              <td>`+ no +`</td>
              
              <td>`+data[i].nama_kecamatan+`</td>
              <td>`+data[i].nama_desa+`</td>
              <td>
                <button type="button" class="btn btn-warning btn-xs btn-edit" data="`+data[i].id_desa+`">Edit</button>
                <button type="button" class="btn btn-danger btn-xs btn-hapus" data="`+data[i].id_desa+`">Hapus</button>
                
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