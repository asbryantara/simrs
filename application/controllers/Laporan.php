<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Laporan extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('M_klinik', 'klinik');
		$this->load->model('M_apotek', 'apotek');
		$this->load->model('M_pendaftaran', 'pendaftaran');
		$this->load->model('M_laporan', 'laporan');
	}

	public function kunjungan(){
		$this->load->view('laporan_kunjungan');
	}
	function view_kunjungan(){
		$data['bulan1'] = $this->input->post('bulan1');
		$data['bulan2'] = $this->input->post('bulan2');
		$data['tahun'] = $this->input->post('tahun');
		// $data['lap'] = $this->laporan->laporan_kunjungan($awal, $akhir)->result();
		$this->load->view('view_kunjungan', $data);
	}

	function kunjungan_excel(){
		$data['bulan1'] = $this->input->post('bulan1');
		$data['bulan2'] = $this->input->post('bulan2');
		$data['tahun'] = $this->input->post('tahun');
		$data['nama_klinik'] = $this->db->get_where('config', ['id_config'=>1])->row_array();
		$data['alamat_klinik'] = $this->db->get_where('config', ['id_config'=>2])->row_array();
		$data['telp_klinik'] = $this->db->get_where('config', ['id_config'=>3])->row_array();
		$data['website_klinik'] = $this->db->get_where('config', ['id_config'=>4])->row_array();
		$data['email_klinik'] = $this->db->get_where('config', ['id_config'=>5])->row_array();
		// $data['lap'] = $this->laporan->laporan_kunjungan($awal, $akhir)->result();
		$this->load->view('excel_kunjungan', $data);
	}

	function diagnosa(){
		$this->load->view('laporan_diagnosa');
	}

	function view_diagnosa(){
		$data['bulan1'] = $this->input->post('bulan1');
		$data['bulan2'] = $this->input->post('bulan2');
		$data['tahun'] = $this->input->post('tahun');
		$awal = $data['tahun'].'-'.$data['bulan1'].'-01';
		$akhir = $data['tahun'].'-'.$data['bulan2'].'-31';
		$data['lap'] = $this->laporan->laporan_diagnosa($awal, $akhir)->result();
		$this->load->view('view_diagnosa', $data);
		// print_r($data['lap']);
	}

	function diagnosa_excel(){
		$data['bulan1'] = $this->input->post('bulan1');
		$data['bulan2'] = $this->input->post('bulan2');
		$data['tahun'] = $this->input->post('tahun');
		$awal = $data['tahun'].'-'.$data['bulan1'].'-01';
		$akhir = $data['tahun'].'-'.$data['bulan2'].'-31';
		$data['nama_klinik'] = $this->db->get_where('config', ['id_config'=>1])->row_array();
		$data['alamat_klinik'] = $this->db->get_where('config', ['id_config'=>2])->row_array();
		$data['telp_klinik'] = $this->db->get_where('config', ['id_config'=>3])->row_array();
		$data['website_klinik'] = $this->db->get_where('config', ['id_config'=>4])->row_array();
		$data['email_klinik'] = $this->db->get_where('config', ['id_config'=>5])->row_array();
		$data['lap'] = $this->laporan->laporan_diagnosa($awal, $akhir)->result();
		$this->load->view('excel_diagnosa', $data);
	}

	function obat(){
		$this->load->view('laporan_obat');
	}

	function view_obat(){
		$data['bulan1'] = $this->input->post('bulan1');
		$data['bulan2'] = $this->input->post('bulan2');
		$data['tahun'] = $this->input->post('tahun');
		$awal = $data['tahun'].'-'.$data['bulan1'].'-01';
		$akhir = $data['tahun'].'-'.$data['bulan2'].'-31';
		$data['lap'] = $this->laporan->laporan_obat($awal, $akhir)->result();
		$this->load->view('view_obat', $data);
		// print_r($data['lap']);
	}

	function obat_excel(){
		$data['bulan1'] = $this->input->post('bulan1');
		$data['bulan2'] = $this->input->post('bulan2');
		$data['tahun'] = $this->input->post('tahun');
		$awal = $data['tahun'].'-'.$data['bulan1'].'-01';
		$akhir = $data['tahun'].'-'.$data['bulan2'].'-31';
		$data['nama_klinik'] = $this->db->get_where('config', ['id_config'=>1])->row_array();
		$data['alamat_klinik'] = $this->db->get_where('config', ['id_config'=>2])->row_array();
		$data['telp_klinik'] = $this->db->get_where('config', ['id_config'=>3])->row_array();
		$data['website_klinik'] = $this->db->get_where('config', ['id_config'=>4])->row_array();
		$data['email_klinik'] = $this->db->get_where('config', ['id_config'=>5])->row_array();
		$data['lap'] = $this->laporan->laporan_obat($awal, $akhir)->result();
		$this->load->view('excel_obat', $data);
	}

	function lab(){
		$this->load->view('laporan_lab');
	}

	function view_lab(){
		$data['bulan1'] = $this->input->post('bulan1');
		$data['bulan2'] = $this->input->post('bulan2');
		$data['tahun'] = $this->input->post('tahun');
		$awal = $data['tahun'].'-'.$data['bulan1'].'-01';
		$akhir = $data['tahun'].'-'.$data['bulan2'].'-31';
		// $data['lap'] = $this->laporan->laporan_lab($awal, $akhir)->result();
		$data['kol'] = $this->laporan->laporan_lab_kol($awal, $akhir)->num_rows();
		$data['gda'] = $this->laporan->laporan_lab_gda($awal, $akhir)->num_rows();
		$data['gdsm'] = $this->laporan->laporan_lab_gdsm($awal, $akhir)->num_rows();
		$data['gdp'] = $this->laporan->laporan_lab_gdp($awal, $akhir)->num_rows();
		$data['hb'] = $this->laporan->laporan_lab_hb($awal, $akhir)->num_rows();
		$data['trombosit'] = $this->laporan->laporan_lab_trombosit($awal, $akhir)->num_rows();
		$data['sgot'] = $this->laporan->laporan_lab_sgot($awal, $akhir)->num_rows();
		$data['sgpt'] = $this->laporan->laporan_lab_sgpt($awal, $akhir)->num_rows();
		$data['asamurat'] = $this->laporan->laporan_lab_asamurat($awal, $akhir)->num_rows();
		$data['widal'] = $this->laporan->laporan_lab_widal($awal, $akhir)->num_rows();
		$this->load->view('view_lab', $data);
		// print_r($data);
	}

	function lab_excel(){
		$data['bulan1'] = $this->input->post('bulan1');
		$data['bulan2'] = $this->input->post('bulan2');
		$data['tahun'] = $this->input->post('tahun');
		$awal = $data['tahun'].'-'.$data['bulan1'].'-01';
		$akhir = $data['tahun'].'-'.$data['bulan2'].'-31';
		// $data['lap'] = $this->laporan->laporan_lab($awal, $akhir)->result();
		$data['kol'] = $this->laporan->laporan_lab_kol($awal, $akhir)->num_rows();
		$data['gda'] = $this->laporan->laporan_lab_gda($awal, $akhir)->num_rows();
		$data['gdsm'] = $this->laporan->laporan_lab_gdsm($awal, $akhir)->num_rows();
		$data['gdp'] = $this->laporan->laporan_lab_gdp($awal, $akhir)->num_rows();
		$data['hb'] = $this->laporan->laporan_lab_hb($awal, $akhir)->num_rows();
		$data['trombosit'] = $this->laporan->laporan_lab_trombosit($awal, $akhir)->num_rows();
		$data['sgot'] = $this->laporan->laporan_lab_sgot($awal, $akhir)->num_rows();
		$data['sgpt'] = $this->laporan->laporan_lab_sgpt($awal, $akhir)->num_rows();
		$data['asamurat'] = $this->laporan->laporan_lab_asamurat($awal, $akhir)->num_rows();
		$data['widal'] = $this->laporan->laporan_lab_widal($awal, $akhir)->num_rows();
		$data['nama_klinik'] = $this->db->get_where('config', ['id_config'=>1])->row_array();
		$data['alamat_klinik'] = $this->db->get_where('config', ['id_config'=>2])->row_array();
		$data['telp_klinik'] = $this->db->get_where('config', ['id_config'=>3])->row_array();
		$data['website_klinik'] = $this->db->get_where('config', ['id_config'=>4])->row_array();
		$data['email_klinik'] = $this->db->get_where('config', ['id_config'=>5])->row_array();
		// $data['lap'] = $this->laporan->laporan_lab($awal, $akhir)->result();
		$this->load->view('excel_lab', $data);
	}


	function radiologi(){
		$this->load->view('laporan_radiologi');
	}

	function view_radiologi(){
		$data['bulan1'] = $this->input->post('bulan1');
		$data['bulan2'] = $this->input->post('bulan2');
		$data['tahun'] = $this->input->post('tahun');
		$awal = $data['tahun'].'-'.$data['bulan1'].'-01';
		$akhir = $data['tahun'].'-'.$data['bulan2'].'-31';
		
		$data['xray'] = $this->laporan->radiologi($awal, $akhir, 'X-Ray Umum')->num_rows();
		$data['usg'] = $this->laporan->radiologi($awal, $akhir, 'USG')->num_rows();
		$data['ctscan'] = $this->laporan->radiologi($awal, $akhir, 'CT-Scan')->num_rows();
		$data['mri'] = $this->laporan->radiologi($awal, $akhir, 'MRI')->num_rows();
		$data['mamografi'] = $this->laporan->radiologi($awal, $akhir, 'Mamografi')->num_rows();
		$data['angiografi'] = $this->laporan->radiologi($awal, $akhir, 'Angiografi')->num_rows();
		$this->load->view('view_radiologi', $data);
		// print_r($data);
	}

	function radiologi_excel(){
		$data['bulan1'] = $this->input->post('bulan1');
		$data['bulan2'] = $this->input->post('bulan2');
		$data['tahun'] = $this->input->post('tahun');
		$awal = $data['tahun'].'-'.$data['bulan1'].'-01';
		$akhir = $data['tahun'].'-'.$data['bulan2'].'-31';
		// $data['lap'] = $this->laporan->laporan_radiologi($awal, $akhir)->result();
		$data['xray'] = $this->laporan->radiologi($awal, $akhir, 'X-Ray Umum')->num_rows();
		$data['usg'] = $this->laporan->radiologi($awal, $akhir, 'USG')->num_rows();
		$data['ctscan'] = $this->laporan->radiologi($awal, $akhir, 'CT-Scan')->num_rows();
		$data['mri'] = $this->laporan->radiologi($awal, $akhir, 'MRI')->num_rows();
		$data['mamografi'] = $this->laporan->radiologi($awal, $akhir, 'Mamografi')->num_rows();
		$data['angiografi'] = $this->laporan->radiologi($awal, $akhir, 'Angiografi')->num_rows();

		$data['nama_klinik'] = $this->db->get_where('config', ['id_config'=>1])->row_array();
		$data['alamat_klinik'] = $this->db->get_where('config', ['id_config'=>2])->row_array();
		$data['telp_klinik'] = $this->db->get_where('config', ['id_config'=>3])->row_array();
		$data['website_klinik'] = $this->db->get_where('config', ['id_config'=>4])->row_array();
		$data['email_klinik'] = $this->db->get_where('config', ['id_config'=>5])->row_array();
		// $data['lap'] = $this->laporan->laporan_radiologi($awal, $akhir)->result();
		$this->load->view('excel_radiologi', $data);
	}


	function dokter(){
		$this->load->view('laporan_dokter');
	}

	function view_dokter(){
		$data['bulan1'] = $this->input->post('bulan1');
		$data['bulan2'] = $this->input->post('bulan2');
		$data['tahun'] = $this->input->post('tahun');
		$awal = $data['tahun'].'-'.$data['bulan1'].'-01';
		$akhir = $data['tahun'].'-'.$data['bulan2'].'-31';
	
		$data['dokter'] = $this->laporan->dokter($awal, $akhir)->result();

		$this->load->view('view_dokter', $data);
		// print_r($data);
	}

	function dokter_excel(){
		$data['bulan1'] = $this->input->post('bulan1');
		$data['bulan2'] = $this->input->post('bulan2');
		$data['tahun'] = $this->input->post('tahun');
		$awal = $data['tahun'].'-'.$data['bulan1'].'-01';
		$akhir = $data['tahun'].'-'.$data['bulan2'].'-31';
		
		$data['dokter'] = $this->laporan->dokter($awal, $akhir)->result();

		$data['nama_klinik'] = $this->db->get_where('config', ['id_config'=>1])->row_array();
		$data['alamat_klinik'] = $this->db->get_where('config', ['id_config'=>2])->row_array();
		$data['telp_klinik'] = $this->db->get_where('config', ['id_config'=>3])->row_array();
		$data['website_klinik'] = $this->db->get_where('config', ['id_config'=>4])->row_array();
		$data['email_klinik'] = $this->db->get_where('config', ['id_config'=>5])->row_array();
		// $data['lap'] = $this->laporan->laporan_dokter($awal, $akhir)->result();
		$this->load->view('excel_dokter', $data);
	}

	function perawat(){
		$this->load->view('laporan_perawat');
	}

	function view_perawat(){
		$data['bulan1'] = $this->input->post('bulan1');
		$data['bulan2'] = $this->input->post('bulan2');
		$data['tahun'] = $this->input->post('tahun');
		$awal = $data['tahun'].'-'.$data['bulan1'].'-01';
		$akhir = $data['tahun'].'-'.$data['bulan2'].'-31';
	
		$data['perawat'] = $this->laporan->perawat($awal, $akhir)->result();

		$this->load->view('view_perawat', $data);
		// print_r($data);
	}

	function perawat_excel(){
		$data['bulan1'] = $this->input->post('bulan1');
		$data['bulan2'] = $this->input->post('bulan2');
		$data['tahun'] = $this->input->post('tahun');
		$awal = $data['tahun'].'-'.$data['bulan1'].'-01';
		$akhir = $data['tahun'].'-'.$data['bulan2'].'-31';
		
		$data['perawat'] = $this->laporan->perawat($awal, $akhir)->result();

		$data['nama_klinik'] = $this->db->get_where('config', ['id_config'=>1])->row_array();
		$data['alamat_klinik'] = $this->db->get_where('config', ['id_config'=>2])->row_array();
		$data['telp_klinik'] = $this->db->get_where('config', ['id_config'=>3])->row_array();
		$data['website_klinik'] = $this->db->get_where('config', ['id_config'=>4])->row_array();
		$data['email_klinik'] = $this->db->get_where('config', ['id_config'=>5])->row_array();
		// $data['lap'] = $this->laporan->laporan_perawat($awal, $akhir)->result();
		$this->load->view('excel_perawat', $data);
	}



	//KEUANGAN

	function keuangan(){
		$this->load->view('laporan_keuangan');
	}

	function view_keuangan(){
		$tanggal = $this->input->post('tanggal1');
		$t1 = explode('-', str_replace(' ','',$tanggal));
		$t2 = $t1[2].'-'.$t1[1].'-'.$t1[0];
		$t3 = $t1[6].'-'.$t1[5].'-'.$t1[4];
		
		$data['sesi'] = $tanggal;
		$data['tgl'] = $this->laporan->laporan_keuangan($t2, $t3)->result();
		$this->load->view('view_keuangan', $data);
	}

	function keuangan_excel(){
		$tanggal = $this->input->post('tanggal1');
		$t1 = explode('-', str_replace(' ','',$tanggal));
		$t2 = $t1[2].'-'.$t1[1].'-'.$t1[0];
		$t3 = $t1[6].'-'.$t1[5].'-'.$t1[4];
		
		$data['tgl'] = $this->laporan->laporan_keuangan($t2, $t3)->result();

		$data['nama_klinik'] = $this->db->get_where('config', ['id_config'=>1])->row_array();
		$data['alamat_klinik'] = $this->db->get_where('config', ['id_config'=>2])->row_array();
		$data['telp_klinik'] = $this->db->get_where('config', ['id_config'=>3])->row_array();
		$data['website_klinik'] = $this->db->get_where('config', ['id_config'=>4])->row_array();
		$data['email_klinik'] = $this->db->get_where('config', ['id_config'=>5])->row_array();
		// $data['lap'] = $this->laporan->laporan_keuangan($awal, $akhir)->result();
		$this->load->view('excel_keuangan', $data);
	}
	
}
