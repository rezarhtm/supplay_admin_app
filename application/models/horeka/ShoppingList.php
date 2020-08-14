<?php 
	class ShoppingList extends CI_Model {
		var $table = "shopping_list";

		public function __construct(){
			parent::__construct();
			$this->load->database();
		}

		public function get(){
			return $this->db->get($this->table)->result();
		}

		public function create($data = []){
        	return $this->db->insert($this->table, $data);
		}

		public function update($id, $data = []){
			$this->db->where("id", $id);
			$this->db->update($this->table, $data);
			return $this->db->affected_rows();
		}

		public function delete($data){
			return $this->db->delete($this->table, $data);
		}
	}
