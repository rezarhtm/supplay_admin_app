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
        $this->load->model('HorekaModel');

        $this->load->model('horeka/ShoppingListModel');
        $this->load->model('horeka/ShoppingProductsListModel');
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

                        if ($this->ShoppingListModel->create($data)) {
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

                        if ($this->ShoppingListModel->update($id, $data)) {
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

                        if ($this->ShoppingListModel->delete($data)) {
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
                        ];

                        $shopping_products_list_count = $this->ShoppingProductsListModel->count($data['shopping_list_id'], $data['product_id']);

                        if ($shopping_products_list_count > 0) {
                            $data["status"] = "success";
                            $data["message"] = "ditambahkan ke shopping list " . $this->ShoppingListModel->find($this->input->post('add_to_list_id'))['name'];
                        } else {
                            if ($this->ShoppingProductsListModel->insert($data)) {
                                $data["status"] = "success";
                                $data["message"] = "ditambahkan ke shopping list " . $this->ShoppingListModel->find($this->input->post('add_to_list_id'))['name'];
                            } else {
                                $data["status"] = "danger";
                                $data["message"] = "shopping list lost";
                            }
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

        $data['shopping_list'] = $this->ShoppingListModel->get();
        $data['data_horeka'] = $this->HorekaModel->getInfo("h_username", $this->auth->userName);

        $this->load->view('template/horeka/header');
        $this->load->view('horeka/home', $data);
        $this->load->view('template/horeka/footer');
    }
}
