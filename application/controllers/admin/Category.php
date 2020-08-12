<?php
class Category extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['auth']);

        // Check Login & Role untuk Admin
        $this->auth->authenticate();
        $this->auth->isRoles("admin");
    }
    
    public function index() {
        $this->load->model("category_entry");
        $data =array(
            'categories' => $this->category_entry->get()
        );
        $this->load->view("template/admin/header");
        $this->load->view("admin/category/viewall", $data);
        $this->load->view("template/admin/footer");
    }
    public function insert() {
        $this->load->model("category_entry");
        $this->load->helper('date');
        $data = array();
        $now = "Y-m-d H:i:s";

        if($this->input->method() == "post") 
        {
            $data = array(
                'category_desc' => $this->input->post('category_desc'),
                'created_at' => date($now),
                'updated_at' => date($now)
            );

            if($this->category_entry->insert($data)) {
                $data["status"] = "success";
                $data["message"] = "data added";
            }else{
                $data["status"] = "danger";
                $data["message"] = "data lost";
            }
        }
        $this->load->view("template/admin/header");
        $this->load->view("admin/category/addcategory", $data);
        $this->load->view("template/admin/footer");
    }

    public function update($category_id) {
        $this->load->model("category_entry");
        $data['category']=$this->category_entry->getInfo('category_id', $category_id);
        $now = "Y-m-d H:i:s";

        if($this->input->method() == "post") 
        {
            $new['category_desc'] = $this->input->post('category_desc');
            $new['updated_at'] = date($now);

            $id = $this->category_entry->update($category_id, $new); 

            if($id) {
                $data["status"] = "success";
                $data["message"] = "data updated";
            }else{
                $data["status"] = "danger";
                $data["message"] = "data lost";
            }
        }
        
        $this->load->view("template/admin/header");
        $this->load->view("admin/category/updatecategory", $data);
        $this->load->view("template/admin/footer");
    }
    public function detailCategory($category_id){
        $data['category']=$this->category_entry->getInfo('category_id',$category_id);
        $this->load->view("template/admin/header");
        $this->load->view("admin/category/updatecategory", $data);
        $this->load->view("template/admin/footer");
    }
    
    public function xindex() {
        $this->load->model("category_entry");
        $this->load->helper('date');
        $data = array();
        $now = "Y-m-d H:i:s";
        

        if ($this->input->method() == "post"){
            $data = array(
                'category_desc' => $this->input->post('category_desc'),
                'created_at' => date($now),
                'updated_at' => date($now)
            );

            if ($this->category_entry->insert($data)) {
                $data["status"] = "success";
                $data["message"] = "data added";
            }else{
                $data["status"] = "danger";
                $data["message"] = "data lost";
            }
        }
    }
}


?>