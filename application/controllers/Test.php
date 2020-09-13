<?php

class Test extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(['auth']);
		$this->load->model('TransactionModel');
	}

	public function index(){
		$data = $this->TransactionModel->getPendingTransactions();
		echo json_encode($data);
	}
}
