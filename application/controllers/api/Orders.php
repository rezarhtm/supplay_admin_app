<?php

class Orders extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(['auth']);

		// Check Login
		$this->auth->authenticate();

		$this->load->model("TransactionModel");
		$this->load->model("HorekaModel");
	}

	public function index()
	{
		$status = null;

		if (isset($_POST['status'])) {
			if ($_POST['status'] == 'pending') {
				$status = 'PENDING';
			} else if ($_POST['status'] == 'running') {
				$status = 'ON PROCESS';
			}
		}

		$list = $this->TransactionModel->get_datatables($status);
		$data = array();
		$no = $_POST['start'];

		if ($this->auth->hasRole('vendor')) {
			foreach ($list as $field) {
				$no++;
				$row = array();
				$row[] = '<button class="btn btn-secondary font-weight-bold" data-toggle="modal" id="btn-lihat-pesanan" data-target="#lihat-pesanan">' . 'Lihat Pesanan' . '</button>';
				$row[] = $field->transaction_id;
				$row[] = '<a href="horeka/detail/' . $field->horeka_username . '">' . $field->horeka_username . '</a>';
				$row[] = number_format($field->total_order);

				switch ($field->order_status) {
					case 'REJECTED':
						$order_status_color = "danger";
						break;
					case 'ON PROCESS':
						$order_status_color = "primary";
						break;
					case 'SENT':
						$order_status_color = "success";
						break;
					default:
						$order_status_color = "secondary";
						break;
				}
				$row[] = '<span class="bg-' . $order_status_color . ' text-white px-3 font-weight-bold">' . $field->order_status . '</span>';

				if ($this->auth->hasRole('vendor')) {
					if ($field->order_status == 'PENDING') {
						$row[] = '
							<form method="POST">
							<input hidden name="transaction_id" value="' . $field->transaction_id . '">
								<button onclick="return confirm(`Terima Transaksi?`)" type="submit" value="terima" name="set_transaction" class="btn btn-success w-100 my-1 float-right font-weight-bold" id="btn-terima">Terima</button>
	
								<div class="modal" tabindex="-1" role="dialog" id="alasan_tolak">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Alasan tolak</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="form-group">
												<textarea name="alasan" class="form-control"></textarea>
											</div>
										</div>
										<div class="modal-footer">
											<button type="submit" type="submit" value="tolak" name="set_transaction" class="btn btn-primary">Tolak</button>
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										</div>
										</div>
									</div>
								</div>
	
								<button data-toggle="modal" type="button" data-target="#alasan_tolak" class="btn btn-danger w-100 my-1 float-right font-weight-bold" id="btn-tolak">Tolak</button>
							</form>
						';
					} else if ($field->order_status == 'ON PROCESS') {
						$row[] = '
							<form method="POST">
							<input hidden name="transaction_id" value="' . $field->transaction_id . '">
								<button onclick="return confirm(`Kirim?`)" type="submit" value="kirim" name="set_transaction" class="btn btn-primary w-100 my-1 float-right font-weight-bold" id="btn-kirim">Kirim</button>
							</form>
						';
					} else {
						$row[] = '';
					}
				}

				$data[] = $row;
			}
		} else if ($this->auth->hasRole('horeka')) {
			foreach ($list as $field) {
				$no++;
				$row = array();
				$row[] = $field->id;
				$row[] = number_format($field->total_order);

				switch ($field->order_status) {
					case 'REJECTED':
						$order_status_color = "danger";
						break;
					case 'ON PROCESS':
						$order_status_color = "primary";
						break;
					case 'SENT':
						$order_status_color = "success";
						break;
					default:
						$order_status_color = "secondary";
						break;
				}
				$row[] = '<span class="bg-' . $order_status_color . ' text-white px-3 font-weight-bold">' . $field->order_status . '</span>';

				// if($field->order_status == 'ON PROCESS' || $field->order_status == 'RETURN'){
					$row[] = '
						<a href="transactions/action/' . $field->id . '" class="btn btn-primary w-100 font-weight-bold">
							Aksi
						</a>
					';
				// }else{
				// 	$row[] = '
				// 		<a class="btn btn-primary w-100 font-weight-bold disabled">
				// 			Aksi
				// 		</a>
				// 	';
				// }
				
				$data[] = $row;
			}
		}


		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->TransactionModel->count_all(),
			"recordsFiltered" => $this->TransactionModel->count_filtered(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	public function detail($id)
	{
		$tr = $this->TransactionModel->orders($id);

		$data['data'] = $tr;
		$data['horeka'] = $this->HorekaModel->getHorekaFromTransaction($id);

		echo json_encode($data);
	}
}
