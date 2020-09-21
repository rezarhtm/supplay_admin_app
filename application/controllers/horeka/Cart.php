<?php

class Cart extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(['auth']);

		// Check Login & Role untuk Horeka
		$this->auth->authenticate();
		$this->auth->isRoles(["horeka"]);

		$this->load->model('ProductModel');
		$this->load->model('horeka/CartModel');

		$this->load->model('horeka/OrderModel');
		$this->load->model('horeka/TransactionModel');
		$this->load->model('horeka/InvoiceModel');
		$this->load->model('horeka/CreditScoreModel');
		$this->load->model('HorekaModel');
	}

	public function index()
	{
		if ($this->input->method() == "post") {
			if ($this->input->post('submit_cart')) {
				switch ($this->input->post('submit_cart')) {
					case "buy":
						$credit_score_horeka = $this->CreditScoreModel->getCreditScore();
						$count_unpaid_invoice = $this->CreditScoreModel->count();

						if ($credit_score_horeka > $count_unpaid_invoice) {
							if ($this->input->post('checked_product')) {
								$check_product = true;
								$qty_sum = 0;

								$vendor_id = null;

								foreach ($this->input->post('checked_product') as $index => $product_id) {
									$product_qty = $this->ProductModel->getInfo('product_id', $product_id)['qty'];
									$vendor_id = $this->ProductModel->getInfo('product_id', $product_id)['vendor_id'];

									$qty_sum += $this->CartModel->find($product_id)['qty'];

									if ($product_qty <= $this->CartModel->find($product_id)['qty']) {
										$check_product = false;
									}
								}

								if ($qty_sum < 1) {
									$check_product = false;
								}

								if ($check_product) {
									$horeka_id = $this->HorekaModel->getInfo("h_username", $this->auth->userName);
									$tr_id = "83" . substr($horeka_id['horeka_id'], -3) . rand(100, 999);
									$data = [
										"id" => $tr_id, 
										"user_id" => $this->auth->userID,
										"vendor_id" => $vendor_id
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

												if ($this->OrderModel->insert($data)) {
													$cart = [
														'product_id' => $product_id
													];

													$this->CartModel->delete($cart);
												}
											}
										}

										$data = [
											"total_order" => $products_sum
										];

										$this->TransactionModel->update($transaction_id, $data);

										// $invoice_number = 1 . date("ym") . rand(100, 999);

										// if ($this->InvoiceModel->insert([
										// 	"invoice_number" => $invoice_number,
										// 	"transaction_id" => $transaction_id,
										// 	"nominal" => $products_sum
										// ])) {
											$data["status"] = "success";
											$data["message"] = "Transaksi berhasil";
										// } else {
										// 	$data["status"] = "success";
										// 	$data["message"] = "Gagal generate invoice";
										// }
									}
								}
							} else {
								$data["status"] = "danger";
								$data["message"] = "Transaksi gagal, produk tidak dipilih";
							}

							// print_r($products);
						} else {
							$data["status"] = "danger";
							$data["message"] = "Credit Score tidak cukup!";
						}
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
