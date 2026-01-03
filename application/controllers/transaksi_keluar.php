<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_keluar extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Transaksi_keluar_model');
        $this->load->model('Transaksi_masuk_model');
        $this->load->library('session');
        $this->load->helper('url');

        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    // 🚗 LIST KENDARAAN MASIH PARKIR
    public function index()
{
    $data['title'] = 'Transaksi Keluar';
    $id_operator   = $this->session->userdata('id_operator');

    $data['list'] = $this->Transaksi_masuk_model
        ->get_by_operator($id_operator);

    // ✅ FIX AREA TANPA UBAH LOGIC
    $data['area_parkir'] = [
        'A' => 'Rooftop',
        'B' => 'Basement'
    ];

    $this->load->view('transaksi_keluar/index', $data);
}


    // 🔄 FORM PROSES
    public function proses($id)
    {
        $data['area_parkir'] = [
        'A' => 'Rooftop',
        'B' => 'Basement'
        ];
        $data['title'] = 'Proses Transaksi Keluar';
        $data['masuk'] = $this->Transaksi_masuk_model->get_by_id($id);

        if (!$data['masuk']) {
            show_404();
        }

        if ($data['masuk']->id_operator != $this->session->userdata('id_operator')) {
            show_error('Akses ditolak', 403);
        }

        if ($data['masuk']->status === 'OUT') {
            $this->session->set_flashdata('error', 'Kendaraan sudah keluar.');
            redirect('transaksi_keluar');
        }

        $this->load->view('transaksi_keluar/proses', $data);
    }

    // 💾 SIMPAN TRANSAKSI KELUAR
    public function simpan()
    {
        $id_masuk     = $this->input->post('id_masuk');
        $waktu_keluar = $this->input->post('waktu_keluar');
        $id_operator  = $this->session->userdata('id_operator'); // AMBIL ID OPERATOR

        $masuk = $this->Transaksi_masuk_model->get_by_id($id_masuk);
        if (!$masuk) { show_error('Data tidak ditemukan'); }

        $start = strtotime($masuk->waktu_masuk);
        $end   = strtotime($waktu_keluar);

        if ($end < $start) {
            $this->session->set_flashdata('error', 'Waktu keluar tidak boleh sebelum waktu masuk');
            redirect('transaksi_keluar/proses/'.$id_masuk);
        }

        $durasi = ceil(($end - $start) / 3600);
        if ($durasi <= 0) { $durasi = 1; }

        $is_weekend = date('N', $end) >= 6;
        if ($masuk->jenis_kendaraan == 'Motor') {
            $tarif_per_jam = $is_weekend ? 7000 : 5000;
        } else {
            $tarif_per_jam = $is_weekend ? 15000 : 10000;
        }

        if ($masuk->is_member == 1) { $tarif_per_jam *= 0.5; }
        $total_tarif = $tarif_per_jam * $durasi;

        // SIMPAN DENGAN MENYERTAKAN ID_OPERATOR
        $this->Transaksi_keluar_model->insert([
            'id_masuk'     => $id_masuk,
            'id_operator'  => $id_operator, // PASTIKAN KOLOM INI ADA DI TABEL
            'waktu_keluar' => date('Y-m-d H:i:s', $end),
            'durasi'       => $durasi,
            'tarif'        => $total_tarif,
            'is_member'    => $masuk->is_member
        ]);

        $this->Transaksi_masuk_model->update_status($id_masuk, 'OUT');
        $this->session->set_flashdata('success', 'Transaksi keluar berhasil!');
        redirect('transaksi_keluar');
    }

    // 📜 RIWAYAT
    public function riwayat()
    {
    $data['title'] = 'Riwayat Transaksi Keluar';
    $data['list']  = $this->Transaksi_keluar_model
        ->get_history_by_operator(
            $this->session->userdata('id_operator')
        );

    $this->load->view('transaksi_keluar/riwayat', $data);
    }

}
