<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pendaftaran extends CI_Model
{
	
  	function autocomplete($term){
      $this->db->like('no_rm', $term , 'both');
      $this->db->or_like('nama_px', $term , 'both');
      $this->db->limit('10');
      return $this->db->get('pasien')->result();
    }

    function list_pendaftaran(){
    	$this->db->select('*');
    	$this->db->from('kunjungan');
    	$this->db->join('pasien', 'pasien.no_rm=kunjungan.no_rm');
    	// $this->db->where('status_kunjungan', 0);
    	$this->db->order_by('id_kunjungan', 'DESC');
    	return $this->db->get();
    }

    function riwayat($no_rm){
      $this->db->select('*');
      $this->db->from('kunjungan');
      $this->db->join('user', 'user.id_user=kunjungan.id_user', 'left');
      $this->db->where('kunjungan.no_rm', $no_rm);
      $this->db->order_by('tgl_kunjungan', 'DESC');
      return $this->db->get();
    }

    function detail($id){
      $this->db->select('*');
      $this->db->from('kunjungan');
      $this->db->join('user', 'user.id_user=kunjungan.id_user', 'left');
      $this->db->join('pasien', 'pasien.no_rm=kunjungan.no_rm');
      $this->db->join('lab', 'lab.id_lab=kunjungan.id_lab', 'left');
      $this->db->join('radiologi', 'radiologi.id_radiologi=kunjungan.id_radiologi', 'left');
      $this->db->where('id_kunjungan', $id);
      return $this->db->get();
    }

    function diagnosa($id){
      $this->db->select('*');
      $this->db->from('diagnosa');
      $this->db->join('master_diagnosa', 'master_diagnosa.kode_diagnosa=diagnosa.kode_diagnosa');
      $this->db->where('id_kunjungan', $id);
      return $this->db->get();
    }

}