<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kasir extends CI_Model
{

	function list_pendaftaran(){
    	$this->db->select('*');
    	$this->db->from('kunjungan');
        $this->db->join('pasien', 'pasien.no_rm=kunjungan.no_rm');
    	$this->db->where('status_kunjungan', 3);
    	$this->db->order_by('id_kunjungan', 'DESC');
    	return $this->db->get();
    }

    function list_selesai_bayar(){
    	$this->db->select('*');
    	$this->db->from('kunjungan');
        $this->db->join('pasien', 'pasien.no_rm=kunjungan.no_rm');
    	$this->db->where('status_kunjungan', 4);
    	$this->db->where('asuransi_px', 1);
    	$this->db->order_by('id_kunjungan', 'DESC');
    	return $this->db->get();
    }

    function kunjungan($id){
    	$this->db->select('*');
    	$this->db->from('kunjungan');
        $this->db->join('pasien', 'pasien.no_rm=kunjungan.no_rm');
    	$this->db->where('id_kunjungan', $id);
    	return $this->db->get();
    }

    function tindakan($id){
    	$this->db->select('*');
    	$this->db->from('master_tindakan');
        $this->db->join('tindakan', 'tindakan.kode_tindakan=master_tindakan.kode_tindakan');
    	$this->db->where('tindakan.id_kunjungan', $id);
    	return $this->db->get();
    }

    function resep($id){
    	$this->db->select('*');
    	$this->db->from('resep');
        $this->db->join('obat', 'resep.id_obat=obat.id_obat');
    	$this->db->where('id_kunjungan', $id);
    	return $this->db->get();
    }

    function bayar($id){
    	$this->db->select('*');
    	$this->db->from('kasir');
        $this->db->join('user', 'kasir.id_user=user.id_user');
    	$this->db->where('id_kunjungan', $id);
    	return $this->db->get();
    }


}