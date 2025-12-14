<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_keluar_model extends CI_Model {

    protected $table = "transaksi_keluar";

    // simpan transaksi keluar
    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    // 🔥 RIWAYAT TRANSAKSI KELUAR
    public function get_all_history()
    {
        $this->db->select('
            tk.*,
            tm.waktu_masuk,
            k.jenis,
            k.merk
        ');
        $this->db->from('transaksi_keluar tk');
        $this->db->join('transaksi_masuk tm', 'tm.id_masuk = tk.id_masuk');
        $this->db->join('master_kendaraan k', 'k.plat = tk.plat');
        $this->db->order_by('tk.id_keluar', 'DESC');

        return $this->db->get()->result();
    }
}
