<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_masuk extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->library('session');
        $this->load->helper('url');

        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }

        $this->load->model('Transaksi_masuk_model');
        $this->load->model('Kendaraan_model');
        $this->load->model('Area_model');
    }

    public function index()
    {
        $data['title'] = 'Transaksi Masuk';
        $id_operator = $this->session->userdata('id_operator');

        $data['list'] = $this->Transaksi_masuk_model
            ->get_by_operator_join($id_operator);

        $this->load->view('transaksi_masuk/index', $data);
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Transaksi Masuk';
        $data['kendaraan'] = $this->Kendaraan_model->get_all();
        $data['area'] = $this->Area_model->get_all();

        $this->load->view('transaksi_masuk/form', $data);
    }

    public function simpan()
{
    $waktu_masuk = $this->input->post('waktu_masuk');

    $today = strtotime(date('Y-m-d 00:00:00'));
    $input = strtotime($waktu_masuk);

    // ❌ sebelum hari ini
    if ($input < $today) {
        $this->session->set_flashdata(
            'error',
            'Waktu masuk tidak boleh sebelum hari ini.'
        );
        redirect('transaksi_masuk/tambah');
    }

    $data = [
        'id_operator' => $this->session->userdata('id_operator'),
        'id_area'     => $this->input->post('id_area'),
        'plat'        => $this->input->post('plat'),
        'waktu_masuk' => date('Y-m-d H:i:s', $input),
        'status'      => 'IN'
    ];

    $this->Transaksi_masuk_model->insert($data);
    redirect('transaksi_masuk');
    }


    // ❌ TIDAK ADA DELETE
    public function hapus($id)
    {
        $this->session->set_flashdata(
            'error',
            'Transaksi masuk tidak boleh dihapus. Silakan lakukan Transaksi Keluar.'
        );
        redirect('transaksi_masuk');
    }
}
