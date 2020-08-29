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

		foreach ($list as $field) {
			$no++;
			$row = array();
			// $row[] = $no;
			$row[] = $field->transaction_id;
			$row[] = $field->horeka_username;
			$row[] = number_format($field->total_order);
			$row[] = $field->order_status;

			if ($this->auth->hasRole('vendor')) {
				if($field->order_status == 'PENDING'){
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
				}else if($field->order_status == 'ON PROCESS'){
					$row[] = '
						<form method="POST">
						<input hidden name="transaction_id" value="' . $field->transaction_id . '">
							<button onclick="return confirm(`Kirim?`)" type="submit" value="kirim" name="set_transaction" class="btn btn-primary w-100 my-1 float-right font-weight-bold" id="btn-kirim">Kirim</button>
						</form>
					';
				}else{
					$row[] = '';
				}
			}

			$data[] = $row;
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
		$data = $this->TransactionModel->detail($id);

		echo json_encode($data[0]);
	}
}
