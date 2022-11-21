<?php
defined('BASEPATH') or exit('No direct script access allowed');

class kwh_biaya_tarif_model extends CI_Model
{

	public function table_perkwh()
	{
		$this->db->select('*');
		$this->db->from('kwh_biaya');

		return $this->db->get()->result();
	}

	public function table_tariftetap()
	{
		$this->db->select('*');
		$this->db->from('kwh_tarif');

		return $this->db->get()->result();
	}

	public function table_kbb()
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');
		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			beban_kmbb LIKE ' . "'%" . $search . "%'" . '
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
		$this->db->from('kwh_biaya_beban');
		$this->db->order_by('beban_kmbb ASC, phasa_kmbb ASC');
		$batas;

		return $this->db->get()->result();
	}

	public function filter_table_kbb()
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			beban_kmbb LIKE ' . "'%" . $search . "%'" . '
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('kwh_biaya_beban');
		$this->db->order_by('beban_kmbb ASC, phasa_kmbb ASC');

		return $this->db->get()->num_rows();
	}

	public function total_table_kbb()
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			beban_kmbb LIKE ' . "'%" . $search . "%'" . '
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}


		$k_search;
		$this->db->select('*');
		$this->db->from('kwh_biaya_beban');
		$this->db->order_by('beban_kmbb ASC, phasa_kmbb ASC');

		return $this->db->get()->num_rows();
	}

}