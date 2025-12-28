<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {

    // ===============================
    // LAPORAN KENDARAAN PARKIR (IN)
    // ===============================

    public function lap_kendaraan_harian($tanggal, $id_operator)
    {
        return $this->db
            ->select('area, COUNT(*) as total')
            ->from('transaksi_masuk')
            ->where('DATE(waktu_masuk)', $tanggal)
            ->where('status', 'IN')
            ->where('id_operator', $id_operator)
            ->group_by('area')
            ->get()
            ->result();
    }

    public function lap_kendaraan_bulanan($bulan, $id_operator)
    {
        return $this->db
            ->select('area, COUNT(*) as total')
            ->from('transaksi_masuk')
            ->where('MONTH(waktu_masuk)', $bulan)
            ->where('status', 'IN')
            ->where('id_operator', $id_operator)
            ->group_by('area')
            ->get()
            ->result();
    }

    // ===============================
    // LAPORAN TRANSAKSI / PENDAPATAN
    // ===============================

    public function lap_transaksi_harian($tanggal, $id_operator)
    {
        return $this->db
            ->select('SUM(tarif) as total_pendapatan')
            ->from('transaksi_keluar')
            ->where('DATE(waktu_keluar)', $tanggal)
            ->where('id_operator', $id_operator)
            ->get()
            ->row();
    }

    public function lap_transaksi_bulanan($bulan, $id_operator)
    {
        return $this->db
            ->select('SUM(tarif) as total_pendapatan')
            ->from('transaksi_keluar')
            ->where('MONTH(waktu_keluar)', $bulan)
            ->where('id_operator', $id_operator)
            ->get()
            ->row();
    }

    // ===============================
    // LAPORAN OPERATOR (AKTIVITAS)
    // ===============================

    public function lap_operator_harian($tanggal)
    {
        return $this->db
            ->select('o.nama_operator, COUNT(tm.id_masuk) as total_masuk')
            ->from('operator o')
            ->join('transaksi_masuk tm', 'o.id_operator = tm.id_operator')
            ->where('DATE(tm.waktu_masuk)', $tanggal)
            ->group_by('o.id_operator')
            ->get()
            ->result();
    }

    // ===== RINGKASAN DASHBOARD LAPORAN =====
public function ringkasan_hari_ini_by_operator($id_operator)
{
    $today = date('Y-m-d');

    // 🚗 Kendaraan MASUK hari ini (berdasarkan area)
    $basement = $this->db
        ->where('area', 'B')
        ->where('DATE(waktu_masuk)', $today)
        ->where('id_operator', $id_operator)
        ->count_all_results('transaksi_masuk');

    $rooftop = $this->db
        ->where('area', 'A')
        ->where('DATE(waktu_masuk)', $today)
        ->where('id_operator', $id_operator)
        ->count_all_results('transaksi_masuk');

    // 💰 Pendapatan hari ini (JOIN ke transaksi_masuk)
    $row = $this->db
    ->select_sum('tk.tarif')
    ->from('transaksi_keluar tk')
    ->join('transaksi_masuk tm', 'tm.id_masuk = tk.id_masuk')
    ->where('DATE(tk.waktu_keluar)', $today)
    ->where('tm.id_operator', $id_operator)
    ->get()
    ->row();

    $pendapatan = ($row && $row->tarif)
    ? (int) $row->tarif
    : 0;


    return [
        'basement'   => (int) $basement,
        'rooftop'    => (int) $rooftop,
        'total'      => (int) ($basement + $rooftop),
        'pendapatan' => $pendapatan
    ];
}

public function lap_transaksi_harian_detail($tanggal, $id_operator)
{
    return $this->db
        ->from('transaksi_keluar')
        ->where('DATE(waktu_keluar)', $tanggal)
        ->where('id_operator', $id_operator)
        ->get()
        ->result();
    }

public function lap_transaksi_bulanan_detail($bulan, $id_operator)
    {
    return $this->db
        ->from('transaksi_keluar')
        ->where('MONTH(waktu_keluar)', $bulan)
        ->where('id_operator', $id_operator)
        ->get()
        ->result();
    }




}
