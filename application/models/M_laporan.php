<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_laporan extends CI_Model
{
    function laporan_diagnosa($awal, $akhir){
        $this->db->select('master_diagnosa.nama_diagnosa ,count(diagnosa.kode_diagnosa) as total');
        $this->db->group_by('diagnosa.kode_diagnosa');
        $this->db->order_by('total', 'DESC');
        $this->db->limit('10');
        $this->db->join('master_diagnosa', 'master_diagnosa.kode_diagnosa=diagnosa.kode_diagnosa');
        $this->db->where('tanggal_diagnosa >=', $awal);
        $this->db->where('tanggal_diagnosa <=', $akhir);
        return $this->db->get('diagnosa');
    }

    function laporan_obat($awal, $akhir){
        $this->db->select('obat.nama_obat ,count(obat.id_obat) as total');
        $this->db->group_by('resep.id_obat');
        $this->db->order_by('total', 'DESC');
        $this->db->join('obat', 'obat.id_obat=resep.id_obat');
        $this->db->where('tgl_resep >=', $awal);
        $this->db->where('tgl_resep <=', $akhir);
        return $this->db->get('resep');
    }

    function laporan_lab_kol($awal, $akhir){
        $this->db->select('*');
        $this->db->join('kunjungan', 'kunjungan.id_lab=lab.id_lab', 'right');
        $this->db->where('kunjungan.tgl_kunjungan >=', $awal);
        $this->db->where('kunjungan.tgl_kunjungan <=', $akhir);
        $this->db->where('kolesterol >=', '0');
        $this->db->where('kolesterol >=', '0');
        $this->db->where('jenis_lab', '1');
        return $this->db->get('lab');
    }

    function laporan_lab_gda($awal, $akhir){
        $this->db->select('*');
        $this->db->join('kunjungan', 'kunjungan.id_lab=lab.id_lab', 'right');
        $this->db->where('kunjungan.tgl_kunjungan >=', $awal);
        $this->db->where('kunjungan.tgl_kunjungan <=', $akhir);
        $this->db->where('gda >=', '0');
        $this->db->where('jenis_lab', '1');
        return $this->db->get('lab');
    }

    function laporan_lab_gdp($awal, $akhir){
        $this->db->select('*');
        $this->db->join('kunjungan', 'kunjungan.id_lab=lab.id_lab', 'right');
        $this->db->where('kunjungan.tgl_kunjungan >=', $awal);
        $this->db->where('kunjungan.tgl_kunjungan <=', $akhir);
        $this->db->where('gdp >=', '0');
        $this->db->where('jenis_lab', '1');
        return $this->db->get('lab');
    }

    function laporan_lab_gdsm($awal, $akhir){
        $this->db->select('*');
        $this->db->join('kunjungan', 'kunjungan.id_lab=lab.id_lab', 'right');
        $this->db->where('kunjungan.tgl_kunjungan >=', $awal);
        $this->db->where('kunjungan.tgl_kunjungan <=', $akhir);
        $this->db->where('gdsm >=', '0');
        $this->db->where('jenis_lab', '1');
        return $this->db->get('lab');
    }

    function laporan_lab_hb($awal, $akhir){
        $this->db->select('*');
        $this->db->join('kunjungan', 'kunjungan.id_lab=lab.id_lab', 'right');
        $this->db->where('kunjungan.tgl_kunjungan >=', $awal);
        $this->db->where('kunjungan.tgl_kunjungan <=', $akhir);
        $this->db->where('hb >=', '0');
        $this->db->where('jenis_lab', '1');
        return $this->db->get('lab');
    }

    function laporan_lab_trombosit($awal, $akhir){
        $this->db->select('*');
        $this->db->join('kunjungan', 'kunjungan.id_lab=lab.id_lab', 'right');
        $this->db->where('kunjungan.tgl_kunjungan >=', $awal);
        $this->db->where('kunjungan.tgl_kunjungan <=', $akhir);
        $this->db->where('trombosit >=', '0');
        $this->db->where('jenis_lab', '1');
        return $this->db->get('lab');
    }

    function laporan_lab_sgot($awal, $akhir){
        $this->db->select('*');
        $this->db->join('kunjungan', 'kunjungan.id_lab=lab.id_lab', 'right');
        $this->db->where('kunjungan.tgl_kunjungan >=', $awal);
        $this->db->where('kunjungan.tgl_kunjungan <=', $akhir);
        $this->db->where('sgot >=', '0');
        $this->db->where('jenis_lab', '1');
        return $this->db->get('lab');
    }

    function laporan_lab_sgpt($awal, $akhir){
        $this->db->select('*');
        $this->db->join('kunjungan', 'kunjungan.id_lab=lab.id_lab', 'right');
        $this->db->where('kunjungan.tgl_kunjungan >=', $awal);
        $this->db->where('kunjungan.tgl_kunjungan <=', $akhir);
        $this->db->where('sgpt >=', '0');
        $this->db->where('jenis_lab', '1');
        return $this->db->get('lab');
    }

    function laporan_lab_asamurat($awal, $akhir){
        $this->db->select('*');
        $this->db->join('kunjungan', 'kunjungan.id_lab=lab.id_lab', 'right');
        $this->db->where('kunjungan.tgl_kunjungan >=', $awal);
        $this->db->where('kunjungan.tgl_kunjungan <=', $akhir);
        $this->db->where('asamurat >=', '0');
        $this->db->where('jenis_lab', '1');
        return $this->db->get('lab');
    }

    function laporan_lab_widal($awal, $akhir){
        $this->db->select('*');
        $this->db->join('kunjungan', 'kunjungan.id_lab=lab.id_lab', 'right');
        $this->db->where('kunjungan.tgl_kunjungan >=', $awal);
        $this->db->where('kunjungan.tgl_kunjungan <=', $akhir);
        $this->db->where('widal >=', '0');
        $this->db->where('jenis_lab', '1');
        return $this->db->get('lab');
    }

    function radiologi($awal, $akhir, $key){
        $this->db->select('*');
        $this->db->join('kunjungan', 'kunjungan.id_radiologi=radiologi.id_radiologi');
        $this->db->where('kunjungan.tgl_kunjungan >=', $awal);
        $this->db->where('kunjungan.tgl_kunjungan <=', $akhir);
        $this->db->where('jenis_pemeriksaan', $key);
        $this->db->where('jenis', '1');
        return $this->db->get('radiologi');
    }

    function dokter($awal, $akhir){
        $this->db->select('user.nama_user ,count(dokter) as total');
        $this->db->group_by('kunjungan.dokter');
        $this->db->order_by('total', 'DESC');
        $this->db->join('user', 'user.id_user=kunjungan.dokter');
        $this->db->where('tgl_kunjungan >=', $awal);
        $this->db->where('tgl_kunjungan <=', $akhir);
        return $this->db->get('kunjungan');
    }

    function perawat($awal, $akhir){
        $this->db->select('user.nama_user ,count(kunjungan.id_user) as total');
        $this->db->group_by('kunjungan.id_user');
        $this->db->order_by('total', 'DESC');
        $this->db->join('user', 'user.id_user=kunjungan.id_user');
        $this->db->where('tgl_kunjungan >=', $awal);
        $this->db->where('tgl_kunjungan <=', $akhir);
        return $this->db->get('kunjungan');
    }

    function laporan_keuangan(){
        $this->db->group_by('tgl_bayar');
        return $this->db->get('kasir');
    }


}