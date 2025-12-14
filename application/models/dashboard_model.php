<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    public function getTotalKendaraan()
    {
        return (int) $this->db->count_all('master_kendaraan');
    }

    public function getTotalOperator()
    {
        return (int) $this->db->count_all('operator');
    }

    /* =====================
       GLOBAL DASHBOARD
       ===================== */

    public function getTransaksiHariIni()
    {
        $today = date('Y-m-d');

        // transaksi masuk hari ini
        $this->db->from('transaksi_masuk');
        $this->db->where('DATE(waktu_masuk)', $today);
        $masuk = $this->db->count_all_results();

        // transaksi keluar hari ini
        $this->db->from('transaksi_keluar');
        $this->db->where('DATE(waktu_keluar)', $today);
        $keluar = $this->db->count_all_results();

        return (int) ($masuk + $keluar);
    }

    public function getPendapatanHariIni()
    {
        $today = date('Y-m-d');

        $this->db->select_sum('total_biaya');
        $this->db->where('DATE(waktu_keluar)', $today);
        $result = $this->db->get('transaksi_keluar')->row();

        return ($result && $result->total_biaya)
            ? (int) $result->total_biaya
            : 0;
    }

    public function getMasukHariIni()
    {
        $today = date('Y-m-d');

        $this->db->from('transaksi_masuk');
        $this->db->where('DATE(waktu_masuk)', $today);
        $this->db->where('status', 'in'); // 🔥 FIX

        return (int) $this->db->count_all_results();
    }

    public function getKeluarHariIni()
    {
        $today = date('Y-m-d');

        $this->db->from('transaksi_keluar');
        $this->db->where('DATE(waktu_keluar)', $today);

        return (int) $this->db->count_all_results();
    }

    /* =====================
       OPERATOR DASHBOARD
       ===================== */

    public function getTotalKendaraanByOperator($id_operator)
    {
        $this->db->from('transaksi_masuk');
        $this->db->where('id_operator', $id_operator);
        $this->db->where('status', 'in'); // 🔥 FIX

        return (int) $this->db->count_all_results();
    }

    public function getTransaksiHariIniByOperator($id_operator)
    {
        $today = date('Y-m-d');

        $this->db->from('transaksi_masuk');
        $this->db->where('DATE(waktu_masuk)', $today);
        $this->db->where('id_operator', $id_operator);
        $masuk = $this->db->count_all_results();

        $this->db->from('transaksi_keluar');
        $this->db->where('DATE(waktu_keluar)', $today);
        $this->db->where('id_operator', $id_operator);
        $keluar = $this->db->count_all_results();

        return (int) ($masuk + $keluar);
    }

    public function getPendapatanHariIniByOperator($id_operator)
    {
        $today = date('Y-m-d');

        $this->db->select_sum('total_biaya');
        $this->db->where('DATE(waktu_keluar)', $today);
        $this->db->where('id_operator', $id_operator);
        $result = $this->db->get('transaksi_keluar')->row();

        return ($result && $result->total_biaya)
            ? (int) $result->total_biaya
            : 0;
    }

    public function getMasukHariIniByOperator($id_operator)
    {
        $today = date('Y-m-d');

        $this->db->from('transaksi_masuk');
        $this->db->where('DATE(waktu_masuk)', $today);
        $this->db->where('id_operator', $id_operator);
        $this->db->where('status', 'in'); // 🔥 FIX

        return (int) $this->db->count_all_results();
    }

    public function getKeluarHariIniByOperator($id_operator)
    {
        $today = date('Y-m-d');

        $this->db->from('transaksi_keluar');
        $this->db->where('DATE(waktu_keluar)', $today);
        $this->db->where('id_operator', $id_operator);

        return (int) $this->db->count_all_results();
    }
}
