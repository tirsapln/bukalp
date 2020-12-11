<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

    public function list()
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->order_by('id_user', 'asc');
        return $this->db->get()->result();
  
    }

    public function add($data){
        $this->db->insert('tb_user', $data);
        
    }

    public function edit($data){
        $this->db->where('id_user', $data['id_user']);
        $this->db->update('tb_user', $data);
        
        
        
    }

    public function hapus($data){
        $this->db->where('id_user', $data['id_user']);
        $this->db->delete('tb_user', $data);
        
        
        
    }

}

/* End of file M_user.php */
