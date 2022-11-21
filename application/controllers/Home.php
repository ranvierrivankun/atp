<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_builder', 'bd');
		$this->load->model('home_model','hm');
		cek_login();
	}

	public function index()
	{
		$data['title'] = 'ATP | Home';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar');
		$this->load->view('home/index');
		$this->load->view('templates/footer');
	}

	public function modal_ganti_password()
	{
		$id_user 	= $this->input->post('id_user');
		$edit 		= $this->bd->edit('user', 'id_user', $id_user)->row();

		$data['edit'] 		= $edit;
		$this->load->view('home/modal_ganti_password', $data, FALSE);
	}

	public function proses_ganti_password()
	{
		$id_user 					= userdata('id_user');
		$password_lama 				= $this->input->post('password_lama');
		$password_baru_1 			= $this->input->post('password_baru_1');

		$cek_password_lama 			= $this->bd->where('user', 'id_user', $id_user)->row();

		if (password_verify($password_lama, userdata('password'))) {
			$data['password'] 		= password_hash($password_baru_1, PASSWORD_DEFAULT);
			$this->bd->update('user', $data, 'id_user', $id_user);

			$output['status'] 		= true;
			$output['keterangan'] 	= "Password Berhasil diganti!";
			$this->session->unset_userdata('login_session');

		} else {
			$output['status'] 		= false;
			$output['keterangan'] 	= "Password Lama Salah";
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function dashboard()
	{
		/* Ambil Role dari userdata */
		$role = userdata('role');

		/* Pengguna */
		$data['total_pengguna'] 			= $this->hm->total_pengguna();
		$data['total_data_pengguna'] 		= $this->hm->total_data_pengguna();
		$data['total_pengguna_active'] 		= $this->hm->total_pengguna_active();
		$data['total_pengguna_inactive'] 	= $this->hm->total_pengguna_inactive();

		/* kWh Meter */
		$data['total_kwh'] 				= $this->hm->total_kwh();
		$data['total_jumlah_kwh_now'] 	= $this->hm->total_jumlah_kwh_now();
		$data['total_jumlah_kwh'] 		= $this->hm->total_jumlah_kwh();
		$data['total_jenis_kwh'] 		= $this->hm->total_jenis_kwh();
		$data['total_kwh_active'] 		= $this->hm->total_kwh_active();
		$data['total_kwh_inactive'] 	= $this->hm->total_kwh_inactive();

		$data['title'] = 'ATP | Dashboard';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar');

		/* Administration */
		if ($role == '1') {
			$this->load->view('home/dashboard_administration/index', $data);

			/* Pengawas TP */
		} else if ($role == '2') {
			$this->load->view('home/dashboard_pengawas_tp/index', $data);

			/* Teknik Listrik */
		} else if ($role == '3') {
			$this->load->view('home/dashboard_teknik_listrik/index', $data);

			/* Operasional */
		} else if ($role == '4') {
			$this->load->view('home/dashboard_operasional/index', $data);
			
			/* Admin TP */
		} else if ($role == '5') {
			$this->load->view('home/dashboard_admin_tp/index', $data);

			/* Pelaksana */
		} else {
			$this->load->view('home/dashboard_tp/index', $data);
		}
		$this->load->view('templates/footer');

	}

	public function table_kwh_now()
	{
		$table 	= $this->hm->table_kn();
		$filter = $this->hm->filter_table_kn();
		$total 	= $this->hm->total_table_kn();

		$data 	= [];

		foreach ($table as $tb) {
			$td = [];

			if (empty($tb->foto_kmpk)) {

				$foto = "<a class='btn btn-sm btn-light' alt='' data-max-width='400' data-max-height='400' data-toggle='lightbox' data-title='Foto kWh' href='".base_url('assets/img/no_picture.png')."'>
				<i class='fa-regular fa-image'></i></a>";

			} else {

				$foto = "<a class='btn btn-sm btn-light' alt='' data-max-width='600' data-max-height='600' data-toggle='lightbox' data-title='Foto kWh' href='".base_url('assets/img/kwh/').$tb->foto_kmpk.'?dummy=TEST'."'>
				<i class='fa-regular fa-image'></i></a>";

			};

			$td[] = "<center><div class='btn-group'>$foto</a></center>";

			$td[] = $tb->nama_kmj;

			$data[] = $td;
		}

		$output = [
			'draw' => $this->input->post('draw'),
			'recordsTotal' => $total,
			'recordsFiltered' => $filter,
			'data'=> $data,
		];
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

}