<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {

    public function totalbarang()
    {
        return $this->db->get('tb_barang')->num_rows();
        
    }

    public function totalbarang_admin()
    {
        $this->db->select('tb_barang.*, count(id_user) as total');
        $this->db->from('tb_barang');
        $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_barang.id_kategori', 'left');
        $this->db->where('id_user', $this->session->userdata('id_user')); 
        $this->db->order_by('id_barang', 'desc');
        return $this->db->get()->result();
  
    }

    public function totalpm()
    {
        $this->db->select('tb_transaksi.*, count(status_order) as total');
        $this->db->from('tb_transaksi');
        $this->db->where('status_order=0');
        //$this->db->where('status_bayar=0');
        $this->db->order_by('id_transaksi', 'desc');
        return $this->db->get()->result();
        
    }

    public function totalpm_admin()
    {
        $this->db->select('tb_transaksi.*, count(id_user) as total');
        $this->db->from('tb_transaksi');
        $this->db->where('status_order=0');
        //$this->db->where('status_bayar=0');
        $this->db->where('id_user', $this->session->userdata('id_user')); 
        $this->db->order_by('id_transaksi', 'desc');
        return $this->db->get()->result();
  
        
    }

    public function totalkategori()
    {
        return $this->db->get('tb_kategori')->num_rows();
        
    }
    public function totalpelanggan()
    {
        return $this->db->get('tb_pelanggan')->num_rows();
        
    }

    public function data_setting($id_user)
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->where('id_user', $id_user);
        return $this->db->get()->row(); 
        
    }

    public function data_set()
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->where('id_user', 2);
        return $this->db->get()->row(); 
        
    }
    public function update($data)
    {
        $this->db->where('id_user', $data['id_user']);
        $this->db->update('tb_user', $data);
        
        
    }

    // QNA
    public function qna()
    {
        $this->db->select('*');
        $this->db->from('tb_qna');
        $this->db->order_by('id_qna', 'desc');
        return $this->db->get()->result();
  
    }

    public function editqna($data){
        $this->db->where('id_qna', $data['id_qna']);
        $this->db->update('tb_qna', $data);
        
        
        
    }

    public function hapusqna($data){
        $this->db->where('id_qna', $data['id_qna']);
        $this->db->delete('tb_qna', $data);
        
        
        
    }

    //PENGADUAN
    public function pengaduan()
    {
        $this->db->select('*');
        $this->db->from('tb_pengaduan');
        $this->db->order_by('id_pengaduan', 'desc');
        return $this->db->get()->result();
  
    }

    public function hapuspengaduan($data){
        $this->db->where('id_pengaduan', $data['id_pengaduan']);
        $this->db->delete('tb_pengaduan', $data);
        
        
        
    }

    

    
    

}

/* End of file M_barang.php */
