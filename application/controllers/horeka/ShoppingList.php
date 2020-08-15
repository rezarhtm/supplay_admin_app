<?php
class ShoppingList extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(['auth']);

		// Check Login & Role untuk Horeka
		$this->auth->authenticate();
		$this->auth->isRoles("horeka");

		$this->load->model('ProductModel');
		$this->load->model('horeka/ShoppingProductsListModel');

		$this->load->model('horeka/OrderModel');
		$this->load->model('horeka/TransactionModel');
	}

	public function index()
	{
		return redirect('horeka');
	}

	public function detail($id)
	{
		if ($this->input->method() == "post") {
			if ($this->input->post('submit_shopping_list')) {
				switch ($this->input->post('submit_shopping_list')) {
					case "buy":
						$check_product = true;
						$qty_sum = 0;

						foreach ($this->input->post('checked_product') as $index => $product_id) {
							$product_qty = $this->ProductModel->getInfo('product_id', $product_id)['qty'];

							$qty_sum += $this->input->post('qty')[$index];

							if ($product_qty <= $this->input->post('qty')[$index]) {
								$check_product = false;
							}
						}

						if($qty_sum < 1){
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
									$buy_qty = $this->input->post('qty')[$index];
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

						// print_r($products);
						break;
					case "delete":
						$data = [
							'product_id' => $this->input->post('product_id')
						];

						if ($this->ShoppingProductsListModel->delete($data)) {
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

		$data['shopping_list'] = $this->ShoppingProductsListModel->find($id);

		$this->load->view('template/horeka/header');
		$this->load->view('horeka/shoppinglist', $data);
		$this->load->view('template/horeka/footer');
	}
}
