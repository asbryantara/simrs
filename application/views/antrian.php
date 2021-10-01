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
          
          <a href="<?= base_url('antrian/front_print') ?>" class="btn btn-info">Tampilan Cetak Antrian</a>
          <a href="<?= base_url('antrian/front_view') ?>" class="btn btn-primary">Tampilan Panggilan Antrian</a>
         
          <br>
          <br>
          
        </div>

        <div class="col-md-6">
          <div class="box box-primary">
           <div class="box-header">
            <label class="pull-left">Pilih Loket</label> 
            <div class="col-md-3">
              <select class="form-control" id="loket">
                <option>1</option>
                <option>2</option>
              </select>
            </div>
            <button id="panggil" class="btn btn-primary pull-right"><i class="fa fa-bell"></i> Panggil</button>
           </div>
           <div class="box-body">
             <center>
               <h1 id="nomor" style="font-size: 130px; margin-bottom: 80px;"></h1>
             </center>
           </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Kunjungan Hari ini</span>
              <span class="info-box-number" id="jumlah"></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

         <div class="col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-orange"><i class="fa fa-clock-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Sisa Antrian</span>
              <span class="info-box-number" id="menunggu"></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

         <div class="col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-star-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Terlayani</span>
              <span class="info-box-number" id="terlayani"></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      

        </div>
        <!-- /.col (RIGHT) -->
        <!-- /.col (RIGHT) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <audio id="in" src="<?= base_url('assets/') ?>audio/in.wav"></audio>
  <audio id="out" src="<?= base_url('assets/') ?>audio/out.wav"></audio>
  <audio id="suarabel" src="<?= base_url('assets/') ?>audio/Airport_Bell.mp3"></audio>
  <audio id="suarabelnomorurut" src="<?= base_url('assets/') ?>audio/nomor-urut.MP3"></audio> 
  <audio id="suarabelsuarabelloket" src="<?= base_url('assets/') ?>audio/konter.MP3"></audio> 
  <audio id="belas" src="<?= base_url('assets/') ?>audio/belas.MP3"></audio> 
  <audio id="sebelas" src="<?= base_url('assets/') ?>audio/sebelas.MP3"></audio> 
  <audio id="puluh" src="<?= base_url('assets/') ?>audio/puluh.MP3"></audio> 
  <audio id="sepuluh" src="<?= base_url('assets/') ?>audio/sepuluh.MP3"></audio> 
  <audio id="ratus" src="<?= base_url('assets/') ?>audio/ratus.MP3"></audio> 
  <audio id="seratus" src="<?= base_url('assets/') ?>audio/seratus.MP3"></audio> 
  <audio id="suarabelloket1" src="<?= base_url('assets/') ?>audio/1.MP3"></audio> 
  <audio id="suarabelloket2" src="<?= base_url('assets/') ?>audio/2.MP3"></audio> 
  <audio id="suarabelloket3" src="<?= base_url('assets/') ?>audio/3.MP3"></audio> 
  <audio id="suarabelloket4" src="<?= base_url('assets/') ?>audio/4.MP3"></audio> 
  <audio id="suarabelloket5" src="<?= base_url('assets/') ?>audio/5.MP3"></audio> 
  <audio id="suarabelloket6" src="<?= base_url('assets/') ?>audio/6.MP3"></audio> 
  <audio id="suarabelloket7" src="<?= base_url('assets/') ?>audio/7.MP3"></audio> 
  <audio id="suarabelloket8" src="<?= base_url('assets/') ?>audio/8.MP3"></audio> 
  <audio id="suarabelloket9" src="<?= base_url('assets/') ?>audio/9.MP3"></audio> 
  <audio id="suarabelloket10" src="<?= base_url('assets/') ?>audio/sepuluh.MP3"></audio> 
  <audio id="belloket" src="<?= base_url('assets/') ?>audio/loket.MP3"></audio> 

<?php $this->load->view('footer') ?>

<script>
  $(document).ready(function () {

    update();

    setInterval(function(){
      update();
    }, 2000);

    $('#antrian').addClass('active');
    
    function update(){
      $.ajax({
        url: '<?= base_url('antrian/update') ?>',
        dataType: 'JSON',
        success: function(data){
          var panggilan = data.panggilan.no_antrian;
          var jumlah = data.jumlah;
          var menunggu = data.menunggu;
          var terlayani = data.terlayani;
          $('#jumlah').html(jumlah);
          $('#menunggu').html(menunggu);
          $('#terlayani').html(terlayani);

          if(data.panggilan == '<h3>Antrian Habis<h3>'){
            $('#panggil').addClass('hidden');
            $('#nomor').html(data.panggilan);
          }else{
            $('#panggil').removeClass('hidden');
            $('#nomor').html(panggilan);
          }
        }

      });
    }

    $('#panggil').on('click', function(){
      $('#panggil').hide();
      var no = $('#nomor').html();
      var loket = $('#loket').val();
      $.ajax({
        url: '<?= base_url('antrian/panggil') ?>',
        type: 'POST',
        data: {loket:loket},
        dataType: 'JSON',
        success: function(data){
          // ke fungsi panggil nomor
          
          panggilan(no, loket);
          

          update();
        }
      });
    });

    function panggilan(no, loket){
          // $('#panggil').addClass('hidden');

      var waktu = 1500;
        setTimeout(function() {
          document.getElementById('in').pause();
          document.getElementById('in').play();
        }, 0);

        waktu = waktu+2500;
        setTimeout(function(){
          document.getElementById('suarabelnomorurut').pause();
          document.getElementById('suarabelnomorurut').play();
        }, waktu);

        // PEMBAGIAN NOMOR URUT SATUAN BELASAN PULUHAN RATUSAN
        if(no <= 10){
          waktu = waktu+1000;
          setTimeout(function(){
            document.getElementById('suarabelloket'+no).pause();
            document.getElementById('suarabelloket'+no).play();
          }, waktu);
        }else if(no == 11){
          waktu = waktu+1000;
          setTimeout(function(){
            document.getElementById('sebelas').pause();
            document.getElementById('sebelas').play();
          }, waktu);
        }else if(no < 20){
          var satuan = String(no).substr(1,1);

          waktu = waktu+1000;
          setTimeout(function(){
            document.getElementById('suarabelloket'+satuan).pause();
            document.getElementById('suarabelloket'+satuan).play();
          }, waktu);
          waktu = waktu+1000;
          setTimeout(function(){
            document.getElementById('belas').pause();
            document.getElementById('belas').play();
          }, waktu);
        }else if(no < 100){
          var satuan = String(no).substr(1,1);
          var puluhan = String(no).substr(0,1);

          // JIKA 20,30,40,50 DST
          if(satuan == 0){
            waktu = waktu+1000;
            setTimeout(function(){
              document.getElementById('suarabelloket'+puluhan).pause();
              document.getElementById('suarabelloket'+puluhan).play();
            }, waktu);
            waktu = waktu+1000;
            setTimeout(function(){
              document.getElementById('puluh').pause();
              document.getElementById('puluh').play();
            }, waktu);
          }else{

            // JIKA ADA SATUANNYA
            waktu = waktu+1000;
            setTimeout(function(){
              document.getElementById('suarabelloket'+puluhan).pause();
              document.getElementById('suarabelloket'+puluhan).play();
            }, waktu);
            waktu = waktu+1000;
            setTimeout(function(){
              document.getElementById('puluh').pause();
              document.getElementById('puluh').play();
            }, waktu);
            waktu = waktu+1000;
            setTimeout(function(){
              document.getElementById('suarabelloket'+satuan).pause();
              document.getElementById('suarabelloket'+satuan).play();
            }, waktu);
          }

        }else if(no == 100){
          waktu = waktu+1000;
          setTimeout(function(){
            document.getElementById('seratus').pause();
            document.getElementById('seratus').play();
          }, waktu);
        }else if(no < 200){
          
          var nomer = String(no).substr(1,2);
          var no_puluhan = parseInt(nomer);

          waktu = waktu+1000;
          setTimeout(function(){
            document.getElementById('seratus').pause();
            document.getElementById('seratus').play();
          }, waktu);


          if(no_puluhan <= 10){
            waktu = waktu+1000;
            setTimeout(function(){
              document.getElementById('suarabelloket'+no_puluhan).pause();
              document.getElementById('suarabelloket'+no_puluhan).play();
            }, waktu);
          }else if(no_puluhan == 11){
            waktu = waktu+1000;
            setTimeout(function(){
              document.getElementById('sebelas').pause();
              document.getElementById('sebelas').play();
            }, waktu);
          }else if(no_puluhan < 20){
            var satuan = String(no_puluhan).substr(1,1);

            waktu = waktu+1000;
            setTimeout(function(){
              document.getElementById('suarabelloket'+satuan).pause();
              document.getElementById('suarabelloket'+satuan).play();
            }, waktu);
            waktu = waktu+1000;
            setTimeout(function(){
              document.getElementById('belas').pause();
              document.getElementById('belas').play();
            }, waktu);
          }else if(no_puluhan < 100){
            var satuan = String(no_puluhan).substr(1,1);
            var puluhan = String(no_puluhan).substr(0,1);

            // JIKA 20,30,40,50 DST
            if(satuan == 0){
              waktu = waktu+1000;
              setTimeout(function(){
                document.getElementById('suarabelloket'+puluhan).pause();
                document.getElementById('suarabelloket'+puluhan).play();
              }, waktu);
              waktu = waktu+1000;
              setTimeout(function(){
                document.getElementById('puluh').pause();
                document.getElementById('puluh').play();
              }, waktu);
            }else{

              // JIKA ADA SATUANNYA
              waktu = waktu+1000;
              setTimeout(function(){
                document.getElementById('suarabelloket'+puluhan).pause();
                document.getElementById('suarabelloket'+puluhan).play();
              }, waktu);
              waktu = waktu+1000;
              setTimeout(function(){
                document.getElementById('puluh').pause();
                document.getElementById('puluh').play();
              }, waktu);
              waktu = waktu+1000;
              setTimeout(function(){
                document.getElementById('suarabelloket'+satuan).pause();
                document.getElementById('suarabelloket'+satuan).play();
              }, waktu);
            }

          }
        }
        // AKHIR PEMBAGIAN no_puluhanMOR URUT SATUAN BELASAN PULUHAN RATUSAN

        waktu = waktu+1000;
        setTimeout(function(){
          document.getElementById('belloket').pause();
          document.getElementById('belloket').play();
        }, waktu);

        waktu = waktu+1000;
        setTimeout(function(){
          document.getElementById('suarabelloket'+loket).pause();
          document.getElementById('suarabelloket'+loket).play();
        }, waktu);

        waktu = waktu+1000;
        setTimeout(function(){
          document.getElementById('out').pause();
          document.getElementById('out').play();
        }, waktu);

        setTimeout(function(){
          $('#panggil').show();
        }, waktu);

    }

  });
</script>