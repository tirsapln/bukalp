<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_kategori');

    }

    // List all your items
    public function index()
    {
        $data = array(
            'title' => 'Kategori',
            'kategori' => $this->m_kategori->list(),
            'isi' => 'v_kategori'
     );
     $this->load->view('layout/v_wrapper_backend', $data, FALSE);

    }

    // Add a new item
    public function add()
    {
        $data = array(
            'nama_kategori' => $this->input->post(nama_kategori),
            
        );

        $this->m_kategori->add($data);
        $this->session->set_flashdata('pesan', 'Berhasil Ditambahkan');
        redirect('kategori');
    }

    //Update one item
    public function edit( $id_kategori )
    {
        $data = array(
            'id_kategori' => $id_kategori,
            'nama_kategori' => $this->input->post(nama_kategori),
            

        );

        $this->m_kategori->edit($data);
        $this->session->set_flashdata('pesan', 'Berhasil Diubah');
        redirect('kategori');
    }

    //Delete one item
    public function hapus( $id_kategori )
    {
        $data = array('id_kategori' => $id_kategori );
        $this->m_kategori->hapus($data);
        $this->session->set_flashdata('pesan', 'Berhasil Dihapus');
        redirect('kategori');
    }
}

/* End of file Kategori.php */

