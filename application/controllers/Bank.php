<?php

class Bank extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['auth']);

        // Check Login & Role untuk Admin
        $this->auth->authenticate();
        $this->auth->isRoles("admin");
    }

    public function index(){
        $this->load->model("BankModel");
        $data = array(
            "banks" => $this->BankModel->get()
        );
        $this->load->view("template/header");
        $this->load->view("bank/viewall", $data);
        $this->load->view("template/footer");        
    }

    public function insert() {
        $this->load->model("BankModel");
        $this->load->helper('date');
        $data = array();
        $now = "Y-m-d H:i:s";

        if($this->input->method() == "post") 
        {
            $data = array(
                'bank_name' => $this->input->post('bank_name'),
                'created_at' => date($now),
                'update_at' => date($now)
            );

            if($this->BankModel->insert($data)) {
                $data["status"] = "success";
                $data["message"] = "data added";
            }else{
                $data["status"] = "danger";
                $data["message"] = "data lost";
            }
        }
        $this->load->view("template/header");
        $this->load->view("bank/addbank", $data);
        $this->load->view("template/footer");
    }

    public function update($bank_id) {
        $this->load->model("BankModel");
        $data["bank"] = $this->BankModel->getInfo('bank_id', $bank_id);
        $now = "Y-m-d H:i:s";

        if($this->input->method() == "post") 
        {
            $new['bank_name'] = $this->input->post('bank_name');
            $new['update_at'] = date($now);

            $id = $this->BankModel->update($bank_id, $new); 

            if($id) {
                $data["status"] = "success";
                $data["message"] = "data updated";
            }else{
                $data["status"] = "danger";
                $data["message"] = "data lost";
            }
        }
        
        $this->load->view("template/header");
        $this->load->view("bank/updatebank", $data);
        $this->load->view("template/footer");
    }
    public function detailBank($bank_id){
        $data['bank']=$this->BankModel->getInfo('bank_id',$bank_id);
        $this->load->view("template/header");
        $this->load->view("bank/updatebank", $data);
        $this->load->view("template/footer");
    }

}

?>