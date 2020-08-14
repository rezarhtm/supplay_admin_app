<?php

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['auth']);

        // Check Login & Role untuk Horeka
        $this->auth->authenticate();
        $this->auth->isRoles("horeka");

        $this->load->model('horeka/ShoppingList');
    }

    public function index()
    {
        if ($this->input->method() == "post") {
            switch ($this->input->post('status')) {
                case "create":
                    $data = [
                        'user_id' => $this->auth->userID,
                        'name' => $this->input->post('shopping_list')
                    ];

                    if ($this->ShoppingList->create($data)) {
                        $data["status"] = "success";
                        $data["message"] = "data added";
                    } else {
                        $data["status"] = "danger";
                        $data["message"] = "data lost";
                    }

                    break;
                case "update": 
                    $id = $this->input->post('shopping_list_id');
                    
                    $data = [
                        'name' => $this->input->post('shopping_list')
                    ];

                    if ($this->ShoppingList->update($id, $data)) {
                        $data["status"] = "success";
                        $data["message"] = "data updated";
                    } else {
                        $data["status"] = "danger";
                        $data["message"] = "data lost";
                    }
                    break;
                case "delete":
                    $data = [
                        'id' => $this->input->post('shopping_list_id')
                    ];

                    if ($this->ShoppingList->delete($data)) {
                        $data["status"] = "success";
                        $data["message"] = "data deleted";
                    } else {
                        $data["status"] = "danger";
                        $data["message"] = "data lost";
                    }
                default:
                    break;
            }
        }

        $data['shopping_list'] = $this->ShoppingList->get();

        $this->load->view('template/horeka/header');
        $this->load->view('horeka/home', $data);
        $this->load->view('template/horeka/footer');
    }
}
