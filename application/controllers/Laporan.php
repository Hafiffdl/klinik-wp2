<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();

		if(empty($this->session->userdata('login'))){
			redirect('auth');  # Ketika user belum login maka dikembalikan
		}

		$this->load->model('Dokter_model');
		$this->load->model('Pasien_model');
		$this->load->model('Kunjungan_model');
	}

	public function index()
	{
		redirect('dashboard');
	}

	function data_dokter(){
		$data['title'] = 'Laporan Data Dokter';

		$data['dokter'] = $this->Dokter_model->tampil_data()->result_array();

		$this->load->view('laporan/view_laporan_dokter', $data);
		
	}

	function data_pasien(){
		$data['title'] = 'Laporan Data Pasien';

		$data['pasien'] = $this->Pasien_model->tampil_data()->result_array();

		$this->load->view('laporan/view_laporan_pasien', $data);
		
	}

	function data_kunjungan(){
		$data['title'] = 'Laporan Data Kunjungan';

		$data['kunjungan'] = $this->Kunjungan_model->tampil_data()->result_array();

		$this->load->view('laporan/view_laporan_kunjungan', $data);
		
	}

	
}
