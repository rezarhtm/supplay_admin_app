<?php

class VendorModel extends CI_Model {
    public function get() {
        $this->load->database();
        return $this->db->get('vendors')->result();
    }
    public function detail($id) {
        $this->load->database();
        $this->db->where('vendor_id',$id);
        return $this->db->get('vendors')->result();
    }
    public function insert($data = array()) {
        $this->load->database();
        return $this->db->insert('vendors', $data);
    }
    public function getInfo($field, $value){
        $this->load->database();
        $this->db->where($field, $value);
        $query = $this->db->get('vendors');
        return $query->row_array();
    }
    public function update($id, $new) {
        $this->db->where("vendor_id", $id);
        $this-> db ->update("vendors", $new);
        return $this->db->affected_rows();
    }
    /*
    public function selectByName($name){
        $query =$this->db->get_where('vendor',array('v_name'=>$name));
        return $query->result_array();
    }
    */
}

?>