<?php

class Vendor extends CI_Controller{
    public function index() {
        $this->load->model('VendorModel');
        $data = array(
            'vendor' => $this->VendorModel->get()
        );
        $this->load->view("template/header");
        $this->load->view("vendor/viewall", $data);
        $this->load->view("template/footer");
    }
    public function detail($id) {
        $this->load->model('VendorModel');
        $data = array (
            'vendor' => $this->VendorModel->detail($id)
        );
        $this->load->view("template/header");
        $this->load->view("vendor/viewthis", $data);
        $this->load->view("template/footer");
    }
    public function insert() {
        $this->load->model("VendorModel");
        $this->load->helper('date');
        $data = array();
        $now = "Y-m-d H:i:s";

        if($this->input->method() == "post") 
        {
            $data = array(
                'vendor_id' => $this->input->post('vendor_id'),
                'v_name' => $this->input->post('v_name'),
                'v_npwp' => $this->input->post('v_npwp'),
                'v_username' => $this->input->post('v_username'),
                'v_password' => $this->input->post('v_username'),
                'v_pic_name' => $this->input->post('v_pic_name'),
                'v_address' => $this->input->post('v_address'),
                'v_biz_address' => $this->input->post('v_biz_address'),
                /*
                'v_city' => $this->input->post('v_city'),
                'v_province' => $this->input->post('v_province'),
                */
                'v_phone' => $this->input->post('v_phone'),
                'v_fax' => $this->input->post('v_fax'),
                'v_email' => $this->input->post('v_email'),
                'v_bank_acc' => $this->input->post('v_bank_acc'),
                'v_remarks' => $this->input->post('v_remarks'),
                'status_id' => '1',
                'created_at' => date($now),
                'updated_at' => date($now)
            );

            if($this->VendorModel->insert($data)) {
                $data["status"] = "success";
                $data["message"] = "data added";
            }else{
                $data["status"] = "danger";
                $data["message"] = "data lost";
            }
        }
        $this->load->view("template/header");
        $this->load->view("vendor/addvendor", $data);
        $this->load->view("template/footer");
    }
    public function update($vendor_id) {
        $this->load->model("VendorModel");
        $up_data['vendor']=$this->VendorModel->getInfo('vendor_id', $vendor_id);
        $now = "Y-m-d H:i:s";

        if($this->input->method() == "post") 
        {
            $new['v_name'] = $this->input->post('v_name');
            $new['v_npwp'] = $this->input->post('v_npwp');
            $new['v_username'] = $this->input->post('v_username');
            $new['v_password'] = $this->input->post('v_password');
            $new['v_pic_name'] = $this->input->post('v_pic_name');
            $new['v_address'] = $this->input->post('v_address');
            $new['v_biz_address'] = $this->input->post('v_biz_address');
            /*
            'v_city' = $this->input->post('v_city');
            'v_province' = $this->input->post('v_province');
            */
            $new['v_phone'] = $this->input->post('v_phone');
            $new['v_fax'] = $this->input->post('v_fax');
            $new['v_email'] = $this->input->post('v_email');
            $new['bank_id'] = $this->input->post('bank_id');
            $new['v_bank_acc'] = $this->input->post('v_bank_acc');
            $new['v_remarks'] = $this->input->post('v_remarks');
            $new['status_id'] = $this->input->post('status_id');
            $new['updated_at'] = date($now);

            $id = $this->VendorModel->update($vendor_id, $new); 

            if($id) {
                $data["status"] = "success";
                $data["message"] = "data updated";
            }else{
                $data["status"] = "danger";
                $data["message"] = "data lost";
            }
        }
        
        $this->load->view("template/header");
        $this->load->view("vendor/updatevendor", $up_data);
        $this->load->view("template/footer");
    }
    public function detailvendor($vendor_id){
        $data['vendor']=$this->VendorModel->getInfo('vendor_id',$vendor_id);
        $this->load->view("template/header");
        $this->load->view("vendor/updatevendor", $data);
        $this->load->view("template/footer");
    }
}

?>