<?php 
  header ("Cache-Control: no-cache, must-revalidate");
  header ("Pragma: no-cache");
  header ("Content-type: application/x-msexcel");
  header ("Content-type: application/octet-stream");
  header ("Content-Disposition: attachment; filename=Laporan Radiologi.xls");
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
      Laporan Pemeriksaan Radiologi
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
        <th>Jenis Pemeriksaan Radiologi</th>
        <th>Jumlah</th>
      </tr>
    </thead>
    
    <?php $no=1; ?>
    <tbody>
      <tr>
        <td><?= $no++ ?></td>
        <td>X-Ray Umum</td>
        <td><?= $xray ?></td>
      </tr>
      <tr>
        <td><?= $no++ ?></td>
        <td>USG</td>
        <td><?= $usg ?></td>
      </tr>
      <tr>
        <td><?= $no++ ?></td>
        <td>CT-Scan</td>
        <td><?= $ctscan ?></td>
      </tr>
      <tr>
        <td><?= $no++ ?></td>
        <td>MRI</td>
        <td><?= $mri ?></td>
      </tr>
      <tr>
        <td><?= $no++ ?></td>
        <td>Mamografi</td>
        <td><?= $mamografi ?></td>
      </tr>
      <tr>
        <td><?= $no++ ?></td>
        <td>Angiografi</td>
        <td><?= $angiografi ?></td>
      </tr>
    </tbody>
  </table>