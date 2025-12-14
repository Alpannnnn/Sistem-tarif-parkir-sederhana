<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class transaksi_rekap_model extends CI_Model {

    // Ambil rekap per tanggal
    public function getRekapByDate($tanggal)
    {
        $this->db->select('
            transaksi_keluar.plat,
            transaksi_keluar.jam_masuk,
            transaksi_keluar.jam_keluar,
            transaksi_keluar.durasi,
            transaksi_keluar.biaya,
            master_kendaraan.jenis
        ');
        $this->db->from('transaksi_keluar');
        $this->db->join('master_kendaraan', 'master_kendaraan.plat = transaksi_keluar.plat', 'left');
        $this->db->where('DATE(transaksi_keluar.jam_keluar)', $tanggal);
        $this->db->order_by('transaksi_keluar.jam_keluar', 'DESC');

        return $this->db->get()->result();
    }
}
?>
