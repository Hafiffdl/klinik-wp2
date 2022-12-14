<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Obat extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();

		if(empty($this->session->userdata('login'))){
			redirect('auth');  # Ketika user belum login maka dikembalikan
		}

		$this->load->model('Obat_model');
	}

	public function index()
	{
		$data['title'] = 'Manajemen Data Obat';

		$data['obat'] = $this->Obat_model->tampil_data()->result_array();

		$this->load->view('header', $data);
		$this->load->view('obat/view_data', $data);
		$this->load->view('footer');
	}

	function tambah(){
		$data['title'] = "Tambah Data obat";

		$this->load->view('header', $data);
		$this->load->view('obat/view_data_add');
		$this->load->view('footer');
	}

	function insert(){
		$nama = $this->input->post('nama_obat');

		$data = array(
			'nama_obat' => $nama
		);

		$this->Obat_model->insert_data($data);

		redirect('obat');
	}

	function edit($id){
		$data['title'] = "Edit Data obat";

		$where = array('id_obat' => $id);
		$data['r'] = $this->Obat_model->edit_data($where)->row_array();

		$this->load->view('header', $data);
		$this->load->view('obat/view_data_edit', $data);
		$this->load->view('footer');
	}

	function update(){
		$id = $this->input->post('id_obat');
		$n = $this->input->post('nama_obat');

		$data = array(
			'nama_obat' => $n
		);

		$where = array('id_obat' => $id);
		$this->Obat_model->update_data($data, $where);

		redirect('obat');
	}

	function hapus($id){
		$where = array('id_obat' => $id);
		$this->Obat_model->hapus_data($where);

		redirect('obat');
	}
}
