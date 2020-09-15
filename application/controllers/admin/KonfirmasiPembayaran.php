<?php
class KonfirmasiPembayaran extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(['auth']);

		// Check Login & Role untuk Admin
		$this->auth->authenticate();
		$this->auth->isRoles(["admin"]);

		$this->load->model('horeka/KonfirmasiPembayaranModel');
	}

	public function index()
	{
		if ($this->input->method() == "post") {
			if ($this->input->post('submit') == 'paid') {
				$this->KonfirmasiPembayaranModel->update($this->input->post('invoice_number'), [
					"status" => "PAID"
				]);
			}else{
				$this->KonfirmasiPembayaranModel->update($this->input->post('invoice_number'), [
					"status" => "UNPAID"
				]);
			}
		}

		$data['konfirmasi_pembayaran'] = $this->KonfirmasiPembayaranModel->get();

		$this->load->view("template/admin/header");
		$this->load->view("admin/konfirmasi_pembayaran/viewall", $data);
		$this->load->view("template/admin/footer");
	}

	public function detail($invoice)
	{
		$data['detail'] = $this->KonfirmasiPembayaranModel->find($invoice);

		$this->load->view("template/admin/header");
		$this->load->view("admin/konfirmasi_pembayaran/viewthis", $data);
		$this->load->view("template/admin/footer");
	}
}
