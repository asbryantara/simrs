<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_antrian extends CI_Model
{
	
	function cek(){
		$this->db->select('*');
		$this->db->from('antrian');
		$this->db->limit('1');
		$this->db->order_by('id_antrian', 'DESC');
		$this->db->like('tgl_antrian', date('Y-m-d'), 'both');
		return $this->db->get();
	}
	
	function update(){
		$this->db->select('*');
		$this->db->from('antrian');
		$this->db->limit('1');
		$this->db->order_by('id_antrian', 'ASC');
		$this->db->like('tgl_antrian', date('Y-m-d'), 'both');
		$this->db->where('status_antrian', '0');
		return $this->db->get();
	}

	function jumlah(){
		$this->db->select('*');
		$this->db->from('antrian');
		$this->db->like('tgl_antrian', date('Y-m-d'), 'both');
		return $this->db->get();
	}

	function terlayani(){
		$this->db->select('*');
		$this->db->from('antrian');
		$this->db->like('tgl_antrian', date('Y-m-d'), 'both');
		$this->db->where('status_antrian', '1');
		return $this->db->get();
	}

	function menunggu(){
		$this->db->select('*');
		$this->db->from('antrian');
		$this->db->like('tgl_antrian', date('Y-m-d'), 'both');
		$this->db->where('status_antrian', '0');
		return $this->db->get();
	}

	function panggil(){
		$this->db->select('*');
		$this->db->from('antrian');
		$this->db->like('tgl_antrian', date('Y-m-d'), 'both');
		$this->db->where('status_antrian !=', '0');
		$this->db->order_by('id_antrian', 'DESC');
		$this->db->limit('1');
		return $this->db->get();
	}
}