<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class M_transaksi extends CI_Model {

    public function simpan_transaksi($data){
        $this->db->insert('tb_transaksi', $data);
        
    }
    public function simpan_rinci_transaksi($data_rinci){
        $this->db->insert('tb_rinci_transaksi', $data_rinci);
        
    }

    // TESSS CARI LOKASI
    public function carilokasi($lokasi)
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->where('id_user', $lokasi); 
        return $this->db->get()->row();
  
    }

    public function belum_bayar()
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $this->db->where('status_order=0');
        $this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan')); 
        $this->db->order_by('id_transaksi', 'desc');
        return $this->db->get()->result();
          
    }

    public function statusorderkadaluarsa()
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $this->db->where('status_order=0');
        $this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan')); 
        $this->db->order_by('id_transaksi', 'desc');
        return $this->db->get()->result();
          
    }

    public function diproses()
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $this->db->where('status_order=1');
        $this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan')); 
        $this->db->order_by('id_transaksi', 'desc');
        return $this->db->get()->result();
          
    }

    public function dikirim()
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $this->db->where('status_order=2');
        $this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan')); 
        $this->db->order_by('id_transaksi', 'desc');
        return $this->db->get()->result();
          
    }

    public function selesai()
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $this->db->where('status_order=3');
        $this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan')); 
        $this->db->order_by('id_transaksi', 'desc');
        return $this->db->get()->result();
          
    }

    public function detail_pesanan($id_transaksi)
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $this->db->where('id_transaksi', $id_transaksi);
        return $this->db->get()->row();
        
        
        
    }

    public function rekening($id)
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->where('id_user', $id);
        return $this->db->get()->row();
        
    }

    

    public function upload_buktibayar($data)
    {
        $this->db->where('id_transaksi', $data['id_transaksi']);
        $this->db->update('tb_transaksi', $data);
        
        
    }

}

/* End of file M_transaksi.php */
