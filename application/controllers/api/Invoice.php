<?php

class Invoice extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(['auth']);

		// Check Login
		$this->auth->authenticate();

		$this->load->model("horeka/InvoiceModel");
	}

	public function detail($id){
		echo json_encode($this->InvoiceModel->find($id));
	}
}
