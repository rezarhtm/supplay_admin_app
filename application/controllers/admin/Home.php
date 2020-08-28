<?php

class Home extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['auth']);

        // Check Login & Role untuk Admin
        $this->auth->authenticate();
        $this->auth->isRoles(["admin"]);
    }
    
    public function index(){
        $this->load->view("template/admin/header");
        $this->load->view("admin/home");
        $this->load->view("template/admin/footer");
    }
}

?>