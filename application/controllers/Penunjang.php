<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Penunjang extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('M_klinik', 'klinik');
	}

	public function lab(){
		$data['pendaftaran'] = $this->klinik->riwayat_lab()->result();
		$this->load->view('lab_index', $data);
	}

	public function addLab(){
		$this->load->view('lab_add');
	}

	public function rad(){
		$this->load->view('rad');
	}

	function autocomplete_lab(){
		if (isset($_GET['term'])) {
		  	$result = $this->klinik->autocomplete_lab($_GET['term']);
		   	if (count($result) > 0) {
		    foreach ($result as $row)


		     	$arr_result[] = array(

					'label'			=> $row->no_rm.' - '.$row->nama_px.' - '.$row->tgl_lahir_px.' - '.$row->alamat_px,
					'no_rm'			=> $row->no_rm,
					'nama_px'		=> $row->nama_px,
					'alamat_px'		=> $row->alamat_px,
					'id_kunjungan'	=> $row->id_kunjungan,
					// 'jk_px'			=> $jk,
					'jk_px'			=> $row->jk_px,
					'tempat_lahir_px'	=> $row->tempat_lahir_px,
					'tgl_lahir_px'		=> $row->tgl_lahir_px,
					// 'asuransi_px'		=> $as,
					'asuransi_px'		=> $row->asuransi_px,
					'asuransi_lain_px'		=> $row->asuransi_lain_px,
				);
		     	echo json_encode($arr_result);
		   	}
		}
	}

	function autocomplete_rad(){
		if (isset($_GET['term'])) {
		  	$result = $this->klinik->autocomplete_rad($_GET['term']);
		   	if (count($result) > 0) {
		    foreach ($result as $row)


		     	$arr_result[] = array(

					'label'			=> $row->no_rm.' - '.$row->nama_px.' - '.$row->tgl_lahir_px.' - '.$row->alamat_px,
					'no_rm'			=> $row->no_rm,
					'nama_px'		=> $row->nama_px,
					'alamat_px'		=> $row->alamat_px,
					'id_kunjungan'	=> $row->id_kunjungan,
					// 'jk_px'			=> $jk,
					'jk_px'			=> $row->jk_px,
					'tempat_lahir_px'	=> $row->tempat_lahir_px,
					'tgl_lahir_px'		=> $row->tgl_lahir_px,
					// 'asuransi_px'		=> $as,
					'asuransi_px'		=> $row->asuransi_px,
					'asuransi_lain_px'		=> $row->asuransi_lain_px,
				);
		     	echo json_encode($arr_result);
		   	}
		}
	}

	function save_lab(){
		$id = $this->input->post('id_kunjungan');
		$data['kolesterol'] = $this->input->post('kolesterol');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['gda'] = $this->input->post('gda');
		$data['gdp'] = $this->input->post('gdp');
		$data['gdsm'] = $this->input->post('gdsm');
		$data['gd'] = $this->input->post('resultGd');
		$data['hb'] = $this->input->post('hb');
		$data['trombosit'] = $this->input->post('trombosit');
		$data['sgot'] = $this->input->post('sgot');
		$data['sgpt'] = $this->input->post('sgpt');
		$data['asamurat'] = $this->input->post('asamurat');
		$data['widal'] = $this->input->post('widal');
		$data['lain'] = $this->input->post('lain');
		$data['jenis_lab'] = 1;

		$this->db->insert('lab', $data);

		$this->db->order_by('id_lab', 'DESC');
		$this->db->limit('1');
		$cek = $this->db->get('lab')->row_array();

		$update = $this->db->update('kunjungan', ['id_lab'=>$cek['id_lab']], ['id_kunjungan'=>$id]);
		if($update){
			$this->session->set_flashdata('success', 'Berhasil menambahkan data lab');
			redirect(base_url('penunjang/lab'));

		}
	}

	function save_rad(){
		$id = $this->input->post('id_kunjungan');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['hasil'] = $this->input->post('hasil');
		$data['jenis_pemeriksaan'] = $this->input->post('jenis_pemeriksaan');
		$data['jenis'] = 1;

		$this->db->insert('radiologi', $data);

		$this->db->order_by('id_radiologi', 'DESC');
		$this->db->limit('1');
		$cek = $this->db->get('radiologi')->row_array();

		$update = $this->db->update('kunjungan', ['id_radiologi'=>$cek['id_radiologi']], ['id_kunjungan'=>$id]);
		if($update){
			$this->session->set_flashdata('success', 'Berhasil menambahkan data radiologi');
			redirect(base_url('penunjang/rad'));

		}
	}

	function riwayat_lab(){
		$data['pendaftaran'] = $this->klinik->riwayat_lab()->result();
		$this->load->view('riwayat_lab', $data);
	}

	function edit_lab(){
		$status = $this->uri->segment(4);
		$id_lab = $this->uri->segment(3);

		if($status ==  0){
	      $ket = 'Menunggu';
	    }elseif($status ==  1){
	      $ket = 'Diperiksa';
	    }elseif($status ==  2){
	      $ket = 'Menunggu Obat';
	    }elseif($status ==  3){
	      $ket = 'Menunggu Pembayaran';
	    }elseif($status ==  4){
	      $ket = 'Selesai';
	    }

		if($status > 1){
			$this->session->set_flashdata('warning', 'Tidak dapat merubah data, status kunjungan '.$ket);
			redirect(base_url('penunjang/riwayat_lab'));
		}else{
			$data['lab'] = $this->db->get_where('lab', ['id_lab'=>$id_lab])->row_array();
			$data['kunj'] = $this->klinik->edit_lab($id_lab)->row_array();
			$this->load->view('edit_lab', $data);
		}
	}

	function update_lab(){
		$id_lab = $this->input->post('id_lab');
		$data['kolesterol'] = $this->input->post('kolesterol');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['gda'] = $this->input->post('gda');
		$data['gdp'] = $this->input->post('gdp');
		$data['gdsm'] = $this->input->post('gdsm');
		$data['gd'] = $this->input->post('resultGd');
		$data['lain'] = $this->input->post('lain');

		$update = $this->db->update('lab', $data, ['id_lab'=>$id_lab]);

		if($update){
			$this->session->set_flashdata('success', 'Berhasil merubah data lab');
			redirect(base_url('penunjang/riwayat_lab'));

		}
	}

	function riwayat_rad(){
		$data['pendaftaran'] = $this->klinik->riwayat_rad()->result();
		$this->load->view('riwayat_rad', $data);
	}

	function edit_rad(){
		$status = $this->uri->segment(4);
		$id_rad = $this->uri->segment(3);

		if($status ==  0){
	      $ket = 'Menunggu';
	    }elseif($status ==  1){
	      $ket = 'Diperiksa';
	    }elseif($status ==  2){
	      $ket = 'Menunggu Obat';
	    }elseif($status ==  3){
	      $ket = 'Menunggu Pembayaran';
	    }elseif($status ==  4){
	      $ket = 'Selesai';
	    }

		if($status > 1){
			$this->session->set_flashdata('warning', 'Tidak dapat merubah data, status kunjungan '.$ket);
			redirect(base_url('penunjang/riwayat_lab'));
		}else{
			$data['rad'] = $this->db->get_where('radiologi', ['id_radiologi'=>$id_rad])->row_array();
			$data['kunj'] = $this->klinik->edit_rad($id_rad)->row_array();
			$this->load->view('edit_rad', $data);
		}
	}

	function update_rad(){
		$id_rad = $this->input->post('id_radiologi');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['jenis_pemeriksaan'] = $this->input->post('jenis_pemeriksaan');
		$data['hasil'] = $this->input->post('hasil');

		$update = $this->db->update('radiologi', $data, ['id_radiologi'=>$id_rad]);

		if($update){
			$this->session->set_flashdata('success', 'Berhasil merubah data radiologi');
			redirect(base_url('penunjang/riwayat_rad'));

		}
	}
}
