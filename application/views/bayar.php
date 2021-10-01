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
          
          <a href="<?= base_url('kasir') ?>" class="btn btn-info"><i class="fa fa-arrow-left"> </i> Kembali</a>
          <!-- <a href="<?= base_url('pendaftaran/list_pendaftaran') ?>" class="btn btn-primary"><i class="fa fa-eye"> </i> Lihat Pendaftaran</a> -->
         
          <br>
          <br>
          
        </div>

        <?= form_open(base_url('klinik/update'), ['class'=>'form-horizontal']) ?>
         <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Identitas Pasien</h3>
            </div>
              <div class="box-body">
                
                <div class="form-group">
                  <label class="col-sm-2 control-label">No. RM</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="no_rm" value="<?= $kunj['no_rm'] ?>" disabled>
                    <input type="hidden" name="id_kunjungan" id="id_kunjungan" value="<?= $kunj['id_kunjungan'] ?>">
                  </div>
               
                  <label class="col-sm-2 control-label">Nama Pasien </label>

                  <div class="col-sm-4">
                    <input type="text" name="nama_px" class="form-control" id="nama_px" value="<?= $kunj['nama_px'] ?>" disabled>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Jenis Kelamin </label>
                  <div class="col-sm-4">
                    <input type="text" id="jk_px" class="form-control" value="<?php if($kunj['jk_px'] == 1){echo 'Laki-laki';}else{echo 'Perempuan';} ?>" disabled>
                  </div>

                  <label class="col-sm-2 control-label">Alamat</label>
                  <div class="col-sm-4">
                    <textarea class="form-control" id="alamat_px" disabled=""><?= $kunj['alamat_px'] ?></textarea> 
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Tempat Tanggal Lahir </label>

                  <div class="col-sm-4">
                    <input type="text" id="ttl" class="form-control" value="<?= $kunj['tempat_lahir_px'].', '.$kunj['tgl_lahir_px'] ?>" disabled="">
                  </div>
                  
                   <label class="col-sm-2 control-label">Pembayaran</label>

                  <div class="col-sm-4">
                    <input type="text" id="pembayaran" class="form-control" value="<?php if($kunj['asuransi_px'] == 1){echo 'Umum';}elseif($kunj['asuransi_px'] == 2){echo 'BPJS Kesehatan';}else{echo $kunj['asuransi_lain_px'];} ?>" disabled>
                  </div>
                  
                </div>

             </div>

          </div>
          <!--- // BOX -->

            <div class="box box-primary " id="rx">
              <div class="box-header with-border">
                <h3 class="box-title">Rincian Biaya </h3>
              </div>

              <div class="box-body" id="tableResep">
                <div class="col-md-12">
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr style="background-color: #A8CDFF;">
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Jumlah</th>
                        <th>Mata Uang</th>
                        <th>Harga</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=1; $total=0; foreach($tindakan as $tx): ?>
                        <tr>
                          <td><?= $no++ ?></td>
                          <td><?= $tx->nama_tindakan ?></td>
                          <td>1</td>
                          <td>IDR</td>
                          <td style="text-align: right;" class='money'><?= $tx->harga_tindakan ?></td>
                          <td style="text-align: right;" class='money'><?= $tx->harga_tindakan ?></td>
                        </tr>
                        <?php $total = $total+$tx->harga_tindakan; ?>
                      <?php endforeach ?>

                      <?php foreach($resep as $ob): ?>
                        <tr>
                          <td><?= $no++ ?></td>
                          <td><?= $ob->nama_obat ?></td>
                          <td><?= $ob->jumlah ?></td>
                          <td>IDR</td>
                          <td style="text-align: right;" class='money'><?= $ob->harga ?></td>
                          <td style="text-align: right;" class='money'><?= ($ob->harga*$ob->jumlah) ?></td>
                        </tr>
                      <?php $total = $total+($ob->harga*$ob->jumlah); endforeach ?>

                      <tr>
                        <td colspan="5" style="text-align: right; font-weight: 700;"><b>Total</b></td>
                        <td style="text-align: right; font-weight: 700;" id="totalBayar" class='money'><b><?= $total ?></b></td>
                      </tr>

                      <?php if($status > 0): ?>
                        <tr>
                          <td colspan="5" style="text-align: right; font-weight: 700;">Bayar</td>
                          <td style="text-align: right; font-weight: 700;" class='money'><?= $bayar['bayar'] ?></td>
                        </tr>
                        <tr>
                          <td colspan="5" style="text-align: right; font-weight: 700;">Kembali</td>
                          <td style="text-align: right; font-weight: 700;" class='money'><?= $bayar['kembali'] ?></td>
                        </tr>
                      <?php endif ?>
                    </tbody>
                  </table>
                </div>

              </div>
            </div>

            
          </div>

          

          <center>
              <button type="button" id="bayar" class="btn btn-primary btn-sm <?php if($status > 0){echo 'disabled';} ?>"><i class="fa fa-money"> </i> Bayar</button>
              <a href="<?= base_url('kasir/cetak_faktur/'.$this->uri->segment(3)) ?>" class="btn btn-primary btn-sm <?php if($status == 0){echo 'disabled';} ?>" target="_blank"><i class="fa fa-print"> </i> Cetak Faktur</a>
              <a href="<?= base_url('kasir/cetak_kwitansi/'.$this->uri->segment(3)) ?>" class="btn btn-primary btn-sm <?php if($status == 0){echo 'disabled';} ?>" target="_blank"><i class="fa fa-print"> </i> Cetak Kwitansi</a>
              <!-- <a href="<?= base_url('kasir/selesai/'.$this->uri->segment(3)) ?>" class="btn btn-danger btn-sm"><i class="fa fa-check"> </i> Selesai</a> -->

             </center>

        </div>
       <?= form_close() ?>

        </div>
        <!-- /.col (RIGHT) -->
        <!-- /.col (RIGHT) -->
      </div>
      <!-- /.row -->

      <div class="modal fade bd-example-modal-lg modal-bayar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <?= form_open('kasir/simpan', ['class'=>'form-horizontal']) ?>
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Pembayaran</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label class="control-label col-md-3">Tagihan</label>
                <div class="col-md-8 input-group">
                  <div class="input-group-addon">
                    Rp
                  </div>
                  <input type="text" name="jumlah_bayar" id="tagihan" class="form-control tagihan" value="<?= $total ?>" readonly autocomplete="off">
                  <input type="hidden" name="id_kunjungan" value="<?= $this->uri->segment(3) ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Bayar</label>
                <div class="col-md-8 input-group">
                  <div class="input-group-addon">
                    Rp
                  </div>
                  <input type="text" name="bayar" id="dibayar" class="form-control" autocomplete="off">
                </div>
              </div>
              <div class="form-group">

                <label class="control-label col-md-3">Kembali</label>
                <div class="col-md-8 input-group">
                  <div class="input-group-addon">
                    Rp
                  </div>
                  <!-- <h4 id="kembalian" style="font-weight: 800;"></h4> -->
                  <input type="text" name="kembali" id="kembali" class="form-control" autocomplete="off" readonly="">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <center>
                <button type="submit" name="Simpan" id="simpan" class="btn btn-primary btn-sm">Simpan</button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Tutup</button>
              </center>
            </div>
          </div>
            <?= form_close() ?>
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<?php $this->load->view('footer') ?>

<script src="<?= base_url('assets/') ?>dist/js/jquery.mask.min.js"></script>
<script>
  $(document).ready(function () {

    OSREC.CurrencyFormatter.formatAll(
    {
     selector: '.money', 
     currency: 'IDR',
     symbol: '',
    });

    var formatRupiah = OSREC.CurrencyFormatter.getFormatter
      ({
        // If currency is not supplied, defaults to USD
        currency:   'IDR',

        // Use to override the currency's default symbol
        symbol:   '',

        // Use to override the currency's default locale - every locale has
        // preconfigured decimal, group and pattern
        // locale:   'fr',

        // Use to override the locale's default decimal character
        decimal:  ',',

        // Use to override the locale's default group (thousand separator) character
        group:    '.',

        // Use to override the locale's default display pattern
        // Note comma = group separator, dot = decimal separator, exclamation = symbol
        // Follows standard unicode currency pattern
        pattern:  '#,##0 !',

        // Return this value if the input value is not a valid number
        // Defaults to '0'
        valueOnError:   '0'

    });

      var val = document.getElementById('tagihan').value;

      var formatted = formatRupiah(val);

      document.getElementById('tagihan').value = formatted;


    $('#kasir').addClass('active');
    

    $('.flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass   : 'iradio_flat-blue'
    });
    
    $('#bayar').on('click', function(){
      $('.modal-bayar').modal('show');
    });

    $('#dibayar').on('keyup', function(){
      pembayaran();
    });

    function pembayaran(){
      var tag = $('#tagihan').val();
      var bay = $('#dibayar').val();

      var bayar = bay.replace(/[.]/g, '');
      var tagihan = tag.replace(/[.]/g, '');

      var kembali = bayar-tagihan;
      // $('#kembali').val(kembali);
      kembalian(kembali);
    }

    function kembalian(kembali){
      var val = kembali;

      var formatted = formatRupiah(val);

      document.getElementById('kembali').value = formatted;
    }

    $( '#dibayar' ).mask('000.000.000.000', {reverse: true});

  });
</script>