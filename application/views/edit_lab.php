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
          
          <!-- <a href="<?= base_url('pasien/add') ?>" class="btn btn-info"><i class="fa fa-plus"> </i> Data Pasien Baru</a> -->
          <a href="<?= base_url('penunjang/riwayat_lab') ?>" class="btn btn-primary"><i class="fa fa-eye"> </i> Riwayat Pemeriksaan</a>
         
          <br>
          <br>
          
        </div>

        <?= form_open(base_url('penunjang/update_lab'), ['class'=>'form-horizontal']) ?>
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


          <div class="box box-primary" id="lab">
            <div class="box-header with-border">
              <h3 class="box-title">Data Pemeriksaan Lab</h3>
              <input type="hidden" name="dataLab" id="dataLab" value="0">
            </div>
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-2 control-label">Kolesterol</label>

                <div class="col-sm-4">
                  <input type="text" name="kolesterol" id="kolesterol" value="<?= $lab['kolesterol'] ?>" class="form-control">
                  <input type="hidden" name="id_lab" value="<?= $lab['id_lab'] ?>">
                  <small id="res-kol"></small>
                </div>
                
                 <label class="col-sm-2 control-label">Gula Darah Acak</label>

                <div class="col-sm-4">
                  <input type="text" name="gda" id="gda" value="<?= $lab['gda'] ?>" class="form-control">
                    <input type="hidden" name="resultGd" id="resultGd" value="0">
                  <small id="res-gda"></small>
                </div>
                
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Gula Darah Puasa</label>

                <div class="col-sm-4">
                  <input type="text" name="gdp" value="<?= $lab['gdp'] ?>" id="gdp" class="form-control">
                  <small id="res-gdp"></small>
                </div>
                
                 <label class="col-sm-2 control-label">Gula Darah Setelah Makan</label>

                <div class="col-sm-4">
                  <input type="text" name="gdsm" value="<?= $lab['gdsm'] ?>" id="gdsm" class="form-control">
                  <small id="res-gdsm"></small>
                </div>
                
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Hemogloin</label>

                <div class="col-sm-4">
                  <input type="text" name="hb" id="hb" value="<?= $lab['hb'] ?>" class="form-control">
                  <small id="res-hb"></small>
                </div>
                
                 <label class="col-sm-2 control-label">Trombosit</label>

                <div class="col-sm-4">
                  <input type="text" name="trombosit" id="trombosit" value="<?= $lab['trombosit'] ?>" class="form-control">
                  <small id="res-trombosit"></small>
                </div>
                
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">SGOT</label>

                <div class="col-sm-4">
                  <input type="text" name="sgot" id="sgot" value="<?= $lab['sgot'] ?>" class="form-control">
                  <small id="res-sgot"></small>
                </div>
                
                 <label class="col-sm-2 control-label">SGPT</label>

                <div class="col-sm-4">
                  <input type="text" name="sgpt" id="sgpt" value="<?= $lab['sgpt'] ?>" class="form-control">
                  <small id="res-sgpt"></small>
                </div>
                
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Asam Urat</label>

                <div class="col-sm-4">
                  <input type="text" name="asamurat" id="asamurat" value="<?= $lab['asamurat'] ?>" class="form-control">
                  <small id="res-asamurat"></small>
                </div>
                
                 <label class="col-sm-2 control-label">Widal</label>

                <div class="col-sm-4">
                  <select name="widal" id="widal" class="form-control">
                    <option value="">-- pilih --</option>
                    <option value="0" <?php if($lab['widal'] == 0){echo 'selected';} ?>>Negatif</option>
                    <option value="1" <?php if($lab['widal'] == 1){echo 'selected';} ?>>Positif</option>
                  </select>
                  <small id="res-widal"></small>
                </div>
                
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Pemeriksaan Lainnya</label>

                <div class="col-sm-4">
                  <textarea name="lain" class="form-control" rows="4"><?= $lab['lain'] ?></textarea>
                </div>
                
                </div>
                
              </div>



            </div>

            


          </div>


          <!-- <div class="box-footer"> -->
              <center><h3 id="res-str"></h3></center>
              <input type="hidden" name="risiko_stroke" id="risiko_stroke" value="0">
            <!-- </div> -->

          <center>
               <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
               <!-- <button type="button" id="btn-lab" class="btn btn-info btn-sm">Tambah Data Lab</button> -->
               <!-- <button type="button" id="btn-lab-del" class="btn btn-danger btn-sm hidden">Hapus Data Lab</button> -->
               <!-- <button type="button" id="btn-rad" class="btn btn-info btn-sm">Tambah Data Radiologi</button> -->
               <!-- <button type="button" id="btn-rad-del" class="btn btn-danger btn-sm hidden">Hapus Data Radiologi</button> -->
               <button type="reset" class="btn btn-default btn-sm">Reset</button>
             </center>

        </div>
       <?= form_close() ?>

        </div>
        <!-- /.col (RIGHT) -->
        <!-- /.col (RIGHT) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<?php $this->load->view('footer') ?>

<script>
  $(document).ready(function () {

    $('#left_lab').addClass('active');
    
    var h = kolesterol();
    actKolesterol(h);
    var i = gda();
    actGda(i);
    var j = gdsm();
    actGdsm(j);
    var k = gdp();
    actGdp(k);
    var l = hemoglobin();
    actHb(l);
    var m = trombosit();
    acttrombosit(m);
    var n = sgot();
    actsgot(n);
    var o = sgpt();
    actsgpt(o);
    var p = asamurat();
    actasamurat(p);
    var q = widal();
    actwidal(q);

    // PEMERIKSAAN HOOOO



    /*
    =================================================================================
                          KODE
    =================================================================================
    KATEGORI              1                 2               3                   4 
    =================================================================================
    TEKANAN DARAH         HYPOTENSI         NORMAL          PREHYPERTENSI       -
    IMT                   KURUS             NORMAL          BERAT BADAN LEBIH   GEMUK
    GULA DARAH            NORMAL            DM
    =================================================================================
    */


    $('.flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass   : 'iradio_flat-blue'
    });
    

    /*
    =======================================
                  TEKANAN DARAH
    =======================================
    KATEGORI          SYSTOLE   | DIASTOLE 
    =======================================
    hypotensi       = <90       | <60
    normal          = 90 - 120  | 60 - 80
    pre hypertensi  = 120 - 140 | 80 - 90
    hypertensi      = 140 - 160 | 90 - 100 
    =======================================
    */


    /*
    =======================================
               PEMERIKSAAN LAB
    =======================================
    KATEGORI          NORMAL
    =======================================
    Gula Darah Puasa          = 70 - 110
    Gula Darah Setelah Makan  = 110 - 125
    Gula Darah Acak           = < 140 
    Kolesterol Total          = < 200
    =======================================
    */


    // HEMOGLOBIN
    $('#hb').on('change', function(){
      var hb = hemoglobin();
      actHb(hb);
    });

    function hemoglobin(){
      var hb;
      var hb = $('#hb').val();
      var jk = $('#jk_px').val();

      if(hb != ''){
        if(jk == 'Laki-Laki'){
          if(hb < 14){
            hb = 'RISK';
          }else if(hb <= 17.5){
            hb = 'Normal';
          }else if(hb > 17.5){
            hb = 'RISK';
          }
        }else{
          if(hb < 12.3){
            hb = 'RISK';
          }else if(hb > 15.3){
            hb = 'RISK';
          }
        }
      }else{
        hb = '';
      }

      return (hb);
    }

    function actHb(hb){
      if(hb != ''){
        if(hb == 'RISK'){
          $('#res-hb').removeClass().addClass('text-red').html(hb);
        }else if(hb == 'Normal'){
          $('#res-hb').removeClass().addClass('text-blue').html(hb);
        }
      }else{
        $('#res-hb').removeClass().html(hb);
      }
    }


    // WIDAL
    function widal(){
      var widal;
      var wd = $('#widal').val();
      if(wd != ''){
        if(wd == 1){
          widal = 'RISK';
        }else{
          widal = 'Normal';
        }
      }else{
        widal = '';
      }

      return (widal);
    }

    function actwidal(widal){
      if(widal != ''){
        if(widal == 'RISK'){
          $('#res-widal').removeClass().addClass('text-red').html(widal);
        }else if(widal == 'Normal'){
          $('#res-widal').removeClass().addClass('text-blue').html(widal);
        }
      }else{
        $('#res-widal').removeClass().html(widal);
      }
    }

    $('#widal').on('change', function(){
      var wd = widal();
      actwidal(wd);
    });


    // ASAM URAT
    function asamurat(){
      var asamurat;
      var au = $('#asamurat').val();
      if(au != ''){
        if(au < 3){
          asamurat = 'RISK';
        }else if(au <= 7){
          asamurat = 'Normal';
        }else{
          asamurat = 'RISK';
        }
      }else{
        asamurat = '';
      }

      return (asamurat);
    }

    function actasamurat(asamurat){
      if(asamurat != ''){
        if(asamurat == 'RISK'){
          $('#res-asamurat').removeClass().addClass('text-red').html(asamurat);
        }else if(asamurat == 'Normal'){
          $('#res-asamurat').removeClass().addClass('text-blue').html(asamurat);
        }
      }else{
        $('#res-asamurat').removeClass().html(asamurat);
      }
    }

    $('#asamurat').on('change', function(){
      var au = asamurat();
      actasamurat(au);
    });

    // SGPT
    function sgpt(){
      var sgpt;
      var pt = $('#sgpt').val();
      if(pt != ''){
        if(pt <= 45){
          sgpt = 'Normal';
        }else{
          sgpt = 'RISK';
        }
      }else{
        sgpt = '';
      }

      return (sgpt);
    }

    function actsgpt(sgpt){
      if(sgpt != ''){
        if(sgpt == 'RISK'){
          $('#res-sgpt').removeClass().addClass('text-red').html(sgpt);
        }else if(sgpt == 'Normal'){
          $('#res-sgpt').removeClass().addClass('text-blue').html(sgpt);
        }
      }else{
        $('#res-sgpt').removeClass().html(sgpt);
      }
    }

    $('#sgpt').on('change', function(){
      var pt = sgpt();
      actsgpt(pt);
    });

    // SGOT
    function sgot(){
      var sgot;
      var ot = $('#sgot').val();
      if(ot != ''){
        if(ot <= 37){
          sgot = 'Normal';
        }else{
          sgot = 'RISK';
        }
      }else{
        sgot = '';
      }

      return (sgot);
    }

    function actsgot(sgot){
      if(sgot != ''){
        if(sgot == 'RISK'){
          $('#res-sgot').removeClass().addClass('text-red').html(sgot);
        }else if(sgot == 'Normal'){
          $('#res-sgot').removeClass().addClass('text-blue').html(sgot);
        }
      }else{
        $('#res-sgot').removeClass().html(sgot);
      }
    }

    $('#sgot').on('change', function(){
      var ot = sgot();
      actsgot(ot);
    });

    // TROMBOSIT
    function trombosit(){
      var trombosit;
      var trom = $('#trombosit').val();
      if(trom != ''){
        if(trom < 150){
          trombosit = 'RISK';
        }else if(trom <= 450){
          trombosit = 'Normal';
        }else{
          trombosit = 'RISK';
        }
      }else{
        trombosit = '';
      }

      return (trombosit);
    }

    function acttrombosit(trombosit){
      if(trombosit != ''){
        if(trombosit == 'RISK'){
          $('#res-trombosit').removeClass().addClass('text-red').html(trombosit);
        }else if(trombosit == 'Normal'){
          $('#res-trombosit').removeClass().addClass('text-blue').html(trombosit);
        }
      }else{
        $('#res-trombosit').removeClass().html(trombosit);
      }
    }

    $('#trombosit').on('change', function(){
      var trom = trombosit();
      acttrombosit(trom);
    });

    // KOLESTEROL
    function kolesterol1(){
      var kolesterol;
      var kol = $('#kolesterol').val();
      if(kol != ''){
        if(kol < 200){
          kolesterol = 'Normal';
        }else if(kol < 240){
          kolesterol = 'Sedang';
        }else if(kol >= 240){
          kolesterol = 'Tinggi';
        }
      }else {
        kolesterol = '';
      }

      return (kolesterol);
    }

    function kolesterol(){
      var kolesterol;
      var kol = $('#kolesterol').val();
      if(kol != ''){
        if(kol >= 200){
          kolesterol = 'Tinggi';
        }else{
          kolesterol = 'Normal';
        }
      }else{
        kolesterol = '';
      }

      return (kolesterol);
    }

    function actKolesterol(kolesterol){
      if(kolesterol != ''){
        if(kolesterol == 'Tinggi'){
          $('#res-kol').removeClass().addClass('text-red').html(kolesterol);
        }else if(kolesterol == 'Normal'){
          $('#res-kol').removeClass().addClass('text-blue').html(kolesterol);
        }
      }else{
        $('#res-kol').removeClass().html(kolesterol);
      }
    }

    $('#kolesterol').on('change', function(){
      var kol = kolesterol();
      actKolesterol(kol);
    });


    function gda(){
      var gulaDarah;
      var gda = $('#gda').val();
      if(gda != ''){
        if(gda > 140){
          gulaDarah = 'Diabetus Mellitus';
        }else{
          gulaDarah = 'Normal';
        }
      }else{
        gulaDarah = '';
      }

      return(gulaDarah);
    }

    function actGda(gulaDarah){
      if(gulaDarah != ''){
        if(gulaDarah == 'Diabetus Mellitus'){
          $('#res-gda').removeClass().addClass('text-red').html(gulaDarah);
        }else if(gulaDarah == 'Normal'){
          $('#res-gda').removeClass().addClass('text-blue').html(gulaDarah);
        }
      }else{
        $('#res-gda').removeClass().html(gulaDarah);
      }
    }


    $('#gda').on('change', function(){
      var gulaDarah = gda();
      actGda(gulaDarah);
      cekGd();
    });


    function gdsm(){
      var gulaDarah;
      var gdsm = $('#gdsm').val();
      if(gdsm != ''){
        if(gdsm < 110){
          gulaDarah = 'Rendah';
        }else if(gdsm <= 125){
          gulaDarah = 'Normal';
        }else{
          gulaDarah = 'Diabetus Mellitus';
        }
      }else{
        gulaDarah = '';
      }
      return(gulaDarah);
    }

    function actGdsm(gulaDarah){
      if(gulaDarah != ''){
        if(gulaDarah == 'Rendah'){
          $('#res-gdsm').removeClass().addClass('text-red').html(gulaDarah);
        }else if( gulaDarah == 'Normal'){
          $('#res-gdsm').removeClass().addClass('text-blue').html(gulaDarah);
        }else if(gulaDarah == 'Diabetus Mellitus'){
          $('#res-gdsm').removeClass().addClass('text-red').html(gulaDarah);
        }
      }else{
        $('#res-gdsm').html('');
      }
    }

    $('#gdsm').on('change', function(){
      var a = gdsm();
      actGdsm(a);
      cekGd();
    });


    function gdp(){
      var gulaDarah;
      var gdp = $('#gdp').val();
      if(gdp != ''){
        if(gdp < 70){
          gulaDarah = 'Rendah';
        }else if(gdp <= 110){
          gulaDarah = 'Normal';
        }else{
          gulaDarah = 'Diabetus Mellitus';
        }
      }else{
        $('#res-gdp').html('');
      }
      return(gulaDarah);
    }

    function actGdp(gulaDarah){
      if(gulaDarah != ''){
        if(gulaDarah == 'Rendah'){
          $('#res-gdp').removeClass().addClass('text-red').html(gulaDarah);
        }else if(gulaDarah == 'Normal'){
          $('#res-gdp').removeClass().addClass('text-blue').html(gulaDarah);
        }else if(gulaDarah == 'Diabetus Mellitus'){
          $('#res-gdp').removeClass().addClass('text-red').html(gulaDarah);
        }
      }else{
        $('#res-gdp').html('');
      }
    }

    $('#gdp').on('change', function(){
      var a = gdp();
      actGdp(a);
      cekGd();
    });


    function cekGd(){
      var a = gda();
      var b = gdp();
      var c = gdsm();
      var d;

      if((a == 'Diabetus Mellitus')||(b == 'Diabetus Mellitus')||(c == 'Diabetus Mellitus')){
        d = 1;
        $('#resultGd').val(1);
      }else{
        $('#resultGd').val(0);
        d = 0;
      }

      return(d);
    }

    /*
    -----------------------------------------------------------------------------------
    Faktor Risiko         Risiko Tinggi         Risiko Sedang           Risiko Rendah
    -----------------------------------------------------------------------------------
    Tekanan Darah         >140/90               120-139/80-89           <120/80
    Kebiasaan Merokok     Perokok               Kadang-kadang merokok   Tidak Merokok
    Cholesterol           >240                  200-239                 <200
    Diabetes              Ya                    Ada riwayat keluarga    Tidak 
    Aktivitas fisik       Malas                 Kadang-kadang           Teratur
    Berat Badan           Gemuk                 Sedikit Gemuk           Normal
    Riwayat Keluarga      Ya                    Tidak yakin             Tidak   
    -----------------------------------------------------------------------------------
    JIKA JUMLAH           >=3                   4-6                     6-8
    */

    

  });
</script>