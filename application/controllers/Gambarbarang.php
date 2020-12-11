<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Gambarbarang extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_gambarbarang');
        $this->load->model('m_barang');

    }

    // List all your items
    public function index()
    {
        $id_user = $this->session->userdata('id_user');
        if ($id_user=="1") {
        $data = array(
            'title' => 'Gambar Barang',
            'gambarbarang' => $this->m_gambarbarang->listsuperadmin(),
            'isi' => 'gambarbarang/v_index'
        );
        } else {
            $data = array(
                'title' => 'Gambar Barang',
                'gambarbarang' => $this->m_gambarbarang->list(),
                'isi' => 'gambarbarang/v_index'
            );
        }
     $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    // Add a new item
    public function add($id_barang)
    {
        $this->form_validation->set_rules('ket', 'Keterangan Gambar', 'required', array('required' =>'%s Harus Diisi!!!'));
        
        
        if ($this->form_validation->run() == TRUE) {
            $config['upload_path'] = './assets/gambarbarang/';
            $config['allowed_types'] = 'jpeg|gif|jpg|png|ico';
            $config['max_size']     = '8000';
            $this->upload->initialize($config);
            $field_name = "gambar";
            if (!$this->upload->do_upload($field_name)) {
                $data = array(
                    'title' => 'Tambah Data',
                    'barang' => $this->m_barang->panggildata($id_barang),
                    'gambarbarang' => $this->m_gambarbarang->panggilgambar($id_barang),
                    'error_upload' => $this->upload->display_errors(),
                    'isi' => 'gambarbarang/v_add'
             );
             $this->load->view('layout/v_wrapper_backend', $data, FALSE);
            }
            else
            {
                $upload_data = array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/gambarbarang/'.$upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);

                $data = array(
                    'id_barang' => $id_barang, 
                    'ket' => $this->input->post('ket'),
                    
                    'gambar' => $upload_data['uploads']['file_name'],
                    
                );
                $this->m_gambarbarang->add($data);
                $this->session->set_flashdata('pesan', 'Berhasil Ditambahkan');
                redirect('gambarbarang/add/'.$id_barang);

            }
            
        } 
        
        
        $data = array(
            'title' => 'Tambah Data',
            'barang' => $this->m_barang->panggildata($id_barang),
            'gambarbarang' => $this->m_gambarbarang->panggilgambar($id_barang),
            'isi' => 'gambarbarang/v_add'
     );
     $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    

    //Delete one item
    public function hapus( $id_barang, $id_gambar)
    {
        //hapus foto
        $gambar= $this->m_gambarbarang->panggildata($id_gambar);
        if ($gambar->gambar != "") {
            unlink('./assets/gambarbarang/'.$gambar->gambar);
        }
        //
        $data = array('id_gambar' => $id_gambar );
        $this->m_gambarbarang->hapus($data);
        $this->session->set_flashdata('pesan', 'Berhasil Dihapus');
        redirect('gambarbarang/add/'.$id_barang);
    }
}

/* End of fils Fotobarang.php */

