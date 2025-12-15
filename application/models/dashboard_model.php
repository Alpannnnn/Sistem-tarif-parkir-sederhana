<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    public function getTotalOperator()
    {
        return (int) $this->db->count_all('operator');
    }

    /* =====================
       OPERATOR DASHBOARD
       ===================== */

    // 🚙 kendaraan terdaftar (UNIK BERDASARKAN PLAT, HISTORIS)
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

    // 🔁 transaksi hari ini (masuk + keluar)
    public function getTransaksiHariIniByOperator($id_operator)
    {
        $today = date('Y-m-d');

        // MASUK
        $masuk = $this->db
            ->from('transaksi_masuk')
            ->where('DATE(waktu_masuk)', $today)
            ->where('id_operator', $id_operator)
            ->count_all_results();

        // KELUAR
        $keluar = $this->db
            ->from('transaksi_keluar')
            ->where('DATE(waktu_keluar)', $today)
            ->where('id_operator', $id_operator)
            ->count_all_results();

        return (int) ($masuk + $keluar);
    }

    // 💰 pendapatan hari ini
    public function getPendapatanHariIniByOperator($id_operator)
    {
        $today = date('Y-m-d');

        $row = $this->db
            ->select('SUM(total_biaya) AS total')
            ->from('transaksi_keluar')
            ->where('DATE(waktu_keluar)', $today)
            ->where('id_operator', $id_operator)
            ->get()
            ->row();

        return ($row && $row->total) ? (int) $row->total : 0;
    }

    // ➕ kendaraan masuk hari ini (HISTORIS, IN + OUT)
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
            ->from('transaksi_keluar')
            ->where('DATE(waktu_keluar)', date('Y-m-d'))
            ->where('id_operator', $id_operator)
            ->count_all_results();
    }
}
