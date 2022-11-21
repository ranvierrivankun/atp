<?php
defined('BASEPATH') or exit('No direct script access allowed');

class kwh_pengguna_model extends CI_Model
{

	public function table_kp($status)
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');
		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nama_kmp LIKE ' . "'%" . $search . "%'" . '
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
		$this->db->from('kwh_pengguna');
		$status_kmp;
		$this->db->order_by('id_kmp DESC, status_kmp ASC');
		$batas;

		return $this->db->get()->result();
	}

	public function filter_table_kp($status)
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nama_kmp LIKE ' . "'%" . $search . "%'" . '
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
		$this->db->from('kwh_pengguna');
		$this->db->order_by('id_kmp DESC, status_kmp ASC');
		$status_kmp;

		return $this->db->get()->num_rows();
	}

	public function total_table_kp($status)
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nama_kmp LIKE ' . "'%" . $search . "%'" . '
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
		$this->db->from('kwh_pengguna');
		$this->db->order_by('id_kmp DESC, status_kmp ASC');
		$status_kmp;

		return $this->db->get()->num_rows();
	}

}