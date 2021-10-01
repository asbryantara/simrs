<?php 
  header ("Cache-Control: no-cache, must-revalidate");
  header ("Pragma: no-cache");
  header ("Content-type: application/x-msexcel");
  header ("Content-type: application/octet-stream");
  header ("Content-Disposition: attachment; filename=Laporan keuangan.xls");
?>

<center>
<table>
  <tr>
    <td colspan="3" style="font-size: 16pt; text-align: center;"><?= $nama_klinik['isi_config'] ?></td>
  </tr>
  <tr>
    <td colspan="3" style="text-align: center;"><?= $alamat_klinik['isi_config'].', '.$telp_klinik['isi_config'] ?></td>
  </tr>
  <tr>
    <td colspan="3" style="text-align: center;"><?= $email_klinik['isi_config'] .', '.$website_klinik['isi_config'] ?></td>
  </tr>
  <tr>
    <td style="font-size: 14pt; text-align: center;" colspan="3">
      <br>
      Laporan Keuangan
      <br>
      <br>
    </td>
  </tr>
</table>
</center>

  <table class="table table-bordered table-hover" border="1">
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
