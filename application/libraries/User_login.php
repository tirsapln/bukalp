<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_login
{
    protected $ci;

    public function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->model('m_auth');
    }

    public function login($username, $password)
    {
        $cek = $this->ci->m_auth->login_user($username, $password);
        if ($cek) {
            $id_user = $cek->id_user;
            $nama_user = $cek->nama_user;
            $username = $cek->username;
            $level_user = $cek->level_user;

            //SESSION
            $this->ci->session->set_userdata('id_user', $id_user);
            $this->ci->session->set_userdata('username', $username);
            $this->ci->session->set_userdata('nama_user', $nama_user);
            $this->ci->session->set_userdata('level_user', $level_user);
            redirect('admin');
            
        }
        else
        {
            //SALAH CEK
            $this->ci->session->set_flashdata('error', 'Username atau Password Salah');
            redirect('auth/login_user');

        }

    }

    public function proteksi()
    {
        if ($this->ci->session->userdata('username') == '') {
            $this->ci->session->set_flashdata('error', 'Anda Belum Login!!!');
            redirect('auth/login_user');
        }
    }

    public function superadmin()
    {
        if ($this->ci->session->userdata('level_user') == '2') {
            $this->ci->session->set_flashdata('error', 'Anda Belum Login!!!');
            redirect('admin');
        }
    }

    public function admin()
    {
        if ($this->ci->session->userdata('level_user') == '1') {
            $this->ci->session->set_flashdata('error', 'Anda Belum Login!!!');
            redirect('admin');
        }
    }

    public function logout()
    {
            $this->ci->session->unset_userdata('id_user');
            $this->ci->session->unset_userdata('username');
            $this->ci->session->unset_userdata('nama_user');
            $this->ci->session->unset_userdata('level_user');
            $this->ci->session->set_flashdata('pesan', 'Berhasil Logout!!!');
            redirect('auth/login_user');
    }
    

}

/* End of file User_login.php */
