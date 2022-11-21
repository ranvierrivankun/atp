<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_pengguna_model extends CI_Model
{

	public function table_pengguna($status)
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');
		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nama_user LIKE ' . "'%" . $search . "%'" . '
			OR
			username LIKE ' . "'%" . $search . "%'" . '
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
			$status_user = $this->db->where('status_user', $status);
		} else {
			$status_user = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('user_role','id_role=role');
		$this->db->join('user_status','id_status=status_user');
		$status_user;
		$this->db->order_by('id_user DESC');
		$batas;

		return $this->db->get()->result();
	}

	public function filter_table_pengguna($status)
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nama_user LIKE ' . "'%" . $search . "%'" . '
			OR
			username LIKE ' . "'%" . $search . "%'" . '
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		if($status != "") {
			$status_user = $this->db->where('status_user', $status);
		} else {
			$status_user = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('user_role','id_role=role');
		$this->db->join('user_status','id_status=status_user');
		$this->db->order_by('id_user DESC');
		$status_user;

		return $this->db->get()->num_rows();
	}

	public function total_table_pengguna($status)
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nama_user LIKE ' . "'%" . $search . "%'" . '
			OR
			username LIKE ' . "'%" . $search . "%'" . '
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}
		
		if($status != "") {
			$status_user = $this->db->where('status_user', $status);
		} else {
			$status_user = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('user_role','id_role=role');
		$this->db->join('user_status','id_status=status_user');
		$this->db->order_by('id_user DESC');
		$status_user;

		return $this->db->get()->num_rows();
	}

	public function table_role()
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');
		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nama_role LIKE ' . "'%" . $search . "%'" . '
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

		$k_search;
		$this->db->select('*');
		$this->db->from('user_role');
		$this->db->order_by('id_role ASC');
		$batas;

		return $this->db->get()->result();
	}

	public function filter_table_role()
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nama_role LIKE ' . "'%" . $search . "%'" . '
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('user_role');
		$this->db->order_by('id_role ASC');

		return $this->db->get()->num_rows();
	}

	public function total_table_role()
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nama_role LIKE ' . "'%" . $search . "%'" . '
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('user_role');
		$this->db->order_by('id_role ASC');

		return $this->db->get()->num_rows();
	}

}