<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Operator extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('operator_model');
    }

    public function index()
    {
        $data['title'] = 'Master Operator';
        $data['operator'] = $this->operator_model->get_all();

        $this->load->view('operator/index', $data);
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Operator';
        $this->load->view('operator/form', $data);
    }

    public function simpan()
    {
        $data = [
            'nama_operator' => $this->input->post('nama_operator'),
            'username'      => $this->input->post('username'),
            'password'      => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
        ];

        $this->operator_model->insert($data);
        redirect('operator');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Operator';
        $data['op'] = $this->operator_model->get_by_id($id);

        $this->load->view('operator/form', $data);
    }

    public function update()
    {
        $id = $this->input->post('id_operator');

        // jika password dikosongkan
        if ($this->input->post('password') == '') {
            $data = [
                'nama_operator' => $this->input->post('nama_operator'),
                'username'      => $this->input->post('username')
            ];
        } else {
            $data = [
                'nama_operator' => $this->input->post('nama_operator'),
                'username'      => $this->input->post('username'),
                'password'      => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
            ];
        }

        $this->operator_model->update($id, $data);
        redirect('operator');
    }

    public function hapus($id)
    {
        $this->operator_model->delete($id);
        redirect('operator');
    }
}
