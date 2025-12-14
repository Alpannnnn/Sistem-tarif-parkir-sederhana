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

    public function simpan()
    {
        $data = [
            'nama_area' => $this->input->post('nama_area'),
            'lokasi'    => $this->input->post('lokasi'),
        ];

        $this->area_model->insert($data);
        redirect('master_area');
    }

    public function edit($id)
    {
        $data['a'] = $this->area_model->get_by_id($id);
        $this->load->view('area/edit', $data);
    }

    public function update()
    {
        $id = $this->input->post('id_area');

        $data = [
            'nama_area' => $this->input->post('nama_area'),
            'lokasi'    => $this->input->post('lokasi'),
        ];

        $this->area_model->update($id, $data);
        redirect('master_area');
    }

    public function hapus($id)
    {
        $this->area_model->delete($id);
        redirect('master_area');
    }
}
