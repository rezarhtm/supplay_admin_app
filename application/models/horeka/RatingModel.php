<?php
class RatingModel extends CI_Model
{
	var $table = "rating";

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function insert($data){
		return $this->db->insert($this->table, $data);
	}

	public function findTransaction($id){
		$this->db->where('transaction_id', $id);
		$this->db->from($this->table);
		return $this->db->get()->result();
	}

	public function totalVendorRating($vendor_id){
		$this->db->where('vendor_id', $vendor_id);
		$this->db->from($this->table);
		$vendor = $this->db->get()->result();

		$sum = 0;

		foreach($vendor as $each_vendor){
			$sum += $each_vendor->nilai;
		}

		return $sum / count($vendor);
	}
}
