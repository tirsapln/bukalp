<?php



defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan_saya extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_transaksi');
        $this->load->model('m_pesananmasuk');
        

    }

    //RINCI
    public function rincian_pesanan($id_transaksi)
    {
        
        
        $id = $this->m_pesananmasuk->rincipesanan($id_transaksi)->id_user;
        
        $order = $this->m_pesananmasuk->rincipesanan($id_transaksi)->no_order;
        $no_order = array('no_order' =>$order);
        
        //print_r($no_order);
        //die();
        $data = array( 
            'title' => 'Rinci Pesanan',
            'transaksi' => $this->m_pesananmasuk->rincipesanan($id_transaksi),
            'toko' => $this->m_pesananmasuk->rincitoko($id),
            'rinciorder' => $this->m_pesananmasuk->rinciorder($no_order),
            
            'isi' => 'v_rincian_pesanan_pelanggan'
     );
     $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
    }

    // List all your items
    public function index()
    {
        
        $data = array(
            'title' => 'Pesanan Saya',
            
            'belum_bayar' => $this->m_transaksi->belum_bayar(),
            'diproses' => $this->m_transaksi->diproses(),
            'dikirim' => $this->m_transaksi->dikirim(),
            'selesai' => $this->m_transaksi->selesai(),
            'isi' => 'v_pesanan_saya'
     );
     $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
    }

    public function bayar($id_transaksi)
    {
        $this->form_validation->set_rules('atas_nama_pengguna', 'Atas Nama', 'required', array('required' =>'%s Harus Diisi!!!'));
        
        $id = $this->m_transaksi->detail_pesanan($id_transaksi)->id_user;
        $rekening = $this->m_transaksi->rekening($id); 

        //print_r($rekening);
        //die();
        
        if ($this->form_validation->run() == TRUE) {
            $config['upload_path'] = './assets/bukti_bayar/';
            $config['allowed_types'] = 'jpeg|gif|jpg|png|ico';
            $config['max_size']     = '8000';
            $this->upload->initialize($config);
            $field_name = 'bukti_bayar';
            if (!$this->upload->do_upload($field_name)) {
                $data = array(
                    'title' => 'Pembayaran',
                    'pesanan' => $this->m_transaksi->detail_pesanan($id_transaksi),
                    'rekening' => $rekening,
                    'error_upload' => $this->upload->display_errors(),
                    'isi' => 'v_bayar'
             );
             $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
             
            }
            else
            {
                $upload_data = array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/bukti_bayar/'.$upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);

                $data = array(
                    'id_transaksi' => $id_transaksi,
                    'atas_nama_pengguna' => $this->input->post('atas_nama_pengguna'), 
                    'nama_bank_pengguna' => $this->input->post('nama_bank_pengguna'),
                    'no_rek_pengguna' => $this->input->post('no_rek_pengguna'),
                    'status_bayar' => '1',
                    'bukti_bayar' => $upload_data['uploads']['file_name'], 
                    
                );
                $this->m_transaksi->upload_buktibayar($data);
                $this->session->set_flashdata('pesan', 'Bukti Pembayaran Behasil di Upload');
                redirect('pesanan_saya');

            } 
            
        } 
        
        //print_r($rekening);
        //die();

        $data = array(
            'title' => 'Pembayaran',
            'pesanan' => $this->m_transaksi->detail_pesanan($id_transaksi), 
            'rekening' => $rekening,
            'isi' => 'v_bayar'
     );
     $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
    }

    // Add a new item
    public function diterima($id_transaksi)
    {
        $data = array(
            'id_transaksi' => $id_transaksi,
            'status_order' => '3',
            
            

        );
        $this->m_pesananmasuk->update_order($data);
        $this->session->set_flashdata('pesan', 'Telah Diterima !!!');
        redirect('pesanan_saya');
    }

    //Update one item
    public function update( $id = NULL )
    {

    }

    //Delete one item
    public function delete( $id = NULL )
    {

    }
}

/* End of file Pesanan_saya.php */

