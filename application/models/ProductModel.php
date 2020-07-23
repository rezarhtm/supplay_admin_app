<?php

class ProductModel extends CI_Model {
    public function get() {
        $this->load->database();
        return $this->db->get('products')->result();
    }
    public function detail($id) {
        $this->load->database();
        $this->db->where('product_id',$id);
        return $this->db->get('products')->result();
    }
    public function insert($data = array()) {
        $this->load->database();
        return $this->db->insert('products', $data);
    }
    public function getInfo($field, $value){
        $this->load->database();
        $this->db->where($field, $value);
        $query = $this->db->get('products');
        return $query->row_array();
    }
    public function update($id, $new) {
        $this->db->where("product_id", $id);
        $this-> db ->update("products", $new);
        return $this->db->affected_rows();
    }
    function getCategory()
    {
        $this->load->database();
        $result = $this->db->get('category');
        $dd[''] = 'Please Select';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
                $dd[$row->category_id] = $row->category_desc;
            }
        }
        return $dd;
    }
    function getVendor()
    {
        $this->load->database();
        $resvendor = $this->db->get('vendors');
        $sel = 'Please Select';
        if ($resvendor->num_rows() > 0) {
            foreach ($resvendor->result() as $row){
                $sel[$row->vendor_id] = $row->v_name;
            }
        }
        return $sel;
    }
}

?>