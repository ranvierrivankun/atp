<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_builder', 'bd');
		$this->load->model('Profile_model','pm');
		cek_login();
	}

	/*View Profile*/
	public function index()
	{
		$data['title'] = 'ATP | Profile';

		$id_user 		= userdata('id_user');
		$getUser 		= $this->pm->getUser($id_user);
		$getUserData 	= $this->pm->getUserData($id_user);
		$total_kwh_now 	= $this->pm->total_kwh_now($id_user);
		$total_kwh 		= $this->pm->total_kwh($id_user);

		$data['getUser'] 		= $getUser;
		$data['getUserData'] 	= $getUserData;
		$data['total_kwh_now'] 	= $total_kwh_now;
		$data['total_kwh'] 		= $total_kwh;

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar');
		$this->load->view('profile/index', $data);
		$this->load->view('templates/footer');
	}

	/*modal edit profile*/
	public function modal_edit_profile()
	{
		$id_user 	= $this->input->post('id_user');
		$edit 		= $this->bd->edit('user', 'id_user', $id_user)->row();

		$data['edit'] 		= $edit;
		$this->load->view('profile/modal_edit_profile', $data, FALSE);
	}

	/*proses update profile*/
	public function update_profile()
	{
		$id_user 		= $this->input->post('id_user');
		$nama_user 		= $this->input->post('nama_user');
		$username 		= $this->input->post('username');
		
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

		$update = $this->bd->update('user', $data, 'id_user', $id_user);
	}

}