<?php 
  header ("Cache-Control: no-cache, must-revalidate");
  header ("Pragma: no-cache");
  header ("Content-type: application/x-msexcel");
  header ("Content-type: application/octet-stream");
  header ("Content-Disposition: attachment; filename=Laporan lab.xls");
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
      Laporan lab
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
                    <th>Jenis Pemeriksaan Lab</th>
                    <th>Jumlah</th>
                  </tr>
                </thead>
                
                <?php $no=1; ?>
                <tbody>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td>Kolesterol</td>
                    <td><?= $kol ?></td>
                  </tr>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td>Gula Darah Acak</td>
                    <td><?= $gda ?></td>
                  </tr>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td>Gula darah Puasa</td>
                    <td><?= $gdp ?></td>
                  </tr>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td>Gula Darah 2 Jam PP</td>
                    <td><?= $gdp ?></td>
                  </tr>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td>Hemoglobin</td>
                    <td><?= $hb ?></td>
                  </tr>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td>Trombosit</td>
                    <td><?= $trombosit ?></td>
                  </tr>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td>SGOT</td>
                    <td><?= $sgot ?></td>
                  </tr>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td>SGPT</td>
                    <td><?= $sgpt ?></td>
                  </tr>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td>Asam Urat</td>
                    <td><?= $asamurat ?></td>
                  </tr>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td>Widal</td>
                    <td><?= $widal ?></td>
                  </tr>
                  
                </tbody>
              </table>
