<?php

class TransactionModel extends CI_Model
{
	var $table = 'transactions'; //nama tabel dari database
	var $column_order = array(null, 'transactions.id', 'horeka.horeka_id', 'transactions.total_order', 'transactions.order_status');
	var $column_search = array('transactions.id', 'horeka.horeka_id'); //field yang diizin untuk pencarian 
	var $order = array('transactions.created_at' => 'DESC'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(['auth']);

		$this->load->model('VendorModel');
		$this->load->model('HorekaModel');

		$this->db->query('SET SESSION sql_mode = ""');

		if (check()) {
			if ($this->auth->hasRole('vendor')) {
				$this->column_order = array(null, 'transactions.id', 'horeka.horeka_id', 'transactions.total_order', 'transactions.order_status');
				$this->column_search = array('transactions.id', 'horeka.horeka_id'); //field yang diizin untuk pencarian 
				$this->order = array('transactions.created_at' => 'DESC'); // default order 
			} else if ($this->auth->hasRole('horeka')) {
				$this->column_order = array('id', 'total_order', 'order_status', null);
				$this->column_search = array('id', 'total_order'); //field yang diizin untuk pencarian 
				$this->order = array('transactions.created_at' => 'DESC'); // default order 
			}
		}
	}

	public function find($id)
	{
		$this->db->where('id', $id);
		$this->db->from($this->table);
		$query = $this->db->get()->row();

		return $query;
	}

	public function insert($data)
	{
		unset($data->id);
		$horeka_id = $this->HorekaModel->getInfo("h_username", $this->auth->userName);
		$data->id = "83" . substr($horeka_id['horeka_id'], -3) . rand(100, 999);
		return $this->db->insert($this->table, $data);
	}

	public function update($id, $new)
	{
		$this->db->where("id", $id);
		$this->db->update("transactions", $new);

		return $this->db->affected_rows();
	}

	public function getTransactionStatus($id)
	{
		$this->db->where('id', $id);
		$this->db->from($this->table);
		$query = $this->db->get()->row();

		return $query->order_status;
	}

	public function getPendingTransactions()
	{
		$from_date = date("Y-m", strtotime("-1 months")) . "-29";
		$to_date = date("Y-m") . "-28";

		$this->db->where('invoice_number', null);
		$this->db->where('created_at >=', $from_date);
		$this->db->where('created_at <=', $to_date);
		$this->db->group_by('user_id');

		$data = $this->db->get($this->table)->result_array();

		foreach ($data as $key => $each) {
			$data['transactions'][$each['user_id']]   = $this->db->where('user_id', $each['user_id'])->get($this->table)->result_array();
		}

		return $data['transactions'];
	}

	public function orders($id)
	{
		$transaction_status = $this->getTransactionStatus($id);

		if ($this->auth->hasRole('vendor')) {
			return $this->db
				->join('products', 'products.product_id = orders.product_id')
				->join('transactions', 'transactions.id = orders.transaction_id')
				->select('products.product_name')
				->select('orders.product_price')
				->select('orders.qty')

				->select('transactions.id as transaction_id')
				->select('transactions.total_order')
				->where('transactions.id', $id)
				->from('orders')
				->get()
				->result();
		} else if ($this->auth->hasRole('horeka')) {
			// if ($transaction_status == 'RETURN') {
			// 	$this->db->where('orders.jumlah_diretur > 0');
			// }

			return $this->db
				->join('products', 'products.product_id = orders.product_id')
				->join('transactions', 'transactions.id = orders.transaction_id')

				->select('products.product_name')
				->select('products.unit')

				->select('orders.id as order_id')
				->select('orders.product_price')
				->select('orders.order_price')
				->select('orders.qty')
				->select('orders.jumlah_diretur')
				->select('orders.jumlah_diterima')

				->select('transactions.id as transaction_id')
				->where('transactions.id', $id)
				->from('orders')
				->get()
				->result();
		}
	}

	private function _get_datatables_query($status = null)
	{
		if ($this->auth->hasRole('vendor')) {
			$vendor = $this->VendorModel->getInfo('v_username', $this->auth->userName);

			$this->db->join('orders', 'orders.transaction_id = transactions.id');
			$this->db->join('products', 'products.product_id = orders.product_id');
			$this->db->join('vendors', 'vendors.vendor_id = products.vendor_id');
			$this->db->join('users', 'users.id = transactions.user_id');
			$this->db->join('horeka', 'horeka.h_username = users.username');

			$this->db->where('vendors.vendor_id', $vendor['vendor_id']);

			if ($status) {
				$this->db->where('transactions.order_status', $status);
			}

			$this->db->select('transactions.order_status');
			$this->db->select('horeka.horeka_id as horeka_username');
			$this->db->select('transactions.total_order as total_order');
			$this->db->select('transactions.id as transaction_id');

			$this->db->group_by('transactions.id');
		} else if ($this->auth->hasRole('horeka')) {
			$this->db->where('user_id', $this->auth->userID);
		}

		$this->db->from($this->table);
		$i = 0;
		foreach ($this->column_search as $item) // looping awal
		{
			if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
			{
				if ($i === 0) // looping awal
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if (count($this->column_search) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}

		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables($status = null)
	{
		$this->_get_datatables_query($status);
		if ($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function count_new_order()
	{
		$vendor = $this->VendorModel->getInfo('v_username', $this->auth->userName);

		return $this->db->from($this->table)
			->where('vendor_id', $vendor['vendor_id'])
			->where('order_status', 'PENDING')->count_all_results();
	}
}
