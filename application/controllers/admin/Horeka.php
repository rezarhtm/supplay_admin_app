<?php

class Horeka extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['auth']);

        // Check Login & Role untuk Admin
        $this->auth->authenticate();
        $this->auth->isRoles("admin");
    }

    public function index() {
        $this->load->model("HorekaModel");
        $data = array(
            "horeka" => $this->HorekaModel->get()
        );
        $this->load->view("template/admin/header");
        $this->load->view("admin/horeka/viewall", $data);
        $this->load->view("template/admin/footer");
        
    }
    public function detail($id) {
        $this->load->model('HorekaModel');
        $data = array (
            'horeka' => $this->HorekaModel->detail($id)
        );
        $this->load->view("template/admin/header");
        $this->load->view("admin/horeka/viewthis", $data);
        $this->load->view("template/admin/footer");
    }
    public function insert() {
        $this->load->model("HorekaModel");
        $this->load->model("BankModel");
        $this->load->model("User");
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
                // 'h_password' => $this->input->post('h_username'),
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
                'credit_score' => 1,
                'created_at' => date($now),
                'updated_at' => date($now)
            );

            $user = $this->User->add(
                [ 
                    'name' => $data['h_name'], 
                    'username' => $data['h_username'], 
                    'password' => $this->input->post('h_password'), 
                    'status' => 1, 
                ]
            );

            $role = $this->User->addRoles($this->db->insert_id(), 2);

            if($this->HorekaModel->insert($data) && $user && $role) {
                $data["status"] = "success";
                $data["message"] = "data added";
            }else{
                $data["status"] = "danger";
                $data["message"] = "data lost";
            }
        }

        $data['bank'] = $this->BankModel->get();

        $this->load->view("template/admin/header");
        $this->load->view("admin/horeka/addhoreka", $data);
        $this->load->view("template/admin/footer");
    }
    public function update($horeka_id) {
        $this->load->model("HorekaModel");
        $this->load->model("BankModel");
        $this->load->model("User");
        $now = "Y-m-d H:i:s";

        if($this->input->method() == "post") 
        {
            $new['h_name'] = $this->input->post('h_name');
            $new['h_npwp'] = $this->input->post('h_npwp');
            $new['h_username'] = $this->input->post('h_username');
            // $new['h_password'] = $this->input->post('h_username');
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
            $new['credit_score'] = $this->input->post('credit_score');
            $new['updated_at'] = date($now);

            $user_id = $this->User->findByUsername($this->input->post('old_username'))->id;

            if(empty($this->input->post('h_password'))){
                $user = $this->User->edit(
                    [
                        'id' => $user_id,

                        'name' => $new['h_name'], 
                        'username' => $new['h_username']
                    ]
                );
            }else{
                $user = $this->User->edit(
                    [ 
                        'id' => $user_id,
                        
                        'name' => $new['h_name'], 
                        'username' => $new['h_username'], 
                        'password' => password_hash($this->input->post('h_password'), PASSWORD_BCRYPT), 
                    ]
                );
            }

            $id = $this->HorekaModel->update($horeka_id, $new); 

            if($user && $id) {
                $data["status"] = "success";
                $data["message"] = "data updated";
            }else{
                $data["status"] = "danger";
                $data["message"] = "data lost";
            }
        }

        $data['bank'] = $this->BankModel->get();
        $data['horeka']=$this->HorekaModel->getInfo('horeka_id', $horeka_id);
        
        $this->load->view("template/admin/header");
        $this->load->view("admin/horeka/updatehoreka", $data);
        $this->load->view("template/admin/footer");
    }
    public function detailhoreka($horeka_id){
        $data['horeka']=$this->HorekaModel->getInfo('horeka_id',$horeka_id);
        $this->load->view("template/admin/header");
        $this->load->view("admin/horeka/updatehoreka", $data);
        $this->load->view("template/admin/footer");
    }
}

?>