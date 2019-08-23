<?php
class Signup_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insert($address, $fname, $lname, $email, $uname, $password)
    {

        $cid = $address['city_id'];
        $result = $this->db->get_where('city', array('city_id' => $cid))->result_array();
        //    print_r($result);

        if ($result) {
            $this->db->insert('address', $address);
            $last_id = $this->db->insert_id();
            //   echo ($last_id);

            //   die();
            $results = $this->db->get('staff')->result_array();
            foreach ($results as $result) {
                if ($result['username'] === $uname || $result['password'] === $password) {
                    return "kindly try other username or password";
                }
            }
            $data = array(
                'first_name' => $fname,
                'last_name' => $lname,
                'address_id' => $last_id,
                'email' => $email,
                'username' => $uname,
                'password' => $password,
            );
            $status = $this->db->insert('staff', $data);
            return "Record added";

        } else {
            return "city id doesnot exist";
        }

        // foreach($address as $result){

        //   if($address[$result] == 'city_id'){
        //       $cid = $address[$result];
        //       echo $cid;
        //   }
        // }

        // echo $cid;
        // die();
        // $query = $this->db->get_where('address', array('address_id' => $id))->result_array();
        // if($query){
        //     // print_r($query);
        //     $results = $this->db->get('staff')->result_array();
        //     foreach($results as $result){
        //         if($result['username'] === $uname || $result['password'] === $password){
        //             return "kindly try other username or password";
        //         }
        //         else{
        //           $status =  $this->db->insert('staff',$data);
        //           return "Record added";
        //         }
        //     }

        // }
        // else{
        //     return "address doesnot exist in table";
        // }

    }
    //  public function read(){
    //      $data = $this->db->get('category');
    //      return $data->result_array();
    //  }
    //  public function insert($input){

    //      $this->db->insert('staff',$input);
    //  }

    //  public function check($username,$password){
    //    $data =  $this->db->select('staff_id,first_name,last_name,address_id,email,active,username,last_update')->where('username',$username)->where('password',$password)->get('staff')->row();
    //    $data = $this->db->get('staff')->result_array();
    //  $this->db->where('username',$username);
    //  $this->db->where('password',$password);
    // $data = $this->db->get('staff')->result_array()[0];
    // $data = $data;
    // $data = $this->db->get('staff')->where({'username',$username,'password',$password})

    // if($data){
    // print_r($data);
    // return $data;
    // print_r($data);
    // }
    // else{
    //     echo "unable";
    // }
    // $results = $data->result_array();
    // foreach($results as $result){
    //     if($result['username'] === $username && $result['password'] === $password){
    //         return $result;
    //     }
    //     else{
    //         return "Not able to find";
    //     }
    // }
    //  }

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
