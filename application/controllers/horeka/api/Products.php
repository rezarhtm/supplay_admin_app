<?php

class Products extends CI_Controller{
	public function __construct()
    {
        parent::__construct();
        $this->load->library(['auth']);

        // Check Login & Role untuk Horeka
        $this->auth->authenticate();
		$this->auth->isRoles("horeka");
		
		$this->load->model("ProductModel");
	}
	
    public function index(){
		$list = $this->ProductModel->get_datatables();
        $data = array();
		$no = $_POST['start'];
		
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->product_id;
            $row[] = $field->product_name;
			$row[] = $field->price_perunit;
			$row[] = $field->unit;
 
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

	public function detail($id){
		$data = $this->ProductModel->detail($id);

		echo json_encode($data[0]);
	}
}
