<?php

class Pembayaran extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(['auth']);

		// Check Login & Role untuk Horeka
		$this->auth->authenticate();
		$this->auth->isRoles(["vendor"]);

		$this->load->model('VendorModel');
		$this->load->model('PembayaranModel');
	}

	public function index()
	{
		$data['vendor'] = $this->VendorModel->getInfo('v_username', $this->auth->userName);

		if ($this->input->method() == "post") {
			if ($this->input->post('request')) {
				if ($this->input->post('request') > $data['vendor']['fund']) {
					$data['status'] = "danger";
					$data['message'] = "Fund tidak mencukupi";
				} else {
					$pembayaran = [
						"vendor_id" => $data['vendor']['vendor_id'],
						"fund_request" => $this->input->post('request')
					];

					if ($pembayaran['fund_request'] > 0) {
						$fund = $data['vendor']['fund'] - $pembayaran['fund_request'];

						if (
							$this->PembayaranModel->insert($pembayaran) &&
							$this->VendorModel->update($data['vendor']['vendor_id'], ['fund' => $fund])
						) {
							$data['status'] = "success";
							$data['message'] = "Permohonan Pembayaran berhasil di lakukan";
						} else {
							$data['status'] = "danger";
							$data['message'] = "Permohonan Pembayaran gagal di lakukan";
						}
					}else{
						$data['status'] = "danger";
						$data['message'] = "Permohonan Pembayaran gagal di lakukan";
					}
				}
			}
		}

		$data['vendor'] = $this->VendorModel->getInfo('v_username', $this->auth->userName);

		$this->load->view('template/vendor/header');
		$this->load->view('vendor/pembayaran', $data);
		$this->load->view('template/vendor/footer');
	}
}
