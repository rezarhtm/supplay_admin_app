<?php

class Invoices extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('horeka/InvoiceModel');
		$this->load->model('TransactionModel');
	}

	public function generate()
	{
		$transactions_ = $this->TransactionModel->getPendingTransactions();

		foreach ($transactions_ as $trkey => $transactions) {
			$invoice_number = 1 . date("ym") . rand(100, 999);
			
			$sum = 0;
			$transaction_id = null;

			foreach($transactions as $key => $transaction){
				$sum += $transaction['total_order'];
				if($key == 0){
					$transaction_id = $transaction['user_id'];
				}

				$this->TransactionModel->update($transaction['id'], [
					'invoice_number' => $invoice_number
				]);
			}

			$this->InvoiceModel->insert([
				"invoice_number" => $invoice_number,
				"user_id" => $transaction_id,
				"nominal" => $sum
			]);
		}
	}
}
