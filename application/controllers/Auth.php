<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model', 'auth');
	}

	private function _has_login()
	{
		if ($this->session->has_userdata('login_session')) {
			redirect('home');
		}
	}

	public function index()
	{
		$this->_has_login();

		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		$username = $this->input->post('username');
		$user = $this->db->get_where('user', ['username' => $username])->row_array();

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Aplikasi-TP V.2.0';
			$this->load->view('auth/header', $data);
			$this->load->view('auth/index');
			$this->load->view('auth/footer');
		} else {
			$input = $this->input->post(null, true);

			$cek_username = $this->auth->cek_username($input['username']);
			if ($cek_username > 0) {
				$password = $this->auth->get_password($input['username']);
				if($user['status_user'] == 1){
					if (password_verify($input['password'], $password)) {
						$user_db = $this->auth->userdata($input['username']);
						$userdata = [
							'user'  => $user_db['id_user'],
							'role'  => $user_db['role'],
							'timestamp' => time()
						];
						$this->session->set_userdata('login_session', $userdata);
						redirect('home');
					}
				} else {
					set_pesan('Akun Tidak Aktif', false);
					redirect('auth');
				}
			} else {
				set_pesan('Akun Tidak Ada', false);
				redirect('auth');
			}
			set_pesan('Password Salah', false);
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('login_session');
		set_pesan('Berhasil Keluar');
		redirect('auth');
	}

}