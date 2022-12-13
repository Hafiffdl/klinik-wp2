<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();

		if(empty($this->session->userdata('login'))){
			redirect('auth');  # Ketika user belum login maka dikembalikan
		}

		$this->load->model('Users_model');
	}

	public function index()
	{
		$data['title'] = 'Manajemen Data Users';

		$data['users'] = $this->Users_model->tampil_data()->result_array();

		$this->load->view('header', $data);
		$this->load->view('users/view_data', $data);
		$this->load->view('footer');
	}

	function tambah(){
		$data['title'] = "Tambah Data Users";

		$this->load->view('header', $data);
		$this->load->view('users/view_data_add');
		$this->load->view('footer');
	}

	function insert(){
		$u = $this->input->post('username');
		$n = $this->input->post('nama_lengkap');
		$p = md5($this->input->post('password'));

		$data = array(
			'username' => $u,
			'nama_lengkap' => $n,
			'password' => $p
		);

		$this->Users_model->insert_data($data);

		redirect('users');
	}

	function edit($id){
		$data['title'] = "Edit Data Users";

		$where = array('id' => $id);
		$data['r'] = $this->Users_model->edit_data($where)->row_array();

		$this->load->view('header', $data);
		$this->load->view('users/view_data_edit', $data);
		$this->load->view('footer');
	}

	function update(){
		$id = $this->input->post('id');
		$u = $this->input->post('username');
		$n = $this->input->post('nama_lengkap');
		$p = md5($this->input->post('password'));

		$data = array(
			'username' => $u,
			'nama_lengkap' => $n,
			'password' => $p
		);

		$where = array('id' => $id);
		$this->Users_model->update_data($data, $where);

		redirect('users');
	}

	function hapus($id){
		$where = array('id' => $id);
		$this->Users_model->hapus_data($where);

		redirect('users');
	}
}
