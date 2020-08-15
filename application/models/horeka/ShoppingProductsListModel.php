<?php 
	class ShoppingProductsListModel extends CI_Model {
		var $table = "shopping_products_list";

		public function __construct(){
			parent::__construct();
			$this->load->database();
		}

		// public function get(){
		// 	$this->db->where('user_id', $this->auth->userID);
		// 	return $this->db->get($this->table)->result();
		// }

		public function find($shopping_list_id){
			return $this->db
			->select('products.*, shopping_products_list.qty AS products_list_qty, shopping_list.name AS shopping_list_name')
			->from($this->table)
			->where('shopping_list_id', $shopping_list_id)
			->join('products', 'products.product_id = shopping_products_list.product_id')
			->join('shopping_list', 'shopping_list.id = shopping_products_list.shopping_list_id')
			->get()->result();
		}

		public function findProduct($shopping_list_id, $product_id){
			return $this->db
			->from($this->table)
			->where('shopping_list_id', $shopping_list_id)
			->where('product_id', $product_id)
			->get()->row_array();
		}

		public function count($shopping_list_id, $product_id){
			return $this->db
			->from($this->table)
			->where('shopping_list_id', $shopping_list_id)
			->where('product_id', $product_id)
			->count_all_results();
		}

		public function insert($data = []){
        	return $this->db->insert($this->table, $data);
		}

		public function update($shopping_list_id, $product_id, $data = []){
			$this->db->where("shopping_list_id", $shopping_list_id)
			->where("product_id", $product_id)
			->update($this->table, $data);

			return $this->db->affected_rows();
		}

		public function delete($data){
			return $this->db->delete($this->table, $data);
		}
	}
