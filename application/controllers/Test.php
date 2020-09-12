<?php

class Test extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(['auth']);
		$this->load->model('horeka/CreditScoreModel');
	}

	public function index(){
		echo $this->CreditScoreModel->count();
		echo $this->CreditScoreModel->getCreditScore();
	}
}
