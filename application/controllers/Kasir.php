<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Kasir extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('M_kasir', 'kasir');
		$this->load->model('M_pendaftaran', 'daftar');
	}

	public function index(){
		$data['pendaftaran'] = $this->kasir->list_pendaftaran()->result();
		$this->load->view('kasir', $data);
	}

	public function selesai_bayar(){
		$data['pendaftaran'] = $this->kasir->list_selesai_bayar()->result();
		$this->load->view('selesai_bayar', $data);
	}

	function bayar(){
		$id = $this->uri->segment(3);
		$data['kunj'] = $this->kasir->kunjungan($id)->row_array();
		$data['tindakan'] = $this->kasir->tindakan($id)->result();
		$data['resep'] = $this->kasir->resep($id)->result();
		$data['bayar'] = $this->kasir->bayar($id)->row_array();
		$data['status'] = $this->db->get_where('kasir', ['id_kunjungan'=>$id])->num_rows();
		$this->load->view('bayar', $data);
	}

	function cetak_faktur(){
		$id = $this->uri->segment(3);
		$data['kunj'] = $this->kasir->kunjungan($id)->row_array();
		$data['tindakan'] = $this->kasir->tindakan($id)->result();
		$data['bayar'] = $this->kasir->bayar($id)->row_array();
		$data['status'] = $this->db->get_where('kasir', ['id_kunjungan'=>$id])->num_rows();
		$data['resep'] = $this->kasir->resep($id)->result();
		$data['nama_klinik'] = $this->db->get_where('config', ['id_config'=>1])->row_array();
		$data['alamat_klinik'] = $this->db->get_where('config', ['id_config'=>2])->row_array();
		$data['telp_klinik'] = $this->db->get_where('config', ['id_config'=>3])->row_array();
		$data['website_klinik'] = $this->db->get_where('config', ['id_config'=>4])->row_array();
		$data['email_klinik'] = $this->db->get_where('config', ['id_config'=>5])->row_array();
		$this->load->view('cetak_faktur', $data);
	}

	function cetak_kwitansi(){
		$id = $this->uri->segment(3);
		$data['kunj'] = $this->kasir->kunjungan($id)->row_array();
		$data['bayar'] = $this->kasir->bayar($id)->row_array();
		$jumlah = $data['bayar']['jumlah_bayar'];
		$data['terbilang'] = $this->terbilang($jumlah);
		$data['nama_klinik'] = $this->db->get_where('config', ['id_config'=>1])->row_array();
		$data['alamat_klinik'] = $this->db->get_where('config', ['id_config'=>2])->row_array();
		$data['telp_klinik'] = $this->db->get_where('config', ['id_config'=>3])->row_array();
		$data['website_klinik'] = $this->db->get_where('config', ['id_config'=>4])->row_array();
		$data['email_klinik'] = $this->db->get_where('config', ['id_config'=>5])->row_array();
		// echo $terbilang;
		$this->load->view('cetak_kwitansi', $data);
	}

	function simpan(){
		$data['jumlah_bayar'] = str_replace('.', '', $this->input->post('jumlah_bayar'));
		$data['bayar'] = str_replace('.', '', $this->input->post('bayar'));
		$data['kembali'] = str_replace('.', '', $this->input->post('kembali'));
		$data['id_kunjungan'] = $this->input->post('id_kunjungan');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['tgl_bayar'] = date('Y-m-d H:i:s');
		$simpan = $this->db->insert('kasir', $data);
		if($simpan){
			$this->db->update('kunjungan', ['status_kunjungan'=>4], ['id_kunjungan'=>$data['id_kunjungan']]);
			redirect(base_url('kasir/bayar/'.$data['id_kunjungan']));
		}
	}

	function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = $this->penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = $this->penyebut($nilai/10)." puluh". $this->penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = $this->penyebut($nilai/100) . " ratus" . $this->penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . $this->penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = $this->penyebut($nilai/1000) . " ribu" . $this->penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = $this->penyebut($nilai/1000000) . " juta" . $this->penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = $this->penyebut($nilai/1000000000) . " milyar" . $this->penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = $this->penyebut($nilai/1000000000000) . " trilyun" . $this->penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
 
	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim($this->penyebut($nilai));
		} else {
			$hasil = trim($this->penyebut($nilai));
		}     		
		return $hasil;
	}

}