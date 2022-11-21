<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kwh_pengguna extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		cek_login();
		akses_pengaturan_kwh();
		$this->load->model('kwh_pengguna_model', 'kpm');
		$this->load->model('M_builder', 'bd');
	}

	public function index()
	{
		$data['title'] = 'ATP | kWh Pengguna';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar');
		$this->load->view('pengaturan_kwh/kwh_pengguna/pengguna');
		$this->load->view('templates/footer');
	}

	public function table_kp()
	{
		$status = $this->input->post('status');

		$table 	= $this->kpm->table_kp($status);
		$filter = $this->kpm->filter_table_kp($status);
		$total 	= $this->kpm->total_table_kp($status);

		$data 	= [];

		foreach ($table as $tb) {
			$td = [];

			$edit = "<a class='btn btn-sm btn-light edit' data-id_kmp='$tb->id_kmp'>
			<i class='fa-solid fa-pen-to-square'></i>
			</a>";

			$detail = "<a class='btn btn-sm btn-light detail' data-id_kmp='$tb->id_kmp'>
			<i class='fa-solid fa-circle-info'></i>
			Detail Jenis kWh</a>";

			$td[] = "<center><div class='btn-group'>$edit</a></center>";

			$td[] = $tb->nama_kmp;

			$ifelse="";
			if ($tb->status_kmp === '1') {
				$td[] = "<center><span class='badge badge-pill badge-success'>Active</span></center>";
			} else {
				$td[] = "<center><span class='badge badge-pill badge-danger'>Inactive</span></center>";
			};

			$td[] = "<center><div class='btn-group'>$detail</a></center>";

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
		$this->load->view('pengaturan_kwh/kwh_pengguna/modal_tambah', FALSE);
	}

	public function tambah_pengguna_kwh()
	{
		$nama_kmp 		= $this->input->post('nama_kmp');
		$status_kmp		= $this->input->post('status_kmp');

		$data['status_kmp']		= $status_kmp;
		$data['nama_kmp'] 		= $nama_kmp;
		$save = $this->bd->save('kwh_pengguna', $data);
	}

	public function modal_edit()
	{
		$id_kmp 	= $this->input->post('id_kmp');
		$edit 		= $this->bd->edit('kwh_pengguna', 'id_kmp', $id_kmp)->row();

		$data['edit'] 		= $edit;
		$this->load->view('pengaturan_kwh/kwh_pengguna/modal_edit', $data, FALSE);
	}

	public function update_modal_edit()
	{
		$id_kmp 		= $this->input->post('id_kmp');
		$nama_kmp 		= $this->input->post('nama_kmp');
		$status_kmp 	= $this->input->post('status_kmp');

		$data['nama_kmp'] 				= $nama_kmp;
		$data['status_kmp'] 			= $status_kmp;

		$update = $this->bd->update('kwh_pengguna', $data, 'id_kmp', $id_kmp);
	}

	public function modal_detail()
	{
		$id_kmp 	= $this->input->post('id_kmp');
		$where 		= $this->bd->where('kwh_jenis', 'pengguna_kmj', $id_kmp)->result_array();

		$data['where'] 		= $where;
		$this->load->view('pengaturan_kwh/kwh_pengguna/modal_detail', $data, FALSE);
	}

}