<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dashboard_model');

        // proteksi login
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['title'] = 'Dashboard';

        $id_operator = $this->session->userdata('id_operator');

        // ambil data dari MODEL
        $data['total_kendaraan']           = $this->Dashboard_model->getTotalKendaraanByOperator($id_operator);
        $data['total_transaksi_hari_ini']  = $this->Dashboard_model->getTransaksiHariIniByOperator($id_operator);
        $data['total_pendapatan_hari_ini'] = $this->Dashboard_model->getPendapatanHariIniByOperator($id_operator);
        $data['kendaraan_masuk']           = $this->Dashboard_model->getMasukHariIniByOperator($id_operator);
        $data['kendaraan_keluar']          = $this->Dashboard_model->getKeluarHariIniByOperator($id_operator);
        $data['total_operator']            = $this->Dashboard_model->getTotalOperator();

        $this->load->view('template/header', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('template/footer');
    }
}
