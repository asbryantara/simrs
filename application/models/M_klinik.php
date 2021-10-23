<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_klinik extends CI_Model
{
	function show_resep($id){
		$this->db->join('obat', 'obat.id_obat=resep.id_obat');
		$this->db->where('id_kunjungan', $id);
		return $this->db->get('resep');
	}

	function list_pendaftaran(){
    	$this->db->select('*');
    	$this->db->from('kunjungan');
    	$this->db->join('pasien', 'pasien.no_rm=kunjungan.no_rm');
    	$this->db->where('status_kunjungan <=', 1);
    	$this->db->or_where('status_kunjungan >=', 5);
    	$this->db->order_by('id_kunjungan', 'DESC');
    	return $this->db->get();
    }

    function list_sudah_periksa(){
    	$this->db->select('*');
    	$this->db->from('kunjungan');
    	$this->db->join('pasien', 'pasien.no_rm=kunjungan.no_rm');
    	$this->db->where('status_kunjungan >', 1);
    	$this->db->order_by('id_kunjungan', 'DESC');
    	return $this->db->get();
    }

    function pengantar($id){
        $this->db->select('*');
        $this->db->from('kunjungan');
        $this->db->join('pasien', 'pasien.no_rm=kunjungan.no_rm');
        $this->db->where('id_kunjungan', $id);
        return $this->db->get();
    }

    function autocomplete_lab($term){
        $this->db->select('*');
        $this->db->from('kunjungan');
        $this->db->where('status_kunjungan', '1');
        $this->db->where('id_lab', null);
        $this->db->join('pasien', 'pasien.no_rm=kunjungan.no_rm');
        $this->db->like('pasien.no_rm', $term , 'both');
        $this->db->limit('10');
        return $this->db->get()->result();
    }

    function autocomplete_rad($term){
        $this->db->select('*');
        $this->db->from('kunjungan');
        $this->db->where('status_kunjungan', '1');
        $this->db->where('id_radiologi', null);
        $this->db->join('pasien', 'pasien.no_rm=kunjungan.no_rm');
        $this->db->like('pasien.no_rm', $term , 'both');
        $this->db->limit('10');
        return $this->db->get()->result();
    }

    function periksa_lab(){
        $this->db->select('*');
        $this->db->from('kunjungan');
        $this->db->join('pasien', 'kunjungan.no_rm=pasien.no_rm');
        $this->db->where('status_kunjungan', '5');
        $this->db->where('is_lab', '1');
        return $this->db->get();
    }

    function riwayat_lab(){
        $this->db->select('*');
        $this->db->from('kunjungan');
        $this->db->join('lab', 'kunjungan.id_lab=lab.id_lab');
        $this->db->join('pasien', 'kunjungan.no_rm=pasien.no_rm');
        $this->db->where('jenis_lab', '1');
        return $this->db->get();
    }

    function edit_lab($id){
      $this->db->select('*');
      $this->db->from('kunjungan');
      $this->db->join('user', 'user.id_user=kunjungan.id_user', 'left');
      $this->db->join('pasien', 'pasien.no_rm=kunjungan.no_rm');
      $this->db->where('id_lab', $id);
      return $this->db->get();
    }

    function riwayat_rad(){
        $this->db->select('*');
        $this->db->from('kunjungan');
        $this->db->join('radiologi', 'kunjungan.id_radiologi=radiologi.id_radiologi');
        $this->db->join('pasien', 'kunjungan.no_rm=pasien.no_rm');
        $this->db->where('jenis', '1');
        return $this->db->get();
    }

    function edit_rad($id){
      $this->db->select('*');
      $this->db->from('kunjungan');
      $this->db->join('user', 'user.id_user=kunjungan.id_user', 'left');
      $this->db->join('pasien', 'pasien.no_rm=kunjungan.no_rm');
      $this->db->where('id_radiologi', $id);
      return $this->db->get();
    }

    function cek_resep($id){
      $this->db->select('*');
      $this->db->from('resep');
      $this->db->where('id_kunjungan', $id);
      return $this->db->get();
    }

    function autocomplete($term){
      $this->db->like('nama_diagnosa', $term , 'both');
      $this->db->limit('10');
      return $this->db->get('master_diagnosa')->result();
    }

    function dx($id, $jenis){
      $this->db->select('*');
      $this->db->from('diagnosa');
      $this->db->join('master_diagnosa', 'master_diagnosa.kode_diagnosa=diagnosa.kode_diagnosa');
      $this->db->where('id_kunjungan', $id);
      $this->db->where('jenis', $jenis);
      return $this->db->get();
    }

}
