<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Apotek extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('M_apotek', 'apotek');
		$this->load->model('M_pendaftaran', 'daftar');
	}

	public function index(){
		$data['pendaftaran'] = $this->apotek->list_pendaftaran()->result();
		$this->load->view('apotek', $data);
	}

	public function resep_selesai(){
		$data['pendaftaran'] = $this->apotek->list_selesai()->result();
		$this->load->view('resep_selesai', $data);
	}
	
	function resep(){
		$id = $this->uri->segment(3);
		$data['kunj'] = $this->daftar->detail($id)->row_array();
		$data['cito'] = $this->db->get_where('resep', ['id_kunjungan'=>$id, 'cito'=>1])->num_rows();
		$data['obat'] = $this->db->get('obat')->result();
		$this->load->view('resep', $data);
	}

	function cetak_resep(){
		$id = $this->uri->segment(3);
		$data['kunj'] = $this->daftar->detail($id)->row_array();
		$data['cito'] = $this->db->get_where('resep', ['id_kunjungan'=>$id, 'cito'=>1])->num_rows();
		$data['obat'] = $this->apotek->resep($id)->result();
		$data['nama_klinik'] = $this->db->get_where('config', ['id_config'=>1])->row_array();
		$data['alamat_klinik'] = $this->db->get_where('config', ['id_config'=>2])->row_array();
		$data['telp_klinik'] = $this->db->get_where('config', ['id_config'=>3])->row_array();
		$data['website_klinik'] = $this->db->get_where('config', ['id_config'=>4])->row_array();
		$data['email_klinik'] = $this->db->get_where('config', ['id_config'=>5])->row_array();
		$this->load->view('cetak_resep', $data);
	}

	function selesai(){
		$id = $this->uri->segment(3);
		
		$cek = $this->apotek->cek_pembayaran($id)->row_array();
		if(($cek['asuransi_px'] == 2)||($cek['asuransi_px'] == 3)){
			$data['status_kunjungan'] = 4;
		}else{
			$data['status_kunjungan'] = 3;
		}


		$this->db->update('kunjungan', $data, ['id_kunjungan'=>$id]);
		$this->session->set_flashdata('success', 'Berhasil membuat resep');
		redirect(base_url('apotek'));
	}


}