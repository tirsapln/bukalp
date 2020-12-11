<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Belanja extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_transaksi');
       

    }

    // List all your items
    public function index()
    {
        //print_r($this->cart->contents()['c4ca4238a0b923820dcc509a6f75849b']);
        //die();
        if(empty($this->cart->contents()))
        {
            redirect('home');
            
        };
        $data = array(
            'title' => 'Keranjang Belanja',
            
            'isi' => 'v_belanja'
            
     );
     $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
        
    }

    // Add a new item
    public function add()
    {
        $redirect_page = $this->input->post('redirect_page');
        
        $data = array(
            'id' => $this->input->post('id'),
            'qty' => $this->input->post('qty'),
            'price' => $this->input->post('price'),       
            'name' => $this->input->post('name'),
            'lokasi' => $this->input->post('lokasi'),
        );
        $this->cart->insert($data);
        redirect($redirect_page,'refresh');
    }

    //Update one item
    public function update()
    {
        $i=1;
        foreach ($this->cart->contents() as $items) {
                
                $data = array(
                    'rowid' => $items['rowid'],
                    'qty'   => $this->input->post($i.'[qty]'),
                    
                );
                
                $this->cart->update($data);
                $i++;        
                
        }
        redirect('belanja');
        

    }

    //Delete one item
    public function hapus($rowid)
    {
        $this->cart->remove($rowid);
        
        redirect('belanja');
        
    }

    public function clear()
    {
        $this->cart->destroy();
        
        redirect('belanja');
        
    }

    public function cekout()
    {
        $this->pelanggan_login->proteksi();
        
        $cart = [];
                    foreach ($this->cart->contents() as $items) {
                        
                        array_push($cart,$items['lokasi']);
        }

        $id_pertama = $cart[0];
        $error = false;
        foreach ($cart as $row) {
            $error =false;
            if($row != $id_pertama)
            {
                $error = true;
            break;
            }
        }
        

        if($error)
        {
            $this->session->set_flashdata('error', 'Barang dalam Keranjang Belanja berada di Toko yang berbeda !!!');  
            redirect('belanja');
            
        }
                   
        

        $this->form_validation->set_rules('provinsi', 'Provinsi', 'required', array('required' =>'%s Harus Dipilih!!!'));
        $this->form_validation->set_rules('kota', 'Kota', 'required', array('required' =>'%s Harus Dipilih!!!'));
        $this->form_validation->set_rules('ekspedisi', 'Ekspedisi', 'required', array('required' =>'%s Harus Dipilih!!!'));
        $this->form_validation->set_rules('paket', 'Paket', 'required', array('required' =>'%s Harus Dipilih!!!'));
        //$this->form_validation->set_rules('provinsi', 'Provinsi', 'required', array('required' =>'%s Harus Dipilih!!!'));
        
        
        if($this->form_validation->run() == FALSE)
        {
            $data = array(
                'title' => 'Cekout Belanja',
                'isi' => 'v_cekout'
         );
         $this->load->view('layout/v_wrapper_frontend', $data, FALSE);

        }else {
            $item= $this->cart->contents();
            $data = array(
                'id_pelanggan' => $this->session->userdata('id_pelanggan'),
                'no_order' => $this->input->post('no_order'),
                'tgl_order' => date('Y-m-d h:i:s'),
                'nama_penerima' => $this->input->post('nama_penerima'),
                'hp_penerima' => $this->input->post('hp_penerima'),
                'provinsi' => $this->input->post('provinsi'),
                'kota' => $this->input->post('kota'),
                'alamat' => $this->input->post('alamat'),
                'kode_pos' => $this->input->post('kode_pos'),
                'catatan' => $this->input->post('catatan'),
                'ekspedisi' => $this->input->post('ekspedisi'),
                'paket' => $this->input->post('paket'),
                'estimasi' => $this->input->post('estimasi'),
                'ongkir' => $this->input->post('ongkir'),
                'berat' => $this->input->post('berat'),
                'grand_total' => $this->input->post('grand_total'),
                'total_bayar' => $this->input->post('total_bayar'),
                'status_bayar' => '0',
                'status_order' => '0',
                //'id_barang' =>  $item['id'],
                'id_user' =>  $id_pertama,
                
           

            );
            $this->m_transaksi->simpan_transaksi($data);

            //simpan rinci
            $i = 1;
            foreach ($this->cart->contents() as $item) {
                $data_rinci = array(
                    'no_order' => $this->input->post('no_order'),
                    'id_barang' =>  $item['id'],
                    'qty' => $this->input->post('qty'.$i++),
                    'id_user' =>  $item['lokasi'],
                    
                );
                $this->m_transaksi->simpan_rinci_transaksi($data_rinci);
            }

            
            //----------
            $this->session->set_flashdata('pesan', 'Pesanan Berhasil di Proses...!!!');
            $this->cart->destroy();
            redirect('pesanan_saya');
            

        }
        
    }

    public function cekoutitem($rowid)
    {
        
        $this->pelanggan_login->proteksi();

        $this->form_validation->set_rules('provinsi', 'Provinsi', 'required', array('required' =>'%s Harus Dipilih!!!'));
        $this->form_validation->set_rules('kota', 'Kota', 'required', array('required' =>'%s Harus Dipilih!!!'));
        $this->form_validation->set_rules('ekspedisi', 'Ekspedisi', 'required', array('required' =>'%s Harus Dipilih!!!'));
        $this->form_validation->set_rules('paket', 'Paket', 'required', array('required' =>'%s Harus Dipilih!!!'));
        //$this->form_validation->set_rules('provinsi', 'Provinsi', 'required', array('required' =>'%s Harus Dipilih!!!'));
        
        
        if($this->form_validation->run() == FALSE)
        {
            $data = array(
                'title' => 'Cekout Belanja',
                'isi' => 'v_cekoutitem',
                //'carilokasi' => $this->m_transaksi->carilokasi(),
                'rowid' => $rowid
               
         );
         $this->load->view('layout/v_wrapper_frontend', $data, FALSE);

        }else {
            $items= $this->cart->contents()[$rowid];
            $data = array(
                'id_pelanggan' => $this->session->userdata('id_pelanggan'),
                'no_order' => $this->input->post('no_order'),
                'tgl_order' => date('Y-m-d h:i:s'),
                'nama_penerima' => $this->input->post('nama_penerima'),
                'hp_penerima' => $this->input->post('hp_penerima'),
                'provinsi' => $this->input->post('provinsi'),
                'kota' => $this->input->post('kota'),
                'alamat' => $this->input->post('alamat'),
                'kode_pos' => $this->input->post('kode_pos'),
                'ekspedisi' => $this->input->post('ekspedisi'),
                'paket' => $this->input->post('paket'),
                'estimasi' => $this->input->post('estimasi'),
                'ongkir' => $this->input->post('ongkir'),
                'berat' => $this->input->post('berat'),
                'grand_total' => $this->input->post('grand_total'),
                'total_bayar' => $this->input->post('total_bayar'),
                'catatan' => $this->input->post('catatan'),
                'status_bayar' => '0',
                'status_order' => '0',
                'id_user' =>  $items['lokasi'],
                
                
            );
            $this->m_transaksi->simpan_transaksi($data);

            //simpan rinci
            $i = 1;
            
            $items = $this->cart->contents()[$rowid];
                $data_rinci = array(
                    'no_order' => $this->input->post('no_order'),
                    'id_barang' =>  $items['id'],
                    'id_user' =>  $items['lokasi'],
                    'qty' => $this->input->post('qty'),
                    
            
                );
                $this->m_transaksi->simpan_rinci_transaksi($data_rinci);
            

            
            //----------
            $this->session->set_flashdata('pesan', 'Pesanan Berhasil di Proses...!!!');
            $this->cart->remove($rowid);
            redirect('pesanan_saya');
        }
  
    } 

    



}

/* End of file Belanja.php */

