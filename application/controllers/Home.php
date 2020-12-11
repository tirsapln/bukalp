<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_home');
        foreach ($this->m_home->autocancle() as $row) {
            
            
            $data = array(
            'id_transaksi' => $row->id_transaksi,
            'status_bayar' => '9',
            'status_order' => '0',

            );
            $this->m_home->kadaluarsa($data);
            
            

        }
        
        
    }
    
    public function index()
    {
        $data = array(
            'title' => 'Home',
            'barang' => $this->m_home->list(),
            'isi' => 'v_home'
     );
     $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
     
    }

    public function tentang()
    {
        $data = array(
            'title' => 'Tentang Kami',
            'isi' => 'v_tentang'
     );
     $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
     
    }

    public function kontak()
    {
        $data = array(
            'title' => 'Home',
            //'barang' => $this->m_home->list(),
            'isi' => 'v_kontak'
     );
     $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
     
    }

    public function bantuan()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required', array('required' =>'%s Harus Diisi!!!'));
        if($this->form_validation->run() == FALSE)
        {
            $data = array(
                'title' => 'Bantuan',
                'qnaa' => $this->m_home->qnaa(),
                'isi' => 'v_bantuan'
         );
         $this->load->view('layout/v_wrapper_frontend', $data, FALSE);

        }else {
            $data = array(
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'pertanyaan' => $this->input->post('pertanyaan'),
            );
            $this->m_home->simpan_pertanyaan($data);
            $this->session->set_flashdata('pesan', 'Pertanyaan berhasil dikirim...!!!');
            redirect('home/bantuan');
        }
    }

    public function pengaduan()
    {
         $this->form_validation->set_rules('nama', 'nama', 'required', array('required' =>'%s Harus Diisi!!!'));
        
        
        if ($this->form_validation->run() == TRUE) {
            $config['upload_path'] = './assets/gambarpengaduan/';
            $config['allowed_types'] = 'jpeg|gif|jpg|png|ico';
            $config['max_size']     = '8000';
            $this->upload->initialize($config);
            $field_name = "foto";
            if (!$this->upload->do_upload($field_name)) {
                $data = array(                    
                    'error_upload' => $this->upload->display_errors(),
                    'title' => 'Bantuan',
                    'isi' => 'v_bantuan'    
                    
             );
             $this->load->view('layout/v_wrapper_backend', $data, FALSE);
            }
            else
            {
                $upload_data = array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/gambarpengaduan/'.$upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);

                $data = array(
                    'nama' => $this->input->post('nama'), 
                    'email' => $this->input->post('email'),
                    'desk_pengaduan' => $this->input->post('desk_pengaduan'),
                    'foto' => $upload_data['uploads']['file_name']
                );
                $this->m_home->pengaduanadd($data);
                $this->session->set_flashdata('pesan', 'Berhasil Ditambahkan');
                redirect('home/bantuan');

            }
            $data = array(
                'nama' => $this->input->post('nama'), 
                'email' => $this->input->post('email'),
                'desk_pengaduan' => $this->input->post('desk_pengaduan'),
                //'foto' => $upload_data['uploads']['file_name']
            );
            $this->m_home->pengaduanadd($data);
            $this->session->set_flashdata('pesan', 'Berhasil Ditambahkan');
            redirect('home/bantuan');
        }
    }
    


    public function kategori($id_kategori)
    {
        $kategori = $this->m_home->kategori($id_kategori);
        $data = array(
            'title' => 'Kategori Barang : '.$kategori->nama_kategori,
            'barang' => $this->m_home->listbarang($id_kategori),
            'isi' => 'v_kategoribarang'
     );
     $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
     
    }

    public function detail_barang($id_barang)
    {
        $data = array(
            'title' => 'Detail Barang',
            'gambar' => $this->m_home->gambar_barang($id_barang),
            'barang' => $this->m_home->detail_barang($id_barang),
            'isi' => 'v_detailbarang'
     );
     $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
    }

    public function cari()
    {
        
        $keyword = $this->input->post('keyword');
        //$keyword = "sepatu";
        //print_r($this->m_home->caridata($keyword));
        //die();
        
        $data = array(
            'title' => 'Pencarian : '.$keyword,
            'cari' => $this->m_home->caridata($keyword),
            'isi' => 'v_cari'
     );
     $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
     
    }

    //CARI
    
}

/* End of file Home.php */
