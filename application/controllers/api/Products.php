<?php

class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['auth']);

        // Check Login
        $this->auth->authenticate();

        $this->load->model("ProductModel");
    }

    public function index()
    {
		if ($this->auth->hasRole('horeka')) {
			$list = $this->ProductModel->get_datatables_();
		}else{
			$list = $this->ProductModel->get_datatables();
		}
		
        $data = array();
		$no = $_POST['start'];

        foreach ($list as $field) {
            $no++;
            $row = array();
            // $row[] = $no;
            $row[] = $field->product_id;
            $row[] = $field->product_name;
            $row[] = number_format($field->price_perunit);
            $row[] = $field->unit;

            if ($this->auth->hasRole('vendor')) {
                $row[] = '
                <form method="POST">
                    <a href="product/update/' . $field->product_id . '" class="btn btn-primary font-weight-bold w-100" id="btn-edit">Edit</a>' . 
                    '<input hidden name="product_id" value="' . $field->product_id . '">' .
                    '<button onclick="return confirm(`Aktifkan Produk?`)" type="submit" value="active" name="set_product" ' . ($field->status_id == 1 ? 'hidden' : '') . ' class="btn btn-success w-100 my-1 float-right font-weight-bold" id="btn-set-aktif">Set Aktif</button>' .
                        '
                    <button onclick="return confirm(`Non-Aktifkan Produk?`)" type="submit" value="not_active" name="set_product" ' . ($field->status_id == 0 ? 'hidden' : '') . ' class="btn btn-danger w-100 my-1 float-right font-weight-bold" id="btn-set-nonaktif">Set Non-aktif</button>
                </form>
                ';
            }

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->ProductModel->count_all(),
            "recordsFiltered" => $this->ProductModel->count_filtered(),
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function detail($id)
    {
        $data = $this->ProductModel->detail($id);

        echo json_encode($data[0]);
    }
}
