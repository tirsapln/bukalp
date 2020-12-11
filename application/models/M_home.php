<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_home extends CI_Model {

    public function list()
    {
        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_barang.id_kategori', 'left');
        $this->db->join('tb_user', 'tb_user.id_user = tb_barang.id_user', 'left');
        $this->db->order_by('id_barang', 'asc');
        
        return $this->db->get()->result();
  
    }

    public function listkategori()
    {
        $this->db->select('*');
        $this->db->from('tb_kategori');
        $this->db->order_by('id_kategori', 'asc');
        return $this->db->get()->result();
  
    }

    public function kategori($id_kategori)
    {
        $this->db->select('*');
        $this->db->from('tb_kategori');
        $this->db->where('id_kategori', $id_kategori);
        
        return $this->db->get()->row();
    }

    public function listbarang($id_kategori)
    {
        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_barang.id_kategori', 'left');
        $this->db->join('tb_user', 'tb_user.id_user = tb_barang.id_user', 'left');
        $this->db->where('tb_barang.id_kategori', $id_kategori);
        
        return $this->db->get()->result();
  
    }

    public function detail_barang($id_barang)
    {
        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_barang.id_kategori', 'left');
        $this->db->join('tb_user', 'tb_user.id_user = tb_barang.id_user', 'left');
        $this->db->where('id_barang', $id_barang);
        return $this->db->get()->row();
    }

    public function gambar_barang($id_barang)
    {
        $this->db->select('*');
        $this->db->from('tb_gambar');
        $this->db->where('id_barang', $id_barang);
        return $this->db->get()->result();
    }

    public function qnaa()
    {
        $this->db->select('*');
        $this->db->from('tb_qna');
        $this->db->where('jawaban !=""');
        return $this->db->get()->result();
  
    }
    public function simpan_pertanyaan($data){
        $this->db->insert('tb_qna', $data);
        
    }

    public function pengaduanadd($data){
        $this->db->insert('tb_pengaduan', $data);
        
    }

    public function caridata($keyword){
        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_barang.id_kategori', 'left');
        $this->db->join('tb_user', 'tb_user.id_user = tb_barang.id_user', 'left');
        $this->db->order_by('id_barang', 'asc');
        $this->db->like('nama_barang', $keyword);
        $this->db->or_like('nama_kategori', $keyword);
        //$this->db->where('nama_kategori', $keyword);
        
        return $this->db->get()->result();
        
    }

    public function autocancle()
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $this->db->where('status_bayar=0 AND DATE_SUB(tgl_order, INTERVAL -1 DAY) <= now()');
       //$this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan')); 
        //$this->db->order_by('id_transaksi', 'desc');
        //SELECT tgl_order,DATE_SUB(tgl_order, INTERVAL -1 DAY) AS tgl_expire,now(),status_order FROM `tb_transaksi` WHERE status_order='0' AND DATE_SUB(tgl_order, INTERVAL -1 DAY) <= now()
        return $this->db->get()->result();

    }

    public function kadaluarsa($data)
    {
        $this->db->where('id_transaksi', $data['id_transaksi']);
        $this->db->update('tb_transaksi', $data);
    }
}