<?php

class HorekaModel extends CI_Model {
    public function get() {
        $this->load->database();
        return $this->db->get('horeka')->result();
    }
    public function detail($id) {
        $this->load->database();
        $this->db->where('horeka_id',$id);
        return $this->db->get('horeka')->result();
    }
    public function insert($data = array()) {
        $this->load->database();
        return $this->db->insert('horeka', $data);
    }
    public function getInfo($field, $value){
        $this->load->database();
        $this->db->where($field, $value);
        $query = $this->db->get('horeka');
        return $query->row_array();
    }
    public function update($id, $new) {
        $this->db->where("horeka_id", $id);
        $this-> db ->update("horeka", $new);
        return $this->db->affected_rows();
	}
	public function getHorekaFromTransaction($id){
		return $this->db
			->join('users', 'users.id = transactions.user_id')
			->join('horeka', 'horeka.h_username = users.username')
			->where('transactions.id', $id)
			->from('transactions')
			->get()
			->row_array();
	}
}
