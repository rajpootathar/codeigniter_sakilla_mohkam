<?php 
    class Language_Model extends CI_Model{
        public function __construct() {
            parent::__construct();
            $this->load->database();
         }

         public function read(){
             $data = $this->db->get('language')->result_array();
             return $data;

         }

         public function insert($data){
             $status = $this->db->insert('language',$data);
             return $status;
         }

        public function update($language_id,$name){
            
            $status = $this->db->update('language',array('name'=>$name),array('language_id'=>$language_id));
            //array('language_id'=>$language_id)
            return $status;
        }
        public function delete($id){
            $status = $this->db->delete('language',array('language_id'=>$id));
            return $status;
        }

        }
        ?>