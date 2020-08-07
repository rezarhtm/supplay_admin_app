<?php

class Home extends CI_Controller{
	public function __construct()
    {
        parent::__construct();
        $this->load->library(['auth']);

        // Check Login & Role untuk Horeka
        $this->auth->authenticate();
		$this->auth->isRoles("horeka");
	}
	
    public function index(){
		$this->load->view('template/horeka/header');
		$this->load->view('horeka/home');
		$this->load->view('template/horeka/footer');
	}
}

?>