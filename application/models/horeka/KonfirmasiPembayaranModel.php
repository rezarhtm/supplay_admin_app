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
}
