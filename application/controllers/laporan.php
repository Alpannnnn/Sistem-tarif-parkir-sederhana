<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Laporan_model');
    }

    public function kendaraan() {
        $tanggal = $this->input->get('tanggal');
        $bulan   = $this->input->get('bulan');

        $data['harian'] = $this->Laporan_model->lap_kendaraan_harian($tanggal);
        $data['bulanan'] = $this->Laporan_model->lap_kendaraan_bulanan($bulan);

        $this->load->view('laporan/kendaraan', $data);
    }

    public function transaksi() {
        $tanggal = $this->input->get('tanggal');
        $bulan   = $this->input->get('bulan');

        $data['harian'] = $this->Laporan_model->lap_transaksi_harian($tanggal);
        $data['bulanan'] = $this->Laporan_model->lap_transaksi_bulanan($bulan);

        $this->load->view('laporan/transaksi', $data);
    }

    public function operator() {
        $tanggal = $this->input->get('tanggal');

        $data['lap_operator'] = $this->Laporan_model->lap_operator_harian($tanggal);

        $this->load->view('laporan/operator', $data);
    }
}
