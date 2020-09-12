<?php

class Test extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(['auth']);
		$this->load->model('horeka/CreditScoreModel');
		$this->load->model('horeka/TransactionModel');
	}

	public function index(){
		print_r($this->TransactionModel->getPendingTransactions());
	}
}
