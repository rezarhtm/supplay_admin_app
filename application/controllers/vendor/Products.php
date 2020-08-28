<?php

class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['auth']);

        // Check Login & Role untuk Horeka
        $this->auth->authenticate();
        $this->auth->isRoles(["vendor"]);

        $this->load->model('ProductModel');
    }

    public function index()
    {
        $data = [];
        if ($this->input->method() == "post") {
            if ($this->input->post('set_product') && $this->input->post('product_id')) {
                $product_id = $this->input->post('product_id');

                switch ($this->input->post('set_product')) {
                    case "active":
                        if($this->ProductModel->update($product_id, ["status_id" => 1])){
                            $data["status"] = "success";
                            $data["message"] = "data updated";
                        }else{
                            $data["status"] = "danger";
                            $data["message"] = "data lost";
                        }
                        break;
                    case "not_active":
                        if($this->ProductModel->update($product_id, ["status_id" => 0])){
                            $data["status"] = "success";
                            $data["message"] = "data updated";
                        }else{
                            $data["status"] = "danger";
                            $data["message"] = "data lost";
                        }
                        break;
                    default:
                        break;
                }
            }
        }

        $this->load->view('template/vendor/header');
        $this->load->view('vendor/products', $data);
        $this->load->view('template/vendor/footer');
    }
}
