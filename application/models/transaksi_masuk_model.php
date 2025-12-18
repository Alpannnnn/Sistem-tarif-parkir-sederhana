<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_masuk_model extends CI_Model {

    protected $table = 'transaksi_masuk';

    /* =====================
       GET DATA
       ===================== */

    public function get_all()
    {
        return $this->db
            ->select('id_masuk, plat, area, waktu_masuk, status')
            ->from($this->table)
            ->order_by('id_masuk', 'DESC')
            ->get()
            ->result();
    }

    // 🚗 kendaraan masih parkir per operator
    public function get_by_operator($id_operator)
{
    return $this->db
        ->select('tm.*')
        ->from('transaksi_masuk tm')
        ->where('tm.id_operator', $id_operator)
        ->where('tm.status', 'IN')
        ->order_by('tm.id_masuk', 'DESC')
        ->get()
        ->result();
}


    // by id
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
        $data['status'] = 'IN';
        return $this->db->insert($this->table, $data);
    }

    /* =====================
       VALIDASI
       ===================== */

    // ❌ kendaraan masih parkir
    public function cekMasihParkir($plat)
    {
        return $this->db
            ->where('plat', $plat)
            ->where('status', 'IN')
            ->count_all_results($this->table) > 0;
    }

    public function update_status($id_masuk, $status)
    {
    $this->db->where('id_masuk', $id_masuk);
    return $this->db->update('transaksi_masuk', [
        'status' => $status
    ]);
    }

    public function get_riwayat($id_operator)
    {
    return $this->db
        ->where('id_operator', $id_operator)
        ->order_by('id_masuk', 'DESC')
        ->get('transaksi_masuk')
        ->result();
    }




    /* =====================
       UPDATE STATUS
       ===================== */

    public function set_out($id_masuk)
    {
        return $this->db
            ->where('id_masuk', $id_masuk)
            ->update($this->table, ['status' => 'OUT']);
    }
}
