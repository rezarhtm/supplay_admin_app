<?php

class Home extends CI_Controller{
    public function index(){
        $this -> load -> view("template/admin/header");
        $this -> load -> view("admin/home");
        $this -> load -> view("template/admin/footer");
    }
}

?>