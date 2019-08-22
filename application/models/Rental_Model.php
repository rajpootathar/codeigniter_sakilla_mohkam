<?php 
    class Rental_Model extends CI_Model{
        public function __construct() {
            parent::__construct();
            $this->load->database();
         
        }

        public function insert($film_id,$customer_id,$staff_id){
            $result = $this->db->get_where('customer',array('customer_id'=>$customer_id))->result_array();
            if($result){
                $result = $this->db->get_where('staff',array('staff_id'=>$staff_id))->result_array();
                if($result){
                    $result = $this->db->select('inventory_id')->get_where('inventory',array('film_id'=>$film_id))->result_array();
            // print_r($result);
        //    $inventory_id = array();
            foreach($result as $key =>$value){
                // echo $result[$key]= $value['inventory_id'];
                // echo "<br>";
                $inventory_id[] = $value['inventory_id'];
            }
       
            $result = $this->db->select('inventory_id,is_returned')->where_in('inventory_id',$inventory_id)->get('rental')->result_array();
            // print_r($result);
            // die();
            foreach($result as $key=>$value){
                $inv_id[] = $value['inventory_id'];
                $is_returned[] = $value['is_returned'];
            }
// print_r($inv_id);
// die();
            $myArray = array(
                'inventory_id'=>$inventory_id,
                'inv_id'=>$inv_id,
                'is_returned'=>$is_returned
            );
            $diff = array_diff($inventory_id,$inv_id);
            // print_r($diff);
            if($diff){
                foreach($diff as $key){
                    $inventory_key = $key;
                }

                $data = array(
                    'inventory_id'=>$inventory_key,
                    'customer_id' => $customer_id,
                    'staff_id'=>$staff_id
                );
                $this->db->insert('rental',$data);
                return "Record entered alloted on rent";
                }
                else{
                    
                foreach($is_returned as $result){
                    // echo $result;
                    if($result != 0){
                        $free = $this->db->select('inventory_id')->get_where('rental',array('is_returned'=>$result))->result_array();
                        print_r($free);
                        foreach($free as $inventory => $value){
                            $inventory_free = $value['inventory_id'];
                        }//foreach inside if of foreach
                        $data = array(
                            'inventory_id'=>$inventory_free,
                            'customer_id' => $customer_id,
                            'staff_id'=>$staff_id
                        );
                    $this->db->insert('rental',$data);
                    return "Record entered alloted on rent";
                    }//if inside foreach
                
                }    //foreach of isreturned
                
            }//else if $diff if
            
        }
        
    }
            
            
            // foreach($myArray as $key => $value){
            //     echo $myArray[$key] = $value; 
            // }
            // print_r($myArray);


            // print_r($result);
            // print_r($array);
        }

        }