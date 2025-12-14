<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_masuk_model extends CI_Model {

    protected $table = "transaksi_masuk";

    /* =====================
       GET DATA
       ===================== */

    // transaksi masuk per operator (HANYA YANG MASIH PARKIR)
    public function get_by_operator_join($id_operator)
    {
        return $this->db
            ->select('tm.*, k.jenis, k.merk, ap.nama_area')
            ->from('transaksi_masuk tm')
            ->join('master_kendaraan k', 'k.plat = tm.plat', 'left')
            ->join('master_area ap', 'ap.id_area = tm.id_area', 'left')
            ->where('tm.id_operator', $id_operator)
            ->where('tm.status', 'in') // 🔥 FIX
            ->order_by('tm.id_masuk', 'DESC')
            ->get()
            ->result();
    }

    // kendaraan masih parkir
    public function get_kendaraan_masuk()
    {
        return $this->db
            ->select('tm.*, k.jenis, k.merk')
            ->from('transaksi_masuk tm')
            ->join('master_kendaraan k', 'k.plat = tm.plat', 'left')
            ->where('tm.status', 'in') // 🔥 FIX
            ->order_by('tm.id_masuk', 'DESC')
            ->get()
            ->result();
    }

    public function get_by_id($id)
    {
        return $this->db
            ->where('id_masuk', $id)
            ->get($this->table)
            ->row();
    }

    /* =====================
       INSERT
       ===================== */

    public function insert($data)
    {
        // pastikan status selalu in
        $data['status'] = 'in';
        return $this->db->insert($this->table, $data);
    }

    /* =====================
       VALIDASI
       ===================== */

    public function sudah_keluar($id_masuk)
    {
        return $this->db
            ->where('id_masuk', $id_masuk)
            ->where('status', 'out') // 🔥 FIX
            ->count_all_results($this->table) > 0;
    }

    /* =====================
       UPDATE STATUS
       ===================== */

    public function set_out($id_masuk)
    {
        return $this->db
            ->where('id_masuk', $id_masuk)
            ->update($this->table, ['status' => 'out']); // 🔥 FIX
    }
}
