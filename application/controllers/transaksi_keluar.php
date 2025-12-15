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

        // 🔐 PROTEKSI LOGIN
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    // 🚗 LIST KENDARAAN MASIH PARKIR
    public function index()
    {
        $data['title'] = 'Transaksi Keluar';
        $id_operator   = $this->session->userdata('id_operator');

        // ✅ FIX: pakai MODEL, bukan query mentah
        $data['list'] = $this->Transaksi_masuk_model
            ->get_by_operator_join($id_operator);

        $this->load->view('transaksi_keluar/index', $data);
    }

    // 🔄 FORM PROSES
    public function proses($id)
    {
        $data['title'] = "Proses Transaksi Keluar";
        $data['masuk'] = $this->Transaksi_masuk_model->get_by_id($id);

        if (!$data['masuk']) {
            show_404();
        }

        // 🔒 VALIDASI OPERATOR
        if ($data['masuk']->id_operator != $this->session->userdata('id_operator')) {
            show_error('Akses ditolak', 403);
        }

        if ($data['masuk']->status === 'OUT') {
            $this->session->set_flashdata('error', 'Kendaraan sudah keluar.');
            redirect('transaksi_keluar');
        }

        $data['master_kendaraan'] =
            $this->Kendaraan_model->get_by_plat($data['masuk']->plat);

        $this->load->view('transaksi_keluar/proses', $data);
    }

    // 💾 SIMPAN
    public function simpan()
    {
        $id_masuk     = $this->input->post('id_masuk');
        $waktu_keluar = $this->input->post('waktu_keluar');
        $id_operator  = $this->session->userdata('id_operator');

        $masuk = $this->Transaksi_masuk_model->get_by_id($id_masuk);

        if (!$masuk || $masuk->status === 'OUT') {
            redirect('transaksi_keluar');
        }

        if ($masuk->id_operator != $id_operator) {
            show_error('Akses ditolak', 403);
        }

        $start = strtotime($masuk->waktu_masuk);
        $end   = strtotime($waktu_keluar);

        if ($end <= $start) {
            $this->session->set_flashdata(
                'error',
                'Waktu keluar harus setelah waktu masuk.'
            );
            redirect('transaksi_keluar/proses/'.$id_masuk);
        }

        // ⏱ DURASI
        $durasi = ceil(($end - $start) / 3600);

        $kendaraan = $this->Kendaraan_model->get_by_plat($masuk->plat);
        $is_weekend = in_array(date('N', $end), [6,7]);

        $tarif = ($kendaraan->jenis == 'Motor')
            ? ($is_weekend ? 7000 : 5000)
            : ($is_weekend ? 15000 : 10000);

        $data = [
            'id_masuk'     => $id_masuk,
            'plat'         => $masuk->plat,
            'durasi'       => $durasi,
            'total_biaya'  => $durasi * $tarif,
            'waktu_keluar' => date('Y-m-d H:i:s', $end),
            'id_operator'  => $id_operator
        ];

        // 🔥 TRANSAKSI AMAN
        $this->db->trans_start();
        $this->Transaksi_keluar_model->insert($data);
        $this->Transaksi_masuk_model->set_out($id_masuk);
        $this->db->trans_complete();

        redirect('transaksi_keluar/riwayat');
    }

    // 📜 RIWAYAT
    public function riwayat()
    {
        $data['title'] = "Riwayat Transaksi Keluar";
        $data['list']  =
            $this->Transaksi_keluar_model
            ->get_history_by_operator(
                $this->session->userdata('id_operator')
            );

        $this->load->view('transaksi_keluar/riwayat', $data);
    }
}
