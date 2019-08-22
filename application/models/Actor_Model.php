<?php 
    class Actor_Model extends CI_Model{
        public function __construct() {
            parent::__construct();
            $this->load->database();
         }

         public function read(){
             $data = $this->db->get('actor')->result_array();
             return $data;
         }

         public function insert($data){
             $status = $this->db->insert('actor',$data);
             return $status;
         }

         public function update($data,$id){
             $result = $this->db->get_where('actor',array('actor_id'=>$id))->result_array();
             if($result){
                 $status = $this->db->update('actor',$data,array('actor_id'=>$id));
                 return "record updated";
             }
             else
             return "this id doesnot exist";
         }

         public function delete($id){
             $result = $this->db->get_where('actor',array('actor_id'=>$id))->result_array();
             if($result){
                 $this->db->delete('actor',array('actor_id'=>$id));
                 return true;
             }
             else
             return false;
         }
        }