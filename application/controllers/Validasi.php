<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_builder', 'bd');
	}

	public function index()
	{
		echo "RANVIER RIVAN";
	}

	public function username()
	{
		$username 		= $this->input->post('username');

		$proses = $this->bd->edit('user', 'username', $username)->num_rows();

		/*$proses = $this->db->select('*')->from('user')->where('username', $username)->get()->num_rows();*/

		if($proses > 0) {
			$data['keterangan'] = "Peringatan! Username ".$username." Sudah terdaftar";
			$data['status'] 	= "gagal";
		}else {
			$data['keterangan'] = "";
			$data['status'] 	= "berhasil";
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function nama_kmp()
	{
		$nama_kmp 		= $this->input->post('nama_kmp');

		$proses = $this->bd->edit('kwh_pengguna', 'nama_kmp', $nama_kmp)->num_rows();

		if($proses > 0) {
			$data['keterangan'] = "Peringatan! Nama Pengguna kWh ".$nama_kmp." Sudah terdaftar";
			$data['status'] 	= "gagal";
		}else {
			$data['keterangan'] = "";
			$data['status'] 	= "berhasil";
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function nama_kmj()
	{
		$nama_kmj 		= $this->input->post('nama_kmj');

		$proses = $this->bd->edit('kwh_jenis', 'nama_kmj', $nama_kmj)->num_rows();

		if($proses > 0) {
			$data['keterangan'] = "Peringatan! Nama Jenis kWh ".$nama_kmj." Sudah terdaftar";
			$data['status'] 	= "gagal";
		}else {
			$data['keterangan'] = "";
			$data['status'] 	= "berhasil";
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function nik()
	{
		$nik 		= $this->input->post('nik');

		$proses = $this->bd->edit('user_data', 'nik', $nik)->num_rows();

		if($proses > 0) {
			$data['keterangan'] = "Peringatan! NIK Sudah terdaftar";
			$data['status'] 	= "gagal";
		}else {
			$data['keterangan'] = "";
			$data['status'] 	= "berhasil";
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

}