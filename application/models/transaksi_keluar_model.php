<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_keluar_model extends CI_Model {

    protected $table = 'transaksi_keluar';

    /**
     * SIMPAN TRANSAKSI KELUAR
     */
    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    /**
     * AMBIL 1 DATA TRANSAKSI KELUAR BERDASARKAN ID
     * (buat proses / detail / validasi)
     */
    public function get_by_id($id_keluar)
    {
        return $this->db
            ->where('id_keluar', $id_keluar)
            ->get($this->table)
            ->row();
    }

    /**
     * RIWAYAT SEMUA TRANSAKSI (ADMIN)
     */
    public function get_all_history()
    {
        return $this->db
            ->select('
                tk.*,
                tm.plat,
                tm.waktu_masuk,
                tm.jenis_kendaraan,
                tm.is_member
            ')
            ->from('transaksi_keluar tk')
            ->join('transaksi_masuk tm', 'tm.id_masuk = tk.id_masuk')
            ->order_by('tk.id_keluar', 'DESC')
            ->get()
            ->result();
    }

    /**
     * RIWAYAT TRANSAKSI PER OPERATOR
     */
    public function get_history_by_operator($id_operator)
    {
        return $this->db
            ->select('
                tk.*,
                tm.plat,
                tm.waktu_masuk,
                tm.jenis_kendaraan,
                tm.is_member
            ')
            ->from('transaksi_keluar tk')
            ->join('transaksi_masuk tm', 'tm.id_masuk = tk.id_masuk')
            ->where('tm.id_operator', $id_operator)
            ->order_by('tk.id_keluar', 'DESC')
            ->get()
            ->result();
    }
}
