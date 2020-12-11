<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_kategori extends CI_Model {

    public function list()
    {
        $this->db->select('*');
        $this->db->from('tb_kategori');
        $this->db->order_by('id_kategori', 'asc');
        return $this->db->get()->result();
  
    }

    public function add($data){
        $this->db->insert('tb_kategori', $data);
        
    }

    public function edit($data){
        $this->db->where('id_kategori', $data['id_kategori']);
        $this->db->update('tb_kategori', $data);
 
        
    }

    public function hapus($data){
        $this->db->where('id_kategori', $data['id_kategori']);
        $this->db->delete('tb_kategori', $data);
        

    }

}

/* End of file M_kategori.php */
