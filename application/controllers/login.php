<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('operator_model');
        $this->load->library('session');
    }

    // =================== PAGE LOGIN ===================
    public function index()
    {
        $this->load->view('login');
    }


    // =================== PAGE REGISTER ===================
    public function register()
    {
        $this->load->view('register');
    }


    // =================== ACTION REGISTER ===================
    public function simpan_register()
    {
        $nama     = $this->input->post('nama_operator');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // ---- VALIDASI: semua field wajib diisi ----
        if ($nama == '' || $username == '' || $password == '') {
            $this->session->set_flashdata('error', 'Semua field wajib diisi!');
            redirect('login/register');
            return;
        }

        // ---- VALIDASI: username sudah digunakan ----
        $cek = $this->operator_model->get_by_username($username);
        if ($cek) {
            $this->session->set_flashdata('error', 'Username sudah dipakai, gunakan yang lain!');
            redirect('login/register');
            return;
        }

        // ---- SIMPAN USER BARU ----
        $data = [
            'nama_operator' => $nama,
            'username'      => $username,
            'password'      => password_hash($password, PASSWORD_DEFAULT)
        ];

        $this->operator_model->insert($data);

        // ---- INFORMASI BERHASIL ----
        $this->session->set_flashdata('success', 'Registrasi berhasil! Silakan login.');
        redirect('login');
    }


    // =================== ACTION LOGIN ===================
    public function auth()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // Ambil user berdasarkan username
        $op = $this->operator_model->get_by_username($username);

        if ($op) {
            // Cek password hash
            if (password_verify($password, $op->password)) {

                // Set session login
                $this->session->set_userdata([
                'id_operator'   => $op->id_operator,
                'nama_operator' => $op->nama_operator,
                'logged_in'     => TRUE
            ]);


                redirect('dashboard');

            } else {
                $this->session->set_flashdata('error', 'Password salah!');
                redirect('login');
            }

        } else {
            $this->session->set_flashdata('error', 'Username tidak ditemukan!');
            redirect('login');
        }
    }


    // =================== LOGOUT ===================
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
