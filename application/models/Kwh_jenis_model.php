<?php
defined('BASEPATH') or exit('No direct script access allowed');

class kwh_jenis_model extends CI_Model
{

	public function table_kj($status)
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
			beban_kmbb LIKE ' . "'%" . $search . "%'" . '
			OR
			phasa_kmbb LIKE ' . "'%" . $search . "%'" . '
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
		$this->db->join('kwh_biaya_beban', 'id_kmbb=k_kmj');
		$status_kmp;
		$this->db->order_by('id_kmj DESC');
		$batas;

		return $this->db->get()->result();
	}

	public function filter_table_kj($status)
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
			beban_kmbb LIKE ' . "'%" . $search . "%'" . '
			OR
			phasa_kmbb LIKE ' . "'%" . $search . "%'" . '
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
		$this->db->join('kwh_biaya_beban', 'id_kmbb=k_kmj');
		$status_kmp;
		$this->db->order_by('id_kmj DESC');

		return $this->db->get()->num_rows();
	}

	public function total_table_kj($status)
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
			beban_kmbb LIKE ' . "'%" . $search . "%'" . '
			OR
			phasa_kmbb LIKE ' . "'%" . $search . "%'" . '
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
		$this->db->join('kwh_biaya_beban', 'id_kmbb=k_kmj');
		$status_kmp;
		$this->db->order_by('id_kmj DESC');

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

	public function getPengguna($searchTerm="")
	{
		$this->db->select('*');
		$this->db->from('kwh_pengguna');
		$this->db->where("nama_kmp like '%".$searchTerm."%' ");
		$this->db->order_by('id_kmp', 'DESC');
		$query = $this->db->get()->result_array();

		$data = array();
		foreach($query as $q){
			$data[] = array("id"=>$q['id_kmp'], "text"=>$q['nama_kmp']);
		}
		return $data;

	}

	public function getBiayaBeban($searchTerm="")
	{
		$this->db->select('*');
		$this->db->from('kwh_biaya_beban');
		$this->db->where("beban_kmbb like '%".$searchTerm."%' ");
		$this->db->order_by('id_kmbb', 'DESC');
		$query = $this->db->get()->result_array();

		$data = array();
		foreach($query as $q){
			$data[] = array("id"=>$q['id_kmbb'], "text"=>$q['beban_kmbb'] .' Ampere - '.''. $q['phasa_kmbb'] .' Phase '.' ');
		}
		return $data;

	}

	public function getFaktorx($searchTerm="")
	{
		$this->db->select('*');
		$this->db->from('kwh_faktorx');
		$this->db->where("fx_kmfx like '%".$searchTerm."%' ");
		$this->db->order_by('id_kmfx', 'DESC');
		$query = $this->db->get()->result_array();

		$data = array();
		foreach($query as $q){
			$data[] = array("id"=>$q['id_kmfx'], "text"=>$q['fx_kmfx']);
		}
		return $data;

	}

}