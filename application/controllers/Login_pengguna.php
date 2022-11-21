<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_pengguna extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		cek_login();
		cek_admin();
		$this->load->model('Login_pengguna_model', 'lpm');
		$this->load->model('M_builder', 'bd');
	}

	public function index()
	{
		$data['title'] = 'ATP | Login Pengguna';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar');
		$this->load->view('pengaturan_akun/login_pengguna/index');
		$this->load->view('templates/footer');
	}

	public function table_pengguna()
	{
		$status = $this->input->post('status');

		$table 	= $this->lpm->table_pengguna($status);
		$filter = $this->lpm->filter_table_pengguna($status);
		$total 	= $this->lpm->total_table_pengguna($status);

		$data 	= [];

		foreach ($table as $tb) {
			$td = [];

			$edit = "<a class='btn btn-sm btn-light edit' data-id_user='$tb->id_user'>
			<i class='fa-solid fa-pen-to-square'></i>
			</a>";

			$reset = "<a class='btn btn-sm btn-info' href='javascript:void(0)' onclick='reset_password($tb->id_user)''>
			<i class='fa-solid fa-arrow-rotate-right'></i>";

			$td[] = "<center><div class='btn-group'>$edit $reset</a></center>";

			$td[] = "<center><a data-max-width='400' data-max-height='400' data-toggle='lightbox' data-title='Foto Pengguna' alt='' href='".base_url('assets/img/users/').$tb->foto."'><img height='30px' width='30px' class='img-radius' src='".base_url('assets/img/users/').$tb->foto.'?dummy=foto_user'."'></a></div></center>";

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
		$getRole 	= $this->bd->all('user_role', 'id_role', 'ASC')->result();
		$getStatus 	= $this->bd->all('user_status', 'id_status', 'ASC')->result();

		$data['getRole'] 	= $getRole;
		$data['getStatus'] 	= $getStatus;
		$this->load->view('pengaturan_akun/login_pengguna/modal_tambah', $data, FALSE);
	}

	public function tambah_pengguna()
	{
		$foto 			= $this->input->post('foto');
		$nama_user 		= $this->input->post('nama_user');
		$username 		= $this->input->post('username');
		$password 		= password_hash($this->input->post('password'), PASSWORD_DEFAULT);
		$role 			= $this->input->post('role');
		$status_user 	= $this->input->post('status_user');

		$data['foto'] 			= $foto;
		$data['nama_user'] 		= $nama_user;
		$data['username'] 		= $username;
		$data['password'] 		= $password;
		$data['role'] 			= $role;
		$data['status_user'] 	= $status_user;

		$save = $this->bd->save('user', $data);
	}

	public function modal_edit()
	{
		$id_user 	= $this->input->post('id_user');
		$edit 		= $this->bd->edit('user', 'id_user', $id_user)->row();
		$getRole 	= $this->bd->all('user_role', 'id_role', 'ASC')->result();
		$getStatus 	= $this->bd->all('user_status', 'id_status', 'ASC')->result();

		$data['edit'] 		= $edit;
		$data['getRole'] 	= $getRole;
		$data['getStatus'] 	= $getStatus;

		$this->load->view('pengaturan_akun/login_pengguna/modal_edit', $data, FALSE);
	}

	public function update_pengguna()
	{
		$id_user 		= $this->input->post('id_user');
		$nama_user 		= $this->input->post('nama_user');
		$username 		= $this->input->post('username');
		$role 			= $this->input->post('role');
		$status_user 	= $this->input->post('status_user');
		
		/* Proses Jika Upload Foto */
		$id_user_login	= userdata('id_user');
		$foto_user 		= $this->db->select('*')->from('tmp_file')->where('kode', 'foto_user')->where('id_user', $id_user_login)->get();

		$cek_foto_user 	= $this->db->select('*')->from('user')->where('id_user', $id_user)->get()->row();

		if($foto_user->num_rows() > 0) {
			$old_file = $cek_foto_user->foto;
			if ($old_file != 'default.png') {
				unlink(FCPATH . 'assets/img/users/' . $old_file);
			}

			$file_foto 			= $foto_user->row();
			$file_foto1 		= $file_foto->file;
			$filename 			= $id_user.'_'.$nama_user.'.jpg';
			$file_old 			= './assets/img/users/'.$file_foto1;
			$file_rename 		= './assets/img/users/'.$filename;
			$hasil 				= rename($file_old, $file_rename);
			$data['foto'] 		= $filename;
		}
		$delete = $this->db->where('kode', 'foto_user')->where('id_user', $id_user_login)->delete('tmp_file');

		$data['nama_user'] 		= $nama_user;
		$data['username'] 		= $username;
		$data['role'] 			= $role;
		$data['status_user'] 	= $status_user;

		$update = $this->bd->update('user', $data, 'id_user', $id_user);
	}

	public function reset_password()
	{
		if ($this->input->is_ajax_request() == true) {
			$id = $this->input->post('id',true);

			$password = 123;
			$password_hash = password_hash($password, PASSWORD_DEFAULT);
			$this->db->set('password', $password_hash);
			$this->db->where('id_user', $id);
			$reset =  $this->db->update('user');

			if($reset){
				$msg = [ 'sukses' => 'Password user Berhasil di Reset Menjadi 123'
			];
		}
		echo json_encode($msg);
	}
}

public function table_role()
{
	$table 	= $this->lpm->table_role();
	$filter = $this->lpm->filter_table_role();
	$total 	= $this->lpm->total_table_role();

	$data = [];

	foreach ($table as $tb) {
		$td = [];

		$edit = "<a class='btn btn-sm btn-light edit_role' data-id_role='$tb->id_role'>
		<i class='fa-solid fa-pen-to-square'></i> Edit Role
		</a>";

		$td[] = "<center><div class='btn-group'>$edit</a></center>";
		$td[] = $tb->nama_role;

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