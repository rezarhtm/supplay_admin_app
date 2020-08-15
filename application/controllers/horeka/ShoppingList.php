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

		$this->load->model('horeka/ShoppingProductsListModel');
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
