<?php
class InvoiceModel extends CI_Model
{
	var $table = "invoices";

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get(){
		$this->db->where('user_id', $this->auth->userID);
		return $this->db->get($this->table)->result();
	}

	public function find($id){
		$this->db->where('invoice_number', $id);
		return $this->db->get($this->table)->row_array();
	}

	public function insert($data){
		return $this->db->insert($this->table, $data);
	}

	public function update($id, $data = []){
		$this->db->where("invoice_number", $id);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
}
