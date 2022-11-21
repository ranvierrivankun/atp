<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile_model extends CI_Model
{

	public function getUser($id_user)
	{
		$this->db->select('*');
		$this->db->where('id_user', $id_user );
		$this->db->from('user');
		$this->db->join('user_role','id_role=role');
		$query = $this->db->get();
		return $query->row();
	}

	public function getUserData($id_user)
	{
		$this->db->select('*');
		$this->db->where('id_user', $id_user );
		$this->db->from('user_data');
		$query = $this->db->get();
		return $query->row();
	}

	public function total_kwh_now($id_user)
	{
		$now = date('M-Y');
		$query = $this->db->where('user_kmpk',$id_user)->where('btahun_kmpk', $now)->get('kwh_pemakaian');
		if($query->num_rows()>0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}

	public function total_kwh($id_user)
	{
		$query = $this->db->where('user_kmpk',$id_user)->get('kwh_pemakaian');
		if($query->num_rows()>0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}

}