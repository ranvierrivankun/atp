<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kwh_jenis extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		cek_login();
		akses_pengaturan_kwh();
		$this->load->model('kwh_jenis_model', 'kjm');
		$this->load->model('M_builder', 'bd');
	}

	public function index()
	{
		$data['title'] = 'ATP | kWh Jenis';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar');
		$this->load->view('pengaturan_kwh/kwh_jenis/jenis');
		$this->load->view('templates/footer');
	}

	public function table_kj()
	{
		$status = $this->input->post('status');

		$table 	= $this->kjm->table_kj($status);
		$filter = $this->kjm->filter_table_kj($status);
		$total 	= $this->kjm->total_table_kj($status);

		$data 	= [];

		foreach ($table as $tb) {
			$td = [];

			$edit = "<a class='btn btn-sm btn-light edit' data-id_kmj='$tb->id_kmj'>
			<i class='fa-solid fa-pen-to-square'></i>
			</a>";

			$detail = "<a class='btn btn-sm btn-light detail' data-id_kmj='$tb->id_kmj'>
			<i class='fa-solid fa-circle-info'></i></a>";

			$td[] = "<center><div class='btn-group'>$edit $detail</a></center>";

			$ifelse="";
			if ($tb->status_kmp === '1') {
				$td[] = "<center><span class='badge badge-pill badge-success'>Active</span></center>";
			} else {
				$td[] = "<center><span class='badge badge-pill badge-danger'>Inactive</span></center>";
			};

			$td[] = $tb->nama_kmp;
			$td[] = $tb->nama_kmj;

			$ifelse="";
			if ($tb->phasa_kmj === '1 PHASE') {
				$td[] = "<center><span class='badge badge-pill badge-info'>1 Phase</span></center>";
			} else {
				$td[] = "<center><span class='badge badge-pill badge-danger'>3 Phase</span></center>";
			};

			/*$td[] = $tb->b_kmj . ' Lt.' . $tb->lt_kmj . ' ' . $tb->r_kmj;*/
			$td[] = $tb->beban_kmbb . ' Ampere - ' . $tb->phasa_kmbb . ' Phase ';

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
		$this->load->view('pengaturan_kwh/kwh_jenis/modal_tambah', FALSE);
	}

	public function tambah_jenis_kwh()
	{
		$pengguna_kmj 	= $this->input->post('pengguna_kmj');
		$nama_kmj 		= $this->input->post('nama_kmj');
		$b_kmj 			= $this->input->post('b_kmj');
		$lt_kmj 		= $this->input->post('lt_kmj');
		$r_kmj 			= $this->input->post('r_kmj');
		$k_kmj 			= $this->input->post('k_kmj');
		$merk_kmj 		= $this->input->post('merk_kmj');
		$type_kmj 		= $this->input->post('type_kmj');
		$phasa_kmj 		= $this->input->post('phasa_kmj');
		$kawat_kmj 		= $this->input->post('kawat_kmj');
		$t_kmj 			= $this->input->post('t_kmj');
		$p_kmj 			= $this->input->post('p_kmj');
		$thn_kmj 		= $this->input->post('thn_kmj');
		$fk_kmj 		= $this->input->post('fk_kmj');
		$ket_kmj 		= $this->input->post('ket_kmj');

		$data['pengguna_kmj'] 	= $pengguna_kmj;
		$data['nama_kmj'] 		= $nama_kmj;
		$data['b_kmj'] 			= $b_kmj;
		$data['lt_kmj'] 		= $lt_kmj;
		$data['r_kmj'] 			= $r_kmj;
		$data['k_kmj'] 			= $k_kmj;
		$data['merk_kmj'] 		= $merk_kmj;
		$data['type_kmj'] 		= $type_kmj;
		$data['phasa_kmj'] 		= $phasa_kmj;
		$data['kawat_kmj'] 		= $kawat_kmj;
		$data['t_kmj'] 			= $t_kmj;
		$data['p_kmj'] 			= $p_kmj;
		$data['thn_kmj'] 		= $thn_kmj;
		$data['fk_kmj'] 		= $fk_kmj;
		$data['ket_kmj'] 		= $ket_kmj;
		$save = $this->bd->save('kwh_jenis', $data);
	}

	public function modal_edit()
	{
		$id_kmj 	= $this->input->post('id_kmj');
		$edit 		= $this->kjm->getJenis($id_kmj);

		$data['edit'] 		= $edit;
		$this->load->view('pengaturan_kwh/kwh_jenis/modal_edit', $data, FALSE);
	}

	public function update_modal_edit()
	{
		$id_kmj 		= $this->input->post('id_kmj');

		$pengguna_kmj 	= $this->input->post('pengguna_kmj');
		$nama_kmj 		= $this->input->post('nama_kmj');
		$b_kmj 			= $this->input->post('b_kmj');
		$lt_kmj 		= $this->input->post('lt_kmj');
		$r_kmj 			= $this->input->post('r_kmj');
		$k_kmj 			= $this->input->post('k_kmj');
		$merk_kmj 		= $this->input->post('merk_kmj');
		$type_kmj 		= $this->input->post('type_kmj');
		$phasa_kmj 		= $this->input->post('phasa_kmj');
		$kawat_kmj 		= $this->input->post('kawat_kmj');
		$t_kmj 			= $this->input->post('t_kmj');
		$p_kmj 			= $this->input->post('p_kmj');
		$thn_kmj 		= $this->input->post('thn_kmj');
		$fk_kmj 		= $this->input->post('fk_kmj');
		$ket_kmj 		= $this->input->post('ket_kmj');

		$data['pengguna_kmj'] 	= $pengguna_kmj;
		$data['nama_kmj'] 		= $nama_kmj;
		$data['b_kmj'] 			= $b_kmj;
		$data['lt_kmj'] 		= $lt_kmj;
		$data['r_kmj'] 			= $r_kmj;
		$data['k_kmj'] 			= $k_kmj;
		$data['merk_kmj'] 		= $merk_kmj;
		$data['type_kmj'] 		= $type_kmj;
		$data['phasa_kmj'] 		= $phasa_kmj;
		$data['kawat_kmj'] 		= $kawat_kmj;
		$data['t_kmj'] 			= $t_kmj;
		$data['p_kmj'] 			= $p_kmj;
		$data['thn_kmj'] 		= $thn_kmj;
		$data['fk_kmj'] 		= $fk_kmj;
		$data['ket_kmj'] 		= $ket_kmj;

		$update = $this->bd->update('kwh_jenis', $data, 'id_kmj', $id_kmj);
	}

	public function getPengguna(){

		$searchTerm 	= $this->input->post('searchTerm');
		$response 		= $this->kjm->getPengguna($searchTerm);
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function getBiayaBeban(){

		$searchTerm 	= $this->input->post('searchTerm');
		$response 		= $this->kjm->getBiayaBeban($searchTerm);
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function getFaktorx(){

		$searchTerm 	= $this->input->post('searchTerm');
		$response 		= $this->kjm->getFaktorx($searchTerm);
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function modal_detail()
	{
		$id_kmj 	= $this->input->post('id_kmj');
		$where 		= $this->kjm->getJenis($id_kmj);

		$data['where'] 		= $where;
		$this->load->view('pengaturan_kwh/kwh_jenis/modal_detail', $data, FALSE);
	}
}