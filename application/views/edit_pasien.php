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
          
          <a href="<?= base_url('pasien') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"> </i> &nbsp; Kembali</a>
         
          <br>
          <br>
          
        </div>

        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Identitas Pasien</h3>
            </div>
            <?= form_open(base_url('pasien/update'), ['class'=>'form-horizontal']) ?>
              <div class="box-body">
                
                <div class="form-group">
                  <label class="col-sm-2 control-label">No. RM</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="no_rm" value="<?= $px['no_rm'] ?>" disabled="">
                    <input type="hidden" name="no_rm" value="<?= $px['no_rm'] ?>" >
                  </div>
               
                  <label class="col-sm-2 control-label">NIK</label>

                  <div class="col-sm-4">
                    <input type="text" name="nik_px" class="form-control" id="nik" value="<?= $px['nik_px'] ?>" placeholder="NIK">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama Pasien <small class="text-red">*</small></label>

                  <div class="col-sm-4">
                    <input type="text" name="nama_px" class="form-control" id="nama_px" value="<?= $px['nama_px'] ?>" required="">
                  </div>
               
                  <label class="col-sm-2 control-label">Jenis Kelamin <small class="text-red">*</small></label>

                  <div class="col-sm-4">
                    <input type="radio" name="jk_px" class="flat-red" value="1" <?php if($px['jk_px'] == 1) echo 'checked'; ?>> Laki-laki &nbsp; &nbsp; &nbsp; &nbsp;
                    <input type="radio" name="jk_px" class="flat-red" value="2" <?php if($px['jk_px'] == 2) echo 'checked'; ?>> Perempuan
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Tempat Lahir <small class="text-red">*</small></label>

                  <div class="col-sm-4">
                    <select name="tempat_lahir_px" class="form-control select2" id="tempat_lahir_px" style="width: 100%" required="">
                      <option value="">-- silahkan pilih --</option>
                      <?php foreach($koka as $kk): ?>

                        <?php 
                          $tl = str_replace('KABUPATEN ', '', str_replace('KOTA ', '', $kk->nama_kota_kab));
                        ?>

                        <option value="<?= $tl ?>" <?php if($px['tempat_lahir_px'] == $tl){echo 'selected';} ?>><?= $tl ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
               
                  <label class="col-sm-2 control-label">Tanggal Lahir <small class="text-red">*</small></label>

                  <div class="col-sm-4">
                    <input type="text" name="tgl_lahir_px" class="form-control" id="tgl_lahir_px" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask required="" value="<?php $t = explode('-', $px['tgl_lahir_px']); $tgl = $t[2].'/'.$t[1].'/'.$t[0]; echo $tgl; ?>">
                    <small id="umur" style="font-weight: 700;"></small>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Alamat <small class="text-red">*</small></label>

                  <div class="col-sm-4">
                    <textarea  name="alamat_px" class="form-control" required=""><?= $px['alamat_px'] ?></textarea>
                  </div>
               
                  <label class="col-sm-2 control-label">Provinsi</label>

                  <div class="col-sm-4">
                    <select name="id_provinsi" id="id_provinsi" class="form-control select2" style="width:100%;">
                      <option value="">-- pilih provinsi --</option>
                      <?php foreach($provinsi as $pro): ?>
                        <option value="<?= $pro->id_provinsi ?>" <?php if($px['id_provinsi'] == $pro->id_provinsi) echo 'selected'; ?> ><?= $pro->nama_provinsi ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Kota/Kabupaten</label>

                  <div class="col-sm-4">
                    <select name="id_kota_kab" id="id_kota_kab" class="form-control select2" style="width:100%;">
                      <option value="">-- pilih kota/kab --</option>
                      <?php foreach($kota_kab as $kk): ?>
                        <option value="<?= $kk->id_kota_kab ?>" <?php if($px['id_kota_kab'] == $kk->id_kota_kab) echo 'selected'; ?> ><?= $kk->nama_kota_kab ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
               
                  <label class="col-sm-2 control-label">Kecamatan</label>

                  <div class="col-sm-4">
                    <select name="id_kecamatan" id="id_kecamatan" class="form-control select2" style="width:100%;" >
                      <option value="">-- pilih kecamatan --</option>
                      <?php foreach($kecamatan as $kec): ?>
                        <option value="<?= $kec->id_kecamatan ?>" <?php if($px['id_kecamatan'] == $kec->id_kecamatan) echo 'selected'; ?> ><?= $kec->nama_kecamatan ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Desa/Kelurahan</label>

                  <div class="col-sm-4">
                    <select name="id_desa" id="id_desa" class="form-control select2" style="width:100%;" >
                      <option value="">-- pilih desa/kelurahan --</option>
                      <?php foreach($desa as $des): ?>
                        <option value="<?= $des->id_desa ?>" <?php if($px['id_desa'] == $des->id_desa) echo 'selected'; ?> ><?= $des->nama_desa ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
               
                  <label class="col-sm-2 control-label">Pendidikan Terakhir</label>

                  <div class="col-sm-4">
                    <select name="pendidikan_px" class="form-control select2" style="width:100%;">
                      <option value=""> -- pilih pendidikan --</option>
                      <option value="0" <?php if($px['pendidikan_px']==0) echo 'selected'; ?>>Tidak Sekolah</option>
                      <option value="1" <?php if($px['pendidikan_px']==1) echo 'selected'; ?>>SD</option>
                      <option value="2" <?php if($px['pendidikan_px']==2) echo 'selected'; ?>>SMP</option>
                      <option value="3" <?php if($px['pendidikan_px']==3) echo 'selected'; ?>>SMA</option>
                      <option value="4" <?php if($px['pendidikan_px']==4) echo 'selected'; ?>>D-III</option>
                      <option value="5" <?php if($px['pendidikan_px']==5) echo 'selected'; ?>>D-IV / S1</option>
                      <option value="6" <?php if($px['pendidikan_px']==6) echo 'selected'; ?>>S2</option>
                      <option value="7" <?php if($px['pendidikan_px']==7) echo 'selected'; ?>>S3</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Pembayaran</label>

                  <div class="col-sm-4">
                    <select name="asuransi_px" id="asuransi_px" class="form-control">
                      <option value="1" <?php if($px['asuransi_px']==1) echo 'selected'; ?>>Umum/Tunai</option>
                      <option value="2" <?php if($px['asuransi_px']==2) echo 'selected'; ?>>BPJS Kesehatan</option>
                      <option value="3" <?php if($px['asuransi_px']==3) echo 'selected'; ?>>Asuransi Lain</option>
                    </select>
                  </div>
               
                  <div id="no_asuransi" class="<?php if(($px['asuransi_px']==1)||($px['asuransi_px']==3)) echo 'hidden'; ?>">
                    <label class="col-sm-2 control-label">No. Kartu BPJS</label>

                    <div class="col-sm-4">
                      <input type="text" name="no_asuransi_px" class="form-control" autocomplete="off" value="<?= $px['no_asuransi_px'] ?>">
                    </div>
                  </div>

                  <div id="nama_asuransi_lain" class="<?php if(($px['asuransi_px']==1)||($px['asuransi_px']==2)) echo 'hidden'; ?>">
                    <label class="col-sm-2 control-label">Nama Asuransi</label>

                    <div class="col-sm-4">
                      <input type="text" name="asuransi_lain_px" class="form-control" value="<?= $px['asuransi_lain_px'] ?>">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Pekerjaan</label>

                  <div class="col-sm-4">
                    <select name="pekerjaan_px" class="form-control">
                      <option value="">-- pilih pekerjaan --</option>
                      <option value="0"<?php if($px['pekerjaan_px']==0) echo 'selected'; ?>>Tidak Bekerja</option>
                      <option value="1"<?php if($px['pekerjaan_px']==1) echo 'selected'; ?>>Tani</option>
                      <option value="2"<?php if($px['pekerjaan_px']==2) echo 'selected'; ?>>PNS</option>
                      <option value="3"<?php if($px['pekerjaan_px']==3) echo 'selected'; ?>>TNI / Polri</option>
                      <option value="4"<?php if($px['pekerjaan_px']==4) echo 'selected'; ?>>Karyawan</option>
                      <option value="5"<?php if($px['pekerjaan_px']==5) echo 'selected'; ?>>Buruh</option>
                      <option value="6"<?php if($px['pekerjaan_px']==6) echo 'selected'; ?>>Wirausaha</option>
                    </select>
                  </div>

                  <label class="col-sm-2 control-label">No. Telp</label>
                  <div class="col-sm-4">
                    <input type="text" name="telp_px" id="telp_px" class="form-control" autocomplete="off" value="<?= $px['telp_px'] ?>">
                  </div>
               
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Agama</label>

                  <div class="col-sm-4">
                    <select name="agama_px" class="form-control">
                      <option value="">-- pilih agama --</option>
                      <option value="ISLAM" <?php if($px['agama_px'] == 'ISLAM'){echo 'selected';} ?>>ISLAM</option>
                      <option value="HINDU" <?php if($px['agama_px'] == 'HINDU'){echo 'selected';} ?>>HINDU</option>
                      <option value="KRISTEN" <?php if($px['agama_px'] == 'KRISTEN'){echo 'selected';} ?>>KRISTEN</option>
                      <option value="BUDHA" <?php if($px['agama_px'] == 'BUDHA'){echo 'selected';} ?>>BUDHA</option>
                      <option value="KATHOLIK" <?php if($px['agama_px'] == 'KATHOLIK'){echo 'selected';} ?>>KATHOLIK</option>
                      <option value="KHONGHUCU" <?php if($px['agama_px'] == 'KHONGHUCU'){echo 'selected';} ?>>KHONGHUCU</option>
                    </select>
                  </div>

                  <label class="col-sm-2 control-label">Alergi</label>
                  <div class="col-sm-4">
                    <input type="text" name="alergi_px" id="alergi_px" value="<?= $px['alergi_px'] ?>" class="form-control" autocomplete="off">
                  </div>
               
                </div>

             </div>
             <div class="box-footer">
               <center>
                 <button type="submit" class="btn btn-primary btn-sm">Update</button>
                 <button type="reset" class="btn btn-default btn-sm">Reset</button>
               </center>
             </div>
           <?= form_close() ?>

          </div>
        </div>

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

    // ACTIVE LEFTBAR
    $('#pasien').addClass('active');

    // SELECT2
    $('.select2').select2();

    // ICHECK
    $('.flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass   : 'iradio_flat-blue'
    });

    // INPUT MASK
    $('#tgl_lahir_px').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });


    $('#alergi_px').autocomplete({
      source: "<?php echo site_url('pasien/alergi');?>",

      select: function (event, ui) {
          $('#alergi_px').val(ui.item.nama_konten); 
        }
    });


    // UMUR
    umur();

    $('#tgl_lahir_px').on('change', function(){
      umur();
    });

    function umur(){
      var today = new Date();
      var tt = $('#tgl_lahir_px').val();
      var birthday = new Date(tt);
      var year = 0;
      if (today.getMonth() < birthday.getMonth()) {
        year = 1;
      } else if ((today.getMonth() == birthday.getMonth()) && today.getDate() < birthday.getDate()) {
        year = 1;
      }
      var age = today.getFullYear() - birthday.getFullYear() - year;
   
      if(age < 0){
        age = 0;
      }
      $('#umur').html(age+' Tahun');
    }
    
    // MENAMPILKAN KOTA KETIKA MEMILIH PROVINSI
    $('#id_provinsi').on('change', function(){
      var id_provinsi = $('#id_provinsi').val();
      if(id_provinsi != ''){
        $('#id_kota_kab').removeAttr('disabled');
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
      }else{
        $('#id_kota_kab, #id_kecamatan, #id_desa').attr('disabled','');
        $('#id_kota_kab, #id_kecamatan, #id_desa').val('').trigger('change');
      }
    });


    // MENAMPILKAN KECAMATAN KETIKA MEMILIH KOTA
    $('#id_kota_kab').on('change', function(){
      var id_kota_kab = $('#id_kota_kab').val();
      if(id_kota_kab != ''){
        $('#id_kecamatan').removeAttr('disabled');
        $.ajax({
          type: 'POST',
          url: '<?= base_url('master/kec_kota') ?>',
          dataType: 'JSON',
          data:{
            id_kota_kab:id_kota_kab,
          },
          success: function(data){
            var html = '';
            html += `<option value="">--pilih kecamatan--</option>`;
            for(i=0; i<data.length; i++){
              html += `<option value=`+data[i].id_kecamatan+`>`+data[i].nama_kecamatan+`</option>`;
            }
            $('#id_kecamatan').html(html);
          }
        });
      }else{
        $('#id_kecamatan, #id_desa').attr('disabled','');
        $('#id_kecamatan, #id_desa').val('').trigger('change');
        
      }
    });

    // MENAMPILKAN DESA KETIKA MEMILIH KECAMATAN
    $('#id_kecamatan').on('change', function(){
      var id_kecamatan = $('#id_kecamatan').val();
      if(id_kecamatan != ''){
        $('#id_desa').removeAttr('disabled');
        $.ajax({
          type: 'POST',
          url: '<?= base_url('master/des_kec') ?>',
          dataType: 'JSON',
          data:{
            id_kecamatan:id_kecamatan,
          },
          success: function(data){
            var html = '';
            html += `<option value="">--pilih desa--</option>`;
            for(i=0; i<data.length; i++){
              html += `<option value=`+data[i].id_desa+`>`+data[i].nama_desa+`</option>`;
            }
            $('#id_desa').html(html);
          }
        });
      }else{
        $('#id_desa').attr('disabled','');
        $('#id_desa').val('').trigger('change');
      }
    });


    // MENAMPILKAN KOLOM NO BPJS KETIKA MEMILIH BPJS
    $('#asuransi_px').on('change', function(){
      var asu = $('#asuransi_px').val();
      if(asu == 1){
        $('#no_asuransi').addClass('hidden');
        $('#nama_asuransi_lain').addClass('hidden');
      }else if(asu == 2){
        $('#no_asuransi').removeClass('hidden');
        $('#nama_asuransi_lain').addClass('hidden');
      }else if(asu == 3){
        $('#nama_asuransi_lain').removeClass('hidden');
        $('#no_asuransi').addClass('hidden');
      }
    });

  });
</script>