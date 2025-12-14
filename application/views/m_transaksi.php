<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Transaksi extends CI_Model {

    // Insert transaksi masuk
    public function insert_masuk($data)
    {
        return $this->db->insert('transaksi_masuk', $data);
    }

    // Cek apakah kendaraan masih IN
    public function get_active_transaksi($plat)
    {
        return $this->db->get_where('transaksi_masuk', [
            'plat' => $plat,
            'status' => 'IN'
        ])->row_array();
    }
}
