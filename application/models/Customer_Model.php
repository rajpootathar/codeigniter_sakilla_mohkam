<?php 
    class Customer_Model extends CI_Model{
        public function __construct() {
            parent::__construct();
            $this->load->database();
         }

         public function read(){
            $data = $this->db->get('customer')->result_array();
            return $data;
         }

         public function insert($address,$fname,$lname,$email){
             $cid = $address['city_id'];
             $result = $this->db->get_where('city',array('city_id'=>$cid))->row();
            //  print_r($result);
            //  die();
            if($result){
                $this->db->insert('address',$address);
                $last_id = $this->db->insert_id();
                $data = array(
                    'first_name'=>$fname,
                    'last_name'=>$lname,
                    'email'=>$email,
                    'address_id'=>$last_id
                );
                $status = $this->db->insert('customer',$data);
                if($status)
                return "added successfully";
                else
                return "not added";
            }
            else{
            return "city id doesnot exist";
        }
         }

         public function update($address,$cust_id,$fname,$lname,$email){
            $cid = $address['city_id'];
            $result = $this->db->get_where('city',array('city_id'=>$cid));
            if($result){
                $customer_data = $this->db->get_where('customer',array('customer_id'=>$cust_id))->result_array();
               print_r($customer_data);
               if($customer_data){
               foreach($customer_data as $data ){
                $address_id = $data['address_id'];
               }
                // $address_id = $customer_data['address_id'];
                $this->db->update('address',$address,array('address_id'=>$address_id));
               $array = array(
                   "first_name"=>$fname,
                   "last_name"=>$lname,
                   "email"=>$email
               );
               $this->db->update('customer',$array,array('customer_id'=>$cust_id));
               return "record updated successfully";
                print_r($address_id);
            }
            else{
                return "sorry invalid cutomer id";
            }
            } //result loop
         }

         public function delete($id){
            $this->db->query('SET FOREIGN_KEY_CHECKS=0');
             $result = $this->db->get_where('customer',array('customer_id'=>$id))->result_array();
             foreach($result as $data){
                $address_id = $data['address_id'];
             }
             $status = $this->db->delete('address',array('address_id'=>$address_id));
             if($status){
                 $status = $this->db->delete('customer',array('customer_id'=>$id));
                 $this->db->query('SET FOREIGN_KEY_CHECKS=1');
                 return $status;
             }

         }
        }
?>