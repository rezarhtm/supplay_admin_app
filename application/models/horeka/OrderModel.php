<?php
class OrderModel extends CI_Model
{
	var $table = "orders";

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function insert($data){
		return $this->db->insert($this->table, $data);
	}
}
