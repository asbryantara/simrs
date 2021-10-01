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
        
        <!-- <div class="col-md-12">
          
          <a href="<?= base_url('pasien/add') ?>" class="btn btn-info"><i class="fa fa-plus"> </i> Data Pasien Baru</a>
          <a href="<?= base_url('klinik/list_klinik') ?>" class="btn btn-primary"><i class="fa fa-eye"> </i> Lihat klinik</a>
         
          <br>
          <br>
          
        </div> -->

        <?= form_open(base_url('klinik/save_periksa'), ['class'=>'form-horizontal']) ?>
         <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Data Pemeriksaan Fisik</h3>
            </div>
              <div class="box-body">
                
                <div class="form-group">
                  <label class="col-sm-2 control-label">No. RM</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="no_rm" value="<?= $per['no_rm'] ?>" disabled>
                    <input type="hidden" name="id_kunjungan" value="<?= $per['id_kunjungan'] ?>">
                  </div>
               
                  <label class="col-sm-2 control-label">Nama Pasien </label>

                  <div class="col-sm-4">
                    <input type="text" name="nama_px" class="form-control" id="nama_px" value="<?= $per['nama_px'] ?>" disabled>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Jenis Kelamin </label>
                  <div class="col-sm-4">
                    <input type="text" id="jk_px" class="form-control" value="<?php if($per['jk_px'] == 1){echo 'Laki-laki';}else{echo 'Perempuan';} ?>" disabled>
                  </div>

                  <label class="col-sm-2 control-label">Alamat</label>
                  <div class="col-sm-4">
                    <textarea class="form-control" id="alamat_px" disabled=""><?= $per['alamat_px'] ?></textarea> 
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Tempat Tanggal Lahir </label>

                  <div class="col-sm-4">
                    <input type="text" id="ttl" class="form-control" value="<?= $per['tempat_lahir_px'].', '.$per['tgl_lahir_px'] ?>" disabled="">
                  </div>
                  
                   <label class="col-sm-2 control-label">Pembayaran</label>

                  <div class="col-sm-4">
                    <input type="text" id="pembayaran" class="form-control" value="<?php if($per['asuransi_px'] == 1){echo 'Umum';}elseif($per['asuransi_px'] == 2){echo 'BPJS Kesehatan';}else{echo $per['asuransi_lain_px'];} ?>" disabled>
                  </div>
                  
                </div>

               <div class="form-group">
                  <label class="col-sm-2 control-label">Keluhan</label>

                  <div class="col-sm-4">
                    <textarea name="keluhan" id="keluhan" class="form-control" rows="4" ><?= $per['keluhan'] ?></textarea>
                  </div>

                   <label class="col-sm-2 control-label">Anamnesa</label>

                  <div class="col-sm-4">
                    <textarea name="anamnesa" id="anamnesa" class="form-control" rows="4" ></textarea>
                  </div>

                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Tekanan Darah</label>

                  <div class="col-sm-2">
                    <input type="text" name="sistol" id="sys" class="form-control" placeholder="Systole">
                    <small id="td"></small>
                  </div>
                  <div class="col-sm-2">
                    <input type="text" name="diastol" id="dias" class="form-control" placeholder="Diastole">
                    <input type="hidden" name="tekanan_darah" id="tekanan_darah">
                  </div>
                  
                   <label class="col-sm-2 control-label">Tinggi / Berat Badan</label>

                  <div class="col-sm-2">
                    <input type="text" name="tb" id="tb" class="form-control" placeholder="tinggi badan (m)">
                    <small id="imt"></small>
                  </div>
                  <div class="col-sm-2">
                    <input type="text" name="bb" id="bb" class="form-control" placeholder="berat badan (kg)">
                    <input type="hidden" name="imt" id="imt2">
                  </div>

                </div>

                <div class="form-group">
                  
                  <label class="col-sm-2 control-label">Merokok</label>

                  <div class="col-sm-4">
                    <select name="merokok" id="merokok" class="form-control">
                      <option>--pilih--</option>
                      <option value="1">Jarang/Tidak Pernah</option>
                      <option value="2">Kadang-Kadang</option>
                      <option value="3">Sering</option>
                    </select>
                  </div>
                   <label class="col-sm-2 control-label">Aktifitas Fisik</label>

                  <div class="col-sm-4">
                    <select name="aktivitas_fisik" id="aktivitas_fisik" class="form-control">
                      <option>--pilih--</option>
                      <option value="1">Jarang/Tidak Pernah</option>
                      <option value="2">Kadang-Kadang</option>
                      <option value="3">Sering</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                 
                  <label class="col-sm-2 control-label">Riwayat Keluarga</label>

                  <div class="col-sm-4">
                    <input type="checkbox" name="riwayat_keluarga_stroke" class="flat-red" id="riwayat_keluarga_stroke" value="1"> Riwayat Keluarga dengan Stroke <br>
                    <input type="checkbox" name="riwayat_keluarga_dm" class="flat-red" id="riwayat_keluarga_dm" value="1"> Riwayat Keluarga dengan Diabetus Mellitus
                  </div>
                  
                </div>

                


             </div>
             

          </div>


          <div class="box box-primary hidden" id="lab">
            <div class="box-header with-border">
              <h3 class="box-title">Data Pemeriksaan Lab</h3>
            </div>
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-2 control-label">Kolesterol</label>

                <div class="col-sm-4">
                  <input type="text" name="kolesterol" id="kolesterol" class="form-control">
                  <small id="res-kol"></small>
                </div>
                
                 <label class="col-sm-2 control-label">Gula Darah Acak</label>

                <div class="col-sm-4">
                  <input type="text" name="gda" id="gda" class="form-control">
                  <small id="res-gda"></small>
                </div>
                
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Gula Darah Puasa</label>

                <div class="col-sm-4">
                  <input type="text" name="gdp" id="gdp" class="form-control">
                  <small id="res-gdp"></small>
                </div>
                
                 <label class="col-sm-2 control-label">Gula Darah Setelah Makan</label>

                <div class="col-sm-4">
                  <input type="text" name="gdsm" id="gdsm" class="form-control">
                  <small id="res-gdsm"></small>
                </div>
                
              </div>



            </div>
          </div>

          <div class="box box-primary hidden" id="rad">
            <div class="box-header with-border">
              <h3 class="box-title">Data Pemeriksaan Radiologi</h3>
            </div>
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-2 control-label">Hasil Pemeriksaan Radiologi</label>

                <div class="col-sm-10">
                    <textarea class="form-control" name="hasil" rows="4"></textarea>
                  
                </div>
                
                
              </div>
            </div>
          </div>

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Diagnosa</h3>
            </div>
            <div class="box-body">
              <div class="form-group">
                 
                  <label class="col-sm-2 control-label">Diagnosa</label>

                  <div class="col-sm-4">
                    <textarea class="form-control" id="diagnosa" name="diagnosa"></textarea>
                  </div>

                  <label class="col-sm-2 control-label">Diagnosa Rekomendasi</label>

                  <div class="col-sm-4" id="dx_rekomendasi">

                  </div>

                </div>
            </div>
            <div class="box-footer">
              <center><h3 id="res-str"></h3></center>
            </div>
          </div>

             <center>
               <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
               <button type="button" id="btn-lab" class="btn btn-info btn-sm">Tambah Data Lab</button>
               <button type="button" id="btn-lab-del" class="btn btn-danger btn-sm hidden">Hapus Data Lab</button>
               <button type="button" id="btn-rad" class="btn btn-info btn-sm">Tambah Data Radiologi</button>
               <button type="button" id="btn-rad-del" class="btn btn-danger btn-sm hidden">Hapus Data Radiologi</button>
               <button type="reset" class="btn btn-default btn-sm">Reset</button>
             </center>

        </div>

        </div>
     <?= form_close() ?>
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

    var r1 = 0;
    var r2 = 0;
    var r3 = 0;

    $('#klinik').addClass('active');
    
   // ICHECK
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


    var td;
    $('#dias').on('blur', function(){
      var sys = $('#sys').val();
      var dias = $('#dias').val();

      if((sys < 90) || (dias < 60)){
        td = 'Hypotensi';
        $('#td').removeClass().addClass('text-red').html('<b>'+td+'</b>');
        $('#tekanan_darah').val(1);
        diagnosa_rekomendasi(td, 'td');
      }else if((sys < 120) || (dias < 80)){
        td = 'Normal';
        $('#td').removeClass().addClass('text-blue').html('<b>'+td+'</b>');
        $('#tekanan_darah').val(2);
        $('.td').remove();

        r3 += 1;

      }else if((sys < 140) || (dias < 90)){
        td = 'Pre Hypertensi';
        $('#td').removeClass().addClass('text-red').html('<b>'+td+'</b>');
        $('#tekanan_darah').val(3);
        diagnosa_rekomendasi(td, 'td');

        r2 += 1;

      }else{
        td = 'Hypertensi';
        $('#td').removeClass().addClass('text-red').html('<b>'+td+'</b>');
        $('#tekanan_darah').val(4);
        diagnosa_rekomendasi(td, 'td');

        r1 += 1;
      }

      risiko_stroke();

    });

    /*
    =======================================
               INDEX MASA TUBUH
                     BB (kg)
               IMT = --------
                     TB^2 (m)
    =======================================
    KATEGORI          IMT
    =======================================
    kurus       = <18.5
    normal      = 18.5 - 25.0
    gemuk       = > 25
    =======================================
    */
    var imt;
    $('#bb').on('blur', function(){
      var tb = $('#tb').val();
      var bb = $('#bb').val();
      var a = bb/(tb*tb);
      imt = a.toFixed(2);

      if(imt < 18.5){
        ket = 'Kurus';
        $('#imt').removeClass();
        $('#imt').addClass('text-red');
        $('#imt').html('<b>'+ket+'</b> (IMT = '+imt+')');
        $('#imt2').val(imt);
      }else if(imt <= 25){
        ket = 'Normal';
        $('#imt').removeClass();
        $('#imt').addClass('text-blue');
        $('#imt').html('<b>'+ket+'</b> (IMT = '+imt+')');
        $('#imt2').val(imt);

        r3 += 1;

      }else  if(imt <= 27){
        ket = 'Berat Badan Lebih';
        $('#imt').removeClass();
        $('#imt').addClass('text-red');
        $('#imt').html('<b>'+ket+'</b> (IMT = '+imt+')');
        $('#imt2').val(imt);
        
        r2 += 1;

      }else{
        ket = 'Gemuk';
        $('#imt').removeClass();
        $('#imt').addClass('text-red');
        $('#imt').html('<b>'+ket+'</b> (IMT = '+imt+')');
        $('#imt2').val(imt);

        r1 += 1;

      }
      risiko_stroke();

    });

    // MENAMPILKAN DATA LAB
    $('#btn-lab').on('click', function(){
      $('#lab').removeClass('hidden');
      $('#btn-lab').addClass('hidden');
      $('#btn-lab-del').removeClass('hidden');
    });

    // MENYEMBUNYIKAN DATA LAB
    $('#btn-lab-del').on('click', function(){
      $('#lab').addClass('hidden');
      $('#btn-lab').removeClass('hidden');
      $('#btn-lab-del').addClass('hidden');
    });

    // MENAMPILKAN DATA RAD
    $('#btn-rad').on('click', function(){
      $('#rad').removeClass('hidden');
      $('#btn-rad').addClass('hidden');
      $('#btn-rad-del').removeClass('hidden');
    });

    // MENYEMBUNYIKAN DATA RAD
    $('#btn-rad-del').on('click', function(){
      $('#rad').addClass('hidden');
      $('#btn-rad').removeClass('hidden');
      $('#btn-rad-del').addClass('hidden');
    });


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

    var gulaDarah;
    var kolesterol;

    $('#kolesterol').on('blur', function(){
      var kol = $('#kolesterol').val();
      if(kol != ''){
        if(kol >= 200){
          kolesterol = 'Tinggi';
          $('#res-kol').removeClass().addClass('text-red').html(kolesterol);
          // diagnosa_rekomendasi(kolesterol, 'gd');

          if(kol < 240){
            r2 += 1;
          }else{
            r1 += 1;
          }


        }else{
          kolesterol = 'Normal';
          $('#res-kol').removeClass().addClass('text-blue').html(kolesterol);

          r3 += 1;

        }
      }

      risiko_stroke();

    });

    $('#gda').on('blur', function(){
      var gda = $('#gda').val();
      if(gda != ''){
        if(gda > 140){
          gulaDarah = 'Diabetus Mellitus';
          $('#res-gda').removeClass().addClass('text-red').html(gulaDarah);
          diagnosa_rekomendasi(gulaDarah, 'gd');
        }else{
          gulaDarah = 'Normal';
          $('#res-gda').removeClass().addClass('text-blue').html(gulaDarah);
        }
      }else{
        $('#res-ga').html('');
      }
      tentukan(gulaDarah);

      var a = $('#res-gda').html();
      var b = $('#res-gdp').html();
      var c = $('#res-gdsm').html();

      if((b == 'Normal') || (b == 'Rendah') || (b == '')){
        if((c == 'Normal') ||  (c == 'Rendah') || (c == '')){
          if(a == 'Diabetus Mellitus'){
            r1 += 1;
          }
        }
      }

      if((b != 'Normal') || (b != 'Rendah') || (b == '')){
        if((c != 'Normal') ||  (c != 'Rendah') || (c == '')){
          if(a == 'Normal'){
            r3 += 1;
          }
        }
      }

      risiko_stroke();


    });

    $('#gdsm').on('blur', function(){
      var gdsm = $('#gdsm').val();
      if(gdsm != ''){
        if(gdsm < 110){
          gulaDarah = 'Rendah';
          $('#res-gdsm').removeClass().addClass('text-red').html(gulaDarah);
          // diagnosa_rekomendasi(gulaDarah, 'gd');
        }else if(gdsm <= 125){
          gulaDarah = 'Normal';
          $('#res-gdsm').removeClass().addClass('text-blue').html(gulaDarah);
        }else{
          gulaDarah = 'Diabetus Mellitus';
          $('#res-gdsm').removeClass().addClass('text-red').html(gulaDarah);
          diagnosa_rekomendasi(gulaDarah, 'gd');
        }
      }else{
        $('#res-gdsm').html('');

      }
      tentukan(gulaDarah);


      var a = $('#res-gda').html();
      var b = $('#res-gdp').html();
      var c = $('#res-gdsm').html();

      if((a == 'Normal') || (a == '')){
        if((b == 'Normal') || (b == 'Rendah') || (b == '')){
          if(c == 'Diabetus Mellitus'){
            r1 += 1;
          }
        }
      }

      if((a != 'Normal') || (a == '')){
        if((b != 'Normal') || (b != 'Rendah') || (b == '')){
          if(c == 'Normal'){
            r3 += 1;
          }
        }
      }

      risiko_stroke();


    });

    $('#gdp').on('blur', function(){
      var gdp = $('#gdp').val();
      if(gdp != ''){
        if(gdp < 70){
          gulaDarah = 'Rendah';
          $('#res-gdp').removeClass().addClass('text-red').html(gulaDarah);
          // diagnosa_rekomendasi(gulaDarah, 'gd');
        }else if(gdp <= 110){
          gulaDarah = 'Normal';
          $('#res-gdp').removeClass().addClass('text-blue').html(gulaDarah);
        }else{
          gulaDarah = 'Diabetus Mellitus';
          $('#res-gdp').removeClass().addClass('text-red').html(gulaDarah);
          diagnosa_rekomendasi(gulaDarah, 'gd');
        }
      }else{
        $('#res-gdp').html('');
      }

      tentukan(gulaDarah);


      var a = $('#res-gda').html();
      var b = $('#res-gdp').html();
      var c = $('#res-gdsm').html();

      if((a == 'Normal') || (a == '')){
        if((c == 'Normal') ||  (c == 'Rendah') ||  (c == '')){
          if((b == 'Diabetus Mellitus')){
            r1 += 1;
          }
        }
      }

      if((a != 'Normal') || (a == '')){
        if((c != 'Normal') ||  (c != 'Rendah') ||  (c == '')){
          if((b == 'Normal')){
            r3 += 1;
          }
        }
      }

      risiko_stroke();


    });

    function tentukan(gulaDarah){
      var a = $('#res-gda').html();
      var b = $('#res-gdp').html();
      var c = $('#res-gdsm').html();
      var d = 0;

      if(a == 'Normal'){
        if((b == 'Normal') || (b == 'Rendah')){
          if((c == 'Normal') ||  (c == 'Rendah')){
            $('.gd').remove();
          }
        }
      }
      // console.log(d)

    }

    $('#riwayat_keluarga_dm').on('ifChecked', function(){
      r2 += 1;
      risiko_stroke();
    });

    $('#riwayat_keluarga_stroke').on('ifChecked', function(){
      r1 += 1;
      risiko_stroke();
    });

    $('#riwayat_keluarga_dm').on('ifUnchecked', function(){
      r2 -= 1;
      risiko_stroke();
    });

    $('#riwayat_keluarga_stroke').on('ifUnchecked', function(){
      r1 -= 1;
      risiko_stroke();
    });

    $('#merokok').on('change', function(){
      var nilai = $('#merokok').val();
      if(nilai == 1){
        r3 += 1;
      }else if(nilai == 2){
        r2 += 1;
      }else if(nilai == 3){
        r1 += 1;
      }
      risiko_stroke();
    });

    $('#aktivitas_fisik').on('change', function(){
      var nilai = $('#aktivitas_fisik').val();
      if(nilai == 1){
        r1 += 1;
      }else if(nilai == 2){
        r2 += 1;
      }else if(nilai == 3){
        r3 += 1;
      }
      risiko_stroke();
    });

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

    
    // $('#diagnosa').on('click', function(){
      // if(td);
      // console.log('merokok = '+ $('#merokok').val());
      // console.log('Kolesterol = '+$('#kolesterol').val());
      // console.log('gula darah = '+gulaDarah);
      // console.log('aktivitas_fisik = '+ $('#aktivitas_fisik').val());
      // console.log('imt = '+imt);
      // console.log('riwayat = '+ $('#riwayat_keluarga').val());
    //   console.log(r1);
    //   console.log(r2);
    //   console.log(r3);
    // });


    function risiko_stroke(){
      console.log(r1);
      console.log(r2);
      console.log(r3);
      if(r1 >= 3){
        $('#res-str').removeClass().addClass('text-red').html(`<i class="fa fa-warning"> </i> <b>Resiko Tinggi Sroke</b>`);
      }else if(r2 >= 4){
        $('#res-str').removeClass().addClass('text-orange').html(`<i class="fa fa-warning"> </i> <b>Resiko Sedang Sroke</b>`);
      }else if(r3 >= 6){
        $('#res-str').removeClass().addClass('text-success').html(`<i class="fa fa-check"> </i> <b>Resiko Rendah Sroke</b>`);
      }
    }




    function diagnosa_rekomendasi(dx, kelas){
        $('.'+kelas).remove();
        $('#dx_rekomendasi').append(`<div class="dx_td `+kelas+`"> <input type="checkbox" class="flat-red" value="`+dx+`"> `+dx+`<br></div>`);
        $('.flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-blue',
          radioClass   : 'iradio_flat-blue'
        });
    }

  });
</script>