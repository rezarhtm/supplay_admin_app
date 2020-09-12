<?php 
	class CartModel extends CI_Model {
		var $table = "carts";

		public function __construct(){
			parent::__construct();
			$this->load->database();
		}

		public function get(){
			return $this->db->select('products.*, carts.qty AS cart_qty')
			->where('carts.user_id', $this->auth->userID)
			->from($this->table)
			->join('products', 'products.product_id = carts.product_id')
			->get()->result();
		}

		public function find($product_id){
			return $this->db
			->from($this->table)
			->where('product_id', $product_id)
			->where('user_id', $this->auth->userID)
			->get()->row_array();
		}

		public function count($product_id){
			return $this->db
			->from($this->table)
			->where('product_id', $product_id)
			->where('user_id', $this->auth->userID)
			->count_all_results();
		}

		public function count_cart(){
			return $this->db
			->from($this->table)
			->where('user_id', $this->auth->userID)
			->count_all_results();
		}

		public function getOne(){
			return $this->db->where('user_id', $this->auth->userID)
			->from($this->table)
			->get()->result();
		}

		public function insert($data = []){
        	return $this->db->insert($this->table, $data);
		}

		public function update($product_id, $data = []){
			$this->db->where("product_id", $product_id)
			->where("user_id", $this->auth->userID)
			->update($this->table, $data);

			return $this->db->affected_rows();
		}

		public function delete($data){
			return $this->db->where("user_id", $this->auth->userID)
			->delete($this->table, $data);
		}
	}
