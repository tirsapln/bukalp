<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_gambarbarang extends CI_Model {

    public function list()
    {
        $this->db->select('tb_barang.*,COUNT(tb_gambar.id_barang) as total_gambar');
        $this->db->from('tb_barang');
        $this->db->join('tb_gambar', 'tb_gambar.id_barang = tb_barang.id_barang', 'left');
        $this->db->group_by('tb_barang.id_barang');
        $this->db->where('id_user', $this->session->userdata('id_user'));
        $this->db->order_by('tb_barang.id_barang', 'desc');
        return $this->db->get()->result();
  
    }
    public function listsuperadmin()
    {
        $this->db->select('tb_barang.*,COUNT(tb_gambar.id_barang) as total_gambar');
        $this->db->from('tb_barang');
        $this->db->join('tb_gambar', 'tb_gambar.id_barang = tb_barang.id_barang', 'left');
        $this->db->group_by('tb_barang.id_barang');
        $this->db->order_by('tb_barang.id_barang', 'desc');
        return $this->db->get()->result();
  
    }

    public function panggildata($id_gambar)
    {
        $this->db->select('*');
        $this->db->from('tb_gambar');
        $this->db->where('id_gambar', $id_gambar);
        return $this->db->get()->row();
  
    }

    public function panggilgambar($id_barang)
    {
        $this->db->select('*');
        $this->db->from('tb_gambar');
        $this->db->where('id_barang', $id_barang);
        return $this->db->get()->result();
        

        
    }
    public function add($data){
        $this->db->insert('tb_gambar', $data);
        
    }

    public function hapus($data){
        $this->db->where('id_gambar', $data['id_gambar']);
        $this->db->delete('tb_gambar', $data);
        

    }
}