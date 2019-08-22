<?php 
    class Sakila_Model extends CI_Model{
        public function __construct() {
            parent::__construct();
            $this->load->database();
         }

         public function read(){
             $data = $this->db->get('category');
             return $data->result_array();
         }

         public function create(){
             $name = $this->session->userdata('name');
             $status = $this->db->insert('category',$name);
             return $status;
         }

         public function update(){
            $category_id = $this->session->userdata('category_id');
            $c_name = $this->session->userdata('c_name');

           $status = $this->db->update('category',array('name'=>$c_name),array('category_id'=>$category_id));
           return $status;

         }

         public function delete(){

            $category_id = $this->session->userdata('category_id');
            $status = $this->db->delete('category',array('category_id'=>$category_id));
            return $status;
         }
    }
?>