<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Klinik extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_klinik', 'klinik');
		$this->load->model('M_pendaftaran', 'daftar');
	}

	public function index()
	{
		$data['pendaftaran'] = $this->klinik->list_pendaftaran()->result();
		$this->load->view('klinik', $data);
	}

	function sudah_periksa()
	{
		$data['pendaftaran'] = $this->klinik->list_sudah_periksa()->result();
		$this->load->view('sudah_diperiksa', $data);
	}

	function periksa()
	{
		$id = $this->uri->segment(3);
		$this->db->update('kunjungan', ['status_kunjungan' => 1], ['id_kunjungan' => $id]);
		$data['kunj'] = $this->daftar->detail($id)->row_array();
		$data['tx'] = $this->db->get('master_tindakan')->result();
		$data['dx'] = $this->db->get('master_diagnosa')->result();
		$data['obat'] = $this->db->get('obat')->result();
		$this->load->view('periksa', $data);
	}

	function edit()
	{
		$id = $this->uri->segment(3);
		// $this->db->update('kunjungan', ['status_kunjungan'=>1], ['id_kunjungan'=>$id]);
		$data['kunj'] = $this->daftar->detail($id)->row_array();
		$data['tx'] = $this->db->get('master_tindakan')->result();
		$data['dx1'] = $this->klinik->dx($id, 1)->row_array();
		$data['dx2'] = $this->klinik->dx($id, 2)->row_array();
		$data['dx3'] = $this->klinik->dx($id, 3)->row_array();
		$data['obat'] = $this->db->get('obat')->result();
		$tx = $this->db->get_where('tindakan', ['id_kunjungan' => $id])->result();
		$dx = $this->db->get_where('diagnosa', ['id_kunjungan' => $id])->result();
		if (count($tx) > 0) {
			foreach ($tx as $t) {
				$tin[] = $t->kode_tindakan;
			}
			$data['tind'] = $tin;
		} else {
			$data['tind'] = null;
		}

		$this->load->view('edit_periksa', $data);
	}

	// function save_periksa(){
	// 	$data['id_kunjungan']	= $this->input->post('id_kunjungan');
	// 	$data['tgl_periksa']	= date('Y-m-d');
	// 	$data['waktu_periksa']	= date('H:i:s');
	// 	$data['id_user']		= $this->session->userdata('id_user');
	// 	$data['anamnesa']		= $this->input->post('anamnesa');
	// 	$data['sistol']			= $this->input->post('sistol');
	// 	$data['diastol']		= $this->input->post('diastol');
	// 	$data['bb']				= $this->input->post('bb');
	// 	$data['tb']				= $this->input->post('tb');
	// 	$data['merokok']		= $this->input->post('merokok');
	// 	$data['aktivitas_fisik']	= $this->input->post('aktivitas_fisik');
	// 	$data['riwayat_keluarga']	= $this->input->post('riwayat_keluarga');
	// 	$data['tekanan_darah']		= $this->input->post('tekanan_darah');
	// 	$data['imt']				= $this->input->post('imt');

	// 	$simpan = $this->db->insert('pemeriksaan', $data);
	// 	if($simpan){
	// 		$this->session->set_flashdata('success', 'Berhasil menambahkan pemeriksaan');
	// 		redirect(base_url('klinik'));
	// 	}
	// }

	function save_resep()
	{
		$data['id_user']		= $this->session->userdata('id_user');
		$data['tgl_resep']		= date('Y-m-d H:i:s');
		$data['id_obat']		= $this->input->post('id_obat');
		$data['jumlah']			= $this->input->post('jumlah');
		$data['aturan_pakai']	= $this->input->post('aturan_pakai');
		$data['id_kunjungan']	= $this->input->post('id_kunjungan');
		$data['cito']			= $this->input->post('cito');

		$cek = $this->db->get_where('resep', ['id_obat' => $data['id_obat'], 'id_kunjungan' => $data['id_kunjungan']])->num_rows();

		$obat = $this->db->get_where('obat', ['id_obat' => $data['id_obat']])->row_array();
		$stok_obat_awal = $obat['stok'];
		$stok_obat_akhir = $stok_obat_awal - $data['jumlah'];

		if ($stok_obat_awal <= 0) {
			// stokk abis
			echo json_encode(3);
		} else {
			// stok ada
			if ($stok_obat_akhir < 0) {
				// stok tidak cukup
				$log['status'] = 4;
				$log['sisa']   = $stok_obat_awal;
				echo json_encode($log);
			} else {
				// stok cukup
				if ($cek > 0) {
					// apakah obat sudah diinput
					echo json_encode(2);
				} else {
					$simpan = $this->db->insert('resep', $data);
					if ($simpan) {
						$new['stok'] = $stok_obat_akhir;
						$this->db->update('obat', $new, ['id_obat' => $data['id_obat']]);
						echo json_encode(1);
					} else {
						echo json_encode(0);
					}
				}
			}
		}
	}

	function show_resep()
	{
		$id_kunjungan = $this->input->post('id_kunjungan');
		$data = $this->klinik->show_resep($id_kunjungan)->result();
		echo json_encode($data);
	}

	function delete_resep()
	{
		$id = $this->input->post('id');
		$id_obat = $this->input->post('id_obat');
		$jumlah = $this->input->post('jumlah');
		$del = $this->db->delete('resep', ['id_resep' => $id]);
		$obat = $this->db->get_where('obat', ['id_obat' => $id_obat])->row_array();
		if ($del) {
			$stok_awal = $obat['stok'];
			$stok_akhir = $stok_awal + $jumlah;
			$this->db->update('obat', ['stok' => $stok_akhir], ['id_obat' => $id_obat]);
			echo json_encode(1);
		}
	}

	function kembalikan_stok($id_obat, $jumlah)
	{
		$obat = $this->db->get_where('obat', ['id_obat' => $id_obat])->row_array();
		$stok_awal = $obat['stok'];
		$stok_akhir = $stok_awal + $jumlah;
		$this->db->update('obat', ['stok' => $stok_akhir], ['id_obat' => $id_obat]);
	}

	function delete_resep_all()
	{
		$id = $this->input->post('id');

		$cek = $this->db->get_where('resep', ['id_kunjungan' => $id])->result();
		foreach ($cek as $row) {
			$this->kembalikan_stok($row->id_obat, $row->jumlah);
		}

		$del = $this->db->delete('resep', ['id_kunjungan' => $id]);
		if ($del) {
			echo json_encode(1);
		}
	}

	function save()
	{
		$id_kunjungan = $this->input->post('id_kunjungan');
		$anamnesa = $this->input->post('anamnesa');
		$alergi = $this->input->post('alergi_obat');
		// $simpan = $this->db->insert('pasien', $data);

		$this->db->update('kunjungan', ['anamnesa' => $anamnesa], ['id_kunjungan' => $id_kunjungan]);
		$cek = $this->db->get_where('kunjungan', ['id_kunjungan' => $id_kunjungan])->row_array();
		$this->db->update('pasien', ['alergi_px' => $alergi], ['no_rm' => $cek['no_rm']]);
		if ($cek['id_lab'] == null) {
			if ($this->input->post('dataLab') == 1) {
				$data['id_lab'] = $this->save_lab($id_kunjungan);
			}
		}

		if ($this->input->post('dataRad') == 1) {
			$data['id_radiologi'] = $this->save_rad($id_kunjungan);
		}

		$data['dokter'] =  $this->session->userdata('id_user');
		if (isset($data)) {
			$update = $this->db->update('kunjungan', $data, ['id_kunjungan' => $this->input->post('id_kunjungan')]);
		}

		$this->save_diagnosa($id_kunjungan);
		$this->save_tindakan();

		$cek = $this->klinik->cek_resep($this->input->post('id_kunjungan'))->result();
		if (count($cek) > 0) {
			$stts['status_kunjungan'] = 2;
		} else {
			$stts['status_kunjungan'] = 3;
		}
		$this->session->set_flashdata('success', 'Berhasil menambahkan data');
		$this->db->update('kunjungan', $stts, ['id_kunjungan' => $this->input->post('id_kunjungan')]);
		redirect(base_url('klinik'));
	}

	function save_diagnosa($id)
	{
		$diagnosa = $this->input->post('diagnosa');

		$this->db->delete('diagnosa', ['id_kunjungan' => $id]);

		$kode_diagnosa1 = $this->input->post('kode_diagnosa1');
		$kode_diagnosa2 = $this->input->post('kode_diagnosa2');
		$kode_diagnosa3 = $this->input->post('kode_diagnosa3');


		if (!empty($kode_diagnosa1)) {

			$cek1 = $this->db->get_where('master_diagnosa', ['kode_diagnosa' => $kode_diagnosa1])->num_rows();
			if ($cek1 > 0) {
				$data['id_kunjungan'] 		= $id;
				$data['tanggal_diagnosa'] 	= date('Y-m-d');
				$data['id_user']			= $this->session->userdata('id_user');
				$data['kode_diagnosa'] = $kode_diagnosa1;
				$data['jenis'] = 1;
				$this->db->insert('diagnosa', $data);
				reset($data);
			} else {
				$a['kode_diagnosa'] = strtoupper($this->input->post('kode_diagnosa1'));
				$a['nama_diagnosa'] = strtoupper($this->input->post('diagnosa1'));
				$this->db->insert('master_diagnosa', $a);
				$data['kode_diagnosa'] = strtoupper($this->input->post('kode_diagnosa1'));
				$data['jenis'] = 1;
				$this->db->insert('diagnosa', $data);
				reset($data);
			}
		}

		if (!empty($kode_diagnosa2)) {
			$cek2 = $this->db->get_where('master_diagnosa', ['kode_diagnosa' => $kode_diagnosa2])->num_rows();
			if ($cek2 > 0) {
				$data['id_kunjungan'] 		= $id;
				$data['tanggal_diagnosa'] 	= date('Y-m-d');
				$data['id_user']			= $this->session->userdata('id_user');
				$data['kode_diagnosa'] = $kode_diagnosa2;
				$data['jenis'] = 2;
				$this->db->insert('diagnosa', $data);
				reset($data);
			} else {
				$a['kode_diagnosa'] = strtoupper($this->input->post('kode_diagnosa2'));
				$a['nama_diagnosa'] = strtoupper($this->input->post('diagnosa2'));
				$this->db->insert('master_diagnosa', $a);
				$data['kode_diagnosa'] = strtoupper($this->input->post('kode_diagnosa2'));
				$data['jenis'] = 2;
				$this->db->insert('diagnosa', $data);
				reset($data);
			}
		}

		if (!empty($kode_diagnosa3)) {

			$cek3 = $this->db->get_where('master_diagnosa', ['kode_diagnosa' => $kode_diagnosa3])->num_rows();
			if ($cek3 > 0) {
				$data['id_kunjungan'] 		= $id;
				$data['tanggal_diagnosa'] 	= date('Y-m-d');
				$data['id_user']			= $this->session->userdata('id_user');
				$data['kode_diagnosa'] 		= $kode_diagnosa3;
				$data['jenis'] = 3;
				$this->db->insert('diagnosa', $data);
				reset($data);
			} else {
				$a['kode_diagnosa'] = strtoupper($this->input->post('kode_diagnosa3'));
				$a['nama_diagnosa'] = strtoupper($this->input->post('diagnosa3'));
				$this->db->insert('master_diagnosa', $a);
				$data['kode_diagnosa'] = strtoupper($this->input->post('kode_diagnosa3'));
				$data['jenis'] = 3;
				$this->db->insert('diagnosa', $data);
				reset($data);
			}
		}
	}

	function save_lab($id)
	{
		$cek = $this->db->get_where('kunjungan', ['id_kunjungan' => $id])->row_array();
		if ($cek['id_lab'] == null) {
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
			$data['jenis_lab'] = 0;

			$this->db->insert('lab', $data);

			$this->db->order_by('id_lab', 'DESC');
			$this->db->limit('1');
			$cek = $this->db->get('lab')->row_array();
			return ($cek['id_lab']);
		}
	}

	function update_lab($id_lab)
	{
		if ($this->input->post('dataLab') == 1) {
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

			$this->db->update('lab', $data, ['id_lab' => $id_lab]);
		}
	}

	function save_rad($id)
	{
		$cek = $this->db->get_where('kunjungan', ['id_kunjungan' => $id])->row_array();
		if ($cek['id_radiologi'] != null) {
			$data['id_user'] = $this->session->userdata('id_user');
			$data['jenis_pemeriksaan'] = $this->input->post('jenis_pemeriksaan');
			$data['jenis'] = 0;
			$data['hasil'] = $this->input->post('hasil');

			$this->db->insert('radiologi', $data);

			$this->db->order_by('id_radiologi', 'DESC');
			$this->db->limit('1');
			$cek = $this->db->get('radiologi')->row_array();
			return ($cek['id_radiologi']);
		}
	}

	function update_rad($id_radiologi)
	{
		if ($this->input->post('dataRad') == 1) {
			$data['id_user'] = $this->session->userdata('id_user');
			$data['jenis_pemeriksaan'] = $this->input->post('jenis_pemeriksaan');
			$data['jenis'] = 0;
			$data['hasil'] = $this->input->post('hasil');

			$this->db->update('radiologi', $data, ['id_radiologi' => $id_radiologi]);
		}
	}

	function save_tindakan()
	{
		$tindakan = $this->input->post('tindakan');

		$this->db->delete('tindakan', ['id_kunjungan' => $this->input->post('id_kunjungan')]);

		for ($i = 0; $i < count($tindakan); $i++) {
			$data['id_kunjungan'] 	= $this->input->post('id_kunjungan');
			$data['tgl_tindakan'] 	= date('Y-m-d H:i:s');
			$data['id_user']		= $this->session->userdata('id_user');
			$data['kode_tindakan'] = $tindakan[$i];

			$this->db->insert('tindakan', $data);
		}
	}

	function update()
	{
		$dx = $this->input->post('diagnosa');
		$dx_rek = $this->input->post('dx_rek');
		$id_kunjungan = $this->input->post('id_kunjungan');

		$dataLab = $this->input->post('dataLab');
		$dataRad = $this->input->post('dataRad');

		$row = $this->db->get_where('kunjungan', ['id_kunjungan' => $id_kunjungan])->row_array();

		if ($row['status_kunjungan'] == 4) {
			$this->session->set_flashdata('warning', 'Tidak dapat merubah data, status kunjungan sudah selesai');
			redirect(base_url('klinik/sudah_periksa'));
		}

		if ($dataLab == 0) {
			if ($row['id_lab']  != null) {
				$this->db->delete('lab', ['id_lab' => $row['id_lab']]);
				$data['id_lab'] = null;
			}
		} else {
			$cek = $this->db->get_where('lab', ['id_lab' => $row['id_lab']])->row_array();
			if ($cek['id_lab'] == null) {
				$data['id_lab'] = $this->save_lab($id_kunjungan);
			} else {
				$this->update_lab($row['id_lab']);
			}
		}

		$cek = $this->db->get_where('radiologi', ['id_radiologi' => $row['id_radiologi']])->row_array();
		if ($dataRad == 0) {
			if ($cek['id_radiologi'] != null) {
				$this->db->delete('radiologi', ['id_radiologi' => $cek['id_radiologi']]);
				$data['id_radiologi'] = null;
			}
		} else {
			if ($cek['id_radiologi'] == null) {
				$data['id_radiologi'] = $this->save_rad();
			} else {
				$this->update_rad($row['id_radiologi']);
			}
		}

		$this->save_diagnosa($id_kunjungan);
		// $update = $this->db->update('kunjungan', $data, ['id_kunjungan'=>$id_kunjungan]);
		$this->save_tindakan();

		// if($update){
		$this->session->set_flashdata('success', 'Berhasil merubah data');
		$this->db->update('kunjungan', ['status_kunjungan' => 2], ['id_kunjungan' => $this->input->post('id_kunjungan')]);
		redirect(base_url('klinik/sudah_periksa'));
		// }
	}

	function pengantar_lab()
	{
		$id = $this->uri->segment(3);
		$data['kunj'] = $this->klinik->pengantar($id)->row_array();
		$data['nama_klinik'] = $this->db->get_where('config', ['id_config' => 1])->row_array();
		$data['alamat_klinik'] = $this->db->get_where('config', ['id_config' => 2])->row_array();
		$data['telp_klinik'] = $this->db->get_where('config', ['id_config' => 3])->row_array();
		$data['website_klinik'] = $this->db->get_where('config', ['id_config' => 4])->row_array();
		$data['email_klinik'] = $this->db->get_where('config', ['id_config' => 5])->row_array();
		$this->load->view('pengantar_lab', $data);
	}

	function pengantar_rad()
	{
		$id = $this->uri->segment(3);
		$data['kunj'] = $this->klinik->pengantar($id)->row_array();
		$data['nama_klinik'] = $this->db->get_where('config', ['id_config' => 1])->row_array();
		$data['alamat_klinik'] = $this->db->get_where('config', ['id_config' => 2])->row_array();
		$data['telp_klinik'] = $this->db->get_where('config', ['id_config' => 3])->row_array();
		$data['website_klinik'] = $this->db->get_where('config', ['id_config' => 4])->row_array();
		$data['email_klinik'] = $this->db->get_where('config', ['id_config' => 5])->row_array();
		$this->load->view('pengantar_rad', $data);
	}

	function hapus_lab()
	{
		$id = $this->input->post('id');
		$data = $this->db->get_where('kunjungan', ['id_kunjungan' => $id])->row_array();
		$id_lab = $data['id_lab'];
		if ($id_lab != null) {
			$this->db->delete('lab', ['id_lab' => $id_lab]);
			$this->db->update('kunjungan', ['id_lab' => null], ['id_kunjungan' => $id]);
		}

		echo json_encode(1);
	}

	function hapus_rad()
	{
		$id = $this->input->post('id');
		$data = $this->db->get_where('kunjungan', ['id_kunjungan' => $id])->row_array();
		$id_rad = $data['id_radiologi'];
		if ($id_rad != null) {
			$this->db->delete('radiologi', ['id_radiologi' => $id_rad]);
			$this->db->update('kunjungan', ['id_radiologi' => null], ['id_kunjungan' => $id]);
		}

		echo json_encode(1);
	}

	function auto_diagnosa()
	{
		if (isset($_GET['term'])) {
			$result = $this->klinik->autocomplete($_GET['term']);
			if (count($result) > 0) {
				foreach ($result as $row)

					$arr_result[] = array(

						'label'				=> $row->nama_diagnosa,
						'kode_diagnosa'		=> $row->kode_diagnosa,
						'nama_diagnosa'		=> $row->nama_diagnosa,
					);
				echo json_encode($arr_result);
			}
		}
	}

	function cek_alergi()
	{
		$alergi_px = $this->input->post('alergi_px');
		$id_obat = $this->input->post('id_obat');

		$cek = $this->db->get_where('obat', ['id_obat' => $id_obat])->row_array();
		$konten = $cek['konten_obat'];
		$ex = explode(', ', $konten);

		if (in_array($alergi_px, $ex)) {
			$data['nama'] = $cek['nama_obat'];
			$data['status'] = 0;
		} else {
			$data['status'] = 1;
		}
		echo json_encode($data);
	}
}
