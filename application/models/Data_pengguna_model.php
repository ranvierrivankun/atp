<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_pengguna_model extends CI_Model
{

	public function table_datapengguna()
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

		$k_search;
		$this->db->select('*');
		$this->db->from('user_data a');
		$this->db->join('user b','b.id_user=a.id_user');
		$this->db->join('user_role','id_role=b.role');
		$this->db->order_by('id_userdata DESC');
		$batas;

		return $this->db->get()->result();
	}

	public function filter_table_datapengguna()
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

		$k_search;
		$this->db->select('*');
		$this->db->from('user_data a');
		$this->db->join('user b','b.id_user=a.id_user');
		$this->db->join('user_role','id_role=b.role');
		$this->db->order_by('id_userdata DESC');

		return $this->db->get()->num_rows();
	}

	public function total_table_datapengguna()
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

		$k_search;
		$this->db->select('*');
		$this->db->from('user_data a');
		$this->db->join('user b','b.id_user=a.id_user');
		$this->db->join('user_role','id_role=b.role');
		$this->db->order_by('id_userdata DESC');

		return $this->db->get()->num_rows();
	}

	public function getDataPengguna($id_userdata)
	{
		$this->db->select('*');
		$this->db->where('id_userdata', $id_userdata );
		$this->db->from('user_data a');
		$this->db->join('user b','b.id_user=a.id_user');
		$this->db->join('user_role','id_role=b.role');
		$query = $this->db->get();
		return $query->row();
	}

	public function getUser($searchTerm="")
	{
		$where = "status_userdata='0' AND nama_user like '%".$searchTerm."%'";

		$this->db->select('*');
		$this->db->from('user');
		$this->db->where($where);
		$this->db->order_by('id_user', 'DESC');
		$query = $this->db->get()->result_array();

		$data = array();
		foreach($query as $q){
			$data[] = array("id"=>$q['id_user'], "text"=>$q['nama_user']);
		}
		return $data;

	}

}