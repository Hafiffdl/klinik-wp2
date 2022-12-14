<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();

		if(empty($this->session->userdata('login'))){
			redirect('auth');  # Ketika user belum login maka dikembalikan
		}

		$this->load->model('Pasien_model');
	}

	public function index()
	{
		$data['title'] = 'Manajemen Data pasien';

		$data['pasien'] = $this->Pasien_model->tampil_data()->result_array();

		$this->load->view('header', $data);
		$this->load->view('pasien/view_data', $data);
		$this->load->view('footer');
	}

	function tambah(){
		$data['title'] = "Tambah Data Pasien";

		$this->load->view('header', $data);
		$this->load->view('pasien/view_data_add');
		$this->load->view('footer');
	}

	function insert(){
		$nama = $this->input->post('nama_pasien');
		$jk = $this->input->post('jenis_kelamin');
		$umur = $this->input->post('umur');

		$data = array(
			'nama_pasien' => $nama,
			'jenis_kelamin' => $jk,
			'umur' => $umur
		);

		$this->Pasien_model->insert_data($data);

		redirect('pasien');
	}

	function edit($id){
		$data['title'] = "Edit Data pasien";

		$where = array('id_pasien' => $id);
		$data['r'] = $this->Pasien_model->edit_data($where)->row_array();

		$this->load->view('header', $data);
		$this->load->view('pasien/view_data_edit', $data);
		$this->load->view('footer');
	}

	function update(){
		$id = $this->input->post('id_pasien');
		$nama = $this->input->post('nama_pasien');
		$jk = $this->input->post('jenis_kelamin');
		$umur = $this->input->post('umur');

		$data = array(
			'nama_pasien' => $nama,
			'jenis_kelamin' => $jk,
			'umur' => $umur
		);

		$where = array('id_pasien' => $id);
		$this->Pasien_model->update_data($data, $where);

		redirect('pasien');
	}

	function hapus($id){
		$where = array('id_pasien' => $id);
		$this->Pasien_model->hapus_data($where);

		redirect('pasien');
	}
}
