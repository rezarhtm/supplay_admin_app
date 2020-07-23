<?php

    class category_entry extends CI_Model {
        public function get() {
            $this -> load -> database();
            $this -> db -> order_by("category_id");
            $this -> db -> limit(15);
            return $this -> db -> get("category")->result();
        }
        public function insert($data = array()) {
            $this -> load -> database();
            return $this -> db -> insert("category", $data);
        }
        public function getList() {
            $this -> load -> database();
            $this -> db -> order_by("category_id");
            return $this -> db -> get("category")->result();
        }
        public function detail($category_id) {
            $this -> load -> database();
            $this -> db -> where("category_id", $category_id);
            $this -> db -> limit(10);
            return $this -> db -> get("category")->result();
        }
        public function update($id, $new) {
            $this->db->where("category_id", $id);
            $this-> db ->update("category", $new);
            return $this->db->affected_rows();
        }
        public function getInfo($field, $value){
            $this->load->database();
            $this->db->where($field, $value);
            $query = $this->db->get('category');
            return $query->row_array();
        }

    }

?>