<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokter extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();

		if(empty($this->session->userdata('login'))){
			redirect('auth');  # Ketika user belum login maka dikembalikan
		}

		$this->load->model('Dokter_model');
	}

	public function index()
	{
		$data['title'] = 'Manajemen Data Dokter';

		$data['dokter'] = $this->Dokter_model->tampil_data()->result_array();

		$this->load->view('header', $data);
		$this->load->view('dokter/view_data', $data);
		$this->load->view('footer');
	}

	function tambah(){
		$data['title'] = "Tambah Data Dokter";

		$this->load->view('header', $data);
		$this->load->view('dokter/view_data_add');
		$this->load->view('footer');
	}

	function insert(){
		$nama = $this->input->post('nama_dokter');

		$data = array(
			'nama_dokter' => $nama
		);

		$this->Dokter_model->insert_data($data);

		redirect('dokter');
	}

	function edit($id){
		$data['title'] = "Edit Data Dokter";

		$where = array('id_dokter' => $id);
		$data['r'] = $this->Dokter_model->edit_data($where)->row_array();

		$this->load->view('header', $data);
		$this->load->view('dokter/view_data_edit', $data);
		$this->load->view('footer');
	}

	function update(){
		$id = $this->input->post('id_dokter');
		$n = $this->input->post('nama_dokter');

		$data = array(
			'nama_dokter' => $n
		);

		$where = array('id_dokter' => $id);
		$this->Dokter_model->update_data($data, $where);

		redirect('dokter');
	}

	function hapus($id){
		$where = array('id_dokter' => $id);
		$this->Dokter_model->hapus_data($where);

		redirect('dokter');
	}
}
