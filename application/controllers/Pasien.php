<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pasien extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('M_pasien', 'px');
		$this->load->model('M_pendaftaran', 'daftar');
	}

	public function index(){
		$data['px'] = $this->db->get('pasien')->result();
		$this->load->view('pasien', $data);
	}

	function add(){
		$data['provinsi'] = $this->db->get('provinsi')->result();
		$data['kota_kab'] = $this->db->get('kota_kab')->result();
		$this->load->view('add_pasien', $data);

	}

	function save(){
		$last_rm = $this->px->last_rm()->row_array();
		$no_rm = $last_rm['no_rm']+1;

		$tgl = explode('/', $this->input->post('tgl_lahir_px'));

		$data['no_rm']				= sprintf('%06s', $no_rm);
		$data['nama_px']			= strtoupper($this->input->post('nama_px'));
		$data['nik_px']				= $this->input->post('nik_px');
		$data['jk_px']				= $this->input->post('jk_px');
		$data['tempat_lahir_px']	= strtoupper($this->input->post('tempat_lahir_px'));
		$data['tgl_lahir_px']		= $tgl[2].'-'.$tgl[1].'-'.$tgl[0];
		$data['alamat_px']			= strtoupper($this->input->post('alamat_px'));
		$data['id_provinsi']		= $this->input->post('id_provinsi');
		$data['id_kota_kab']		= $this->input->post('id_kota_kab');
		$data['id_kecamatan']		= $this->input->post('id_kecamatan');
		$data['id_desa']			= $this->input->post('id_desa');
		$data['pendidikan_px']		= $this->input->post('pendidikan_px');
		$data['asuransi_px']		= $this->input->post('asuransi_px');
		$data['asuransi_lain_px']	= strtoupper($this->input->post('asuransi_lain_px'));
		$data['no_asuransi_px']		= $this->input->post('no_asuransi_px');
		$data['pekerjaan_px']		= $this->input->post('pekerjaan_px');
		$data['telp_px']			= $this->input->post('telp_px');
		$data['agama_px']			= $this->input->post('agama_px');
		// $data['alergi_px']			= $this->input->post('alergi_px');

		$simpan = $this->db->insert('pasien', $data);
		if($simpan){
			redirect(base_url('pendaftaran/auto/'.sprintf('%06s', $no_rm)));
		}
	}

	function detail(){
		$no_rm = $this->uri->segment(3);
		$data['px'] = $this->px->detail_pasien($no_rm)->row_array();
		$data['pendaftaran'] = $this->daftar->riwayat($no_rm)->result();
		$this->load->view('detail_pasien', $data);
	}

	function edit(){
		$no_rm = $this->uri->segment(3);
		$data['px'] = $this->px->detail_pasien($no_rm)->row_array();
		$data['provinsi'] = $this->db->get('provinsi')->result();
		$data['kota_kab'] = $this->db->get('kota_kab')->result();
		$data['koka'] = $this->db->get_where('kota_kab', ['id_provinsi'=>$data['px']['id_provinsi']])->result();
		$data['kecamatan'] = $this->db->get_where('kecamatan', ['id_kota_kab'=>$data['px']['id_kota_kab']])->result();
		$data['desa'] = $this->db->get_where('desa', ['id_kecamatan'=>$data['px']['id_kecamatan']])->result();
		$this->load->view('edit_pasien', $data);
	}

	function update(){
		$tgl 	= explode('/', $this->input->post('tgl_lahir_px'));
		$no_rm	= $this->input->post('no_rm');

		$data['nama_px']			= strtoupper($this->input->post('nama_px'));
		$data['nik_px']				= $this->input->post('nik_px');
		$data['jk_px']				= $this->input->post('jk_px');
		$data['tempat_lahir_px']	= strtoupper($this->input->post('tempat_lahir_px'));
		$data['tgl_lahir_px']		= $tgl[2].'-'.$tgl[1].'-'.$tgl[0];
		$data['alamat_px']			= strtoupper($this->input->post('alamat_px'));
		$data['id_provinsi']		= $this->input->post('id_provinsi');
		$data['id_kota_kab']		= $this->input->post('id_kota_kab');
		$data['id_kecamatan']		= $this->input->post('id_kecamatan');
		$data['id_desa']			= $this->input->post('id_desa');
		$data['pendidikan_px']		= $this->input->post('pendidikan_px');
		$data['asuransi_px']		= $this->input->post('asuransi_px');
		$data['asuransi_lain_px']	= strtoupper($this->input->post('asuransi_lain_px'));
		$data['no_asuransi_px']		= $this->input->post('no_asuransi_px');
		$data['pekerjaan_px']		= $this->input->post('pekerjaan_px');
		$data['telp_px']			= $this->input->post('telp_px');
		$data['agama_px']			= $this->input->post('agama_px');
		$data['alergi_px']			= $this->input->post('alergi_px');

		$update = $this->db->update('pasien', $data, ['no_rm'=>$no_rm]);
		if($update){
			redirect(base_url('pasien/detail/'.$no_rm));
		}
		// print_r($data);
	}

	function delete(){
		$no_rm	= $this->uri->segment(3);

		$cek = $this->db->get_where('pasien', ['no_rm'=>$no_rm])->num_rows();
		if($cek > 0){
			// digunakan
			$this->session->set_flashdata('warning', 'Tidak dapat menghapus, data masih digunakan !');
			redirect('pasien');
		}else{
			$delete = $this->db->delete('pasien', ['no_rm'=>$no_rm]);
			if($delete){
				$this->session->set_flashdata('success', 'Berhasil menghapus data !');
				redirect('pasien');
			}
		}
	}

	function alergi(){
		if (isset($_GET['term'])) {
		  	$result = $this->px->autocomplete($_GET['term']);
		   	if (count($result) > 0) {
		    foreach ($result as $row)


		     	$arr_result[] = array(

					'label'			=> $row->nama_konten,
					'nama_konten'	=> $row->nama_konten,
				);
		     	echo json_encode($arr_result);
		   	}
		}
	}
}
