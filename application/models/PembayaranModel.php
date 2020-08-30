<?php

class PembayaranModel extends CI_Model {
	public function insert($data = []) {
        $this->load->database();
        return $this->db->insert('permohonan_pembayaran', $data);
    }
}

?>