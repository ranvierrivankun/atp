<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_pengguna extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		cek_login();
		akses_data_pengguna();
		$this->load->model('Data_pengguna_model', 'dpm');
		$this->load->model('M_builder', 'bd');
	}

	public function index()
	{
		$data['title'] = 'ATP | Data Pengguna';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar');
		$this->load->view('pengaturan_akun/data_pengguna/index');
		$this->load->view('templates/footer');
	}

	public function table_datapengguna()
	{
		$table 	= $this->dpm->table_datapengguna();
		$filter = $this->dpm->filter_table_datapengguna();
		$total 	= $this->dpm->total_table_datapengguna();

		$data 	= [];

		foreach ($table as $tb) {
			$td = [];

			$edit = "<a class='btn btn-sm btn-light edit' data-id_userdata='$tb->id_userdata'>
			<i class='fa-solid fa-pen-to-square'></i>
			</a>";

			$detail = "<a class='btn btn-sm btn-light detail' data-id_userdata='$tb->id_userdata'>
			<i class='fa-solid fa-circle-info'></i></a>";

			$td[] = "<center><div class='btn-group'>$edit $detail</a></center>";

			$td[] = "<center><a data-max-width='400' data-max-height='400' data-toggle='lightbox' data-title='Foto Pengguna' href='".base_url('assets/img/users/').$tb->foto."'><img height='30px' width='30px' class='img-radius' src='".base_url('assets/img/users/').$tb->foto."'></a></div></center>";

			$td[] = $tb->nama_user;
			$td[] = $tb->username;

			$td[] = $tb->nama_role;

			$ifelse="";
			if ($tb->status_user === '1') {
				$td[] = "<center><span class='badge badge-pill badge-success'>Active</span></center>";
			} else {
				$td[] = "<center><span class='badge badge-pill badge-danger'>Inactive</span></center>";
			};

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

	public function modal_tambah()
	{
		$this->load->view('pengaturan_akun/data_pengguna/modal_tambah', FALSE);
	}

	public function tambah_pengguna()
	{
		$id_user 		= $this->input->post('id_user');
		$nik 			= $this->input->post('nik');
		$tempat_lahir 	= $this->input->post('tempat_lahir');
		$tanggal_lahir 	= $this->input->post('tanggal_lahir');
		$email 			= $this->input->post('email');
		$no_hp 			= $this->input->post('no_hp');

		/* Query ambil nama_user di db user */
		$QueryGetName 	= $this->db->select('*')->from('user')->where('id_user', $id_user)->get()->row();
		$getNameUser	= $QueryGetName->nama_user;

		/* Untuk Proses Upload */
		$id_user_upload = userdata('id_user');

		/* Proses Jika Upload KTP */
		$ktp 			= $this->db->select('*')->from('tmp_file')->where('kode', 'ktp')->where('id_user', $id_user_upload)->get();

		if($ktp->num_rows() > 0) {
			$proses 			= $ktp->row();
			$filename_old 		= $proses->file;
			$filename_new		= 'KTP_'.$getNameUser.'.pdf';
			$file_old 			= './assets/file/'.$filename_old;
			$file_new 			= './assets/file/'.$filename_new;
			$hasil 				= rename($file_old, $file_new);
			$data['ktp'] 		= $filename_new;
		}
		$delete = $this->db->where('kode', 'ktp')->where('id_user', $id_user_upload)->delete('tmp_file');

		/* Proses Jika Upload Ijazah */
		$ijazah 			= $this->db->select('*')->from('tmp_file')->where('kode', 'ijazah')->where('id_user', $id_user_upload)->get();

		if($ijazah->num_rows() > 0) {
			$proses 			= $ijazah->row();
			$filename_old 		= $proses->file;
			$filename_new		= 'Ijazah_'.$getNameUser.'.pdf';
			$file_old 			= './assets/file/'.$filename_old;
			$file_new 			= './assets/file/'.$filename_new;
			$hasil 				= rename($file_old, $file_new);
			$data['ijazah'] 	= $filename_new;
		}
		$delete = $this->db->where('kode', 'ijazah')->where('id_user', $id_user_upload)->delete('tmp_file');

		/* Proses Jika Upload KK */
		$kk 				= $this->db->select('*')->from('tmp_file')->where('kode', 'kk')->where('id_user', $id_user_upload)->get();

		if($kk->num_rows() > 0) {
			$proses 			= $kk->row();
			$filename_old 		= $proses->file;
			$filename_new		= 'KK_'.$getNameUser.'.pdf';
			$file_old 			= './assets/file/'.$filename_old;
			$file_new 			= './assets/file/'.$filename_new;
			$hasil 				= rename($file_old, $file_new);
			$data['kk'] 		= $filename_new;
		}
		$delete = $this->db->where('kode', 'kk')->where('id_user', $id_user_upload)->delete('tmp_file');

		$data['id_user'] 		= $id_user;
		$data['nik'] 			= $nik;
		$data['tempat_lahir'] 	= $tempat_lahir;
		$data['tanggal_lahir'] 	= $tanggal_lahir;
		$data['email'] 			= $email;
		$data['no_hp'] 			= $no_hp;

		$save = $this->bd->save('user_data', $data);
		$update = $this->bd->update('user', ["status_userdata" => 1], 'id_user', $id_user);
	}

	public function modal_edit()
	{
		$id_userdata 	= $this->input->post('id_userdata');
		$where 			= $this->dpm->getDataPengguna($id_userdata);

		$data['where'] 		= $where;
		$this->load->view('pengaturan_akun/data_pengguna/modal_edit', $data, FALSE);
	}

	public function update_data_pengguna()
	{
		$id_userdata 	= $this->input->post('id_userdata');
		$id_user 		= $this->input->post('id_user');

		$nik 			= $this->input->post('nik');
		$tempat_lahir 	= $this->input->post('tempat_lahir');
		$tanggal_lahir 	= $this->input->post('tanggal_lahir');
		$email 			= $this->input->post('email');
		$no_hp 			= $this->input->post('no_hp');

		/* Query ambil nama_user di db user */
		$QueryGetName 	= $this->db->select('*')->from('user')->where('id_user', $id_user)->get()->row();
		$getNameUser	= $QueryGetName->nama_user;
		
		/* Untuk Proses Upload */
		$id_user_upload = userdata('id_user');

		/* Proses Jika Upload KTP */
		$ktp 			= $this->db->select('*')->from('tmp_file')->where('kode', 'ktp')->where('id_user', $id_user_upload)->get();

		if($ktp->num_rows() > 0) {
			$proses 			= $ktp->row();
			$filename_old 		= $proses->file;
			$filename_new		= 'KTP_'.$getNameUser.'.pdf';
			$file_old 			= './assets/file/'.$filename_old;
			$file_new 			= './assets/file/'.$filename_new;
			$hasil 				= rename($file_old, $file_new);
			$data['ktp'] 		= $filename_new;
		}
		$delete = $this->db->where('kode', 'ktp')->where('id_user', $id_user_upload)->delete('tmp_file');

		/* Proses Jika Upload Ijazah */
		$ijazah 			= $this->db->select('*')->from('tmp_file')->where('kode', 'ijazah')->where('id_user', $id_user_upload)->get();

		if($ijazah->num_rows() > 0) {
			$proses 			= $ijazah->row();
			$filename_old 		= $proses->file;
			$filename_new		= 'Ijazah_'.$getNameUser.'.pdf';
			$file_old 			= './assets/file/'.$filename_old;
			$file_new 			= './assets/file/'.$filename_new;
			$hasil 				= rename($file_old, $file_new);
			$data['ijazah'] 	= $filename_new;
		}
		$delete = $this->db->where('kode', 'ijazah')->where('id_user', $id_user_upload)->delete('tmp_file');

		/* Proses Jika Upload KK */
		$kk 				= $this->db->select('*')->from('tmp_file')->where('kode', 'kk')->where('id_user', $id_user_upload)->get();

		if($kk->num_rows() > 0) {
			$proses 			= $kk->row();
			$filename_old 		= $proses->file;
			$filename_new		= 'KK_'.$getNameUser.'.pdf';
			$file_old 			= './assets/file/'.$filename_old;
			$file_new 			= './assets/file/'.$filename_new;
			$hasil 				= rename($file_old, $file_new);
			$data['kk'] 		= $filename_new;
		}
		$delete = $this->db->where('kode', 'kk')->where('id_user', $id_user_upload)->delete('tmp_file');

		$data['nik'] 			= $nik;
		$data['tempat_lahir'] 	= $tempat_lahir;
		$data['tanggal_lahir'] 	= $tanggal_lahir;
		$data['email'] 			= $email;
		$data['no_hp'] 			= $no_hp;

		$update = $this->bd->update('user_data', $data, 'id_userdata', $id_userdata);
	}

	public function modal_detail()
	{
		$id_userdata 	= $this->input->post('id_userdata');
		$where 			= $this->dpm->getDataPengguna($id_userdata);

		$data['where'] 		= $where;
		$this->load->view('pengaturan_akun/data_pengguna/modal_detail', $data, FALSE);
	}

	public function getUser(){

		$searchTerm 	= $this->input->post('searchTerm');
		$response 		= $this->dpm->getUser($searchTerm);
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
	
}