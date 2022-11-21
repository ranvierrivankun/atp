<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kwh_meter extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		cek_login();
		akses_kwh_meter();
		$this->load->model('kwh_meter_model', 'kmm');
		$this->load->model('M_builder', 'bd');
	}

	public function index()
	{
		$data['title'] = 'ATP | kWh Meter';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar');
		$this->load->view('kwh_meter/index');
		$this->load->view('templates/footer');
	}

	public function table_km()
	{
		$status = $this->input->post('status');

		$table 	= $this->kmm->table_km($status);
		$filter = $this->kmm->filter_table_km($status);
		$total 	= $this->kmm->total_table_km($status);

		$data 	= [];

		foreach ($table as $tb) {
			$td = [];

			$pemakaian = "<a class='btn btn-sm btn-light' target='_blank' href='kwh_meter/pemakaian/$tb->id_kmj' >
			<i class='fa-regular fa-square-plus'></i>
			</a>";

			$detail = "<a class='btn btn-sm btn-light detail' data-id_kmj='$tb->id_kmj'>
			<i class='fa-solid fa-circle-info'></i></a>";

			$td[] = "<center><div class='btn-group'>$pemakaian $detail</a></center>";

			$ifelse="";
			if ($tb->status_kmp === '1') {
				$td[] = "<center><span class='badge badge-pill badge-success'>Active</span></center>";
			} else {
				$td[] = "<center><span class='badge badge-pill badge-danger'>Inactive</span></center>";
			};

			$td[] = $tb->nama_kmp;
			$td[] = $tb->nama_kmj;
			$td[] = $tb->b_kmj . ' Lt.' . $tb->lt_kmj . ' ' . $tb->r_kmj;

			$data[] = $td;
		}

		$output = [
			'draw' 				=> $this->input->post('draw'),
			'recordsTotal' 		=> $total,
			'recordsFiltered' 	=> $filter,
			'data'				=> $data,
		];
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function modal_detail()
	{
		$id_kmj 			= $this->input->post('id_kmj');
		$where 				= $this->kmm->getJenis($id_kmj);

		$data['where'] 		= $where;
		$this->load->view('pengaturan_kwh/kwh_jenis/modal_detail', $data, FALSE);
	}

	public function pemakaian($id_kmj)
	{
		$data['title'] 		= 'ATP | kWh Meter Pemakaian';

		$where 				= $this->bd->where('kwh_jenis', 'id_kmj', $id_kmj)->row();
		$data['where'] 		= $where;

		$reset 				= $this->db->select('*')->from('kwh_jenis')->where('id_kmj', $id_kmj)->join('kwh_pemakaian_lalu', 'id_kmjl=id_kmj')->order_by('id_kml', 'DESC')->get()->row();
		$data['reset'] 		= $reset;

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar');
		$this->load->view('kwh_meter/pemakaian', $data);
		$this->load->view('templates/footer');
	}

	public function table_km_pemakaian()
	{
		$tahun 	= $this->input->post('tahun');
		$id_kmj = $this->input->post('id_kmj');

		/*$user = $this->session->userdata('login_session');*/
		$role = userdata('role');

		$table 	= $this->kmm->table_km_pemakaian($tahun, $id_kmj);
		$filter = $this->kmm->filter_table_kmtable_km_pemakaian($tahun, $id_kmj);
		$total 	= $this->kmm->total_table_km_pemakaian($tahun, $id_kmj);

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

			$print = "<a class='btn btn-sm btn-dark' target='_blank' media='print' href='".base_url('kwh_meter/print/').$tb->pengguna_kmpk.'/print?data='.$tb->btahun_kmpk. "' >
			<i class='fa-solid fa-print'></i></a>";

			$reset = "<a class='btn btn-sm btn-danger reset' data-id_kmpk='$tb->id_kmpk'>
			<i class='fa-solid fa-repeat text-light'></i>
			</a>";

			$edit = "<a class='btn btn-sm btn-light edit' data-id_kmpk='$tb->id_kmpk'>
			<i class='fa-solid fa-pen-to-square'></i>
			</a>";

			/* Jika Role Admin */
			if ($role == '1') {

				if ($tb->s_kmpk >= "100000" && $tb->status_kmpk != "1") {
					$td[] = "<center><div class='btn-group'>$edit $foto $reset</a></center>";
				} else if ($tb->btahun_kmpk == date('M-Y')) {
					$td[] = "<center><div class='btn-group'>$edit $foto $print</a></center>";
				} else {
					$td[] = "<center><div class='btn-group'>$foto $print</a></center>";
				}

				/* Jika Role Pengawas TP */
			} else if ($role == '2') {

				if ($tb->s_kmpk >= "100000" && $tb->status_kmpk != "1") {
					$td[] = "<center><div class='btn-group'>$edit $foto $reset</a></center>";
				} else if ($tb->btahun_kmpk == date('M-Y')) {
					$td[] = "<center><div class='btn-group'>$edit $foto $print</a></center>";
				} else {
					$td[] = "<center><div class='btn-group'>$foto $print</a></center>";
				}

			} else {

				if ($tb->s_kmpk >= "100000" && $tb->status_kmpk != "1") {
					$td[] = "<center><div class='btn-group'>$foto $reset</a></center>";
				} else {
					$td[] = "<center><div class='btn-group'>$foto $print</a></center>";
				}

			}

			$td[] = $tb->btahun_kmpk;

			$ifelse='';

			if ($tb->limit_kmpk >= "1") {
				$td[] = $tb->l_kmpk.'
				<span class="badge badge-danger badge-counter">'.$tb->limit_kmpk.'</span>
				';
			} else {
				$td[] = $tb->l_kmpk;
			};

			$td[] = $tb->s_kmpk;
			$td[] = $tb->se_kmpk;
			$td[] = $tb->fx_kmpk;
			$td[] = $tb->jk_kmpk;
			$td[] = rupiah($tb->bk_kmpk);
			$td[] = rupiah($tb->bb_kmpk);
			$td[] = rupiah($tb->bt_kmpk);
			$td[] = rupiah($tb->j_kmpk);
			$td[] = $tb->nama_user;

			$data[] = $td;
		}

		$output = [
			'draw' 				=> $this->input->post('draw'),
			'recordsTotal' 		=> $total,
			'recordsFiltered' 	=> $filter,
			'data'				=> $data,
		];
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function modal_tambah()
	{
		$id_kmj 			= $this->input->post('id_kmj');
		$where 				= $this->kmm->getJenis($id_kmj);

		$getBiaya			= $this->bd->all('kwh_biaya', 'id_kmb', 'ASC')->row();
		$getLalu 			= $this->bd->edit('kwh_pemakaian_lalu', 'id_kmjl', $id_kmj)->row();

		$data['where'] 		= $where;
		$data['getBiaya'] 	= $getBiaya;
		$data['getLalu'] 	= $getLalu;
		$this->load->view('kwh_meter/modal_tambah', $data, FALSE);
	}

	public function tambah_pemakaian_kwh()
	{
		/* Input Type Hidden */
		$tahun_kmpk 		= $this->input->post('tahun_kmpk');
		$jenis_kmpk 		= $this->input->post('jenis_kmpk');
		$pengguna_kmpk 		= $this->input->post('pengguna_kmpk');
		$user_kmpk 			= $this->input->post('user_kmpk');
		$nama_kmj 			= $this->input->post('nama_kmj');

		$btahun_kmpk 		= $this->input->post('btahun_kmpk');
		$l_kmpk 			= $this->input->post('l_kmpk');
		$s_kmpk 			= $this->input->post('s_kmpk');
		$se_kmpk 			= $this->input->post('se_kmpk');
		$fx_kmpk 			= $this->input->post('fx_kmpk');
		$jk_kmpk 			= $this->input->post('jk_kmpk');
		$bk_kmpk 			= $this->input->post('bk_kmpk');
		$bb_kmpk 			= $this->input->post('bb_kmpk');
		$bt_kmpk 			= $this->input->post('bt_kmpk');
		$j_kmpk 			= $this->input->post('j_kmpk');

		/* Proses Jika Upload Foto */
		$total 				= $this->db->select_max('id_kmpk')->get('kwh_pemakaian')->row()->id_kmpk + 1;
		$id_user 			= userdata('id_user');
		$foto_kmpk 			= $this->db->select('*')->from('tmp_file')->where('kode', 'foto_kmpk')->where('id_user', $id_user)->get();

		if($foto_kmpk->num_rows() > 0) {
			$file_kwh 			= $foto_kmpk->row();
			$file_kwh1 			= $file_kwh->file;
			$filename 			= date('M-Y').'_'.$nama_kmj.'_'.$total.'.jpg';
			$file_old 			= './assets/img/kwh/'.$file_kwh1;
			$file_rename 		= './assets/img/kwh/'.$filename;
			$hasil 				= rename($file_old, $file_rename);
			$kp['foto_kmpk'] 	= $filename;
		}
		$delete = $this->db->where('kode', 'foto_kmpk')->where('id_user', $id_user)->delete('tmp_file');

		/* Insert to tb kwh_pemakaian_lalu */
		$kpl['id_kmjl'] 		= $jenis_kmpk;
		$kpl['v_kml'] 			= $s_kmpk;

		$save = $this->bd->save('kwh_pemakaian_lalu', $kpl);

		/* Insert to tb kwh_pemakaian */
		$kp['tahun_kmpk'] 		= $tahun_kmpk;
		$kp['jenis_kmpk'] 		= $jenis_kmpk;
		$kp['pengguna_kmpk'] 	= $pengguna_kmpk;
		$kp['user_kmpk'] 		= $user_kmpk;
		$kp['btahun_kmpk'] 		= $btahun_kmpk;
		$kp['l_kmpk'] 			= $l_kmpk;
		$kp['s_kmpk'] 			= $s_kmpk;
		$kp['se_kmpk'] 			= $se_kmpk;
		$kp['fx_kmpk'] 			= $fx_kmpk;
		$kp['jk_kmpk'] 			= $jk_kmpk;
		$kp['bk_kmpk'] 			= $bk_kmpk;
		$kp['bb_kmpk'] 			= $bb_kmpk;
		$kp['bt_kmpk'] 			= $bt_kmpk;
		$kp['j_kmpk'] 			= $j_kmpk;

		$save 	= $this->bd->save('kwh_pemakaian', $kp);
		$update = $this->bd->update('kwh_jenis', ["status_kmpkj" => 1], 'id_kmj', $jenis_kmpk );
	}

	public function tambah_pemakaian_kwh_2()
	{
		/* Input Type Hidden */
		$tahun_kmpk 		= $this->input->post('tahun_kmpk');
		$jenis_kmpk 		= $this->input->post('jenis_kmpk');
		$pengguna_kmpk 		= $this->input->post('pengguna_kmpk');
		$user_kmpk 			= $this->input->post('user_kmpk');
		$limit_kmpk 		= $this->input->post('limit_kmpkj');
		$nama_kmj 			= $this->input->post('nama_kmj');

		$btahun_kmpk 		= $this->input->post('btahun_kmpk');
		$l_kmpk 			= $this->input->post('l_kmpk');
		$s_kmpk 			= $this->input->post('s_kmpk');
		$se_kmpk 			= $this->input->post('se_kmpk');
		$fx_kmpk 			= $this->input->post('fx_kmpk');
		$jk_kmpk 			= $this->input->post('jk_kmpk');
		$bk_kmpk 			= $this->input->post('bk_kmpk');
		$bb_kmpk 			= $this->input->post('bb_kmpk');
		$bt_kmpk 			= $this->input->post('bt_kmpk');
		$j_kmpk 			= $this->input->post('j_kmpk');

		/* Proses Jika Upload Foto */
		$total 				= $this->db->select_max('id_kmpk')->get('kwh_pemakaian')->row()->id_kmpk + 1;
		$id_user 			= userdata('id_user');
		$foto_kmpk 			= $this->db->select('*')->from('tmp_file')->where('kode', 'foto_kmpk')->where('id_user', $id_user)->get();

		if($foto_kmpk->num_rows() > 0) {
			$file_kwh 			= $foto_kmpk->row();
			$file_kwh1 			= $file_kwh->file;
			$filename 			= date('M-Y').'_'.$nama_kmj.'_'.$total.'.jpg';
			$file_old 			= './assets/img/kwh/'.$file_kwh1;
			$file_rename 		= './assets/img/kwh/'.$filename;
			$hasil 				= rename($file_old, $file_rename);
			$kp['foto_kmpk'] 	= $filename;
		}
		$delete = $this->db->where('kode', 'foto_kmpk')->where('id_user', $id_user)->delete('tmp_file');

		/* Update to tb kwh_pemakaian_lalu */
		$kpl['v_kml'] 			= $s_kmpk;

		$update = $this->bd->update('kwh_pemakaian_lalu', $kpl, 'id_kmjl', $jenis_kmpk);

		/* Insert to tb kwh_pemakaian */
		$kp['tahun_kmpk'] 		= $tahun_kmpk;
		$kp['jenis_kmpk'] 		= $jenis_kmpk;
		$kp['pengguna_kmpk'] 	= $pengguna_kmpk;
		$kp['user_kmpk'] 		= $user_kmpk;
		$kp['limit_kmpk'] 		= $limit_kmpk;
		$kp['btahun_kmpk'] 		= $btahun_kmpk;
		$kp['l_kmpk'] 			= $l_kmpk;
		$kp['s_kmpk'] 			= $s_kmpk;
		$kp['se_kmpk'] 			= $se_kmpk;
		$kp['fx_kmpk'] 			= $fx_kmpk;
		$kp['jk_kmpk'] 			= $jk_kmpk;
		$kp['bk_kmpk'] 			= $bk_kmpk;
		$kp['bb_kmpk'] 			= $bb_kmpk;
		$kp['bt_kmpk'] 			= $bt_kmpk;
		$kp['j_kmpk'] 			= $j_kmpk;

		$save 	= $this->bd->save('kwh_pemakaian', $kp);
		$update = $this->bd->update('kwh_jenis', ["status_kmpkj" => 1], 'id_kmj', $jenis_kmpk);
	}

	public function modal_reset()
	{
		$id_kmpk 	= $this->input->post('id_kmpk');
		$edit 		= $this->bd->edit('kwh_pemakaian', 'id_kmpk', $id_kmpk)->row();

		$data['edit'] 		= $edit;
		$this->load->view('kwh_meter/modal_reset', $data, FALSE);
	}

	public function update_modal_reset()
	{
		$id_kmpk 			= $this->input->post('id_kmpk');
		$id_kmj 			= $this->input->post('jenis_kmpk');

		/* Update kWh Pemakaian lalu ke kWh Sekarang*/
		$v_kml 				= $this->input->post('s_kmpk');
		$lalu['v_kml'] 		= $v_kml;
		$update 			= $this->bd->update('kwh_pemakaian_lalu', $lalu, 'id_kmjl', $id_kmj);

		/* Update status_kmpk & limit_kmpk di tb kwh_pemakaian */
		$limit_kmpk 					= $this->db->select_max('limit_kmpk')->from('kwh_pemakaian')->where('id_kmpk', $id_kmpk)->get()->row()->limit_kmpk + 1;

		$kwh_pemakaian['status_kmpk'] 	= 1;
		$kwh_pemakaian['limit_kmpk'] 	= $limit_kmpk;
		$update 						= $this->bd->update('kwh_pemakaian', $kwh_pemakaian, 'id_kmpk', $id_kmpk);

		/* Update limit_kmpkj di tb kwh_jenis */
		$limit_kmpkj				= $this->db->select_max('limit_kmpkj')->from('kwh_jenis')->where('id_kmj', $id_kmj)->get()->row()->limit_kmpkj + 1;

		$kwh_jenis['limit_kmpkj'] 	= $limit_kmpkj;
		$update 					= $this->bd->update('kwh_jenis', $kwh_jenis, 'id_kmj', $id_kmj);
	}

	public function modal_edit()
	{
		$id_kmpk 			= $this->input->post('id_kmpk');
		$edit				= $this->kmm->getPemakaian($id_kmpk);

		$data['edit'] 		= $edit;
		$this->load->view('kwh_meter/modal_edit', $data, FALSE);
	}

	public function update_modal_edit()
	{
		/* Input Type Hidden */
		$id_kmpk 			= $this->input->post('id_kmpk');
		$jenis_kmpk 		= $this->input->post('jenis_kmpk');
		$nama_kmj 			= $this->input->post('nama_kmj');

		$s_kmpk 			= $this->input->post('s_kmpk');
		$se_kmpk 			= $this->input->post('se_kmpk');
		$jk_kmpk 			= $this->input->post('jk_kmpk');
		$bb_kmpk 			= $this->input->post('bb_kmpk');
		$j_kmpk 			= $this->input->post('j_kmpk');

		/* Proses Jika Upload Foto */
		$total 				= $this->db->select_max('id_kmpk')->get('kwh_pemakaian')->row()->id_kmpk + 1;
		$id_user 			= userdata('id_user');
		$foto_kmpk 			= $this->db->select('*')->from('tmp_file')->where('kode', 'foto_kmpk')->where('id_user', $id_user)->get();

		$cek_foto_kmpk 		= $this->db->select('*')->from('kwh_pemakaian')->where('id_kmpk', $id_kmpk)->get()->row();

		if($foto_kmpk->num_rows() > 0) {
			$old_file = $cek_foto_kmpk->foto_kmpk;
			unlink(FCPATH . 'assets/img/kwh/' . $old_file);

			$file_kwh 			= $foto_kmpk->row();
			$file_kwh1 			= $file_kwh->file;
			$filename 			= date('M-Y').'_'.$nama_kmj.'_'.$total.'.jpg';
			$file_old 			= './assets/img/kwh/'.$file_kwh1;
			$file_rename 		= './assets/img/kwh/'.$filename;
			$hasil 				= rename($file_old, $file_rename);
			$kp['foto_kmpk'] 	= $filename;
		}
		$delete = $this->db->where('kode', 'foto_kmpk')->where('id_user', $id_user)->delete('tmp_file');

		/* Update to tb kwh_pemakaian_lalu */
		$kpl['v_kml'] 			= $s_kmpk;

		$update = $this->bd->update('kwh_pemakaian_lalu', $kpl, 'id_kmjl', $jenis_kmpk);

		/* Update to tb kwh_pemakaian */
		$kp['s_kmpk'] 			= $s_kmpk;
		$kp['se_kmpk'] 			= $se_kmpk;
		$kp['jk_kmpk'] 			= $jk_kmpk;
		$kp['bb_kmpk'] 			= $bb_kmpk;
		$kp['j_kmpk'] 			= $j_kmpk;

		$update = $this->bd->update('kwh_pemakaian', $kp, 'id_kmpk', $id_kmpk);
	}

	public function print($id)
	{
		/* Mengambil btahun_kmpk dari data= di url */
		$btahun_kmpk 	= $this->input->get('data');

		$data['getJenisPrint']	= $this->kmm->getJenisPrint($id, $btahun_kmpk);
		$data['printPengguna']	= $this->kmm->printPengguna($id, $btahun_kmpk);
		$data['printJumlah']	= $this->kmm->printJumlah($id, $btahun_kmpk);

		$this->load->view('kwh_meter/print', $data);
	}
}