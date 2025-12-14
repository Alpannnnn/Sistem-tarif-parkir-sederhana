<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kendaraan_model extends CI_Model {

    private $table = 'master_kendaraan';

    /* =========================
       GET DATA
       ========================= */

    public function get_all()
    {
        return $this->db
            ->order_by('plat', 'ASC')
            ->get($this->table)
            ->result();
    }

    public function get_by_plat($plat)
    {
        return $this->db
            ->where('plat', $plat)
            ->get($this->table)
            ->row();
    }

    /* =========================
       VALIDASI
       ========================= */

    // cek plat sudah ada
    public function plat_sudah_ada($plat)
    {
        return $this->db
            ->where('plat', $plat)
            ->count_all_results($this->table) > 0;
    }

    // cek kendaraan digunakan di transaksi
    public function digunakan_di_transaksi($plat)
    {
        $masuk = $this->db
            ->where('plat', $plat)
            ->count_all_results('transaksi_masuk');

        $keluar = $this->db
            ->where('plat', $plat)
            ->count_all_results('transaksi_keluar');

        return ($masuk + $keluar) > 0;
    }

    /* =========================
       CRUD
       ========================= */

    // INSERT dengan validasi plat unik
    public function insert($data)
    {
        if ($this->plat_sudah_ada($data['plat'])) {
            return false;
        }

        $this->db->insert($this->table, $data);
        return $this->db->affected_rows() > 0;
    }

    // UPDATE data kendaraan
    public function update($plat, $data)
    {
        $this->db->where('plat', $plat)->update($this->table, $data);
        return $this->db->affected_rows() > 0;
    }

    // DELETE dengan validasi FK + validasi hasil
    public function delete($plat)
    {
        // masih digunakan transaksi
        if ($this->digunakan_di_transaksi($plat)) {
            return false;
        }

        $this->db->where('plat', $plat)->delete($this->table);

        // pastikan benar-benar terhapus
        return $this->db->affected_rows() > 0;
    }
}
