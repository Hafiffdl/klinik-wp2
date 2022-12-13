<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();

		$this->load->model('Login_model');
	}

	public function index()
	{
		$this->load->view('login');
	}

	public function login_aksi()
	{
		$user = $this->input->post('username', true);
		$pass = md5($this->input->post('password', true));

		# Aturan Validasi
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() != FALSE)
		{
			$where = array(
				'username' => $user,
				'password' => $pass
			);

			$cekLogin = $this->Login_model->cek_login($where)->num_rows();

			if($cekLogin > 0)
			{
				$sess_data = array(
					'login' => 'OK',
					'username' => $user
				);
				$this->session->set_userdata($sess_data);

				redirect(base_url());
			}else
			{
				redirect('auth');
			}

			
		}else
		{
			$this->load->view('login');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth');
	}
}
