<?php

class TransactionModel extends CI_Model
{
	var $table = 'transactions'; //nama tabel dari database
	var $column_order = array('transaction_id', 'horeka_username', 'total_order', 'order_status');
	var $column_search = array('products.product_id', 'products.product_name'); //field yang diizin untuk pencarian 
	var $order = array('transactions.created_at' => 'DESC'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();

		$this->load->model('VendorModel');

		$this->db->query('SET SESSION sql_mode = ""');
	}

	public function get()
	{
		return $this->db->from('products')->order_by('created_at', 'DESC')->get()->result();
	}
	
	public function update($id, $new)
    {
        $this->db->where("id", $id);
		$this->db->update("transactions", $new);
		
        return $this->db->affected_rows();
    }

	public function detail($id)
	{
		$this->db->where('products.product_id', $id);
		return $this->db
			// ->select('products.*, category.category_desc')
			->from('products')
			->join('category', 'category.category_id = products.category_id')
			->get()
			->result();
	}

	private function _get_datatables_query($status = null)
	{
		$vendor = $this->VendorModel->getInfo('v_username', $this->auth->userName);

		$this->db->join('orders', 'orders.transaction_id = transactions.id');
		$this->db->join('products', 'products.product_id = orders.product_id');
		$this->db->join('vendors', 'vendors.vendor_id = products.vendor_id');
		$this->db->join('users', 'users.id = transactions.user_id');
		$this->db->join('horeka', 'horeka.h_username = users.username');

		$this->db->where('vendors.vendor_id', $vendor['vendor_id']);

		if($status){
			$this->db->where('transactions.order_status', $status);
		}

		$this->db->select('transactions.order_status');
		$this->db->select('horeka.h_username as horeka_username');
		$this->db->select('transactions.total_order as total_order');
		$this->db->select('transactions.id as transaction_id');

		$this->db->group_by('transactions.id');

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

	public function count_new_order(){
		return $this->db->from($this->table)->where('order_status', 'PENDING')->count_all_results();
	}
}
