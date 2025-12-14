<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tarif_model extends CI_Model {

    private $table = 'master_tarif';

    public function get_all()
    {
        return $this->db->get($this->table)->result();
    }

    public function get_by_jenis($jenis)
    {
        return $this->db->get_where($this->table, ['jenis' => $jenis])->row();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        return $this->db->update($this->table, $data, ['id_tarif' => $id]);
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, ['id_tarif' => $id]);
    }
}
