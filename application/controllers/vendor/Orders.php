<?php

class Orders extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['auth']);

        // Check Login & Role untuk Vendor
        $this->auth->authenticate();
        $this->auth->isRoles(["vendor"]);

        $this->load->model('TransactionModel');
    }

    public function index()
    {
        $data = [];

        if ($this->input->method() == "post") {
            if ($this->input->post('set_transaction') && $this->input->post('transaction_id')) {
                $transaction_id = $this->input->post('transaction_id');

                switch ($this->input->post('set_transaction')) {
                    case "terima":
                        if($this->TransactionModel->update($transaction_id, ["order_status" => 'ON PROCESS'])){
                            $data["status"] = "success";
                            $data["message"] = "Transaksi berhasil diterima";
                        }else{
                            $data["status"] = "danger";
                            $data["message"] = "Data gagal di update, silahkan coba lagi";
                        }
                        break;
                    case "tolak":
                        if($this->TransactionModel->update($transaction_id, ["order_status" => 'REJECTED', "note" => $this->input->post('alasan')])){
                            $data["status"] = "success";
                            $data["message"] = "Transaksi berhasil ditolak";
                        }else{
                            $data["status"] = "danger";
                            $data["message"] = "Data gagal di update, silahkan coba lagi";
                        }
                        break;
                    case "kirim":
                        if($this->TransactionModel->update($transaction_id, ["order_status" => 'SENT'])){
                            $data["status"] = "success";
                            $data["message"] = "Transaksi berhasil dikirim";
                        }else{
                            $data["status"] = "danger";
                            $data["message"] = "Data gagal di update, silahkan coba lagi";
                        }
						break;
					case "konfirmasiselesai":
						if($this->TransactionModel->update($transaction_id, ["order_status" => 'COMPLETE'])){
							$data["status"] = "success";
							$data["message"] = "Transaksi berhasil dikonfirmasi";
						}else{
							$data["status"] = "danger";
							$data["message"] = "Data gagal di update, silahkan coba lagi";
						}
						break;
                    default:
                        break;
                }
            }
        }
        
        $this->load->view('template/vendor/header');
        $this->load->view('vendor/orders', $data);
        $this->load->view('template/vendor/footer');
    }
}