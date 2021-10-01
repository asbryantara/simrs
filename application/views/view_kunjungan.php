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
                      <option value="01" <?php if($bulan1 == '01'){echo 'selected';} ?>>Januari</option>
                      <option value="02" <?php if($bulan1 == '02'){echo 'selected';} ?>>Februari</option>
                      <option value="03" <?php if($bulan1 == '03'){echo 'selected';} ?>>Maret</option>
                      <option value="04" <?php if($bulan1 == '04'){echo 'selected';} ?>>April</option>
                      <option value="05" <?php if($bulan1 == '05'){echo 'selected';} ?>>Mei</option>
                      <option value="06" <?php if($bulan1 == '06'){echo 'selected';} ?>>Juni</option>
                      <option value="07" <?php if($bulan1 == '07'){echo 'selected';} ?>>Juli</option>
                      <option value="08" <?php if($bulan1 == '08'){echo 'selected';} ?>>Agustus</option>
                      <option value="09" <?php if($bulan1 == '09'){echo 'selected';} ?>>September</option>
                      <option value="10" <?php if($bulan1 == '10'){echo 'selected';} ?>>Oktober</option>
                      <option value="11" <?php if($bulan1 == '11'){echo 'selected';} ?>>November</option>
                      <option value="12" <?php if($bulan1 == '12'){echo 'selected';} ?>>Desember</option>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <select name="bulan2" id="bulan2" class="form-control" required="">
                      <option value="">--sampai bulan--</option>
                      <option value="01" <?php if($bulan2 == '01'){echo 'selected';} ?>>Januari</option>
                      <option value="02" <?php if($bulan2 == '02'){echo 'selected';} ?>>Februari</option>
                      <option value="03" <?php if($bulan2 == '03'){echo 'selected';} ?>>Maret</option>
                      <option value="04" <?php if($bulan2 == '04'){echo 'selected';} ?>>April</option>
                      <option value="05" <?php if($bulan2 == '05'){echo 'selected';} ?>>Mei</option>
                      <option value="06" <?php if($bulan2 == '06'){echo 'selected';} ?>>Juni</option>
                      <option value="07" <?php if($bulan2 == '07'){echo 'selected';} ?>>Juli</option>
                      <option value="08" <?php if($bulan2 == '08'){echo 'selected';} ?>>Agustus</option>
                      <option value="09" <?php if($bulan2 == '09'){echo 'selected';} ?>>September</option>
                      <option value="10" <?php if($bulan2 == '10'){echo 'selected';} ?>>Oktober</option>
                      <option value="11" <?php if($bulan2 == '11'){echo 'selected';} ?>>November</option>
                      <option value="12" <?php if($bulan2 == '12'){echo 'selected';} ?>>Desember</option>
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

          </div>
          <div id="hasil" class="box box-primary">
            <div class="box-header">
              <div class="pull-right">
                <span><i>Cetak sebagai : </i> &nbsp; </span>
                <button type="button" name="excel" class="btn btn-success btn-sm" onclick="submitForm('kunjungan_excel');"><i class="fa fa-file-excel-o"></i>&nbsp; Excel</button>
                <!-- <button type="button" name="pdf" class="btn btn-danger btn-sm" onclick="submitForm('laporan/cetak_pdf');"><i class="fa fa-file-pdf-o"></i>&nbsp; PDF</button> -->
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover">
                <thead id="hasil_judul">
                  <tr>
                    <th>No</th>
                    <th>Bulan</th>
                    <th>Jumlah Kunjungan</th>
                  </tr>
                </thead>
                
                <tbody>
                  
                  <?php $no=1; $total = 0; for ($i=$bulan1; $i <= $bulan2; $i++): ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td>
                        <?php  
                          if($i == '01'){
                            echo $label = 'Januari';
                          }elseif($i == '02'){
                            echo $label = 'Februari';
                          }elseif($i == '03'){
                            echo $label = 'Maret';
                          }elseif($i == '04'){
                            echo $label = 'April';
                          }elseif($i == '05'){
                            echo $label = 'Mei';
                          }elseif($i == '06'){
                            echo $label = 'Juni';
                          }elseif($i == '07'){
                            echo $label = 'Juli';
                          }elseif($i == '08'){
                            echo $label = 'Agustus';
                          }elseif($i == '09'){
                            echo $label = 'September';
                          }elseif($i == '10'){
                            echo $label = 'Oktober';
                          }elseif($i == '11'){
                            echo $label = 'November';
                          }elseif($i == '12'){
                            echo $label = 'Desember';
                          }
                        ?>
                      </td>
                      <td>
                        <?php 
                          $bulan = $tahun.'-'.sprintf('%02s', $i);
                          $this->db->like('tgl_kunjungan', $bulan, 'both');
                          $jumlah = $this->db->get('kunjungan')->num_rows(); 
                          echo $value = $jumlah;

                          $lab[] = $label;
                          $val[] = $value;
                          $total += $value;
                        ?>
                      </td>
                    </tr>

                  <?php endfor ?>
                  <tr>
                    <td colspan="2"><b>Total</b></td>
                    <td><?= $total ?></td>
                  </tr>

                </tbody>
              </table>
            </div>
            <div class="box-body">
              <center><h3>Grafik Kunjungan Pasien</h3></center>
              <div class="chart">
                <canvas id="barChart" style="height:230px"></canvas>
              </div>
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
  
  function submitForm(action){
    var form = document.getElementById('form_filter');
    form.action = action;
    form.submit();
  }

  $(document).ready(function(){
    $('#laporan').addClass('active');
    $('#lap_kunjungan').addClass('active');
  
    var label = '<?= json_encode($lab) ?>';
    var value = '<?= json_encode($val) ?>';
    
    var a = JSON.parse(label);
    var b = JSON.parse(value);
    console.log(a);
    console.log(b);

    var areaChartData = {
      labels  : a,
      datasets: [
        
        {
          label               : 'Digital Goods',
          fillColor           : 'rgba(60,141,188,0.9)',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : b
        }
      ]
    }



    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    var barChartData                     = areaChartData
    barChartData.datasets.fillColor   = '#00a65a'
    barChartData.datasets.strokeColor = '#00a65a'
    barChartData.datasets.pointColor  = '#00a65a'
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions);
  });
</script>