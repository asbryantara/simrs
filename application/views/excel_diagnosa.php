<?php 
  header ("Cache-Control: no-cache, must-revalidate");
  header ("Pragma: no-cache");
  header ("Content-type: application/x-msexcel");
  header ("Content-type: application/octet-stream");
  header ("Content-Disposition: attachment; filename=Laporan 10 Besar Diagnosa.xls");
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
      Laporan 10 Besar Diagnosis
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
        <th>Nama Dagnosis</th>
        <th>Jumlah</th>
      </tr>
    </thead>
    
    <tbody>
      <?php $no=1; foreach($lap as $l): ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= $l->nama_diagnosa ?></td>
          <td><?= $l->total ?></td>
        </tr>
      <?php 
        $label[] = $l->nama_diagnosa;
        $value[] = $l->total;
        endforeach 
      ?>
    </tbody>
  </table>
