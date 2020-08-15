<?php

class Cart extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(['auth']);

		// Check Login & Role untuk Horeka
		$this->auth->authenticate();
		$this->auth->isRoles("horeka");

		// $this->load->model('ProductModel');

		// $this->load->model('horeka/ShoppingListModel');
		// $this->load->model('horeka/ShoppingProductsListModel');
		$this->load->model('horeka/CartModel');
	}

	public function index()
	{
		if ($this->input->method() == "post") {
			if ($this->input->post('submit_cart')) {
				switch ($this->input->post('submit_cart')) {
					case "delete":
						$data = [
							'product_id' => $this->input->post('product_id')
						];

						if ($this->CartModel->delete($data)) {
							$data["status"] = "success";
							$data["message"] = "data deleted";
						} else {
							$data["status"] = "danger";
							$data["message"] = "data lost";
						}
						break;
					default:
						break;
				}
			}
		}

		$data['carts'] = $this->CartModel->get();

		$this->load->view('template/horeka/header');
		$this->load->view('horeka/cart', $data);
		$this->load->view('template/horeka/footer');
	}
}
