<?php
defined('BASEPATH') or exit('No direct script access allowed');

class kwh_meter_model extends CI_Model
{

	public function table_km($status)
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');
		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nama_kmp LIKE ' . "'%" . $search . "%'" . '
			OR
			nama_kmj LIKE ' . "'%" . $search . "%'" . '
			OR
			b_kmj LIKE ' . "'%" . $search . "%'" . '
			OR
			lt_kmj LIKE ' . "'%" . $search . "%'" . '
			OR
			r_kmj LIKE ' . "'%" . $search . "%'" . '
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		if($awal == -1){
			$batas = "";
		}else{
			$batas = $this->db->limit($awal, $akhir);
		}

		if($status != "") {
			$status_kmp = $this->db->where('status_kmp', $status);
		} else {
			$status_kmp = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('kwh_jenis');
		$this->db->join('kwh_pengguna', 'id_kmp=pengguna_kmj');
		$status_kmp;
		$this->db->order_by('id_kmj DESC');
		$batas;

		return $this->db->get()->result();
	}

	public function filter_table_km($status)
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nama_kmp LIKE ' . "'%" . $search . "%'" . '
			OR
			nama_kmj LIKE ' . "'%" . $search . "%'" . '
			OR
			b_kmj LIKE ' . "'%" . $search . "%'" . '
			OR
			lt_kmj LIKE ' . "'%" . $search . "%'" . '
			OR
			r_kmj LIKE ' . "'%" . $search . "%'" . '
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		if($status != "") {
			$status_kmp = $this->db->where('status_kmp', $status);
		} else {
			$status_kmp = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('kwh_jenis');
		$this->db->join('kwh_pengguna', 'id_kmp=pengguna_kmj');
		$status_kmp;
		$this->db->order_by('id_kmj DESC');

		return $this->db->get()->num_rows();
	}

	public function total_table_km($status)
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nama_kmp LIKE ' . "'%" . $search . "%'" . '
			OR
			nama_kmj LIKE ' . "'%" . $search . "%'" . '
			OR
			b_kmj LIKE ' . "'%" . $search . "%'" . '
			OR
			lt_kmj LIKE ' . "'%" . $search . "%'" . '
			OR
			r_kmj LIKE ' . "'%" . $search . "%'" . '
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		if($status != "") {
			$status_kmp = $this->db->where('status_kmp', $status);
		} else {
			$status_kmp = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('kwh_jenis');
		$this->db->join('kwh_pengguna', 'id_kmp=pengguna_kmj');
		$status_kmp;
		$this->db->order_by('id_kmj DESC');

		return $this->db->get()->num_rows();
	}

	public function table_km_pemakaian($tahun, $id_kmj)
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');
		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			btahun_kmpk LIKE ' . "'%" . $search . "%'" . '
			OR
			l_kmpk LIKE ' . "'%" . $search . "%'" . '
			OR
			s_kmpk LIKE ' . "'%" . $search . "%'" . '
			OR
			se_kmpk LIKE ' . "'%" . $search . "%'" . '
			OR
			jk_kmpk LIKE ' . "'%" . $search . "%'" . '
			OR
			bb_kmpk LIKE ' . "'%" . $search . "%'" . '
			OR
			j_kmpk LIKE ' . "'%" . $search . "%'" . '
			OR
			nama_user LIKE ' . "'%" . $search . "%'" . '
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		if($awal == -1){
			$batas = "";
		}else{
			$batas = $this->db->limit($awal, $akhir);
		}

		if($tahun != "") {
			$thn = $this->db->where('tahun_kmpk', $tahun);
		} else {
			$thn = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->where('jenis_kmpk', $id_kmj);
		$this->db->from('kwh_pemakaian');
		$this->db->join('user', 'id_user=user_kmpk');
		$this->db->join('kwh_jenis', 'id_kmj=jenis_kmpk');
		$thn;
		$this->db->order_by('id_kmpk DESC');
		$batas;

		return $this->db->get()->result();
	}

	public function filter_table_kmtable_km_pemakaian($tahun, $id_kmj)
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			btahun_kmpk LIKE ' . "'%" . $search . "%'" . '
			OR
			l_kmpk LIKE ' . "'%" . $search . "%'" . '
			OR
			s_kmpk LIKE ' . "'%" . $search . "%'" . '
			OR
			se_kmpk LIKE ' . "'%" . $search . "%'" . '
			OR
			jk_kmpk LIKE ' . "'%" . $search . "%'" . '
			OR
			bb_kmpk LIKE ' . "'%" . $search . "%'" . '
			OR
			j_kmpk LIKE ' . "'%" . $search . "%'" . '
			OR
			nama_user LIKE ' . "'%" . $search . "%'" . '
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		if($tahun != "") {
			$thn = $this->db->where('tahun_kmpk', $tahun);
		} else {
			$thn = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->where('jenis_kmpk', $id_kmj);
		$this->db->from('kwh_pemakaian');
		$this->db->join('user', 'id_user=user_kmpk');
		$this->db->join('kwh_jenis', 'id_kmj=jenis_kmpk');
		$thn;
		$this->db->order_by('id_kmpk DESC');

		return $this->db->get()->num_rows();
	}

	public function total_table_km_pemakaian($tahun, $id_kmj)
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			btahun_kmpk LIKE ' . "'%" . $search . "%'" . '
			OR
			l_kmpk LIKE ' . "'%" . $search . "%'" . '
			OR
			s_kmpk LIKE ' . "'%" . $search . "%'" . '
			OR
			se_kmpk LIKE ' . "'%" . $search . "%'" . '
			OR
			jk_kmpk LIKE ' . "'%" . $search . "%'" . '
			OR
			bb_kmpk LIKE ' . "'%" . $search . "%'" . '
			OR
			j_kmpk LIKE ' . "'%" . $search . "%'" . '
			OR
			nama_user LIKE ' . "'%" . $search . "%'" . '
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		if($tahun != "") {
			$thn = $this->db->where('tahun_kmpk', $tahun);
		} else {
			$thn = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->where('jenis_kmpk', $id_kmj);
		$this->db->from('kwh_pemakaian');
		$this->db->join('user', 'id_user=user_kmpk');
		$this->db->join('kwh_jenis', 'id_kmj=jenis_kmpk');
		$thn;
		$this->db->order_by('id_kmpk DESC');

		return $this->db->get()->num_rows();
	}

	public function getJenis($id_kmj)
	{
		$this->db->select('*');
		$this->db->where('id_kmj', $id_kmj );
		$this->db->from('kwh_jenis');
		$this->db->join('kwh_pengguna','id_kmp=pengguna_kmj');
		$this->db->join('kwh_biaya_beban','id_kmbb=k_kmj');
		$this->db->join('kwh_faktorx','id_kmfx=fk_kmj');
		$query = $this->db->get();
		return $query->row();
	}

	public function getPemakaian($id_kmpk)
	{
		$this->db->select('*');
		$this->db->where('id_kmpk', $id_kmpk );
		$this->db->from('kwh_pemakaian');
		$this->db->join('kwh_jenis','id_kmj=jenis_kmpk');
		$query = $this->db->get();
		return $query->row();
	}

	public function getJenisPrint($id, $btahun_kmpk)
	{
		$this->db->select('*');
		$this->db->where('pengguna_kmpk', $id);
		$this->db->where('btahun_kmpk', $btahun_kmpk);
		$this->db->from('kwh_pemakaian');
		$this->db->join('kwh_pengguna','id_kmp=pengguna_kmpk');
		$this->db->join('kwh_jenis','id_kmj=jenis_kmpk');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function printPengguna($id, $btahun_kmpk)
	{
		$this->db->select('*');
		$this->db->where('pengguna_kmpk', $id);
		$this->db->where('btahun_kmpk', $btahun_kmpk);
		$this->db->from('kwh_pemakaian');
		$this->db->join('kwh_pengguna','id_kmp=pengguna_kmpk');
		$this->db->join('kwh_jenis','id_kmj=jenis_kmpk');
		$query = $this->db->get();
		return $query->row();
	}

	public function printJumlah($id, $btahun_kmpk)
	{
		$this->db->select('SUM(j_kmpk) as j_kmpk');
		$this->db->where('pengguna_kmpk', $id);
		$this->db->where('btahun_kmpk', $btahun_kmpk);
		$this->db->from('kwh_pemakaian');
		return $this->db->get()->row()->j_kmpk;
	}

}