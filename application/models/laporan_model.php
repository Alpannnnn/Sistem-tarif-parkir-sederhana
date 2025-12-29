<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {

    /**
     * =========================
     * LAPORAN TRANSAKSI
     * =========================
     */
    public function get_laporan($filter = array())
    {
        $sql = "
            SELECT 
                tk.id_keluar,
                tm.plat,
                tm.jenis_kendaraan,
                tm.waktu_masuk,
                tk.waktu_keluar,
                tk.durasi,
                tk.tarif,
                tk.is_member,
                mo.nama_operator AS operator_nama,
                mo.username AS operator_username
            FROM transaksi_keluar tk
            JOIN transaksi_masuk tm ON tm.id_masuk = tk.id_masuk
            JOIN master_operator mo ON mo.id_operator = tm.id_operator
            WHERE 1=1
        ";

        // FILTER OPERATOR
        if (!empty($filter['id_operator'])) {
            $sql .= " AND tm.id_operator = " . (int)$filter['id_operator'];
        }

        // FILTER TANGGAL (YYYY-MM-DD)
        if (!empty($filter['tanggal'])) {
            $tanggal = $this->db->escape($filter['tanggal']);
            $sql .= " AND DATE(tk.waktu_keluar) = $tanggal";
        }

        // FILTER BULAN (YYYY-MM)
        if (!empty($filter['bulan'])) {
            $bulan = $this->db->escape($filter['bulan']);
            $sql .= " AND DATE_FORMAT(tk.waktu_keluar, '%Y-%m') = $bulan";
        }

        $sql .= " ORDER BY tk.waktu_keluar DESC";

        return $this->db->query($sql)->result();
    }

    /**
     * =========================
     * RINGKASAN LAPORAN
     * =========================
     */
    public function get_ringkasan($filter = array())
    {
        $sql = "
            SELECT 
                COUNT(tk.id_keluar) AS total_transaksi,
                COALESCE(SUM(tk.tarif), 0) AS total_pendapatan,
                COALESCE(SUM(tk.durasi), 0) AS total_durasi,
                SUM(CASE WHEN tm.jenis_kendaraan = 'Motor' THEN 1 ELSE 0 END) AS total_motor,
                SUM(CASE WHEN tm.jenis_kendaraan = 'Mobil' THEN 1 ELSE 0 END) AS total_mobil,
                SUM(CASE WHEN tk.is_member = 1 THEN 1 ELSE 0 END) AS total_member
            FROM transaksi_keluar tk
            JOIN transaksi_masuk tm ON tm.id_masuk = tk.id_masuk
            WHERE 1=1
        ";

        // FILTER OPERATOR
        if (!empty($filter['id_operator'])) {
            $sql .= " AND tm.id_operator = " . (int)$filter['id_operator'];
        }

        // FILTER TANGGAL
        if (!empty($filter['tanggal'])) {
            $tanggal = $this->db->escape($filter['tanggal']);
            $sql .= " AND DATE(tk.waktu_keluar) = $tanggal";
        }

        // FILTER BULAN
        if (!empty($filter['bulan'])) {
            $bulan = $this->db->escape($filter['bulan']);
            $sql .= " AND DATE_FORMAT(tk.waktu_keluar, '%Y-%m') = $bulan";
        }

        $result = $this->db->query($sql)->row();

        if (!$result) {
            return (object) array(
                'total_transaksi'  => 0,
                'total_pendapatan' => 0,
                'total_durasi'     => 0,
                'total_motor'      => 0,
                'total_mobil'      => 0,
                'total_member'     => 0
            );
        }

        return $result;
    }
}
