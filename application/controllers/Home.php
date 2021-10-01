<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('M_pendaftaran', 'daftar');
	}

	public function index(){
		
		$data['pasien'] = $this->db->get('pasien')->num_rows();
		$data['all_kunjungan'] = $this->db->get('kunjungan')->num_rows();
		$data['obat'] = $this->db->get('obat')->num_rows();
		$data['tindakan'] = $this->db->get('master_tindakan')->num_rows();
		$data['suplier'] = $this->db->get('suplier')->num_rows();
		$data['day_kunjungan'] = $this->db->get_where('kunjungan', ['tgl_kunjungan'=>date('Y-m-d')])->num_rows();

		$satu = date('Y-m-d');
		$dua = date('Y-m-d', strtotime('-1 days', strtotime($satu)));
		$tiga = date('Y-m-d', strtotime('-2 days', strtotime($satu)));
		$empat = date('Y-m-d', strtotime('-3 days', strtotime($satu)));
		$lima = date('Y-m-d', strtotime('-4 days', strtotime($satu)));
		$enam = date('Y-m-d', strtotime('-5 days', strtotime($satu)));
		$tujuh = date('Y-m-d', strtotime('-6 days', strtotime($satu)));

		$data['satu'] = $this->db->get_where('kunjungan', ['tgl_kunjungan'=>$satu])->num_rows();
		$data['dua'] = $this->db->get_where('kunjungan', ['tgl_kunjungan'=>$dua])->num_rows();
		$data['tiga'] = $this->db->get_where('kunjungan', ['tgl_kunjungan'=>$tiga])->num_rows();
		$data['empat'] = $this->db->get_where('kunjungan', ['tgl_kunjungan'=>$empat])->num_rows();
		$data['lima'] = $this->db->get_where('kunjungan', ['tgl_kunjungan'=>$lima])->num_rows();
		$data['enam'] = $this->db->get_where('kunjungan', ['tgl_kunjungan'=>$enam])->num_rows();
		$data['tujuh'] = $this->db->get_where('kunjungan', ['tgl_kunjungan'=>$tujuh])->num_rows();
		$this->load->view('home', $data);
	}

	function konfigurasi(){
		$data['config'] = $this->db->get('config')->result();
		$this->load->view('konfigurasi', $data);
	}

	function edit_konfigurasi(){
		$id = $this->uri->segment(3);
		$data['con'] = $this->db->get_where('config', ['id_config'=>$id])->row_array();
		$this->load->view('edit_konfigurasi', $data);
	}

	function save_konfigurasi(){
		$id = $this->input->post('id_config');
		$data['isi_config'] = $this->input->post('isi_config');
		$this->db->update('config', $data, ['id_config'=>$id]);
		$this->session->set_flashdata('success', 'Berhasil merubah data');
		redirect('home/konfigurasi');
	}
}