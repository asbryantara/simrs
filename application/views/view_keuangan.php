<?php 
  $this->load->view('header');
  $this->load->view('leftbar');
?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Laporan keuangan
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
          <?= form_open(base_url('laporan/view_keuangan'), ['name' => 'form_laporan','class'=>'form-horizontal', 'id'=>'form_filter']) ?>
          <div id="box_filter" class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-filter"></i>&nbsp;Filter</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                  <label class="col-md-2 control-label">Pilih Tanggal</label>
                  <div class="col-md-6">
                    <input type="text" name="tanggal1" class="form-control tanggal" value="<?= $sesi ?>"  autocomplete="off">
                  </div>

                <center>
                  <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-search"> </i> Cari</button>
                  <!-- <input type="submit" name="submit" value="cek" class="btn btn-danger"> -->
                  <input type="reset" name="reset" value="Reset" class="btn btn-sm">  
                </center>
            </div>

          </div>
          <div id="hasil" class="box box-primary">
            <div class="box-header">
              <div class="pull-right">
                <span><i>Cetak sebagai : </i> &nbsp; </span>
                <button type="button" name="excel" class="btn btn-success btn-sm" onclick="submitForm('keuangan_excel');"><i class="fa fa-file-excel-o"></i>&nbsp; Excel</button>
                <!-- <button type="button" name="pdf" class="btn btn-danger btn-sm" onclick="submitForm('laporan/cetak_pdf');"><i class="fa fa-file-pdf-o"></i>&nbsp; PDF</button> -->
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover">
                <thead id="hasil_judul">
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Pemasukan</th>
                  </tr>
                </thead>
                
                <tbody>
                  <?php $this->load->model('M_laporan'); ?>
                  <?php $no=1; $tot=0; foreach($tgl as $l): ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $l->tgl_bayar ?></td>
                      <td class="money">
                        <?php 
                          $cek = $this->db->get_where('kasir', ['tgl_bayar'=>$l->tgl_bayar])->result();
                          $jum = 0;
                          foreach($cek as $c){
                            $jum += $c->jumlah_bayar;
                          }
                          echo $jum;
                          $tot += $jum;
                        ?>
                      </td>
                      
                    </tr>
                  <?php endforeach ?>
                  <tr>
                    <td colspan="2" style="text-align: right;"><b>Total</b></td>
                    <td class="money"><?= $tot ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
<!--             <div class="box-body">
              <center><h3>Grafik Penggunaan</h3></center>
              <div class="chart">
                <canvas id="barChart" style="height:400px"></canvas>
              </div>
            </div> -->
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
  
  function submitForm(action){
    var form = document.getElementById('form_filter');
    form.action = action;
    form.submit();
  }

  

  $(document).ready(function(){
    $('#laporan').addClass('active');
    $('#lap_keuangan').addClass('active');
  
  OSREC.CurrencyFormatter.formatAll(
  {
   selector: '.money', 
   currency: 'IDR',
   symbol: 'Rp ',
  });

  });
</script>