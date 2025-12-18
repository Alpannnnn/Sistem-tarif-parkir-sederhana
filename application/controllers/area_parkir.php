<?php
defined('BASEPATH') OR exit('No direct script_access allowed');

class Area_parkir extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('area_model');
    }

    public function index()
    {
        $data['area'] = $this->area_model->get_all();
        $this->load->view('area/index', $data);
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Area';
        $this->load->view('area/tambah', $data);
    }
}
