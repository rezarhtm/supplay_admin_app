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

        $this->load->model('ProductModel');

        $this->load->model('horeka/ShoppingList');
        $this->load->model('horeka/ShoppingProductsList');
        $this->load->model('horeka/CartModel');
    }

    public function index()
    {
        if ($this->input->method() == "post") {
            if ($this->input->post('status')) {
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

            if ($this->input->post('add_to')) {
                $product_qty = $this->ProductModel->getInfo('product_id', $this->input->post('buy_product_id'))['qty'];


                switch ($this->input->post('add_to')) {
                    case "list":
                        $data = [
                            'shopping_list_id' => $this->input->post('add_to_list_id'),
                            'product_id' => $this->input->post('buy_product_id'),
                            'qty' => $this->input->post('buy_qty')
                        ];

                        if ($product_qty >= $data['qty']) {
                            if ($this->ShoppingProductsList->insert($data)) {
                                $data["status"] = "success";
                                $data["message"] = "ditambahkan ke shopping list " . $this->ShoppingList->find($this->input->post('add_to_list_id'))['name'];
                            } else {
                                $data["status"] = "danger";
                                $data["message"] = "gagal";
                            }
                        } else {
                            $data["status"] = "danger";
                            $data["message"] = "stok tidak mencukupi";
                        }

                        break;
                    case "cart":
                        $data = [
                            'user_id' => $this->auth->userID,
                            'product_id' => $this->input->post('buy_product_id'),
                            'qty' => $this->input->post('buy_qty')
                        ];

                        $cart = $this->CartModel->find($data['product_id']);
                        $cart_count = $this->CartModel->count($data['product_id']);

                        if ($cart_count > 0) {
                            $product_id = $data['product_id'];

                            $data = [
                                'qty' => $cart['qty'] + $this->input->post('buy_qty')
                            ];

                            if ($product_qty >= $data['qty']) {
                                if ($this->CartModel->update($product_id, $data)) {
                                    $data["status"] = "success";
                                    $data["message"] = "cart updated";
                                } else {
                                    $data["status"] = "danger";
                                    $data["message"] = "cart lost";
                                }
                            } else {
                                $data["status"] = "danger";
                                $data["message"] = "stok tidak mencukupi";
                            }
                        } else {
                            if ($this->CartModel->insert($data)) {
                                $data["status"] = "success";
                                $data["message"] = "cart added";
                            } else {
                                $data["status"] = "danger";
                                $data["message"] = "cart lost";
                            }
                        }

                        break;
                    default:
                        break;
                }
            }
        }

        $data['shopping_list'] = $this->ShoppingList->get();

        $this->load->view('template/horeka/header');
        $this->load->view('horeka/home', $data);
        $this->load->view('template/horeka/footer');
    }
}
