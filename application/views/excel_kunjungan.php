<?php 
  header ("Cache-Control: no-cache, must-revalidate");
  header ("Pragma: no-cache");
  header ("Content-type: application/x-msexcel");
  header ("Content-type: application/octet-stream");
  header ("Content-Disposition: attachment; filename=Laporan Kunjungan.xls");
?>

<center>
  <h3><?= $nama_klinik['isi_config'] ?></h3>
  <p><?= $alamat_klinik['isi_config'].', '.$telp_klinik['isi_config'] ?></p>
  <p><?= $email_klinik['isi_config'] .', '.$website_klinik['isi_config'] ?></p>
  <hr>
  <h4>Laporan Kunjungan</h4>
</center>

<table class="table table-bordered table-hover" border="1">
  <thead id="hasil_judul">
    <tr>
      <th>No</th>
      <th>Bulan</th>
      <th>Jumlah Kunjungan</th>
    </tr>
  </thead>

  <tbody>
    
    <?php $no=1; $total = 0; $label = ''; for ($i=$bulan1; $i <= $bulan2; $i++): ?>
      <tr>
        <td><?= $no++ ?></td>
        <td>
          <?php  
            if($i == '01'){
              echo $label = 'Januari';
            }elseif($i == '02'){
              echo $label = 'Februari';
            }elseif($i == '03'){
              echo $label = 'Maret';
            }elseif($i == '04'){
              echo $label = 'April';
            }elseif($i == '05'){
              echo $label = 'Mei';
            }elseif($i == '06'){
              echo $label = 'Juni';
            }elseif($i == '07'){
              echo $label = 'Juli';
            }elseif($i == '08'){
              echo $label = 'Agustus';
            }elseif($i == '09'){
              echo $label = 'September';
            }elseif($i == '10'){
              echo $label = 'Oktober';
            }elseif($i == '11'){
              echo $label = 'November';
            }elseif($i == '12'){
              echo $label = 'Desember';
            }
          ?>
        </td>
        <td>
          <?php 
            $bulan = $tahun.'-'.sprintf('%02s', $i);
            $this->db->like('tgl_kunjungan', $bulan, 'both');
            $jumlah = $this->db->get('kunjungan')->num_rows(); 
            echo $value = $jumlah;

            $lab[] = $label;
            $val[] = $value;
            $total += $value;
          ?>
        </td>
      </tr>

    <?php endfor ?>
    <tr>
      <td colspan="2"><b>Total</b></td>
      <td><?= $total ?></td>
    </tr>

  </tbody>
</table>