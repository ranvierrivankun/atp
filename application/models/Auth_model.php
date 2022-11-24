<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{

    /*cek username*/
    public function cek_username($username)
    {
        $query = $this->db->get_where('user', ['username' => $username]);
        return $query->num_rows();
    }

    /*get password user*/
    public function get_password($username)
    {
        $data = $this->db->get_where('user', ['username' => $username])->row_array();
        return $data['password'];
    }

    /*get userdata*/
    public function userdata($username)
    {
        return $this->db->get_where('user', ['username' => $username])->row_array();
    }
}
