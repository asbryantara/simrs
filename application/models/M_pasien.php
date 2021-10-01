<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pasien extends CI_Model
{
	
	function last_rm(){
		$this->db->select('*');
		$this->db->from('pasien');
		$this->db->limit('1');
		$this->db->order_by('no_rm', 'DESC');
		return $this->db->get();
	}

	function detail_pasien($no_rm){
		$this->db->select('*');
		$this->db->from('pasien');
		$this->db->join('desa', 'desa.id_desa=pasien.id_desa', 'left');
		$this->db->join('kecamatan', 'kecamatan.id_kecamatan=pasien.id_kecamatan', 'left');
		$this->db->join('kota_kab', 'kota_kab.id_kota_kab=pasien.id_kota_kab', 'left');
		$this->db->join('provinsi', 'provinsi.id_provinsi=pasien.id_provinsi', 'left');
		$this->db->where('no_rm', $no_rm);
		return $this->db->get();
	}

	function autocomplete($term){
      $this->db->like('nama_konten', $term , 'both');
      $this->db->limit('10');
      return $this->db->get('konten')->result();
    }
}