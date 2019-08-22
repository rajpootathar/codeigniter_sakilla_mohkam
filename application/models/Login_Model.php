<?php 
    class Login_Model extends CI_Model{
        public function __construct() {
            parent::__construct();
            $this->load->database();
         }

         public function read(){
             $data = $this->db->get('category');
             return $data->result_array();
         }
         public function insert($input){

             $this->db->insert('staff',$input);
         }

         public function check($username,$password){
           $data =  $this->db->select('staff_id,first_name,last_name,address_id,email,active,username,last_update')->where('username',$username)->where('password',$password)->get('staff')->row();
        //    $data = $this->db->get('staff')->result_array(); 
           //  $this->db->where('username',$username);
            //  $this->db->where('password',$password);
            // $data = $this->db->get('staff')->result_array()[0];
                // $data = $data;
            // $data = $this->db->get('staff')->where({'username',$username,'password',$password})

            if($data){
                // print_r($data);
                return $data;
                // print_r($data);
            }
            else{
                echo "unable";
            }
            // $results = $data->result_array();
            // foreach($results as $result){
            //     if($result['username'] === $username && $result['password'] === $password){
            //         return $result;
            //     }
            //     else{
            //         return "Not able to find";
            //     }
            // }
         }

        //  public function create(){
        //      $name = $this->session->userdata('name');
        //      $status = $this->db->insert('category',$name);
        //      return $status;
        //  }

        //  public function update(){
        //     $category_id = $this->session->userdata('category_id');
        //     $c_name = $this->session->userdata('c_name');

        //    $status = $this->db->update('category',array('name'=>$c_name),array('category_id'=>$category_id));
        //    return $status;

        //  }

        //  public function delete(){

        //     $category_id = $this->session->userdata('category_id');
        //     $status = $this->db->delete('category',array('category_id'=>$category_id));
        //     return $status;
        //  }
    }
?>