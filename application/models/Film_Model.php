<?php 
    class Film_Model extends CI_Model{
        public function __construct() {
            parent::__construct();
            $this->load->database();
         }

         public function read(){
             $result = $this->db->get('film')->result_array();
             return $result;
         }

         public function insert($lang_id,$data){
             foreach($data as $record){
                 $info = $data['title'];
             }
            //  echo $info;
            //  die();
             if($info == NULL){
             return false;
             }
            //  die('die');
             $result = $this->db->get_where('language',array('language_id'=>$lang_id))->result_array();
            //  print_r($result);
            //  die();
             if($result){
                 $status = $this->db->insert('film',$data);
                 return $status;
             }
             else{
                 return false;
             }
         }

         public function update($lang_id,$film_id,$data){
            $result = $this->db->get_where('film',array('film_id'=>$film_id))->result_array();

            if($result){
             $result = $this->db->get_where('language',array('language_id'=>$lang_id))->result_array();

             if($result){
                $this->db->update('film',$data,array('film_id'=>$film_id));
                return "film updated";
             }
             else{
                 return "Invalid language id";
             }
            }
            else{
                return "sorry, invalid film id";
            }
         }

         public function delete($id){
             $result = $result = $this->db->get_where('film',array('film_id'=>$id))->result_array();
             if($result){
                $this->db->query('SET FOREIGN_KEY_CHECKS=0');
                $status = $this->db->delete('film',array('film_id'=>$id));
                $this->db->query('SET FOREIGN_KEY_CHECKS=0');
                return $status;
             }
             else{
                 return false;
             }
         }
        }
