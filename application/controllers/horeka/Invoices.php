<?php

class Invoices extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library(['auth']);

		// Check Login & Role untuk Horeka
		$this->auth->authenticate();
		$this->auth->isRoles(["horeka"]);

		$this->load->model('horeka/InvoiceModel');
		$this->load->model('horeka/KonfirmasiPembayaranModel');
	}

	public function index()
	{
		$data['invoices'] = $this->InvoiceModel->get();

		$this->load->view('template/horeka/header');
		$this->load->view('horeka/invoices', $data);
		$this->load->view('template/horeka/footer');
	}

	public function cara_pembayaran()
	{
		$this->load->view('template/horeka/header');
		$this->load->view('horeka/cara-pembayaran');
		$this->load->view('template/horeka/footer');
	}

	public function konfirmasi_pembayaran()
	{
		$data = [];

		if ($this->input->method() == "post") {
			if ($this->input->post('konfirmasi') && $this->input->post('id')) {
				$config['upload_path']          = './uploads/bukti_pembayaran';
				$config['allowed_types']        = 'gif|jpg|png';
				$config['max_size']             = 10240;
				$config['file_name']			= $this->input->post('id');

				$this->load->library('upload', $config);

				$dname = explode(".", $_FILES['bukti']['name']);

				$invoice_number = $this->input->post('invoice');

				$insert = $this->KonfirmasiPembayaranModel->insert([
					"id" => $this->input->post('id'),
					"invoice_number" => $invoice_number,
					"jumlah_transfer" => $this->input->post('jumlah'),
					"bank_tujuan" => $this->input->post('bank'),
					"bukti_pembayaran" => $config['file_name'] . '.' . end($dname)
				]);

				$update_invoice = $this->InvoiceModel->update($invoice_number, [
					"status" => "UNPAID"
				]);

				if ($this->upload->do_upload('bukti') && $insert && $update_invoice) {
					$message = "Konfirmasi Pembayaran sukses";
					$data["status"] = "success";
				} else {
					$message = $this->upload->display_errors();
					$data["status"] = "danger";
				}

				$data["message"] = $message;
			}
		}

		$this->load->view('template/horeka/header');
		$this->load->view('horeka/konfirmasi-pembayaran', $data);
		$this->load->view('template/horeka/footer');
	}
}
