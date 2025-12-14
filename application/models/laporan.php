<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {

    // === LAPORAN KENDARAAN ===
    public function lap_kendaraan_harian($tanggal) {
        $this->db->where('DATE(waktu_masuk)', $tanggal);
        return $this->db->get('transaksi_masuk')->result();
    }

    public function lap_kendaraan_bulanan($bulan) {
        $this->db->where('MONTH(waktu_masuk)', $bulan);
        return $this->db->get('transaksi_masuk')->result();
    }

    // === LAPORAN TRANSAKSI ===
    public function lap_transaksi_harian($tanggal) {
        $this->db->where('DATE(waktu_keluar)', $tanggal);
        return $this->db->get('transaksi_keluar')->result();
    }

    public function lap_transaksi_bulanan($bulan) {
        $this->db->where('MONTH(waktu_keluar)', $bulan);
        return $this->db->get('transaksi_keluar')->result();
    }

    // === LAPORAN OPERATOR ===
    public function lap_operator_harian($tanggal) {
        $this->db->select('operator.nama_operator, COUNT(*) as total_masuk');
        $this->db->from('operator');
        $this->db->join('transaksi_masuk', 'operator.id_operator = transaksi_masuk.id_operator');
        $this->db->where('DATE(transaksi_masuk.waktu_masuk)', $tanggal);
        $this->db->group_by('operator.id_operator');
        return $this->db->get()->result();
    }
}
