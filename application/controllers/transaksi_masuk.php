<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_masuk extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->library('session');
        $this->load->helper('url');
        $this->load->config('parkir');

        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }

        $this->load->model('Transaksi_masuk_model');
    }

    public function index()
{
    $id_operator = $this->session->userdata('id_operator');

    $data['title'] = 'Transaksi Masuk';
    $data['list']  = $this->Transaksi_masuk_model
                        ->get_by_operator($id_operator);

    $data['area_parkir'] = $this->config->item('area_parkir');

    $this->load->view('transaksi_masuk/index', $data);
}

    public function tambah()
    {
    $data['title'] = 'Tambah Transaksi Masuk';
    $data['area_parkir'] = $this->config->item('area_parkir');

    $this->load->view('transaksi_masuk/form', $data);
    }


   public function simpan()
{
    $plat   = strtoupper(trim($this->input->post('plat')));
    $area   = $this->input->post('area');
    $waktu  = $this->input->post('waktu_masuk');
    $jenis  = $this->input->post('jenis_kendaraan');
    $member = $this->input->post('is_member') ? 1 : 0;

    // VALIDASI KELENGKAPAN DATA
    if (!$plat || !$area || !$waktu || !$jenis) {
        $this->session->set_flashdata('error', 'Data tidak lengkap');
        redirect('transaksi_masuk/tambah');
    }

    // --- VALIDASI TAMBAHAN: Waktu tidak boleh sebelum hari ini ---
    if (strtotime($waktu) < strtotime(date('Y-m-d H:i'))) {
        $this->session->set_flashdata('error', 'Waktu masuk tidak boleh sebelum waktu sekarang');
        redirect('transaksi_masuk/tambah');
    }

    // VALIDASI MASIH PARKIR
    if ($this->Transaksi_masuk_model->cekMasihParkir($plat)) {
        $this->session->set_flashdata('error', 'Kendaraan masih parkir');
        redirect('transaksi_masuk/tambah');
    }

    // LOGIC INSERT (TETAP SAMA)
    $this->Transaksi_masuk_model->insert([
        'id_operator'     => $this->session->userdata('id_operator'),
        'area'            => $area,
        'plat'            => $plat,
        'waktu_masuk'     => $waktu,
        'jenis_kendaraan' => $jenis,
        'is_member'       => $member,
        'status'          => 'IN'
    ]);

    redirect('transaksi_masuk/riwayat');
}


    public function riwayat()
{
    $id_operator = $this->session->userdata('id_operator');

    $data['title'] = 'Riwayat Transaksi Masuk';
    $data['list']  = $this->Transaksi_masuk_model
                            ->get_by_operator($id_operator);

    $this->load->view('transaksi_masuk/riwayat', $data);
}

}
