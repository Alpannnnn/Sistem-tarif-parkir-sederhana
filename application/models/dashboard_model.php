<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    /* =====================
       GLOBAL
       ===================== */

    public function getTotalOperator()
    {
        return (int) $this->db
            ->where('is_active', 1)
            ->count_all_results('master_operator');
    }

    /* =====================
       OPERATOR DASHBOARD
       ===================== */

    // 🚗 kendaraan unik (plat) historis per operator
    public function getTotalKendaraanByOperator($id_operator)
    {
        $row = $this->db
            ->select('COUNT(DISTINCT plat) AS total')
            ->from('transaksi_masuk')
            ->where('id_operator', $id_operator)
            ->get()
            ->row();

        return $row ? (int) $row->total : 0;
    }

    // 🔁 transaksi hari ini (IN + OUT)
    // 🔁 transaksi hari ini (hitung dari kendaraan masuk)
public function getTransaksiHariIniByOperator($id_operator)
{
    $today = date('Y-m-d');

    return (int) $this->db
        ->from('transaksi_masuk')
        ->where('DATE(waktu_masuk)', $today)
        ->where('id_operator', $id_operator)
        ->count_all_results();
}

    // 💰 pendapatan hari ini
    public function getPendapatanHariIniByOperator($id_operator)
    {
    $today = date('Y-m-d');

    $row = $this->db
        ->select('SUM(tk.tarif) AS total')
        ->from('transaksi_keluar tk')
        ->join('transaksi_masuk tm', 'tm.id_masuk = tk.id_masuk')
        ->where('DATE(tk.waktu_keluar)', $today)
        ->where('tm.id_operator', $id_operator)
        ->get()
        ->row();

    return $row && $row->total ? (int) $row->total : 0;
    }



    // ➕ kendaraan masuk hari ini
    public function getMasukHariIniByOperator($id_operator)
    {
        return (int) $this->db
            ->from('transaksi_masuk')
            ->where('DATE(waktu_masuk)', date('Y-m-d'))
            ->where('id_operator', $id_operator)
            ->count_all_results();
    }

    // ➖ kendaraan keluar hari ini
    public function getKeluarHariIniByOperator($id_operator)
    {
    return (int) $this->db
        ->from('transaksi_keluar tk')
        ->join(
            'transaksi_masuk tm',
            'tm.id_masuk = tk.id_masuk'
        )
        ->where('DATE(tk.waktu_keluar)', date('Y-m-d'))
        ->where('tm.id_operator', $id_operator)
        ->count_all_results();
    }

}
