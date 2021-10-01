<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_master extends CI_Model
{
	// PROVINSI
	function show_provinsi(){
		$this->db->select('*');
		$this->db->from('provinsi');
		$this->db->order_by('id_provinsi', 'DESC');
		return $this->db->get();
	}

	function search_provinsi($key){
		$this->db->select('*');
		$this->db->from('provinsi');
		$this->db->order_by('id_provinsi', 'DESC');
		$this->db->like('nama_provinsi', $key, 'both');
		return $this->db->get();
	}

	// KOTA KABUPATEN
	function show_kota_kab(){
		$this->db->select('*');
		$this->db->from('kota_kab');
		$this->db->order_by('id_kota_kab', 'DESC');
		$this->db->join('provinsi', 'kota_kab.id_provinsi=provinsi.id_provinsi');
		return $this->db->get();
	}

	function search_kota_kab($key){
		$this->db->select('*');
		$this->db->from('kota_kab');
		$this->db->order_by('id_kota_kab', 'DESC');
		$this->db->join('provinsi', 'kota_kab.id_provinsi=provinsi.id_provinsi');
		$this->db->like('nama_kota_kab', $key, 'both');
		$this->db->or_like('nama_provinsi', $key, 'both');
		return $this->db->get();
	}

	function detail_kota_kab($id){
		$this->db->select('*');
		$this->db->from('kota_kab');
		$this->db->join('provinsi', 'kota_kab.id_provinsi=provinsi.id_provinsi');
		$this->db->where('id_kota_kab', $id);
		return $this->db->get();
	}

	// KECAMATAN
	function show_kecamatan(){
		$this->db->select('*');
		$this->db->from('kecamatan');
		$this->db->order_by('id_kecamatan', 'DESC');
		$this->db->limit('50');
		$this->db->join('kota_kab', 'kecamatan.id_kota_kab=kota_kab.id_kota_kab');
		return $this->db->get();
	}

	function search_kecamatan($key){
		$this->db->select('*');
		$this->db->from('kecamatan');
		$this->db->order_by('id_kecamatan', 'DESC');
		$this->db->limit('50');
		$this->db->join('kota_kab', 'kecamatan.id_kota_kab=kota_kab.id_kota_kab');
		// $this->db->join('provinsi', 'kecamatan.id_provinsi=provinsi.id_provinsi');
		$this->db->like('nama_kecamatan', $key, 'both');
		// $this->db->or_like('nama_provinsi', $key, 'both');
		$this->db->or_like('nama_kota_kab', $key, 'both');
		return $this->db->get();
	}

	function detail_kecamatan($id){
		$this->db->select('*');
		$this->db->from('kecamatan');
		$this->db->join('kota_kab', 'kecamatan.id_kota_kab=kota_kab.id_kota_kab');
		$this->db->where('id_kecamatan', $id);
		return $this->db->get();
	}

	// DESA
	function show_desa(){
		$this->db->select('*');
		$this->db->from('desa');
		// $this->db->order_by('id_desa', 'DESC');
		$this->db->limit('20');
		$this->db->join('kecamatan', 'desa.id_kecamatan=kecamatan.id_kecamatan');
		return $this->db->get();
	}

	function search_desa($key){
		$this->db->select('*');
		$this->db->from('desa');
		$this->db->order_by('id_desa', 'DESC');
		// $this->db->join('provinsi', 'desa.id_provinsi=provinsi.id_provinsi');
		$this->db->limit('50');
		$this->db->join('kecamatan', 'desa.id_kecamatan=kecamatan.id_kecamatan');
		// $this->db->join('kota_kab', 'desa.id_kota_kab=kota_kab.id_kota_kab');
		$this->db->like('nama_desa', $key, 'both');
		// $this->db->or_like('nama_provinsi', $key, 'both');
		// $this->db->or_like('nama_kota_kab', $key, 'both');
		return $this->db->get();
	}

	function detail_desa($id){
		$this->db->select('*');
		$this->db->from('desa');
		$this->db->join('kecamatan', 'desa.id_kecamatan=kecamatan.id_kecamatan');
		$this->db->where('id_desa', $id);
		return $this->db->get();
	}

	// MIXED
	function kota_prov($id_provinsi){
		$this->db->select('*');
		$this->db->from('kota_kab');
		$this->db->join('provinsi', 'kota_kab.id_provinsi=provinsi.id_provinsi');
		$this->db->where('kota_kab.id_provinsi', $id_provinsi);
		return $this->db->get();
	}

	function kec_kota($id_kota_kab){
		$this->db->select('*');
		$this->db->from('kecamatan');
		$this->db->join('kota_kab', 'kecamatan.id_kota_kab=kota_kab.id_kota_kab');
		$this->db->where('kecamatan.id_provinsi', $id_provinsi);
		$this->db->where('kecamatan.id_kota_kab', $id_kota_kab);
		return $this->db->get();
	}


	/* 
	   =================================================
	   ||                 MASTER TINDAKAN              ||
	   =================================================
	*/


	function tampil_tindakan(){
		$this->db->select('*');
		$this->db->from('master_tindakan');
		$this->db->order_by('kode_tindakan', 'DESC');
		return $this->db->get();
	}

	function search_tindakan($key){
		$this->db->select('*');
		$this->db->from('master_tindakan');
		$this->db->like('nama_tindakan', $key, 'both');
		$this->db->or_like('kode_tindakan', $key, 'both');
		return $this->db->get();
	}


	/* 
	   =================================================
	   ||                 MASTER DIAGNOSA              ||
	   =================================================
	*/


	function tampil_diagnosa(){
		$this->db->select('*');
		$this->db->from('master_diagnosa');
		$this->db->order_by('kode_diagnosa', 'DESC');
		return $this->db->get();
	}

	function search_diagnosa($key){
		$this->db->select('*');
		$this->db->from('master_diagnosa');
		$this->db->like('nama_diagnosa', $key, 'both');
		$this->db->or_like('kode_diagnosa', $key, 'both');
		return $this->db->get();
	}

	/* 
	   =================================================
	   ||                 MASTER SUPLIER              ||
	   =================================================
	*/


	function tampil_suplier(){
		$this->db->select('*');
		$this->db->from('suplier');
		$this->db->order_by('id_suplier', 'DESC');
		return $this->db->get();
	}

	function search_suplier($key){
		$this->db->select('*');
		$this->db->from('suplier');
		$this->db->order_by('id_suplier', 'DESC');
		$this->db->like('nama_suplier', $key, 'both');
		$this->db->or_like('telp_suplier', $key, 'both');
		$this->db->or_like('alamat_suplier', $key, 'both');
		return $this->db->get();
	}

	/* 
	   =================================================
	   ||              MASTER KONTEN OBAT              ||
	   =================================================
	*/


	function tampil_konten(){
		$this->db->select('*');
		$this->db->from('konten');
		$this->db->order_by('id_konten', 'DESC');
		return $this->db->get();
	}

	function search_konten($key){
		$this->db->select('*');
		$this->db->from('konten');
		$this->db->order_by('id_konten', 'DESC');
		$this->db->like('nama_konten', $key, 'both');
		$this->db->or_like('telp_konten', $key, 'both');
		$this->db->or_like('alamat_konten', $key, 'both');
		return $this->db->get();
	}

	/* 
	   =================================================
	   ||                 MASTER OBAT              ||
	   =================================================
	*/


	function tampil_obat(){
		$this->db->select('*');
		$this->db->from('obat');
		$this->db->join('suplier', 'suplier.id_suplier=obat.id_suplier');
		$this->db->order_by('id_obat', 'DESC');
		return $this->db->get();
	}

	function detail_obat($id_obat){
		$this->db->select('*');
		$this->db->from('obat');
		$this->db->join('suplier', 'suplier.id_suplier=obat.id_suplier');
		$this->db->where('obat.id_obat', $id_obat);
		return $this->db->get();
	}

	function search_obat($key){
		$this->db->select('*');
		$this->db->from('obat');
		$this->db->join('suplier', 'suplier.id_suplier=obat.id_suplier');
		$this->db->order_by('id_obat', 'DESC');
		$this->db->like('nama_obat', $key, 'both');
		return $this->db->get();
	}
}