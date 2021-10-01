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
          
          <a href="<?= base_url('klinik/sudah_periksa') ?>" class="btn btn-info"><i class="fa fa-arrow-left"> </i> Kembali</a>
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
                <h3 class="box-title">Resep </h3>
                <h3 class="box-title pull-right"><?php if($cito > 0){echo '<span class="text-red "><i class="fa fa-warning"> </i> Cito</span>';} ?> </h3>
              </div>

              <div class="box-body" id="tableResep">
                <div class="col-md-12">
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr style="background-color: #A8CDFF;">
                        <th>Nama Obat</th>
                        <th>Jumlah</th>
                        <th>Aturan Pakai</th>
                      </tr>
                    </thead>
                    <tbody id="rowResep">
                      
                    </tbody>
                  </table>
                </div>

              </div>
            </div>

            
          </div>

          

          <center>
              <a href="<?= base_url('apotek/cetak_resep/'.$this->uri->segment(3)) ?>" class="btn btn-primary btn-sm" target="_blank"><i class="fa fa-print"> </i> Cetak Resep</a>
              <a href="<?= base_url('apotek/selesai/'.$this->uri->segment(3)) ?>" class="btn btn-danger btn-sm"><i class="fa fa-check"> </i> Selesai</a>

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



    $('#apotek').addClass('active');
    

    $('.flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass   : 'iradio_flat-blue'
    });
    
    showResep();

    function showResep(){
      var id_kunjungan = $('#id_kunjungan').val();
      var html = '';
      $.ajax({
        url : '<?= base_url('klinik/show_resep') ?>',
        dataType: 'JSON',
        method : 'POST',
        data : {id_kunjungan:id_kunjungan},
        success:function(data){
          if(data.length > 0){
            $('#rx').removeClass('hidden');
            $('#addresep').addClass('hidden');
            $('#deleteresep').removeClass('hidden');
            for(a=0; a<data.length; a++){
              html += `

                <tr style="background-color: #D6D6D6;">
                  <td>`+data[a].nama_obat+`</td>
                  <td>`+data[a].jumlah+`</td>
                  <td>`+data[a].aturan_pakai+`</td>
                </tr>

              `;

            }
            $('#tableResep').show();
          }else{
            $('#tableResep').hide();
          }

          $('#rowResep').html(html);
        }
      });
    }


  });
</script>