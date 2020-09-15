<?php
class KonfirmasiPembayaranModel extends CI_Model
{
	var $table = "konfirmasi_pembayaran";

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function insert($data){
		return $this->db->insert($this->table, $data);
	}

	public function get(){
		$this->db->join('invoices', 'invoices.invoice_number = konfirmasi_pembayaran.invoice_number');
		return $this->db->get($this->table)->result();
	}

	public function find($id){
		$this->db->where('invoice_number', $id);
		return $this->db->get($this->table)->row_array();
	}

	public function update($invoice, $data = []){
		$this->db->where("invoice_number", $invoice);
		$this->db->update("invoices", $data);
		return $this->db->affected_rows();
	}
}
