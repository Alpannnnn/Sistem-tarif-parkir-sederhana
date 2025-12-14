<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_keluar extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Transaksi_keluar_model');
        $this->load->model('Transaksi_masuk_model');
        $this->load->model('Kendaraan_model');
        $this->load->library('session');
        $this->load->helper('url');
    }

    // 🔥 LIST KENDARAAN MASIH PARKIR
    public function index()
    {
        $data['title'] = 'Transaksi Keluar';
        $data['list']  = $this->Transaksi_masuk_model->get_kendaraan_masuk();
        $this->load->view('transaksi_keluar/index', $data);
    }

    public function proses($id)
    {
        $data['title'] = "Proses Transaksi Keluar";
        $data['masuk'] = $this->Transaksi_masuk_model->get_by_id($id);

        if (!$data['masuk']) {
            show_404();
        }

        // ❌ SUDAH OUT
        if ($data['masuk']->status == 'OUT') {
            $this->session->set_flashdata(
                'error',
                'Kendaraan sudah keluar.'
            );
            redirect('transaksi_keluar');
        }

        $data['master_kendaraan'] =
            $this->Kendaraan_model->get_by_plat($data['masuk']->plat);

        $this->load->view('transaksi_keluar/proses', $data);
    }

    public function simpan()
{
    $id_masuk     = $this->input->post('id_masuk');
    $waktu_keluar = $this->input->post('waktu_keluar');

    $masuk = $this->Transaksi_masuk_model->get_by_id($id_masuk);

    if (!$masuk || $masuk->status == 'OUT') {
        redirect('transaksi_keluar');
    }

    $today = strtotime(date('Y-m-d 00:00:00'));
    $start = strtotime($masuk->waktu_masuk);
    $end   = strtotime($waktu_keluar);

    // ❌ sebelum hari ini
    if ($end < $today) {
        $this->session->set_flashdata(
            'error',
            'Waktu keluar tidak boleh sebelum hari ini.'
        );
        redirect('transaksi_keluar/proses/'.$id_masuk);
    }

    // ❌ sebelum waktu masuk
    if ($end <= $start) {
        $this->session->set_flashdata(
            'error',
            'Waktu keluar harus setelah waktu masuk.'
        );
        redirect('transaksi_keluar/proses/'.$id_masuk);
    }

    // hitung durasi
    $durasi = ceil(($end - $start) / 3600);

    $kendaraan = $this->Kendaraan_model->get_by_plat($masuk->plat);
    $hari = date('N', $end);
    $is_weekend = ($hari == 6 || $hari == 7);

    if ($kendaraan->jenis == 'Motor') {
        $tarif = $is_weekend ? 7000 : 5000;
    } else {
        $tarif = $is_weekend ? 15000 : 10000;
    }

    $data = [
        'id_masuk'     => $id_masuk,
        'plat'         => $masuk->plat,
        'durasi'       => $durasi,
        'total_biaya'  => $durasi * $tarif,
        'waktu_keluar' => date('Y-m-d H:i:s', $end),
        'id_operator'  => $this->session->userdata('id_operator')
    ];

    $this->Transaksi_keluar_model->insert($data);
    $this->Transaksi_masuk_model->set_out($id_masuk);

    redirect('transaksi_keluar/riwayat');
}



    // 🔥 RIWAYAT
    public function riwayat()
    {
        $data['title'] = "Riwayat Transaksi Keluar";
        $data['list']  = $this->Transaksi_keluar_model->get_all_history();
        $this->load->view('transaksi_keluar/riwayat', $data);
    }
}
