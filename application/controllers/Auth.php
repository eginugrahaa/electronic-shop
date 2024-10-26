<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
    }

    public function index()
    {
        // Cek jika sudah login, arahkan ke halaman sesuai role
        if ($this->session->userdata('username')) {
            if ($this->session->userdata('role_id') == 1) {
                redirect('dashboard');
            }
        }
        
        $this->load->view('auth/login');
    }

    public function login()
    {
        // Validasi input username dan password
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/login');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));

        // Ambil data user dari database
        $user = $this->Auth_model->get_user($username);

        if ($user) {
            if ($password == $user['password']) {
                // Jika password benar, set session
                $data = [
                    'username' => $user['username'],
                    'role_id' => $user['role_id']
                ];
                $this->session->set_userdata($data);

                // Redirect berdasarkan role_id
                if ($user['role_id'] == 1) {
                    redirect('dashboard'); // Jika berhasil
                }
            } else {
                // Jika password salah
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
                redirect('auth');
            }
        } else {
            // Jika username tidak ditemukan
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username is not registered!</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        // Unset session data
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');
        redirect('auth');
    }
}