<?php
class TransactionModel extends CI_Model
{
	var $table = "transactions";

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function insert($data)
	{
		return $this->db->insert($this->table, $data);
	}

	public function update($id, $data = [])
	{
		$this->db->where("id", $id)
			->where("user_id", $this->auth->userID)
			->update($this->table, $data);

		return $this->db->affected_rows();
	}
}
