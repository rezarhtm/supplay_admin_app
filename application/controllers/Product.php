<?php

class product extends CI_Controller {
    public function index() {
        $this->load->model("ProductModel");
        $data = array(
            "product" => $this->ProductModel->get()
        );
        $this->load->view("template/header");
        $this->load->view("product/viewall", $data);
        $this->load->view("template/footer");
        
    }
    public function detail($id) {
        $this->load->model('ProductModel');
        $data = array (
            'product' => $this->ProductModel->detail($id)
        );
        $this->load->view("template/header");
        $this->load->view("product/viewthis", $data);
        $this->load->view("template/footer");
    }
    public function insert() {
        $this->load->model("ProductModel");
        $this->load->helper('date');
        $this->load->helper('form_helper');
        $data = array();
        $now = "Y-m-d H:i:s";

        $category_get = $this->ProductModel->getCategory();

        $vendor_get = $this->ProductModel->getVendor();

        $data = array(
            'vendor_get' => $this->ProductModel->getVendor(),
            'vendor_selected' => $this->input->post('vendor_id'),
            'category_get' => $this->ProductModel->getCategory(),
            'category_selected' => $this->input->post('category_id'),
            
            #'vendor_get' => $this->ProductModel->getVendor(),
            #'vendor_selected' => $this->input->post('vendor_id'),
        );

        if($this->input->method() == "post") 
        {
            $data = array(
                'product_id' => $this->input->post('product_id'),
                'product_name' => $this->input->post('product_name'),

                'vendor_id' => $this->input->post('vendor_id'),

                'product_desc' => $this->input->post('product_desc'),
                #'category_id' => $this->input->post('category_id'),
                #'category_get' => $this->ProductModel->getCategory(),
                'category_id' => $this->input->post('category_id'),
                'qty' => $this->input->post('qty'),
                'unit' => $this->input->post('unit'),
                'price_perunit' => $this->input->post('price_perunit'),
                'status_id' => '1',
                'created_at' => date($now),
                'updated_at' => date($now),
                
            );

            if($this->ProductModel->insert($data)) {
                $data["status"] = "success";
                $data["message"] = "data added";
            }else{
                $data["status"] = "danger";
                $data["message"] = "data lost";
            }
        }


        $this->load->view("template/header");
        $this->load->view("product/addproduct", $data);
        $this->load->view("template/footer");
    }

    public function update($product_id) {
        $this->load->model("ProductModel");
        $up_data['product']=$this->ProductModel->getInfo('product_id', $product_id);
        $now = "Y-m-d H:i:s";

        if($this->input->method() == "post") 
        {

            $new['product_name'] = $this->input->post('product_name');
            $new['vendor_id'] = $this->input->post('vendor_id');
            $new['product_desc'] = $this->input->post('product_desc');
            $new['category_id'] = $this->input->post('category_id');
            $new['qty'] = $this->input->post('qty');
            $new['unit'] = $this->input->post('unit');
            $new['price_perunit'] = $this->input->post('price_perunit');
            $new['status_id'] = $this->input->post('status_id');
            $new['updated_at'] = date($now);

            $id = $this->ProductModel->update($product_id, $new); 

            if($id) {
                $data["status"] = "success";
                $data["message"] = "data updated";
            }else{
                $data["status"] = "danger";
                $data["message"] = "data lost";
            }
        }
        
        $this->load->view("template/header");
        $this->load->view("product/updateproduct", $up_data);
        $this->load->view("template/footer");
    }
    public function detailproduct($product_id){
        $data['product']=$this->ProductModel->getInfo('product_id',$product_id);
        $this->load->view("template/header");
        $this->load->view("product/updateproduct", $data);
        $this->load->view("template/footer");
    }
}

?>