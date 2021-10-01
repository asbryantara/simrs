<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Antrian extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('M_antrian', 'antri');
	}

	public function index(){
		
		$this->load->view('antrian');
	}

	function front_print(){
		$this->load->view('antrian_front');
	}

	function front_view(){
		$this->load->view('antrian_view');
	}

	function panggilan(){
		$data = $this->antri->panggil()->row_array();
		echo json_encode($data);
	}

	function tambah(){
		$cek = $this->antri->cek()->row_array();

		$data['tgl_antrian'] = date('Y-m-d H:i:s');
		$data['no_antrian'] = $cek['no_antrian']+1;
		$data['jenis_antrian'] = '1';
		$data['status_antrian'] = '0';

		$this->db->insert('antrian', $data);

		$hasil = $this->antri->cek()->row_array();
		echo json_encode($hasil['no_antrian']);
	}

	function update(){
		$data['panggilan'] 	= $this->antri->update()->row_array();
		$data['jumlah'] 	= $this->antri->jumlah()->num_rows();
		$data['terlayani'] 	= $this->antri->terlayani()->num_rows();
		$data['menunggu'] 	= $this->antri->menunggu()->num_rows();
		if(!empty($data['panggilan']['no_antrian'])){
			echo json_encode($data);
		}else{
			$data['panggilan'] = '<h3>Antrian Habis<h3>';
			echo json_encode($data);
		}
	}

	function panggil(){
		$loket = $this->input->post('loket');
		$data = $this->antri->update()->row_array();
		$panggil = $this->db->update('antrian', ['status_antrian'=>1, 'loket_antrian'=>$loket], ['id_antrian'=>$data['id_antrian']]);
		if($panggil){
			echo json_encode($data['no_antrian']);
		}
		
	}

	// function pending(){
		
	// }

}