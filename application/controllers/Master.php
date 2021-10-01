<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Master extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('M_master', 'master');
	}

	public function provinsi(){
		
		$this->load->view('provinsi');
	}

	function show_provinsi(){
		$data = $this->master->show_provinsi()->result();
		echo json_encode($data);
	}

	function save_provinsi(){
		$data['nama_provinsi'] = strtoupper($this->input->post('nama_provinsi'));
		$cek = $this->db->get_where('provinsi', ['nama_provinsi'=>$data['nama_provinsi']])->num_rows();
		if($cek > 0){
			echo json_encode('duplikasi');
		}else{
			$this->db->insert('provinsi', $data);
			echo json_encode('sukses');
		}
	}

	function detail_provinsi(){
		$id_provinsi = $this->input->post('id_provinsi');
		$data = $this->db->get_where('provinsi', ['id_provinsi'=>$id_provinsi])->row_array();
		echo json_encode($data);
	}

	function update_provinsi(){
		$id_provinsi = $this->input->post('id_provinsi');
		$data['nama_provinsi'] = strtoupper($this->input->post('nama_provinsi'));

		$update = $this->db->update('provinsi', $data, ['id_provinsi'=>$id_provinsi]);
		if($update){
			echo json_encode('sukses');
		}
	}

	function delete_provinsi(){
		$id_provinsi = $this->input->post('id_provinsi');
		$delete = $this->db->delete('provinsi', ['id_provinsi'=>$id_provinsi]);
		if($delete){
			echo json_encode('sukses');
		}
	}

	function search_provinsi(){
		$key = $this->input->post('search');
		$data = $this->master->search_provinsi($key)->result();
		echo json_encode($data);
	}


	// KOTA KABUPATEN

	public function kota_kab(){
		$data['row'] = $this->db->get('provinsi')->result();
		$this->load->view('kota_kab', $data);
	}

	function show_kota_kab(){
		$data = $this->master->show_kota_kab()->result();
		echo json_encode($data);
	}

	function save_kota_kab(){
		$data['nama_kota_kab'] = strtoupper($this->input->post('nama_kota_kab'));
		$data['id_provinsi'] = $this->input->post('id_provinsi');
		$cek = $this->db->get_where('kota_kab', ['nama_kota_kab'=>$data['nama_kota_kab'], 'id_provinsi'=>$data['id_provinsi']])->num_rows();
		if($cek > 0){
			echo json_encode('duplikasi');
		}else{
			$this->db->insert('kota_kab', $data);
			echo json_encode('sukses');
		}
	}

	function detail_kota_kab(){
		$id_kota_kab = $this->input->post('id_kota_kab');
		$data = $this->master->detail_kota_kab($id_kota_kab)->row_array();
		echo json_encode($data);
	}

	function update_kota_kab(){
		$id_kota_kab = $this->input->post('id_kota_kab');
		$data['nama_kota_kab'] = strtoupper($this->input->post('nama_kota_kab'));
		$data['id_provinsi'] = strtoupper($this->input->post('id_provinsi'));

		$update = $this->db->update('kota_kab', $data, ['id_kota_kab'=>$id_kota_kab]);
		if($update){
			echo json_encode('sukses');
		}
	}

	function delete_kota_kab(){
		$id_kota_kab = $this->input->post('id_kota_kab');
		$delete = $this->db->delete('kota_kab', ['id_kota_kab'=>$id_kota_kab]);
		if($delete){
			echo json_encode('sukses');
		}
	}

	function search_kota_kab(){
		$key = $this->input->post('search');
		$data = $this->master->search_kota_kab($key)->result();
		echo json_encode($data);
	}



	// KECAMATAN

	public function kecamatan(){
		$data['row'] = $this->db->get('provinsi')->result();
		$data['kota_kab'] = $this->db->get('kota_kab')->result();
		$this->load->view('kecamatan', $data);
	}

	function show_kecamatan(){
		$data = $this->master->show_kecamatan()->result();
		echo json_encode($data);
	}

	function save_kecamatan(){
		$id_kota_kab = $this->input->post('id_kota_kab');
		$this->db->limit('1');
		$this->db->order_by('id_kota_kab', 'DESC');
		$this->db->where('id_kota_kab', $id_kota_kab);
		$temp = $this->db->get_where('kecamatan')->row_array();
		$id_kecamatan = $temp['id_kecamatan']+10;


		$data['nama_kecamatan'] = strtoupper($this->input->post('nama_kecamatan'));
		$data['id_kota_kab'] = $id_kota_kab;
		$data['id_kecamatan'] = $id_kecamatan;
		$cek = $this->db->get_where('kecamatan', ['nama_kecamatan'=>$data['nama_kecamatan'], 'id_kota_kab'=>$data['id_kota_kab']])->num_rows();
		if($cek > 0){
			echo json_encode('duplikasi');
		}else{
			$this->db->insert('kecamatan', $data);
			echo json_encode('sukses');
		}

	}

	function detail_kecamatan(){
		$id_kecamatan = $this->input->post('id_kecamatan');
		$data = $this->master->detail_kecamatan($id_kecamatan)->row_array();
		echo json_encode($data);
	}

	function update_kecamatan(){
		$id_kecamatan = $this->input->post('id_kecamatan');
		$data['nama_kecamatan'] = strtoupper($this->input->post('nama_kecamatan'));
		$data['id_kota_kab'] = $this->input->post('id_kota_kab');

		$update = $this->db->update('kecamatan', $data, ['id_kecamatan'=>$id_kecamatan]);
		if($update){
			echo json_encode('sukses');
		}
	}

	function delete_kecamatan(){
		$id_kecamatan = $this->input->post('id_kecamatan');
		$delete = $this->db->delete('kecamatan', ['id_kecamatan'=>$id_kecamatan]);
		if($delete){
			echo json_encode('sukses');
		}
	}

	function search_kecamatan(){
		$key = $this->input->post('search');
		$data = $this->master->search_kecamatan($key)->result();
		echo json_encode($data);
	}

	// DESA

	public function desa(){
		$data['row'] = $this->db->get('provinsi')->result();
		$this->load->view('desa', $data);
	}

	function show_desa(){
		$data = $this->master->show_desa()->result();
		echo json_encode($data);
	}

	function save_desa(){

		$id_kecamatan = $this->input->post('id_kecamatan');
		
		$this->db->limit('1');
		$this->db->order_by('id_desa', 'DESC');
		$this->db->where('id_kecamatan', $id_kecamatan);
		$temp = $this->db->get('desa')->row_array();
		$id_desa = $temp['id_desa']+1;

		$data['nama_desa'] = strtoupper($this->input->post('nama_desa'));
		$data['id_desa'] = $id_desa;

		$data['id_kecamatan'] = $this->input->post('id_kecamatan');
		$cek = $this->db->get_where('desa', ['nama_desa'=>$data['nama_desa'], 'id_kecamatan'=>$data['id_kecamatan']])->num_rows();
		if($cek > 0){
			echo json_encode('duplikasi');
		}else{
			$this->db->insert('desa', $data);
			echo json_encode('sukses');
		}
	}

	function detail_desa(){
		$id_desa = $this->input->post('id_desa');
		$data = $this->master->detail_desa($id_desa)->row_array();
		echo json_encode($data);
	}

	function update_desa(){
		// $data['id_kota_kab'] = strtoupper($this->input->post('id_kota_kab'));
		// $data['id_provinsi'] = strtoupper($this->input->post('id_provinsi'));


		$id_desa = $this->input->post('id_desa');
		$data['nama_desa'] = strtoupper($this->input->post('nama_desa'));
		$data['id_kecamatan'] = strtoupper($this->input->post('id_kecamatan'));

		$update = $this->db->update('desa', $data, ['id_desa'=>$id_desa]);
		if($update){
			echo json_encode('sukses');
		}
	}

	function delete_desa(){
		$id_desa = $this->input->post('id_desa');
		$delete = $this->db->delete('desa', ['id_desa'=>$id_desa]);
		if($delete){
			echo json_encode('sukses');
		}
	}

	function search_desa(){
		$key = $this->input->post('search');
		$data = $this->master->search_desa($key)->result();
		echo json_encode($data);
	}

	// MIXED

	function kota_prov(){
		$id_provinsi = $this->input->post('id_provinsi');
		$data = $this->master->kota_prov($id_provinsi)->result();
		echo json_encode($data);
	}

	function kec_kota(){
		// $id_provinsi = $this->input->post('id_provinsi');
		$id_kota_kab = $this->input->post('id_kota_kab');
		$data = $this->db->get_where('kecamatan', ['id_kota_kab'=>$id_kota_kab])->result();
		echo json_encode($data);
	}

	function des_kec(){
		$id_kecamatan = $this->input->post('id_kecamatan');
		$data = $this->db->get_where('desa', ['id_kecamatan'=>$id_kecamatan])->result();
		echo json_encode($data);
	}

	function edit_kecamatan(){
		$id_kecamatan = $this->input->post('id_kecamatan');
		$id_provinsi = substr($id_kecamatan, 0, 2);
		$data['kec'] = $this->master->detail_kecamatan($id_kecamatan)->row_array();
		$data['kk'] = $this->db->get_where('kota_kab', ['id_provinsi'=>$id_provinsi])->result();

		echo json_encode($data);
	}

	function edit_desa(){
		$id_desa = $this->input->post('id_desa');
		$data['des'] 	= $this->master->detail_desa($id_desa)->row_array();
		$data['kec'] 	= $this->db->get_where('kecamatan', ['id_kota_kab'=>substr($id_desa, 0,4)])->result();
		$data['kk'] 	= $this->db->get_where('kota_kab', ['id_provinsi'=>substr($id_desa, 0,2)])->result();
		$data['prov'] 	= substr($id_desa, 0,2);

		echo json_encode($data);
	}


	// =================================================
	// ||                 MASTER TINDAKAN              ||
	// =================================================


	public function tindakan(){
		
		$this->load->view('tindakan');
	}

	function show_tindakan(){
		$data = $this->master->tampil_tindakan()->result();
		echo json_encode($data);
	}

	function save_tindakan(){
		$data['kode_tindakan'] = $this->input->post('kode_tindakan');
		$data['nama_tindakan'] = ucwords($this->input->post('nama_tindakan'));
		$data['harga_tindakan'] = str_replace('.', '', $this->input->post('harga_tindakan'));

		$cek = $this->db->get_where('master_tindakan', ['kode_tindakan'=>$data['kode_tindakan']])->num_rows();
		if($cek > 0){
			echo json_encode('duplikasi');
		}else{
			$this->db->insert('master_tindakan', $data);
			echo json_encode('sukses');
		}
	}

	function detail_tindakan(){
		$kode_tindakan = $this->input->post('kode_tindakan');
		$data = $this->db->get_where('master_tindakan', ['kode_tindakan'=>$kode_tindakan])->row_array();
		echo json_encode($data);
	}

	function update_tindakan(){
		$kode_tindakan = $this->input->post('kode_tindakan');
		$data['nama_tindakan'] = ucwords($this->input->post('nama_tindakan'));
		$data['harga_tindakan'] = str_replace('.', '', $this->input->post('harga_tindakan'));

		$update = $this->db->update('master_tindakan', $data, ['kode_tindakan'=>$kode_tindakan]);
		if($update){
			echo json_encode('sukses');
		}
	}

	function delete_tindakan(){
		$kode_tindakan = $this->input->post('kode_tindakan');
		$delete = $this->db->delete('master_tindakan', ['kode_tindakan'=>$kode_tindakan]);
		if($delete){
			echo json_encode('sukses');
		}
	}

	function search_tindakan(){
		$key = $this->input->post('search');
		$data = $this->master->search_tindakan($key)->result();
		echo json_encode($data);
	}

	// =================================================
	// ||                 MASTER SUPLER               ||
	// =================================================


	public function suplier(){
		
		$this->load->view('suplier');
	}

	function show_suplier(){
		$data = $this->master->tampil_suplier()->result();
		echo json_encode($data);
	}

	function save_suplier(){
		$data['nama_suplier'] = ucwords($this->input->post('nama_suplier'));
		$data['alamat_suplier'] = ucwords($this->input->post('alamat_suplier'));
		$data['telp_suplier'] = ucwords($this->input->post('telp_suplier'));

		$cek = $this->db->get_where('suplier', ['nama_suplier'=>$data['nama_suplier']])->num_rows();
		if($cek > 0){
			echo json_encode('duplikasi');
		}else{
			$this->db->insert('suplier', $data);
			echo json_encode('sukses');
		}
	}

	function detail_suplier(){
		$id_suplier = $this->input->post('id_suplier');
		$data = $this->db->get_where('suplier', ['id_suplier'=>$id_suplier])->row_array();
		echo json_encode($data);
	}

	function update_suplier(){
		$id_suplier = $this->input->post('id_suplier');
		$data['nama_suplier'] = ucwords($this->input->post('nama_suplier'));
		$data['alamat_suplier'] = ucwords($this->input->post('alamat_suplier'));
		$data['telp_suplier'] = $this->input->post('telp_suplier');

		$update = $this->db->update('suplier', $data, ['id_suplier'=>$id_suplier]);
		if($update){
			echo json_encode('sukses');
		}
	}

	function delete_suplier(){
		$id_suplier = $this->input->post('id_suplier');
		$delete = $this->db->delete('suplier', ['id_suplier'=>$id_suplier]);
		if($delete){
			echo json_encode('sukses');
		}
	}

	function search_suplier(){
		$key = $this->input->post('search');
		$data = $this->master->search_suplier($key)->result();
		echo json_encode($data);
	}


	// =================================================
	// ||                 MASTER OBAT               ||
	// =================================================


	public function obat(){
		$data['suplier'] = $this->db->get('suplier')->result();
		$data['konten'] = $this->db->get('konten')->result();
		$this->load->view('obat', $data);
	}

	function show_obat(){
		$data = $this->master->tampil_obat()->result();
		echo json_encode($data);
	}

	function add_obat(){
		$data['suplier'] = $this->db->get('suplier')->result();
		$data['konten'] = $this->db->get('konten')->result();
		$this->load->view('add_obat', $data);
	}

	// function save_obat(){
	// 	$data['nama_obat'] = ucwords($this->input->post('nama_obat'));
	// 	$data['harga'] = str_replace('.', '', $this->input->post('harga'));
	// 	$data['stok'] = $this->input->post('stok');
	// 	$data['id_suplier'] = $this->input->post('id_suplier');

	// 	$cek = $this->db->get_where('obat', ['nama_obat'=>$data['nama_obat']])->num_rows();
	// 	if($cek > 0){
	// 		echo json_encode('duplikasi');
	// 	}else{
	// 		$this->db->insert('obat', $data);
	// 		echo json_encode('sukses');
	// 	}
	// }

	function simpan_obat(){
		$data['nama_obat'] = ucwords($this->input->post('nama_obat'));
		$data['harga'] = str_replace('.', '', $this->input->post('harga'));
		$data['stok'] = $this->input->post('stok');
		$data['id_suplier'] = $this->input->post('id_suplier');

		$konten = $this->input->post('konten');

		if(!empty($konten)){
			$kon = implode(', ', $konten);
			$data['konten_obat'] = $kon;
		}

		// print_r($data);

		$cek = $this->db->get_where('obat', ['nama_obat'=>$data['nama_obat']])->num_rows();
		if($cek > 0){
			$this->session->set_flashdata('warning', 'Nama obat sudah ada !');
			redirect(base_url('master/obat'));
		}else{
			$this->db->insert('obat', $data);
			$this->session->set_flashdata('success', 'Berhasil menambahkan data !');
			redirect(base_url('master/obat'));
		}
	}

	function detail_obat(){
		$id_obat = $this->input->post('id_obat');
		$data = $this->master->detail_obat($id_obat)->row_array();
		echo json_encode($data);
	}

	function edit_obat(){
		$id_obat = $this->uri->segment(3);
		$data['suplier'] = $this->db->get('suplier')->result();
		$data['konten'] = $this->db->get('konten')->result();
		$data['obat'] = $this->master->detail_obat($id_obat)->row_array();
		$this->load->view('edit_obat', $data);
	}

	// function update_obat(){
	// 	$id_obat = $this->input->post('id_obat');
	// 	$data['nama_obat'] = ucwords($this->input->post('nama_obat'));
	// 	$data['stok'] = $this->input->post('stok');
	// 	$data['harga'] = str_replace('.', '', $this->input->post('harga'));
	// 	$data['id_suplier'] = $this->input->post('id_suplier');

	// 	$update = $this->db->update('obat', $data, ['id_obat'=>$id_obat]);
	// 	if($update){
	// 		echo json_encode('sukses');
	// 	}
	// }

	function perbarui_obat(){
		$id_obat = $this->input->post('id_obat');
		$data['nama_obat'] = ucwords($this->input->post('nama_obat'));
		$data['stok'] = $this->input->post('stok');
		$data['harga'] = str_replace('.', '', $this->input->post('harga'));
		$data['id_suplier'] = $this->input->post('id_suplier');

		$konten = $this->input->post('konten');

		if(!empty($konten)){
			$kon = implode(', ', $konten);
			$data['konten_obat'] = $kon;
		}

		$update = $this->db->update('obat', $data, ['id_obat'=>$id_obat]);
		if($update){
			$this->session->set_flashdata('success', 'Berhasil merubah data !');
			redirect(base_url('master/obat'));
		}
	}

	function delete_obat(){
		$id_obat = $this->input->post('id_obat');
		$delete = $this->db->delete('obat', ['id_obat'=>$id_obat]);
		if($delete){
			echo json_encode('sukses');
		}
	}

	function search_obat(){
		$key = $this->input->post('search');
		$data = $this->master->search_obat($key)->result();
		echo json_encode($data);
	}


	// =================================================
	// ||            MASTER KONTEN OBAT               ||
	// =================================================


	public function konten(){
		
		$this->load->view('konten');
	}

	function show_konten(){
		$data = $this->master->tampil_konten()->result();
		echo json_encode($data);
	}

	function save_konten(){
		$data['nama_konten'] = strtoupper($this->input->post('nama_konten'));

		$cek = $this->db->get_where('konten', ['nama_konten'=>$data['nama_konten']])->num_rows();
		if($cek > 0){
			echo json_encode('duplikasi');
		}else{
			$this->db->insert('konten', $data);
			echo json_encode('sukses');
		}
	}

	function detail_konten(){
		$id_konten = $this->input->post('id_konten');
		$data = $this->db->get_where('konten', ['id_konten'=>$id_konten])->row_array();
		echo json_encode($data);
	}

	function update_konten(){
		$id_konten = $this->input->post('id_konten');
		$data['nama_konten'] = strtoupper($this->input->post('nama_konten'));

		$update = $this->db->update('konten', $data, ['id_konten'=>$id_konten]);
		if($update){
			echo json_encode('sukses');
		}
	}

	function delete_konten(){
		$id_konten = $this->input->post('id_konten');
		$delete = $this->db->delete('konten', ['id_konten'=>$id_konten]);
		if($delete){
			echo json_encode('sukses');
		}
	}

	function search_konten(){
		$key = $this->input->post('search');
		$data = $this->master->search_konten($key)->result();
		echo json_encode($data);
	}


	// =================================================
	// ||                 MASTER DIAGNOSA              ||
	// =================================================


	public function diagnosa(){
		
		$this->load->view('diagnosa');
	}

	function show_diagnosa(){
		$data = $this->master->tampil_diagnosa()->result();
		echo json_encode($data);
	}

	function save_diagnosa(){
		$data['kode_diagnosa'] = strtoupper($this->input->post('kode_diagnosa'));
		$data['nama_diagnosa'] = strtoupper($this->input->post('nama_diagnosa'));

		$cek = $this->db->get_where('master_diagnosa', ['kode_diagnosa'=>$data['kode_diagnosa']])->num_rows();
		if($cek > 0){
			echo json_encode('duplikasi');
		}else{
			$this->db->insert('master_diagnosa', $data);
			echo json_encode('sukses');
		}
	}

	function detail_diagnosa(){
		$kode_diagnosa = $this->input->post('kode_diagnosa');
		$data = $this->db->get_where('master_diagnosa', ['kode_diagnosa'=>$kode_diagnosa])->row_array();
		echo json_encode($data);
	}

	function update_diagnosa(){
		$kode_diagnosa = strtoupper($this->input->post('kode_diagnosa'));
		$data['nama_diagnosa'] = strtoupper($this->input->post('nama_diagnosa'));

		$update = $this->db->update('master_diagnosa', $data, ['kode_diagnosa'=>$kode_diagnosa]);
		if($update){
			echo json_encode('sukses');
		}
	}

	function delete_diagnosa(){
		$kode_diagnosa = $this->input->post('kode_diagnosa');
		$delete = $this->db->delete('master_diagnosa', ['kode_diagnosa'=>$kode_diagnosa]);
		if($delete){
			echo json_encode('sukses');
		}
	}

	function search_diagnosa(){
		$key = $this->input->post('search');
		$data = $this->master->search_diagnosa($key)->result();
		echo json_encode($data);
	}

}