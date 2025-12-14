<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class transaksi_rekap extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaksi_rekap_model');
    }

    public function index()
    {
        // default: tampilkan semua rekap hari ini
        $tanggal = $this->input->get('tanggal');

        if (!$tanggal) {
            $tanggal = date('Y-m-d');
        }

        $data['tanggal'] = $tanggal;
        $data['rekap'] = $this->transaksi_rekap_model->getRekapByDate($tanggal);

        $this->load->view('template/header');
        $this->load->view('transaksi/rekap/index', $data);
        $this->load->view('template/footer');
    }

    public function filter()
    {
        $tanggal = $this->input->post('tanggal');

        redirect('transaksi_rekap?tanggal=' . $tanggal);
    }
}
?>
