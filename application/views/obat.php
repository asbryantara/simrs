<?php 
  $this->load->view('header');
  $this->load->view('leftbar');
?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-circle-o"></i> &nbsp; Data Obat
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
              <a href="<?= base_url('master/add_obat') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> &nbsp; Tambah</a>
              <!-- <button type="button" class="btn btn-primary btn-sm" id="add"><i class="fa fa-plus"> </i> Tambah</button> -->

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
                    <th>Nama obat</th>
                    <th>Suplier</th>
                    <th>Konten</th>
                    <th>Harga</th>
                    <th>Stok</th>
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
      <div class="modal fade bd-example-modal-lg modal-tambah" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="judul-modal">Tambah Data obat</h4>
            </div>
            <div class="modal-body">
              
              <div class="form-group">
                <label class="control-label col-md-3">Suplier</label>
                <div class="col-md-8 input-group">
                  <select id="id_suplier" class="form-control select2" style="width: 100%;">
                    <option value="">--pilih suplier--</option>
                    <?php foreach($suplier as $row): ?>
                      <option value="<?= $row->id_suplier ?>"><?= $row->nama_suplier ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Nama Obat</label>
                <div class="col-md-8 input-group">
                  <input type="text" id="nama_obat" class="form-control" autocomplete="off">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Konten Obat</label>
                <div class="col-md-8 input-group">
                  <select name="konten[]" id="konten" class="form-control select2" multiple="multiple" data-placeholder="Tambah Konten Obat" style="width: 100%">
                    <?php foreach($konten as $k): ?>
                      <option value="<?= $k->nama_konten ?>"><?= $k->nama_konten ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Harga</label>
                <div class="col-md-8 input-group">
                  <div class="input-group-addon">
                    Rp
                  </div>
                  <input type="text" name="harga" id="harga" class="form-control" autocomplete="off">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Stok</label>
                <div class="col-md-8 input-group">
                  <input type="text" name="stok" id="stok" class="form-control" autocomplete="off">
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
              <h4 class="modal-title">Edit Data obat</h4>
            </div>
            <div class="modal-body">
               <div class="form-group">
                <label class="control-label col-md-3">Suplier</label>
                <div class="col-md-8 input-group">
                  <select id="u_id_suplier" class="form-control select2" style="width: 100%;">
                    <option value="">--pilih suplier--</option>
                    <?php foreach($suplier as $row): ?>
                      <option value="<?= $row->id_suplier ?>"><?= $row->nama_suplier ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Nama Obat</label>
                <div class="col-md-8 input-group">
                  <input type="text" id="u_nama_obat" class="form-control" autocomplete="off">
                  <input type="hidden" id="u_id_obat">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Harga</label>
                <div class="col-md-8 input-group">
                  <div class="input-group-addon">
                    Rp
                  </div>
                  <input type="text" name="u_harga" id="u_harga" class="form-control" autocomplete="off">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Stok</label>
                <div class="col-md-8 input-group">
                  <input type="text" name="u_stok" id="u_stok" class="form-control" autocomplete="off">
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
              <input type="hidden" name="d_id_obat" id="d_id_obat">
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
    
    $('#id_suplier, #u_id_suplier').select2();

    $( '#harga, #u_harga' ).mask('000.000.000.000', {reverse: true});

    $("#konten").select2({ dropdownParent: ".modal-tambah" });

    var formatRupiah = OSREC.CurrencyFormatter.getFormatter
      ({
        currency:   'IDR',

        symbol:   '',
        decimal:  ',',
        group:    '.',
        pattern:  '#,##0 !',
        valueOnError:   '0'

    });

    // load tampil
    tampil();

    // mangaktifkan leftbar
    $('#obat').addClass('active');
    $('#master').addClass('active');
    $('#loading').css('display','none');
    
    // menampilkan data
    function tampil(){
      $.ajax({
        type: 'GET',
        url: '<?= base_url('master/show_obat') ?>',
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

    $('#stok, #harga').on('keyup', function(e){
      if(e.keyCode == 13){
        simpan();
      }
    });

    function simpan(){
      var nama_obat = $('#nama_obat').val();
      var harga = $('#harga').val();
      var stok = $('#stok').val();
      var id_suplier = $('#id_suplier').val();
      $.ajax({
        type: 'POST',
        url: '<?= base_url('master/save_obat') ?>',
        dataType: 'JSON',
        data:{
          nama_obat:nama_obat,
          harga:harga,
          stok:stok,
          id_suplier:id_suplier,
        },
        success: function(data){
          if(data == 'duplikasi'){
            alert('obat '+nama_obat+' sudah ada di dalam database !');
          }else{
            $('#nama_obat').val('');
            $('#harga').val('');
            $('#stok').val('');
            // $('#id_suplier').val('');
            $('.modal-tambah').modal('hide');
            tampil();
          }
        }
      });
      return false;
    }

    // menampilkan modal edit
    $(document).on('click', '.btn-edit', function(){
      var id_obat = $(this).attr('data');
      $.ajax({
        type: 'POST',
        url: '<?= base_url('master/detail_obat') ?>',
        dataType: 'JSON',
        data: {id_obat:id_obat},
        success: function(data){
          $('#u_id_obat').val(data.id_obat);
          $('#u_nama_obat').val(data.nama_obat);
          $('#u_harga').val(formatRupiah(data.harga));
          $('#u_stok').val(data.stok);
          $('#u_id_suplier').val(data.id_suplier).trigger('change');
          $('.modal-edit').modal('show');
          // console.log(data);
        }
      });
      return false;
    });

    $('#u_nama_obat, #harga, #stok').on('keyup', function(e){
      if(e.keyCode == 13){
        update();
      }
    });


    // // update data
    $('#update').on('click', function(){
      update();
    });

    function update(){
      var id_obat = $('#u_id_obat').val();
      var nama_obat = $('#u_nama_obat').val();
      var stok = $('#u_stok').val();
      var harga = $('#u_harga').val();
      var id_suplier = $('#u_id_suplier').val();
      $.ajax({
        type: 'POST',
        url: '<?= base_url('master/update_obat') ?>',
        dataType: 'JSON',
        data:{
          id_obat:id_obat,
          nama_obat:nama_obat,
          stok:stok,
          harga:harga,
          id_suplier:id_suplier,
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
      var id_obat = $(this).attr('data');
      $('#d_id_obat').val(id_obat);
      $('#modal-hapus').modal('show');
    });

   

    // // proses hapus
    $(document).on('click', '#hapus', function(){
      var id_obat = $('#d_id_obat').val()
      $.ajax({
        type: 'POST',
        url: '<?= base_url('master/delete_obat') ?>',
        dataType: 'JSON',
        data:{id_obat:id_obat},
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
        url: '<?= base_url('master/search_obat') ?>',
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
              <td>`+data[i].nama_obat+`</td>
              <td>`+data[i].nama_suplier+`</td>
              <td>`+data[i].konten_obat+`</td>
              <td class="money">`+data[i].harga+`</td>
              <td>`+data[i].stok+`</td>
              <td>
                <a href="<?= base_url('master/edit_obat/') ?>`+data[i].id_obat+`" class="btn btn-warning btn-xs">Edit</a>
                <button type="button" class="btn btn-danger btn-xs btn-hapus" data="`+data[i].id_obat+`">Hapus</button>
                
              </td>
 
            </tr>
          `;
          no++;
        }
      }else{
        html = `
          <tr>
            <td colspan="6" class="text-center"> Tidak ada data </td>
          </tr>
        `;
      }
      $('#isi').html(html);
      OSREC.CurrencyFormatter.formatAll(
      {
       selector: '.money', 
       currency: 'IDR',
       symbol: 'Rp ',
      });
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