<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_apotek extends CI_Model
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
    	$this->db->where('status_kunjungan', 2);
    	$this->db->order_by('id_kunjungan', 'DESC');
    	return $this->db->get();
    }

    function list_selesai(){
        $this->db->select('*');
        $this->db->from('kunjungan');
        $this->db->join('pasien', 'pasien.no_rm=kunjungan.no_rm');
        $this->db->where('status_kunjungan >=', 3);
        $this->db->order_by('id_kunjungan', 'DESC');
        return $this->db->get();
    }

    function detail($id){
        $this->db->select('*');
        $this->db->from('resep');
        $this->db->where('id_kunjungan', $id);
        return $this->db->get();
    }

    function list_sudah_obat(){
    	$this->db->select('*');
    	$this->db->from('kunjungan');
    	$this->db->join('pasien', 'pasien.no_rm=kunjungan.no_rm');
    	$this->db->where('status_kunjungan', 3);
    	$this->db->order_by('id_kunjungan', 'DESC');
        return $this->db->get();
    }

    function resep($id){
        $this->db->select('*');
        $this->db->from('resep');
        $this->db->join('obat', 'obat.id_obat=resep.id_obat');
        $this->db->where('id_kunjungan', $id);
    	return $this->db->get();
    }

    function cek_pembayaran($id){
        $this->db->select('*');
        $this->db->from('kunjungan');
        $this->db->join('pasien', 'pasien.no_rm=kunjungan.no_rm');
        $this->db->where('id_kunjungan', $id);
        return $this->db->get();
    }

}