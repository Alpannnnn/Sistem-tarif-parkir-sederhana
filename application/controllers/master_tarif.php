<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_tarif extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        // Pastikan helper session sudah otomatis diload
        $this->load->library('session');
        $this->load->helper('url');

        // Cek login manual (lebih aman)
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['title'] = "Master Tarif (Hardcode)";
        $this->load->view('tarif/index', $data);
    }
}
