<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pendaftaran extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('M_pendaftaran', 'daftar');
		$this->load->model('M_apotek', 'apotek');

		// STATUS KUNJUNGAN
		// 0 MENUNGGU
		// 1 DIPERIKSA
		// 2 MENUNGGU OBAT
		// 3 MENUNGGU PEMBAYARAN
		// 4 SELESAI
	}

	public function index(){
		$this->load->view('pendaftaran');
	}

	public function list_pendaftaran(){
		$data['pendaftaran'] = $this->daftar->list_pendaftaran()->result();
		// print_r($data);
		$this->load->view('list_pendaftaran', $data);
	}

	public function auto(){
		$no_rm = $this->uri->segment(3);
		$data['px'] = $this->db->get_where('pasien', ['no_rm'=>$no_rm])->row_array();
		$this->load->view('auto_pendaftaran', $data);
	}

	function save(){
		if($this->input->post('dataLab') == 1){
			$data['id_lab'] = $this->save_lab();
		}

		if($this->input->post('dataRad') == 1){
			$data['id_radiologi'] = $this->save_rad();
		}

		$data['no_rm'] = $this->input->post('no_rm');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['tgl_kunjungan'] = date('Y-m-d');
		$data['waktu_kunjungan'] = date('H:i:s');
		$data['anamnesa'] = $this->input->post('anamnesa');
		$data['sistol'] = $this->input->post('sistol');
		$data['diastol'] = $this->input->post('diastol');
		$data['td'] = $this->input->post('resultTd');
		$data['bb'] = $this->input->post('bb');
		$data['tb'] = $this->input->post('tb');
		$data['imt'] = $this->input->post('resultImt');
		$data['merokok'] = $this->input->post('merokok');
		$data['aktivitas_fisik'] = $this->input->post('aktivitas_fisik');
		$data['riwayat_kel_stroke'] = $this->input->post('riwayat_keluarga_stroke');
		$data['riwayat_kel_dm'] = $this->input->post('riwayat_keluarga_dm');
		$data['risiko_stroke'] = $this->input->post('risiko_stroke');
		$data['status_kunjungan'] = 0;


		// print_r($data);

		$simpan = $this->db->insert('kunjungan', $data);
		if($simpan){
			$this->session->set_flashdata('success', 'Berhasil menambahkan data');
			redirect(base_url('pendaftaran'));
		}
	}

	function save_lab(){
		if($this->input->post('dataLab') == 1){
			$data['kolesterol'] = $this->input->post('kolesterol');
			$data['id_user'] = $this->session->userdata('id_user');
			$data['gda'] = $this->input->post('gda');
			$data['gdp'] = $this->input->post('gdp');
			$data['gdsm'] = $this->input->post('gdsm');
			$data['gd'] = $this->input->post('resultGd');

			$this->db->insert('lab', $data);

			$this->db->order_by('id_lab', 'DESC');
			$this->db->limit('1');
			$cek = $this->db->get('lab')->row_array();
			return ($cek['id_lab']);
		}
	}

	function update_lab($id_lab){
		if($this->input->post('dataLab') == 1){
			$data['kolesterol'] = $this->input->post('kolesterol');
			$data['id_user'] = $this->session->userdata('id_user');
			$data['gda'] = $this->input->post('gda');
			$data['gdp'] = $this->input->post('gdp');
			$data['gdsm'] = $this->input->post('gdsm');
			$data['gd'] = $this->input->post('resultGd');

			$this->db->update('lab', $data, ['id_lab'=>$id_lab]);
		}
	}

	function save_rad(){
		if($this->input->post('dataRad') == 1){
			$data['id_user'] = $this->session->userdata('id_user');
			$data['jenis'] = 0;
			$data['hasil'] = $this->input->post('hasil');

			$this->db->insert('radiologi', $data);

			$this->db->order_by('id_radiologi', 'DESC');
			$this->db->limit('1');
			$cek = $this->db->get('radiologi')->row_array();
			return ($cek['id_radiologi']);
		}
	}

	function update_rad($id_radiologi){
		if($this->input->post('dataRad') == 1){
			$data['id_user'] = $this->session->userdata('id_user');
			$data['jenis'] = 0;
			$data['hasil'] = $this->input->post('hasil');

			$this->db->update('radiologi', $data, ['id_radiologi'=>$id_radiologi]);
		}
	}

	function autocomplete(){
		if (isset($_GET['term'])) {
		  	$result = $this->daftar->autocomplete($_GET['term']);
		   	if (count($result) > 0) {
		    foreach ($result as $row)
	     		

		     	$arr_result[] = array(

					'label'			=> $row->no_rm.' - '.$row->nama_px.' - '.$row->tgl_lahir_px.' - '.$row->alamat_px,
					'no_rm'			=> $row->no_rm,
					'nama_px'		=> $row->nama_px,
					'alamat_px'		=> $row->alamat_px,
					// 'jk_px'			=> $jk,
					'jk_px'			=> $row->jk_px,
					'tempat_lahir_px'	=> $row->tempat_lahir_px,
					'tgl_lahir_px'		=> $row->tgl_lahir_px,
					// 'asuransi_px'		=> $as,
					'asuransi_px'		=> $row->asuransi_px,
					'asuransi_lain_px'		=> $row->asuransi_lain_px,
					'alergi_px'		=> $row->alergi_px,
				);
		     	echo json_encode($arr_result);
		   	}
		}
	}

	function detail(){
		$id = $this->uri->segment(3);

		$data['kunj']  = $this->daftar->detail($id)->row_array();
		$data['status_lab'] = $this->db->get_where('kunjungan', ['id_lab'=> null, 'id_kunjungan'=>$id])->num_rows();
		$data['status_rad'] = $this->db->get_where('kunjungan', ['id_radiologi'=> null, 'id_kunjungan'=>$id])->num_rows();
		$data['status_resep'] = $this->db->get_where('resep', ['id_kunjungan'=>$id])->num_rows();
		$data['status_diag'] = $this->db->get_where('diagnosa', ['id_kunjungan'=>$id])->num_rows();
		$data['resep'] = $this->apotek->show_resep($id)->result();
		$data['dx'] = $this->daftar->diagnosa($id)->result();
		$this->load->view('detail_pendaftaran', $data);
	}

	function edit(){
		$id = $this->uri->segment(3);
		$data['kunj'] = $this->daftar->detail($id)->row_array();
		$this->load->view('edit_pendaftaran', $data);
	}

	function update(){

		$id_kunjungan = $this->input->post('id_kunjungan');
		$dataLab = $this->input->post('dataLab');
		$dataRad = $this->input->post('dataRad');

		$row = $this->db->get_where('kunjungan', ['id_kunjungan'=>$id_kunjungan])->row_array();

		if($dataLab == 0){
			if($row['id_lab']  != null){
				$this->db->delete('lab', ['id_lab'=>$row['id_lab']]);
				$data['id_lab'] = null;
			}
		}else{
			$cek = $this->db->get_where('lab', ['id_lab'=>$row['id_lab']])->row_array();
			if($cek['id_lab']==null){
				$data['id_lab'] = $this->save_lab();
			}else{
				$this->update_lab($row['id_lab']);
			}
		}

		$cek = $this->db->get_where('radiologi', ['id_radiologi'=>$row['id_radiologi']])->row_array();
		if($dataRad == 0){
			if($cek['id_radiologi']!=null){
				$this->db->delete('radiologi', ['id_radiologi'=>$cek['id_radiologi']]);				
				$data['id_radiologi'] = null;
			}
		}else{
			if($cek['id_radiologi']==null){
				$data['id_radiologi'] = $this->save_rad();
			}else{
				$this->update_rad($row['id_radiologi']);
			}
		}

		$data['id_user'] = $this->session->userdata('id_user');
		$data['tgl_kunjungan'] = date('Y-m-d');
		$data['waktu_kunjungan'] = date('H:i:s');
		$data['anamnesa'] = $this->input->post('anamnesa');
		$data['sistol'] = $this->input->post('sistol');
		$data['diastol'] = $this->input->post('diastol');
		$data['td'] = $this->input->post('resultTd');
		$data['bb'] = $this->input->post('bb');
		$data['tb'] = $this->input->post('tb');
		$data['imt'] = $this->input->post('resultImt');
		$data['merokok'] = $this->input->post('merokok');
		$data['aktivitas_fisik'] = $this->input->post('aktivitas_fisik');
		$data['riwayat_kel_stroke'] = $this->input->post('riwayat_keluarga_stroke');
		$data['riwayat_kel_dm'] = $this->input->post('riwayat_keluarga_dm');
		$data['risiko_stroke'] = $this->input->post('risiko_stroke');

		$update = $this->db->update('kunjungan', $data, ['id_kunjungan'=>$id_kunjungan]);
		if($update){
			$this->session->set_flashdata('success', 'Berhasil merubah data');
			redirect(base_url('pendaftaran/list_pendaftaran'));
		}
	}

	function delete(){
		$id_kunjungan = $this->uri->segment(3);
		$delete = $this->db->delete('kunjungan', ['id_kunjungan'=>$id_kunjungan]);
		if($delete){
			$this->session->set_flashdata('success', 'Berhasil menghapus data');
			redirect(base_url('pendaftaran/list_pendaftaran'));
		}else{
			$this->session->set_flashdata('warning', 'Gagal menghapus data');
			redirect(base_url('pendaftaran/list_pendaftaran'));
		}
	}
}