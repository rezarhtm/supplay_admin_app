<?php
class OrderModel extends CI_Model
{
	var $table = "orders";

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function update($id, $new){
        $this->db->where("id", $id);
		$this->db->update($this->table, $new);
		
        return $this->db->affected_rows();
	}
}
