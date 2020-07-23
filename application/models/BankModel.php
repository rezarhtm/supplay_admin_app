<?php

class BankModel extends CI_Model{
    public function get() {
        $this->load->database();
        return $this->db->get('bank')->result();
    }

    public function insert($data = array()) {
        $this->load->database();
        return $this->db->insert('bank', $data);
    }
    public function getInfo($field, $value){
        $this->load->database();
        $this->db->where($field, $value);
        $query = $this->db->get('bank');
        return $query->row_array();
    }
    public function update($id, $new) {
        $this->db->where("bank_id", $id);
        $this-> db ->update("bank", $new);
        return $this->db->affected_rows();
    }
}

?>