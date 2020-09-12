<?php

class Transactions extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(['auth']);

		// Check Login & Role untuk Horeka
		$this->auth->authenticate();
		$this->auth->isRoles(["horeka"]);

		$this->load->model('TransactionModel');
		$this->load->model('OrderModel');
		$this->load->model('horeka/RatingModel');
		$this->load->model('VendorModel');
	}

	public function index()
	{
		$this->load->view('template/horeka/header');
		$this->load->view('horeka/transactions');
		$this->load->view('template/horeka/footer');
	}

	public function action($id)
	{
		if ($this->input->method() == "post") {
			$checked_product = $this->input->post('checked_product');
			$diterima = $this->input->post('diterima');
			$diretur = $this->input->post('diretur');

			$transaction_id = $this->input->post('transaction_id');

			if ($this->input->post('submit_transaction')) {
				$total_retur = 0;

				foreach ($checked_product as $key => $product) {
					$this->OrderModel->update($product, [
						'jumlah_diterima' => $diterima[$key],
						'jumlah_diretur' => $diretur[$key],
					]);

					$total_retur += $diretur[$key];
				}

				if ($total_retur > 0) {
					if (
						$this->TransactionModel->update($transaction_id, [
							'order_status' => 'RETURN'
						])
					) {
						$data["status"] = "success";
						$data["message"] = "Order direturn";
					} else {
						$data["status"] = "error";
						$data["message"] = "Konfirmasi Order gagal";
					}
				} else {
					if (
						$this->TransactionModel->update($transaction_id, [
							'order_status' => 'COMPLETE'
						])
					) {
						$data["status"] = "success";
						$data["message"] = "Order selesai";

						return redirect('horeka/transactions/rate/' . $transaction_id);
					} else {
						$data["status"] = "error";
						$data["message"] = "Konfirmasi Order gagal";
					}
				}
			}
		}

		$data = [];

		// if ($this->TransactionModel->getTransactionStatus($id) == 'ON PROCESS' || $this->TransactionModel->getTransactionStatus($id) == 'RETURN') {
			$data['orders'] = $this->TransactionModel->orders($id);
			$data['transaction_status'] = $this->TransactionModel->getTransactionStatus($id);
		// } else {
			// return redirect('horeka/transactions');
		// }

		$this->load->view('template/horeka/header');
		$this->load->view('horeka/transactions/action', $data);
		$this->load->view('template/horeka/footer');
	}

	public function rate($transaction_id)
	{
		if ($this->input->method() == "post") {
			if ($this->input->post('submit_rating')) {
				$tr_id = $this->input->post('transaction_id');
				$rate = $this->input->post('rate');
				$komentar = $this->input->post('komentar');

				$vendor_id = $this->TransactionModel->find($tr_id)->vendor_id;

				if ($this->RatingModel->insert([
					'transaction_id' => $tr_id,
					'vendor_id' => $vendor_id,
					'nilai' => $rate,
					'komentar' => $komentar
				])) {
					$count_rate = $this->RatingModel->totalVendorRating($vendor_id);

					if ($this->VendorModel->update($vendor_id, ['rating' => $count_rate])) {
						$data["status"] = "success";
						$data["message"] = "Berhasil memberi penilaian";
					} else {
						$data["status"] = "error";
						$data["message"] = "Penilaian gagal";
					}
				} else {
					$data["status"] = "error";
					$data["message"] = "Penilaian gagal";
				}
			}
		}

		if ($this->TransactionModel->getTransactionStatus($transaction_id) != 'ON PROCESS' && $this->TransactionModel->getTransactionStatus($transaction_id) != 'REJECTED') {
			$data['transaction_id'] = $transaction_id;
			$data['transaction'] = $this->RatingModel->findTransaction($transaction_id);
		} else {
			return redirect('horeka/transactions');
		}

		$this->load->view('template/horeka/header');
		$this->load->view('horeka/transactions/rate', $data);
		$this->load->view('template/horeka/footer');
	}
}
