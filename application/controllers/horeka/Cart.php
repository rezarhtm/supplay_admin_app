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

		$this->load->model('ProductModel');
		$this->load->model('horeka/CartModel');

		$this->load->model('horeka/OrderModel');
		$this->load->model('horeka/TransactionModel');
	}

	public function index()
	{
		if ($this->input->method() == "post") {
			if ($this->input->post('submit_cart')) {
				switch ($this->input->post('submit_cart')) {
					case "buy":
						if ($this->input->post('checked_product')) {
							$check_product = true;
							$qty_sum = 0;

							foreach ($this->input->post('checked_product') as $index => $product_id) {
								$product_qty = $this->ProductModel->getInfo('product_id', $product_id)['qty'];

								$qty_sum += $this->CartModel->find($product_id)['qty'];

								if ($product_qty <= $this->CartModel->find($product_id)['qty']) {
									$check_product = false;
								}
							}

							if ($qty_sum < 1) {
								$check_product = false;
							}

							if ($check_product) {
								$data = [
									"user_id" => $this->auth->userID
								];

								if ($this->TransactionModel->insert($data)) {
									$transaction_id = $this->db->insert_id();
									$products_sum = 0;

									foreach ($this->input->post('checked_product') as $index => $product_id) {
										$buy_qty = $this->CartModel->find($product_id)['qty'];
										if ($buy_qty > 0) {
											$product = $this->ProductModel->getInfo('product_id', $product_id);

											$data = [
												"transaction_id" => $transaction_id,
												"product_id" => $product_id,
												"qty" => $buy_qty,
												"product_price" => $product['price_perunit'],
												"order_price" => $buy_qty * $product['price_perunit']
											];

											$products_sum += $data['order_price'];

											$this->OrderModel->insert($data);
										}
									}

									$data = [
										"total_order" => $products_sum
									];

									$this->TransactionModel->update($transaction_id, $data);

									$data["status"] = "success";
									$data["message"] = "transaksi berhasil";
								}
							}
						} else {
							$data["status"] = "danger";
							$data["message"] = "transaksi gagal, produk tidak dipilih";
						}

						// print_r($products);
						break;
					case "delete":
						$data = [
							'product_id' => $this->input->post('product_id')
						];

						if ($this->CartModel->delete($data)) {
							$data["status"] = "success";
							$data["message"] = "cart deleted";
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
