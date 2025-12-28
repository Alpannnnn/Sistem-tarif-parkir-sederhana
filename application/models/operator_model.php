<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Operator_model extends CI_Model {

    protected $table = 'master_operator';

    public function get_all()
    {
        return $this->db
            ->where('is_active', 1)
            ->get($this->table)
            ->result();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    // ✅ UBAH: Hanya ambil operator aktif by ID
    public function get_by_id($id)
    {
        return $this->db
            ->where('id_operator', $id)
            ->where('is_active', 1)
            ->get($this->table)
            ->row();
    }

    public function update($id, $data)
    {
        return $this->db->where('id_operator', $id)->update($this->table, $data);
    }

    // ✅ UBAH: Soft delete (set is_active = 0)
    public function delete($id)
    {
        return $this->db
            ->where('id_operator', $id)
            ->update($this->table, ['is_active' => 0]);
    }

    public function get_by_username($username)
    {
        return $this->db->get_where($this->table, ['username' => $username])->row();
    }

    // ✅ UBAH: Login hanya untuk operator aktif
    public function cek_login($username)
    {
        return $this->db
            ->where('username', $username)
            ->where('is_active', 1)
            ->get($this->table)
            ->row();
    }
}
