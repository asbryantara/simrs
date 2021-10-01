<?php 
  $this->load->view('header');
  $this->load->view('leftbar');
?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Laporan Kunjungan
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
          <?= form_open(base_url('laporan/view_kunjungan'), ['name' => 'form_laporan','class'=>'form-horizontal', 'id'=>'form_filter']) ?>
          <div id="box_filter" class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-filter"></i>&nbsp;Filter</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                  <label class="col-md-2 control-label">Cetak Laporan</label>
                  <div class="col-md-3">
                    <select name="bulan1" id="bulan1" class="form-control" required="">
                      <option value="">--dari bulan--</option>
                      <option value="01">Januari</option>
                      <option value="02">Februari</option>
                      <option value="03">Maret</option>
                      <option value="04">April</option>
                      <option value="05">Mei</option>
                      <option value="06">Juni</option>
                      <option value="07">Juli</option>
                      <option value="08">Agustus</option>
                      <option value="09">September</option>
                      <option value="10">Oktober</option>
                      <option value="11">November</option>
                      <option value="12">Desember</option>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <select name="bulan2" id="bulan2" class="form-control" required="">
                      <option value="">--sampai bulan--</option>
                      <option value="01">Januari</option>
                      <option value="02">Februari</option>
                      <option value="03">Maret</option>
                      <option value="04">April</option>
                      <option value="05">Mei</option>
                      <option value="06">Juni</option>
                      <option value="07">Juli</option>
                      <option value="08">Agustus</option>
                      <option value="09">September</option>
                      <option value="10">Oktober</option>
                      <option value="11">November</option>
                      <option value="12">Desember</option>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <select name="tahun" id="tahun" class="form-control" required="">
                      <?php 
                        $th = date('Y');
                        for ($i=1; $i < 6; $i++) { 
                          echo '<option value="'.$th.'">'.$th.'</option>';
                          $th -= 1;
                        }
                      ?>
                    </select>
                  </div>
                </div>

                <center>
                  <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-search"> </i> Cari</button>
                  <!-- <input type="submit" name="submit" value="cek" class="btn btn-danger"> -->
                  <input type="reset" name="reset" value="Reset" class="btn btn-sm">  
                </center>
            </div>

            <div class="overlay hidden" id="loading">
              <i class="fa fa-refresh fa-spin"></i>
            </div>
          </div>
          <div id="hasil" class="box hidden">
            <div class="box-header">
              <div class="pull-right">
                <span><i>Cetak sebagai : </i> &nbsp; </span>
                <button type="button" name="excel" class="btn btn-success btn-sm" onclick="submitForm('laporan/cetak_excel');"><i class="fa fa-file-excel-o"></i>&nbsp; Excel</button>
                <button type="button" name="pdf" class="btn btn-danger btn-sm" onclick="submitForm('laporan/cetak_pdf');"><i class="fa fa-file-pdf-o"></i>&nbsp; PDF</button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead id="hasil_judul">
                  <tr>
                    <th>No</th>
                    <th>Nama Pasien</th>
                    <th>Nama Peminjam</th>
                    <th>Instansi</th>
                    <th>Tujuan</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali</th>
                  </tr>
                </thead>
                
                <tbody id="hasil_filter" >
                  
                </tbody>
              </table>
            </div>
          </div>
          <?= form_close() ?>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view('footer') ?>
<script>
  function konfirmasi(){
    return confirm('Apakah anda yakin ingin menghapus data ini ?');
  }
  function submitForm(action){
    var form = document.getElementById('form_filter');
    form.action = action;
    form.submit();
  }
  $(document).ready(function(){
    $('#laporan_peminjaman').addClass('active');

    $('#home').removeClass('active');
    $('.select2').select2();
    //Flat red color scheme for iCheck
    $('#tdk_kbl').on('ifChecked', function(){
      $('#tanggalkembali').val('');
    });
    $('input[type="checkbox"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-blue'
    });
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true,
    });
    //Date range picker
    $('.tanggal').daterangepicker({
      autoUpdateInput : false,
      opens : 'left',
      locale: {
        cancelLabel : 'Batal',
        applyLabel : 'Oke'
      }
    });
    $('.tanggal').on('apply.daterangepicker', function(ev, picker){
      $(this).val(picker.startDate.format('DD-MM-YYYY') + '  -s/d-  ' + picker.endDate.format('DD-MM-YYYY'));
      $('#tdk_kbl').iCheck('uncheck');
    });
    $('.tanggal').on('cancel.daterangepicker', function(ev, picker){
      $(this).val('');
    });
  
    
  });
</script>