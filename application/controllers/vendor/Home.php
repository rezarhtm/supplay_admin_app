<?php

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['auth']);

        // Check Login & Role untuk Vendor
        $this->auth->authenticate();
        $this->auth->isRoles(["vendor"]);
    }

    public function index()
    {
        $this->load->view('template/vendor/header');
        $this->load->view('vendor/home');
        $this->load->view('template/vendor/footer');
    }
}