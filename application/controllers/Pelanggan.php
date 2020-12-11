<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_pelanggan');
        $this->load->model('m_auth');
        
    }

    //Update one item
    public function editsuperadmin( $id_pelanggan)
    {
        $data = array(
            'id_pelanggan' => $id_pelanggan,
            
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password'),
            

        );

        $this->m_pelanggan->editsuperadmin($data);
        $this->session->set_flashdata('pesan', 'Berhasil Diubah');
        redirect('pelanggan');


    }

    //Delete one item
    public function hapus($id_pelanggan)
    {
        $data = array('id_pelanggan' => $id_pelanggan );
        $this->m_pelanggan->hapus($data);
        $this->session->set_flashdata('pesan', 'Berhasil Dihapus');
        redirect('pelanggan');
    }

    public function index()
    {
        $this->user_login->superadmin();
        $data = array(
            'title' => 'Pelanggan',
            'pelanggan' => $this->m_pelanggan->list(),
            'isi' => 'v_pelanggan'
     );
     $this->load->view('layout/v_wrapper_backend', $data, FALSE);
     
    }
    

    public function register()
    {

        $this->form_validation->set_rules('nama_pelanggan', 'Nama Lengkap', 'required', array('required' =>'%s Harus Diisi!!!'));
        $this->form_validation->set_rules('nik', 'NIK', 'required', array('required' =>'%s Harus Diisi!!!'));
        $this->form_validation->set_rules('email', 'Email', 'required', array('required|is_uniqui[tb_pelanggan.email]' =>'%s Harus Diisi!!!', 'is_unique' => '%s Email Sudah Terdaftar '));
        $this->form_validation->set_rules('password', 'Password', 'required', array('required' =>'%s Harus Diisi!!!'));
        $this->form_validation->set_rules('ulangi_password', 'Ulangi Password', 'required|matches[password]', array('required' =>'%s Harus Diisi!!!'));
        
        
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Register Pelanggan',
                'isi' => 'v_register'
         );
         $this->load->view('layout/v_wrapper_frontend', $data, FALSE);

        } else {
            $data = array(
                
                'nama_pelanggan' => $this->input->post('nama_pelanggan'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'nik' => $this->input->post('nik'),
                'foto' => 'no_foto.jpg',

            );
    
            $this->m_pelanggan->register($data);
            $this->session->set_flashdata('pesan', 'Akun berhasil terdaftar, Silahkan Login');
            redirect('pelanggan/register');
        }
    }

    public function login()
    {

        $this->form_validation->set_rules('email', 'email', 'required', array(
            'required' =>'%s Harus Diisi !!!'
        ));
        $this->form_validation->set_rules('password', 'Password', 'required', array(
            'required' =>'%s Harus Diisi !!!'
        ));
        
        
        if ($this->form_validation->run() == TRUE) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $this->pelanggan_login->login($email, $password);
            
        } 
            
        
        $data = array(
            'title' => 'Login Pelanggan',
            'isi' => 'v_login_pelanggan'
     );
     $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
    }

    public function logout()
    {
        $this->pelanggan_login->logout();

    }

    public function akun()
    {
        $this->pelanggan_login->proteksi();
        $id_pelanggan= $this->session->userdata('id_pelanggan');

        $this->form_validation->set_rules('nama_pelanggan', 'Pelanggan', 'required', array('required' =>'%s Harus Diisi!!!'));
        
        
        if ($this->form_validation->run() == TRUE) {
            $config['upload_path'] = './assets/foto/';
            $config['allowed_types'] = 'jpeg|gif|jpg|png|ico';
            $config['max_size']     = '8000';
            $this->upload->initialize($config);
            $field_name = "foto";
            if (!$this->upload->do_upload($field_name)) {
                $this->pelanggan_login->proteksi();
                $data = array(
                    'title' => 'Akun Saya',
                    'akun' => $this->m_pelanggan->akun($id_pelanggan),
                    'isi' => 'v_akun_saya'
                );
                 $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
            }
            else
            {
                
                $upload_data = array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/foto/'.$upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);

                

                $data = array(
                    'id_pelanggan' => $id_pelanggan,
                    'nama_pelanggan' => $this->input->post('nama_pelanggan'), 
                    'email' => $this->input->post('email'),
                    'password' => $this->input->post('password'),
                    'nik' => $this->input->post('nik'),
                    'alamat' => $this->input->post('alamat'),
                    'foto' => $upload_data['uploads']['file_name'],
                    'no_telpon' => $this->input->post('no_telpon'),
                    
                );
                $this->m_pelanggan->edit($data);
                $this->session->set_flashdata('pesan', 'Berhasil Diubah');
                redirect('pelanggan/akun');

            }

            $data = array(
                'id_pelanggan' => $id_pelanggan,
                    'nama_pelanggan' => $this->input->post('nama_pelanggan'), 
                    'email' => $this->input->post('email'),
                    'password' => $this->input->post('password'),
                    'nik' => $this->input->post('nik'),
                    'alamat' => $this->input->post('alamat'),
                    //'foto' => $upload_data['uploads']['file_name'],
                    'no_telpon' => $this->input->post('no_telpon'),
                
            );
            $this->m_pelanggan->edit($data);
            $this->session->set_flashdata('pesan', 'Berhasil Diubah');
            redirect('pelanggan/akun');
            
        } 
        
        
        $data = array(
            'title' => 'Akun Saya',
            'akun' => $this->m_pelanggan->akun($id_pelanggan),
            'isi' => 'v_akun_saya'
     );
     $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
        

    }

}