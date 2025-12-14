<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Operator_model extends CI_Model {

    protected $table = 'master_operator';

    public function get_all()
    {
        return $this->db->get($this->table)->result();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function get_by_id($id)
    {
        return $this->db->where('id_operator', $id)->get($this->table)->row();
    }

    public function update($id, $data)
    {
        return $this->db->where('id_operator', $id)->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db->where('id_operator', $id)->delete($this->table);
    }

    public function get_by_username($username)
    {
        return $this->db->get_where($this->table, ['username' => $username])->row();
    }

    // login – ambil user, verifikasi password di controller
    public function cek_login($username)
    {
        return $this->db->get_where($this->table, ['username' => $username])->row();
    }
}
