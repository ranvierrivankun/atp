<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_builder', 'bd');
	}

	public function index()
	{
		echo "RANVIER RIVAN";
	}

	public function kwh_pemakaian()
	{
		$id_user 	= userdata('id_user');
		$getFile 	= $this->db->select('*')->from('tmp_file')->where('kode', 'foto_kmpk')->where('id_user', $id_user)->get()->row();

		$config['upload_path'] 		= './assets/img/kwh/';
		$config['allowed_types'] 	= '*';
		$config['max_size']  		= '10000000000';
		$config['encrypt_name']     = TRUE;
		$this->upload->initialize($config);

		if($this->upload->do_upload('foto_kmpk')){

			$old_file = $getFile->file;
			unlink(FCPATH . 'assets/img/kwh/' . $old_file);

			$cek = $this->db->select('*')->from('tmp_file')->where('kode', 'foto_kmpk')->where('id_user', $id_user)->get();

			if($cek->num_rows() > 0) {
				$data['file']   = $this->upload->data('file_name');
				$update         = $this->db->where('kode', 'foto_kmpk')->where('id_user', $id_user)->update('tmp_file', $data);
			} else {
				$data['kode'] 		= "foto_kmpk";
				$data['file'] 		= $this->upload->data('file_name');
				$data['id_user'] 	= $id_user;
				$simpan 			= $this->bd->save('tmp_file', $data);
			}

		} else {
			$error = array('error' => $this->upload->display_errors());
		}
	}

	public function ganti_foto_user()
	{
		$id_user 	= userdata('id_user');
		$getFile 	= $this->db->select('*')->from('tmp_file')->where('kode', 'foto_user')->where('id_user', $id_user)->get()->row();

		$config['upload_path'] 		= './assets/img/users/';
		$config['allowed_types'] 	= '*';
		$config['max_size']  		= '10000000000';
		$config['encrypt_name']     = TRUE;
		$this->upload->initialize($config);

		if($this->upload->do_upload('foto')){

			$old_file = $getFile->file;
			unlink(FCPATH . 'assets/img/users/' . $old_file);

			$cek = $this->db->select('*')->from('tmp_file')->where('kode', 'foto_user')->where('id_user', $id_user)->get();

			if($cek->num_rows() > 0) {
				$data['file']   = $this->upload->data('file_name');
				$update         = $this->db->where('kode', 'foto_user')->where('id_user', $id_user)->update('tmp_file', $data);
			} else {
				$data['kode'] 		= "foto_user";
				$data['file'] 		= $this->upload->data('file_name');
				$data['id_user'] 	= $id_user;
				$simpan 			= $this->bd->save('tmp_file', $data);
			}

		} else {
			$error = array('error' => $this->upload->display_errors());
		}
	}

	public function file()
	{
		$id_user 	= userdata('id_user');
		$ktp 		= $this->db->select('*')->from('tmp_file')->where('kode', 'ktp')->where('id_user', $id_user)->get()->row();
		$ijazah 	= $this->db->select('*')->from('tmp_file')->where('kode', 'ijazah')->where('id_user', $id_user)->get()->row();
		$kk 	= $this->db->select('*')->from('tmp_file')->where('kode', 'kk')->where('id_user', $id_user)->get()->row();

		$config['upload_path'] 		= './assets/file/';
		$config['allowed_types'] 	= '*';
		$config['max_size']  		= '10000000000';
		$config['encrypt_name']     = TRUE;
		$this->upload->initialize($config);

		if($this->upload->do_upload('ktp')){

			$old_file = $ktp->file;
			unlink(FCPATH . 'assets/file/' . $old_file);

			$cek = $this->db->select('*')->from('tmp_file')->where('kode', 'ktp')->where('id_user', $id_user)->get();

			if($cek->num_rows() > 0) {
				$data['file']   = $this->upload->data('file_name');
				$update         = $this->db->where('kode', 'ktp')->where('id_user', $id_user)->update('tmp_file', $data);
			} else {
				$data['kode'] 		= "ktp";
				$data['file'] 		= $this->upload->data('file_name');
				$data['id_user'] 	= $id_user;
				$simpan 			= $this->bd->save('tmp_file', $data);
			}

		} else if($this->upload->do_upload('ijazah')) {

			$old_file = $ijazah->file;
			unlink(FCPATH . 'assets/file/' . $old_file);

			$cek = $this->db->select('*')->from('tmp_file')->where('kode', 'ijazah')->where('id_user', $id_user)->get();

			if($cek->num_rows() > 0) {
				$data['file']   = $this->upload->data('file_name');
				$update         = $this->db->where('kode', 'ijazah')->where('id_user', $id_user)->update('tmp_file', $data);
			} else {
				$data['kode'] 		= "ijazah";
				$data['file'] 		= $this->upload->data('file_name');
				$data['id_user'] 	= $id_user;
				$simpan 			= $this->bd->save('tmp_file', $data);
			}

		} else if($this->upload->do_upload('kk')) {

			$old_file = $kk->file;
			unlink(FCPATH . 'assets/file/' . $old_file);

			$cek = $this->db->select('*')->from('tmp_file')->where('kode', 'kk')->where('id_user', $id_user)->get();

			if($cek->num_rows() > 0) {
				$data['file']   = $this->upload->data('file_name');
				$update         = $this->db->where('kode', 'kk')->where('id_user', $id_user)->update('tmp_file', $data);
			} else {
				$data['kode'] 		= "kk";
				$data['file'] 		= $this->upload->data('file_name');
				$data['id_user'] 	= $id_user;
				$simpan 			= $this->bd->save('tmp_file', $data);
			}

		} else {
			$error = array('error' => $this->upload->display_errors());
		}
	}

}