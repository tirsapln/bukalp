<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class M_pesananmasuk extends CI_Model {

    public function pesanan()
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $this->db->where('status_order=0');
        //$this->db->where('status_bayar=0');
        $this->db->where('id_user', $this->session->userdata('id_user')); 
        $this->db->order_by('id_transaksi', 'desc');
        return $this->db->get()->result();
  
    }
    public function listexcel($idtoko)
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        //$this->db->join('tb_rinci_transaksi', 'tb_rinci_transaksi.no_order = tb_transaksi.no_order', 'left');
        //$this->db->join('tb_rinci_transaksi', 'tb_rinci_transaksi.id_barang = tb_barang.id_barang', 'left');
        //$this->db->join('tb_barang', 'tb_barang.id_barang = tb_transaksi.id_barang', 'left');
        $this->db->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_transaksi.id_pelanggan', 'left');
        $this->db->where('status_order=3');
        $this->db->where('id_user', $idtoko); 
        $this->db->order_by('id_transaksi', 'desc');
        return $this->db->get();
    }

    public function listpdf($idtoko)
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        //$this->db->join('tb_rinci_transaksi', 'tb_rinci_transaksi.no_order = tb_transaksi.no_order', 'left');
        //$this->db->join('tb_rinci_transaksi', 'tb_rinci_transaksi.id_barang = tb_barang.id_barang', 'left');
        //$this->db->join('tb_barang', 'tb_barang.id_barang = tb_transaksi.id_barang', 'left');
        $this->db->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_transaksi.id_pelanggan', 'left');
        $this->db->where('status_order=3');
        $this->db->where('id_user', $idtoko); 
        $this->db->order_by('id_transaksi', 'desc');
        return $this->db->get();
    }

    public function pesanansuperadmin()
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $this->db->where('status_order=0'); 
        $this->db->where('status_bayar=0'); 
        $this->db->order_by('id_transaksi', 'desc');
        return $this->db->get()->result();
  
    }

    public function pesanan_selesaisuperadmin()
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $this->db->where('status_order=3');
        //$this->db->where('id_user', $this->session->userdata('id_user')); 
        
        //$this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan')); 
        $this->db->order_by('id_transaksi', 'desc');
        return $this->db->get()->result();
  
    }

    public function rincipesanan($id_transaksi)
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $this->db->where('id_transaksi', $id_transaksi);
        //$this->db->where('id_user', $this->session->userdata('id_user')); 
        return $this->db->get()->row();
  
    }

    public function rincitoko($id)
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->where('id_user', $id); 
        return $this->db->get()->row();
    }

    public function rinciorder($no_order)
    {
        $this->db->select('*');
        $this->db->from('tb_rinci_transaksi');
        //$this->db->join('tb_transaksi', 'tb_transaksi.no_order = tb_rinci_transaksi.no_order', 'left');
        $this->db->join('tb_barang', 'tb_barang.id_barang = tb_rinci_transaksi.id_barang', 'left');
        $this->db->where($no_order); 
        $this->db->order_by('id_rinci', 'desc');
        return $this->db->get()->result();
    }


    public function update_order($data)
    {
        $this->db->where('id_transaksi', $data['id_transaksi']);
        $this->db->update('tb_transaksi', $data);
    }

    public function pesanan_diproses()
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $this->db->where('status_order=1');
        $this->db->where('id_user', $this->session->userdata('id_user')); 
        
        //$this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan')); 
        $this->db->order_by('id_transaksi', 'desc');
        return $this->db->get()->result();
  
    }

    public function pesanan_dikirim()
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $this->db->where('status_order=2');
        $this->db->where('id_user', $this->session->userdata('id_user')); 
        
        //$this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan')); 
        $this->db->order_by('id_transaksi', 'desc');
        return $this->db->get()->result();
  
    }

    public function pesanan_selesai()
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $this->db->where('status_order=3');
        $this->db->where('id_user', $this->session->userdata('id_user')); 
        
        //$this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan')); 
        $this->db->order_by('id_transaksi', 'desc');
        return $this->db->get()->result();
  
    }


}

/* End of file M_pesananmasuk.php */
