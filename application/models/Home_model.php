<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home_model extends CI_Model
{

	/*Menghitung total pengguna*/
	public function total_pengguna()
	{
		$query = $this->db->get('user');
		if($query->num_rows()>0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}

	/*Menghitung total data pengguna*/
	public function total_data_pengguna()
	{
		$query = $this->db->get('user_data');
		if($query->num_rows()>0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}

	/*Menghitung total pengguna aktif*/
	public function total_pengguna_active()
	{
		$query = $this->db->select('*')->where('status_user', '1')->from('user')->get();
		if($query->num_rows()>0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}

	/*Menghitung total pengguna inactive*/
	public function total_pengguna_inactive()
	{
		$query = $this->db->select('*')->where('status_user', '2')->from('user')->get();
		if($query->num_rows()>0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}

	/*Menghitung total kwh pemakaian*/
	public function total_kwh()
	{
		$query = $this->db->get('kwh_pemakaian');
		if($query->num_rows()>0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}

	/*Menghitung total jenis kwh*/
	public function total_jenis_kwh()
	{
		$query = $this->db->get('kwh_jenis');
		if($query->num_rows()>0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}

	/*Menghitung total pengguna kwh yang aktif*/
	public function total_kwh_active()
	{
		$query = $this->db->select('*')->where('status_kmp', '1')->from('kwh_jenis')->join('kwh_pengguna', 'id_kmp=pengguna_kmj')->get();
		if($query->num_rows()>0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}

	/*Menghitung total pengguna kwh yang inactive*/
	public function total_kwh_inactive()
	{
		$query = $this->db->select('*')->where('status_kmp', '2')->from('kwh_jenis')->join('kwh_pengguna', 'id_kmp=pengguna_kmj')->get();
		if($query->num_rows()>0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}

	/*Menghitung total jumlah kwh sekarang*/
	public function total_jumlah_kwh_now()
	{
		$tanggal = date('M-Y');
		$this->db->select('SUM(j_kmpk) as j_kmpk');
		$this->db->where('btahun_kmpk', $tanggal);
		$this->db->from('kwh_pemakaian');
		return $this->db->get()->row()->j_kmpk;
	}

	/*Menghitung total jumlah biaya keseluruhan*/
	public function total_jumlah_kwh()
	{
		$this->db->select('SUM(j_kmpk) as j_kmpk');
		$this->db->from('kwh_pemakaian');
		return $this->db->get()->row()->j_kmpk;
	}

	public function table_kn()
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');
		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nama_kmj LIKE ' . "'%" . $search . "%'" . '
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
		$now = date('M-Y');
		$this->db->select('*');
		$this->db->where('btahun_kmpk', $now);
		$this->db->from('kwh_pemakaian');
		$this->db->join('kwh_jenis', 'id_kmj=jenis_kmpk');
		$this->db->order_by('id_kmpk DESC');
		$batas;

		return $this->db->get()->result();
	}

	public function filter_table_kn()
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nama_kmj LIKE ' . "'%" . $search . "%'" . '
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$now = date('M-Y');
		$this->db->select('*');
		$this->db->where('btahun_kmpk', $now);
		$this->db->from('kwh_pemakaian');
		$this->db->join('kwh_jenis', 'id_kmj=jenis_kmpk');
		$this->db->order_by('id_kmpk DESC');

		return $this->db->get()->num_rows();
	}

	public function total_table_kn()
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nama_kmj LIKE ' . "'%" . $search . "%'" . '
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$now = date('M-Y');
		$this->db->select('*');
		$this->db->where('btahun_kmpk', $now);
		$this->db->from('kwh_pemakaian');
		$this->db->join('kwh_jenis', 'id_kmj=jenis_kmpk');
		$this->db->order_by('id_kmpk DESC');

		return $this->db->get()->num_rows();
	}

}