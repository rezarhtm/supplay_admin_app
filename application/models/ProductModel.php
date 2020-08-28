<?php

class ProductModel extends CI_Model
{
    var $table = 'products'; //nama tabel dari database
    var $column_order = array(null, 'product_name', 'price_perunit', 'unit');
    var $column_search = array('product_id', 'product_name'); //field yang diizin untuk pencarian 
    var $order = array('created_at' => 'DESC'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('VendorModel');
    }

    public function get()
    {
        return $this->db->from('products')->order_by('created_at', 'DESC')->get()->result();
    }
    // public function getAndOrderByPrice() {
    //     
    //     return $this->db->from('products')->order_by('price_perunit', 'ASC')->get()->result();
    // }
    public function detail($id)
    {
        $this->db->where('products.product_id', $id);
        return $this->db
        // ->select('products.*, category.category_desc')
        ->from('products')
        ->join('category', 'category.category_id = products.category_id')
        ->get()
        ->result();
    }
    public function insert($data = array())
    {

        return $this->db->insert('products', $data);
    }
    public function getInfo($field, $value)
    {

        $this->db->where($field, $value);
        $query = $this->db->get('products');
        return $query->row_array();
    }
    public function update($id, $new)
    {
        $this->db->where("product_id", $id);
        $this->db->update("products", $new);
        return $this->db->affected_rows();
    }
    function getCategory()
    {

        $result = $this->db->get('category')->result();
        // $dd[''] = 'Please Select';
        // if ($result->num_rows() > 0) {
        //     foreach ($result->result() as $row) {
        //         $dd[$row->category_id] = $row->category_desc;
        //     }
        // }
        // return $dd;
        return $result;
    }
    function getVendor()
    {

        $resvendor = $this->db->get('vendors')->result();
        // $sel = 'Please Select';
        // if ($resvendor->num_rows() > 0) {
        //     foreach ($resvendor->result() as $row){
        //         $sel[$row->vendor_id] = $row->v_name;
        //     }
        // }
        return $resvendor;
    }

    private function _get_datatables_query()
    {
        if ($this->auth->hasRole('vendor')) {
            $vendor = $this->VendorModel->getInfo('v_username', $this->auth->userName);
            $this->db->where('vendor_id', $vendor['vendor_id']);
        }

        $this->db->from($this->table);
        $i = 0;
        foreach ($this->column_search as $item) // looping awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                if ($i === 0) // looping awal
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
}
