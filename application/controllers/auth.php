<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Operator_model');
        $this->load->library('session');
    }

    public function login()
    {
        if ($this->input->post()) {

            $username = $this->input->post('username', TRUE);
            $password = $this->input->post('password', TRUE);

            $user = $this->Operator_model->cek_login($username);

            if ($user && password_verify($password, $user->password)) {

                $this->session->set_userdata([
                    'id_operator'   => $user->id_operator,
                    'nama_operator' => $user->nama_operator,
                    'logged_in'     => TRUE
                ]);

                redirect('dashboard');
                return;
            }

            $this->session->set_flashdata(
                'error',
                $user ? 'Password salah!' : 'Username tidak ditemukan!'
            );

            redirect('auth/login');
            return;
        }

        $this->load->view('auth/login');
    }

    public function register()
    {
        if ($this->input->post()) {

            $data = [
                'nama_operator' => $this->input->post('nama', TRUE),
                'username'      => $this->input->post('username', TRUE),
                'password'      => password_hash(
                    $this->input->post('password'),
                    PASSWORD_DEFAULT
                )
            ];

            $this->Operator_model->insert($data);

            $this->session->set_flashdata(
                'success',
                'Register berhasil! Silakan login.'
            );

            redirect('auth/login');
            return;
        }

        $this->load->view('auth/register');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login'); // ✔️ BENAR
    }
}
