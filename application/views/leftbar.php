<?php $row = $this->db->get_where('user',array('username'=>$this->session->userdata('username')))->row_array();  ?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= base_url('uploads/'.$row['foto']) ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $row['nama_user'] ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <?php
          $user = $this->db->get_where('user',array('id_user'=>$this->session->userdata('id_user')))->row_array();
          $akses = explode(', ',$user['hak_akses']);
        ?>
        <li class="header">MAIN NAVIGATION</li>
        <li id="home">
          <a href="<?= base_url('home') ?>">
            <i class="fa fa-home"></i> <span>Home</span>
          </a>
        </li>
        
        <?php if((in_array('Pendaftaran',$akses))or($user['level']=='1')): ?>

        <li id="antrian">
          <a href="<?= base_url('antrian') ?>">
            <i class="fa fa-bell"></i> <span>Antrian</span>
          </a>
        </li>

        <li id="pendaftaran">
          <a href="<?= base_url('pendaftaran') ?>">
            <i class="fa fa-pencil"></i> <span>Pendaftaran</span>
          </a>
        </li>

         <li id="pasien">
          <a href="<?= base_url('pasien') ?>">
            <i class="fa fa-users"></i> <span>Pasien</span>
          </a>
        </li>

        <?php endif ?>
        <?php if((in_array('Klinik',$akses))or($user['level']=='1')): ?>

        <li id="klinik">
          <a href="<?= base_url('klinik') ?>">
            <?php $kl = $this->db->get_where('kunjungan', ['status_kunjungan'=>0])->num_rows(); ?>
            <i class="fa fa-stethoscope"></i> <span>Klinik 
              <?php if($kl > 0): ?>
                <small class="label pull-right bg-red"> <?= $kl ?> </small>
              <?php endif ?>
            </span>
          </a>
        </li>

        <?php endif ?>
        <?php if((in_array('Apotek',$akses))or($user['level']=='1')): ?>

        <li id="apotek">
          <a href="<?= base_url('apotek') ?>">
            <?php $ap = $this->db->get_where('kunjungan', ['status_kunjungan'=>2])->num_rows(); ?>
            <i class="fa fa-medkit"></i> <span>Apotek 
              <?php if($ap > 0): ?>
              <small class="label pull-right bg-red"> <?= $ap ?> </small>
              <?php endif ?>
            </span>
          </a>
        </li>

        <?php endif ?>
        <?php if((in_array('Kasir',$akses))or($user['level']=='1')): ?>

         <li id="kasir">
          <a href="<?= base_url('kasir') ?>">
            <?php $ks = $this->db->get_where('kunjungan', ['status_kunjungan'=>3])->num_rows(); ?>
            <i class="fa fa-money"></i> <span>Kasir
              <?php if($ks > 0): ?>
              <small class="label pull-right bg-red"> <?= $ks ?> </small> 
              <?php endif ?>
            </span>
          </a>
        </li>

        <?php endif ?>
        <?php if((in_array('Lab',$akses))or($user['level']=='1')): ?>

        <li id="left_lab">
          <a href="<?= base_url('penunjang/lab') ?>">
            <i class="fa fa-flask"></i> <span>Laboratorium
            </span>
          </a>
        </li>

        <?php endif ?>
        <?php if((in_array('Radiologi',$akses))or($user['level']=='1')): ?>

        <li id="left_rad">
          <a href="<?= base_url('penunjang/rad') ?>">
            <i class="fa fa-magic"></i> <span>Radiologi
            </span>
          </a>
        </li>

        <?php endif ?>

        <?php
          if((in_array('Apotek',$akses))or($user['level']=='1')or(in_array('Pendaftaran',$akses))){
        ?>

        <li class="treeview" id="master">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if((in_array('User',$akses))or($user['level']=='1')){ ?>
            <li id="user"><a href="<?= base_url('User/all') ?>">
              <i class="fa fa-circle-o"></i> User
              </a>
            </li>

            <?php } if((in_array('Pendaftaran',$akses))or($user['level']=='1')){ ?>
            <li id="provinsi"><a href="<?= base_url('master/provinsi') ?>">
              <i class="fa fa-circle-o"></i> Provinsi
              </a>
            </li>
          
            <li id="kota_kab"><a href="<?= base_url('master/kota_kab') ?>">
              <i class="fa fa-circle-o"></i> Kota / Kabupaten
              </a>
            </li>

            <li id="kecamatan"><a href="<?= base_url('master/kecamatan') ?>">
              <i class="fa fa-circle-o"></i> Kecamatan
              </a>
            </li>
            
            <li id="desa"><a href="<?= base_url('master/desa') ?>">
              <i class="fa fa-circle-o"></i> Desa
              </a>
            </li>

            <?php } ?>
            
            <?php if($user['level']=='1'){ ?>
            <li id="tindakan"><a href="<?= base_url('master/tindakan') ?>">
              <i class="fa fa-circle-o"></i> Tindakan
              </a>
            </li>

            <li id="diagnosa"><a href="<?= base_url('master/diagnosa') ?>">
              <i class="fa fa-circle-o"></i> Diagnosis
              </a>
            </li>
            <?php } ?>
            
            <?php if((in_array('Apotek',$akses))or($user['level']=='1')){ ?>
            <li id="suplier"><a href="<?= base_url('master/suplier') ?>">
              <i class="fa fa-circle-o"></i> Suplier
              </a>
            </li>
            

            <li id="obat"><a href="<?= base_url('master/obat') ?>">
              <i class="fa fa-circle-o"></i> Obat
              </a>
            </li>

             <li id="left_konten"><a href="<?= base_url('master/konten') ?>">
              <i class="fa fa-circle-o"></i> Konten Obat
              </a>
            </li>
            <?php } ?>


          </ul>
        </li>


        <li class="treeview" id="laporan">
          <a href="#">
            <i class="fa fa-bar-chart"></i> <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="lap_kunjungan"><a href="<?= base_url('laporan/kunjungan') ?>">
              <i class="fa fa-circle-o"></i> Kunjungan
              </a>
            </li>
            <li id="lap_diagnosa"><a href="<?= base_url('laporan/diagnosa') ?>">
              <i class="fa fa-circle-o"></i> 10 Besar Diagnosis
              </a>
            </li>
            <li id="lap_obat"><a href="<?= base_url('laporan/obat') ?>">
              <i class="fa fa-circle-o"></i> Obat
              </a>
            </li>
            <li id="lap_lab"><a href="<?= base_url('laporan/lab') ?>">
              <i class="fa fa-circle-o"></i> Laboratorium
              </a>
            </li>
            <li id="lap_radiologi"><a href="<?= base_url('laporan/radiologi') ?>">
              <i class="fa fa-circle-o"></i> Radiologi
              </a>
            </li>
            <li id="lap_dokter"><a href="<?= base_url('laporan/dokter') ?>">
              <i class="fa fa-circle-o"></i> Kinerja Dokter
              </a>
            </li>

            <li id="lap_perawat"><a href="<?= base_url('laporan/perawat') ?>">
              <i class="fa fa-circle-o"></i> Kinerja Perawat
              </a>
            </li>

            <li id="lap_keuangan"><a href="<?= base_url('laporan/keuangan') ?>">
              <i class="fa fa-circle-o"></i> Keuangan
              </a>
            </li>


          </ul>
        </li>


        <?php if($user['level']=='1'): ?>

        <li id="konfigurasi">
          <a href="<?= base_url('home/konfigurasi') ?>">
            <i class="fa fa-gear"></i> <span>Konfigurasi
            </span>
          </a>
        </li>

        <?php endif ?>


        <?php 
          } 
         ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>