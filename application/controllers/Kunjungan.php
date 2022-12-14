<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kunjungan extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();

		if(empty($this->session->userdata('login'))){
			redirect('auth');  # Ketika user belum login maka dikembalikan
		}

		$this->load->model('Kunjungan_model');
		$this->load->model('Pasien_model');
		$this->load->model('Dokter_model');
		$this->load->model('Obat_model');
	}

	public function index()
	{
		$data['title'] = 'Kunjungan/Berobat';

		$data['kunjungan'] = $this->Kunjungan_model->tampil_data()->result_array();

		$this->load->view('header', $data);
		$this->load->view('kunjungan/view_data', $data);
		$this->load->view('footer');
	}

	function tambah(){
		$data['title'] = "Kunjungan Baru";

		$data['pasien'] = $this->Pasien_model->tampil_data()->result_array();
		$data['dokter'] = $this->Dokter_model->tampil_data()->result_array();

		$this->load->view('header', $data);
		$this->load->view('kunjungan/view_data_add', $data);
		$this->load->view('footer');
	}

	function insert(){
		$tgl = $this->input->post('tgl_berobat');
		$pasien = $this->input->post('pasien');
		$dokter = $this->input->post('dokter');

		$data = array(
			'tgl_berobat' => $tgl,
			'id_pasien' => $pasien,
			'id_dokter' => $dokter
		);

		$this->Kunjungan_model->insert_data($data);

		redirect('kunjungan');
	}

	function edit($id){
		$data['title'] = "Edit Data Kunjungan Pasien";

		$data['pasien'] = $this->Pasien_model->tampil_data()->result_array();
		$data['dokter'] = $this->Dokter_model->tampil_data()->result_array();

		$where = array('id_berobat' => $id);
		$data['edit'] = $this->Kunjungan_model->edit_data($where)->row_array();

		$this->load->view('header', $data);
		$this->load->view('kunjungan/view_data_edit', $data);
		$this->load->view('footer');
	}

	function update(){
		$id = $this->input->post('id');
		$tgl = $this->input->post('tgl_berobat');
		$pasien = $this->input->post('pasien');
		$dokter = $this->input->post('dokter');

		$data = array(
			'tgl_berobat' => $tgl,
			'id_pasien' => $pasien,
			'id_dokter' => $dokter
		);

		$where = array('id_berobat' => $id);
		$this->Kunjungan_model->update_data($data, $where);

		redirect('kunjungan');
	}

	function hapus($id){
		$where = array('id_berobat' => $id);
		$this->Kunjungan_model->hapus_data($where);

		redirect('kunjungan');
	}

	// fungsi untuk rekam medis

	function rekam($id){
		$data['title'] = "Rekam Medis";

		// Show detail rekam medis
		$data['d'] = $this->Kunjungan_model->tampil_rekam($id)->row_array();

		// Show Riwayat kunjungan
		$q = $this->db->query("SELECT id_pasien FROM berobat WHERE id_berobat='$id'")->row_array();
		$id_pasien = $q['id_pasien'];
		$data['riwayat'] = $this->Kunjungan_model->tampil_riwayat($id_pasien)->result_array();

		
		// Show data obat
		$data['obat'] = $this->Obat_model->tampil_data()->result_array();
		// Show resep obat
		$data['resep'] = $this->Kunjungan_model->tampil_resep($id)->result_array();



		$this->load->view('header', $data);
		$this->load->view('kunjungan/view_rekam_medis', $data);
		$this->load->view('footer');
	}

	function insert_rekam(){
		$id_berobat = $this->input->post('id');
		$keluhan = $this->input->post('keluhan');
		$diagnosa = $this->input->post('diagnosa');
		$penatalaksanaan = $this->input->post('penatalaksanaan');

		$data = array(
			'keluhan_pasien' => $keluhan,
			'hasil_diagnosa' => $diagnosa,
			'penatalaksanaan' => $penatalaksanaan
		);

		$where = array('id_berobat'=>$id_berobat);

		$this->Kunjungan_model->update_data($data, $where);

		redirect('kunjungan/rekam/'.$id_berobat);

	}

	function insert_resep(){
		$id_berobat = $this->input->post('id');
		$obat = $this->input->post('obat');

		$data = array(
			'id_berobat' => $id_berobat,
			'id_obat' => $obat
		);

		$this->Kunjungan_model->insert_resep($data);

		redirect('kunjungan/rekam/'.$id_berobat);

	}

	function hapus_resep($id, $id_berobat){
		$where = array('id_resep'=>$id);
		$this->Kunjungan_model->hapus_resep($where);

		redirect('kunjungan/rekam/'.$id_berobat);
	}

}
