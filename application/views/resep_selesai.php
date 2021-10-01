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
          
          <a href="<?= base_url('apotek') ?>" class="btn btn-primary"><i class="fa fa-eye"> </i> Resep Baru</a>
          <!-- <a href="<?= base_url('pendaftaran') ?>" class="btn btn-primary"><i class="fa fa-plus"> </i> Data Pendaftaran Baru</a> -->
         
          <br>
          <br>
          
        </div>

        <div class="col-md-12">
          <div class="box box-primary">
           <!-- <div class="box-header">
            
          </div> -->
          <div class="box-body">
            <table class="table table-hover table-striped table-bordered" id="example1">
              <thead>
                <tr>
                  <th>No RM</th>
                  <th>Nama</th>
                  <th>JK</th>
                  <th>Tgl Daftar</th>
                  <th>Cito</th>
                  <th>Pembayaran</th>
                  <th>Status</th>
                  <th width="50">#</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($pendaftaran as $p):

                  $cek = $this->db->get_where('resep', ['id_kunjungan'=>$p->id_kunjungan, 'cito'=>1])->num_rows();
                  if($cek > 0){
                    $cito = 1;
                  }else{
                    $cito = 0;
                  }
                ?>
                  <tr <?php if($cito == 1)echo 'style="background-color: #FFD5D5"' ?>>
                    <td><?= $p->no_rm ?></td>
                    <td><?= $p->nama_px ?></td>
                    <td><?php if($p->jk_px ==  1){echo 'L';}else{echo 'P';} ?></td>
                    <td><?= $p->tgl_kunjungan.' '.$p->waktu_kunjungan ?></td>
                    <td>
                      <?php 
                        if($cito == 1){
                          echo 'Ya';
                        }else{
                          echo 'Tidak';
                        }
                      ?>
                    </td>
                    <td><?php if($p->asuransi_px ==  1){echo 'Umum';}elseif($p->asuransi_px ==  2){echo 'BPJS';}else{echo $p->asuransi_lain_px;} ?></td>
                    <td>
                      <?php 
                        if($p->status_kunjungan ==  0){
                          echo 'Menunggu';
                        }elseif($p->status_kunjungan ==  1){
                          echo 'Diperiksa';
                        }elseif($p->status_kunjungan ==  2){
                          echo 'Menunggu Obat';
                        }elseif($p->status_kunjungan ==  3){
                          echo 'Menunggu Pembayaran';
                        }elseif($p->status_kunjungan ==  4){
                          echo 'Selesai';
                        }
                      ?>
                    </td>
                    <td>
                      
                      <a href="<?= base_url('apotek/resep/'.$p->id_kunjungan) ?>" class="btn btn-primary btn-xs"><i class="fa fa-eye"> </i> Lihat</a>
                      <!-- <a href="<?= base_url('apotek/detail/'.$p->id_kunjungan) ?>" class="btn btn-info btn-xs"><i class="fa fa-eye"></i></a>
                      <a href="<?= base_url('apotek/edit/'.$p->id_kunjungan) ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
                      <a href="<?= base_url('apotek/delete/'.$p->id_kunjungan) ?>" class="btn btn-danger btn-xs" onclick="return konfirmasi()"><i class="fa fa-trash"></i></a> -->
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
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


<?php $this->load->view('footer') ?>

<script>

  function konfirmasi(){
    return confirm('Apakah anda yakin ?');
  }

  $(document).ready(function () {

    $('#apotek').addClass('active');
   
    

  });
</script>