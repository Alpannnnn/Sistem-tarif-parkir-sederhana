<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_kendaraan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kendaraan_model');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index()
    {
        $data['title'] = 'Master Kendaraan';
        $data['master_kendaraan'] = $this->Kendaraan_model->get_all();

        $this->load->view('kendaraan/index', $data);
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Kendaraan';
        $this->load->view('kendaraan/tambah', $data);
    }

    public function simpan()
    {
        // VALIDASI INPUT
        if (!$this->input->post('plat') || !$this->input->post('jenis')) {
            $this->session->set_flashdata(
                'error',
                'Plat dan jenis kendaraan wajib diisi.'
            );
            redirect('master_kendaraan/tambah');
        }

        $data = [
            'plat'  => strtoupper(trim($this->input->post('plat'))),
            'jenis' => $this->input->post('jenis'),
            'merk'  => $this->input->post('merk'),
            'warna' => $this->input->post('warna'),
        ];

        if (!$this->Kendaraan_model->insert($data)) {
            $this->session->set_flashdata(
                'error',
                'Plat kendaraan sudah terdaftar.'
            );
            redirect('master_kendaraan/tambah');
        }

        $this->session->set_flashdata(
            'success',
            'Data kendaraan berhasil ditambahkan.'
        );
        redirect('master_kendaraan');
    }

    public function edit($plat)
    {
        $data['title'] = 'Edit Kendaraan';
        $data['k'] = $this->Kendaraan_model->get_by_plat($plat);

        if (!$data['k']) {
            show_404();
        }

        $this->load->view('kendaraan/edit', $data);
    }

    public function update()
    {
        $plat = $this->input->post('plat');

        $data = [
            'jenis' => $this->input->post('jenis'),
            'merk'  => $this->input->post('merk'),
            'warna' => $this->input->post('warna'),
        ];

        if ($this->Kendaraan_model->update($plat, $data)) {
            $this->session->set_flashdata(
                'success',
                'Data kendaraan berhasil diperbarui.'
            );
        } else {
            $this->session->set_flashdata(
                'error',
                'Tidak ada perubahan data.'
            );
        }

        redirect('master_kendaraan');
    }

    public function hapus($plat)
    {
        if (!$this->Kendaraan_model->delete($plat)) {
            $this->session->set_flashdata(
                'error',
                'Kendaraan tidak dapat dihapus karena masih digunakan dalam transaksi.'
            );
        } else {
            $this->session->set_flashdata(
                'success',
                'Data kendaraan berhasil dihapus.'
            );
        }

        redirect('master_kendaraan');
    }
}
