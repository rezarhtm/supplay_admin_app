<?php 
	class CreditScoreModel extends CI_Model {
		public function __construct(){
			parent::__construct();
			$this->load->database();
		}

		public function find($product_id){
			return $this->db
			->from($this->table)
			->where('product_id', $product_id)
			->where('user_id', $this->auth->userID)
			->get()->row_array();
		}

		public function getCreditScore(){
			return $this->db
			->from("horeka")
			->where('h_username', $this->auth->userName)
			->get()->row_array()['credit_score'];
		}

		public function count(){
			return $this->db
			->from("invoices")
			->join('transactions', 'transactions.id = invoices.transaction_id')
			->where('invoices.status !=', 'PAID')
			->where('transactions.user_id', $this->auth->userID)
			->count_all_results();
		}
	}
