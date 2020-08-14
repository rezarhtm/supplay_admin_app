<?php 
	class ShoppingList extends CI_Model {
		var $table = "shopping_list";

		public function __construct(){
			parent::__construct();
			$this->load->database();
		}

		public function get(){
			$this->db->where('user_id', $this->auth->userID);
			return $this->db->get($this->table)->result();
		}

		public function find($id){
			return $this->db
			->from($this->table)
			->where('id', $id)
			->where('user_id', $this->auth->userID)
			->get()->row_array();
		}

		public function create($data = []){
        	return $this->db->insert($this->table, $data);
		}

		public function update($id, $data = []){
			$this->db->where("id", $id);
			$this->db->where('user_id', $this->auth->userID);
			$this->db->update($this->table, $data);
			return $this->db->affected_rows();
		}

		public function delete($data){
			return $this->db
			->where('user_id', $this->auth->userID)
			->delete($this->table, $data);
		}
	}
