<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kwh_biaya_tarif extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		cek_login();
		akses_pengaturan_kwh();
		$this->load->model('kwh_biaya_tarif_model', 'kbtm');
		$this->load->model('M_builder', 'bd');
	}

	public function index()
	{
		$data['title'] = 'ATP | kWh Biaya Tarif';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar');
		$this->load->view('pengaturan_kwh/kwh_biaya_tarif/biaya_tarif');
		$this->load->view('templates/footer');
	}

	public function table_perkwh()
	{
		$table 	= $this->kbtm->table_perkwh();
		$data 	= [];

		foreach ($table as $tb) {
			$td = [];

			$edit = "<a class='btn btn-sm btn-light edit_biayaperkwh' data-id_kmb='$tb->id_kmb'>
			<i class='fa-solid fa-pen-to-square'></i>
			</a>";
			
			$td[] = "<center><div class='btn-group'>$edit</a></center>";
			$td[] = rupiah($tb->biaya_kmb);

			$data[] = $td;
		}

		$output = [
			'draw' => $this->input->post('draw'),
			'data'=> $data,
		];
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function modal_edit_biayaperkwh()
	{
		$id_kmb 	= $this->input->post('id_kmb');
		$edit 		= $this->bd->edit('kwh_biaya', 'id_kmb', $id_kmb)->row();

		$data['edit'] 		= $edit;
		$this->load->view('pengaturan_kwh/kwh_biaya_tarif/modal_edit_biayaperkwh', $data, FALSE);
	}

	public function update_modal_edit_biayaperkwh()
	{
		$id_kmb 		= $this->input->post('id_kmb');
		$biaya_kmb 		= $this->input->post('biaya_kmb');

		$data['biaya_kmb'] 	= $biaya_kmb;

		$update = $this->bd->update('kwh_biaya', $data, 'id_kmb', $id_kmb);
	}

	public function table_tariftetap()
	{
		$table 	= $this->kbtm->table_tariftetap();
		$data 	= [];

		foreach ($table as $tb) {
			$td = [];

			$edit = "<a class='btn btn-sm btn-light edit_tariftetap' data-id_kmt='$tb->id_kmt'>
			<i class='fa-solid fa-pen-to-square'></i>
			</a>";
			
			$td[] = "<center><div class='btn-group'>$edit</a></center>";
			$td[] = rupiah($tb->tarif_kmt);

			$data[] = $td;
		}

		$output = [
			'draw' => $this->input->post('draw'),
			'data'=> $data,
		];
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function modal_edit_tariftetapkwh()
	{
		$id_kmt 	= $this->input->post('id_kmt');
		$edit 		= $this->bd->edit('kwh_tarif', 'id_kmt', $id_kmt)->row();

		$data['edit'] 		= $edit;
		$this->load->view('pengaturan_kwh/kwh_biaya_tarif/modal_edit_tariftetapkwh', $data, FALSE);
	}

	public function update_modal_edit_tariftetapkwh()
	{
		$id_kmt 		= $this->input->post('id_kmt');
		$tarif_kmt 		= $this->input->post('tarif_kmt');

		$data['tarif_kmt'] 	= $tarif_kmt;

		$update = $this->bd->update('kwh_tarif', $data, 'id_kmt', $id_kmt);
	}

	public function table_kbb()
	{
		$table 	= $this->kbtm->table_kbb();
		$filter = $this->kbtm->filter_table_kbb();
		$total 	= $this->kbtm->total_table_kbb();

		$data 	= [];

		foreach ($table as $tb) {
			$td = [];

			$ifelse="";
			if ($tb->phasa_kmbb === '1') {
				$edit = "<a class='btn btn-sm btn-light edit_1' data-id_kmbb='$tb->id_kmbb'>
				<i class='fa-solid fa-pen-to-square'></i>
				</a>";
			} else {
				$edit = "<a class='btn btn-sm btn-light edit_3' data-id_kmbb='$tb->id_kmbb'>
				<i class='fa-solid fa-pen-to-square'></i>
				</a>";
			};
			
			$delete = "<a class='btn btn-sm btn-danger' href='javascript:void(0)' onclick='delete_kmbb($tb->id_kmbb)''>
			<i class='fa-solid fa-trash'></i>";

			$td[] = "<center><div class='btn-group'>$edit $delete</a></center>";

			$td[] = $tb->beban_kmbb. ' Ampere';

			$ifelse="";
			if ($tb->phasa_kmbb === '1') {
				$td[] = "<center><span class='badge badge-pill badge-info'>1 Phase</span></center>";
			} else {
				$td[] = "<center><span class='badge badge-pill badge-danger'>3 Phase</span></center>";
			};

			$td[] = rupiah($tb->bb_kmbb);

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

	public function modal_tambah_1()
	{
		$getTarif 	= $this->bd->all('kwh_tarif', 'id_kmt', 'ASC')->row_array();

		$data['getTarif'] 	= $getTarif;
		$this->load->view('pengaturan_kwh/kwh_biaya_tarif/modal_tambah_1', $data, FALSE);
	}

	public function tambah_tarif_1()
	{
		$phasa_kmbb 	= $this->input->post('phasa_kmbb');
		$beban_kmbb 	= $this->input->post('beban_kmbb');
		$bb_kmbb 		= $this->input->post('bb_kmbb');

		$data['phasa_kmbb'] 	= $phasa_kmbb;
		$data['beban_kmbb'] 	= $beban_kmbb;
		$data['bb_kmbb'] 		= $bb_kmbb;

		$save = $this->bd->save('kwh_biaya_beban', $data);
	}

	public function modal_edit_1()
	{
		$id_kmbb 	= $this->input->post('id_kmbb');
		$edit 		= $this->bd->edit('kwh_biaya_beban', 'id_kmbb', $id_kmbb)->row();
		$getTarif 	= $this->bd->all('kwh_tarif', 'id_kmt', 'ASC')->row_array();

		$data['edit'] 		= $edit;
		$data['getTarif'] 	= $getTarif;

		$this->load->view('pengaturan_kwh/kwh_biaya_tarif/modal_edit_1', $data, FALSE);
	}

	public function update_modal_edit_1()
	{
		$id_kmbb 		= $this->input->post('id_kmbb');
		$beban_kmbb 	= $this->input->post('beban_kmbb');
		$bb_kmbb 		= $this->input->post('bb_kmbb');

		$data['beban_kmbb'] 	= $beban_kmbb;
		$data['bb_kmbb'] 		= $bb_kmbb;

		$update = $this->bd->update('kwh_biaya_beban', $data, 'id_kmbb', $id_kmbb);
	}

	public function modal_tambah_3()
	{
		$getTarif 	= $this->bd->all('kwh_tarif', 'id_kmt', 'ASC')->row_array();

		$data['getTarif'] 	= $getTarif;
		$this->load->view('pengaturan_kwh/kwh_biaya_tarif/modal_tambah_3', $data, FALSE);
	}

	public function tambah_tarif_3()
	{
		$phasa_kmbb 	= $this->input->post('phasa_kmbb');
		$beban_kmbb 	= $this->input->post('beban_kmbb');
		$bb_kmbb 		= $this->input->post('bb_kmbb');

		$data['phasa_kmbb'] 	= $phasa_kmbb;
		$data['beban_kmbb'] 	= $beban_kmbb;
		$data['bb_kmbb'] 		= $bb_kmbb;

		$save = $this->bd->save('kwh_biaya_beban', $data);
	}

	public function modal_edit_3()
	{
		$id_kmbb 	= $this->input->post('id_kmbb');
		$edit 		= $this->bd->edit('kwh_biaya_beban', 'id_kmbb', $id_kmbb)->row();
		$getTarif 	= $this->bd->all('kwh_tarif', 'id_kmt', 'ASC')->row_array();

		$data['edit'] 		= $edit;
		$data['getTarif'] 	= $getTarif;

		$this->load->view('pengaturan_kwh/kwh_biaya_tarif/modal_edit_3', $data, FALSE);
	}

	public function update_modal_edit_3()
	{
		$id_kmbb 		= $this->input->post('id_kmbb');
		$beban_kmbb 	= $this->input->post('beban_kmbb');
		$bb_kmbb 		= $this->input->post('bb_kmbb');

		$data['beban_kmbb'] 	= $beban_kmbb;
		$data['bb_kmbb'] 		= $bb_kmbb;

		$update = $this->bd->update('kwh_biaya_beban', $data, 'id_kmbb', $id_kmbb);
	}

	public function delete_kmbb()
	{
		if ($this->input->is_ajax_request() == true) {
			$id_kmbb = $this->input->post('id',true);
			$hapus = $this->bd->delete('kwh_biaya_beban','id_kmbb', $id_kmbb);

			if($hapus){
				$msg = [ 'sukses' => 'Biaya Beban Berhasil Terhapus'
			];
		}
		echo json_encode($msg);
	}
}

}