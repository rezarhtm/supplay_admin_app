<?php

class Horeka extends CI_Controller {
    public function index() {
        $this->load->model("HorekaModel");
        $data = array(
            "horeka" => $this->HorekaModel->get()
        );
        $this->load->view("template/header");
        $this->load->view("horeka/viewall", $data);
        $this->load->view("template/footer");
        
    }
    public function detail($id) {
        $this->load->model('HorekaModel');
        $data = array (
            'horeka' => $this->HorekaModel->detail($id)
        );
        $this->load->view("template/header");
        $this->load->view("horeka/viewthis", $data);
        $this->load->view("template/footer");
    }
    public function insert() {
        $this->load->model("HorekaModel");
        $this->load->helper('date');
        $data = array();
        $now = "Y-m-d H:i:s";

        if($this->input->method() == "post") 
        {
            $data = array(
                'horeka_id' => $this->input->post('horeka_id'),
                'h_name' => $this->input->post('h_name'),
                'h_npwp' => $this->input->post('h_npwp'),
                'h_username' => $this->input->post('h_username'),
                'h_password' => $this->input->post('h_username'),
                'h_pic_name' => $this->input->post('h_pic_name'),
                'h_address' => $this->input->post('h_address'),
                'h_biz_address' => $this->input->post('h_biz_address'),
                /*
                'h_city' => $this->input->post('h_city'),
                'h_province' => $this->input->post('h_province'),
                */
                'h_phone' => $this->input->post('h_phone'),
                'h_fax' => $this->input->post('h_fax'),
                'h_email' => $this->input->post('h_email'),
                'bank_id' => $this->input->post('bank_id'),
                'h_bank_acc' => $this->input->post('h_bank_acc'),
                'remarks' => $this->input->post('remarks'),
                'status_id' => '1',
                'created_at' => date($now),
                'updated_at' => date($now)
            );

            if($this->HorekaModel->insert($data)) {
                $data["status"] = "success";
                $data["message"] = "data added";
            }else{
                $data["status"] = "danger";
                $data["message"] = "data lost";
            }
        }
        $this->load->view("template/header");
        $this->load->view("horeka/addhoreka", $data);
        $this->load->view("template/footer");
    }
    public function update($horeka_id) {
        $this->load->model("HorekaModel");
        $up_data['horeka']=$this->HorekaModel->getInfo('horeka_id', $horeka_id);
        $now = "Y-m-d H:i:s";

        if($this->input->method() == "post") 
        {
            $new['h_name'] = $this->input->post('h_name');
            $new['h_npwp'] = $this->input->post('h_npwp');
            $new['h_username'] = $this->input->post('h_username');
            $new['h_password'] = $this->input->post('h_password');
            $new['h_pic_name'] = $this->input->post('h_pic_name');
            $new['h_address'] = $this->input->post('h_address');
            $new['h_biz_address'] = $this->input->post('h_biz_address');
            /*
            'h_city' = $this->input->post('h_city');
            'h_province' = $this->input->post('h_province');
            */
            $new['h_phone'] = $this->input->post('h_phone');
            $new['h_fax'] = $this->input->post('h_fax');
            $new['h_email'] = $this->input->post('h_email');
            $new['bank_id'] = $this->input->post('bank_id');
            $new['h_bank_acc'] = $this->input->post('h_bank_acc');
            $new['remarks'] = $this->input->post('remarks');
            $new['status_id'] = $this->input->post('status_id');
            $new['updated_at'] = date($now);

            $id = $this->HorekaModel->update($horeka_id, $new); 

            if($id) {
                $data["status"] = "success";
                $data["message"] = "data updated";
            }else{
                $data["status"] = "danger";
                $data["message"] = "data lost";
            }
        }
        
        $this->load->view("template/header");
        $this->load->view("horeka/updatehoreka", $up_data);
        $this->load->view("template/footer");
    }
    public function detailhoreka($horeka_id){
        $data['horeka']=$this->HorekaModel->getInfo('horeka_id',$horeka_id);
        $this->load->view("template/header");
        $this->load->view("horeka/updatehoreka", $data);
        $this->load->view("template/footer");
    }
}

?>