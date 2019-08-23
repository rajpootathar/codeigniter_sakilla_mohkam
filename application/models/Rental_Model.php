<?php
class Rental_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();

    }
    public function insert($film_id, $customer_id, $staff_id)
    {
        $result = $this->db->get_where('customer', array('customer_id' => $customer_id))->result_array();
        if ($result) {
            $result = $this->db->get_where('staff', array('staff_id' => $staff_id))->result_array();
            if ($result) {
                $result = $this->db->select('inventory_id')->where('film_id', $film_id)->where('rented_out', 0)->get('inventory')->result_array();
                $inventory_free = null;
                foreach ($result as $data) {
                    $inventory_free = $data['inventory_id'];
                }

                // print_r($inventory_free);
                // die();

                if ($inventory_free != null) {
                    $result = $this->db->select('rental_duration,rental_rate')->get_where('film', array('film_id' => $film_id))->result_array();
                    // print_r($result);

                    $rent = $result[0]['rental_duration'];
                    $rate = $result[0]['rental_rate'];

                    $date = date('Y-m-d', strtotime("+" . $rent . " days"));
                    $rental = $rent * $rate;

                    $data = array(
                        'inventory_id' => $inventory_free,
                        'customer_id' => $customer_id,
                        'return_date' => $date,
                        'staff_id' => $staff_id,

                    );

                    $status = $this->db->insert('rental', $data);
                    if ($status) {
                        $rent_id = $this->db->insert_id('rental');
                        $data = array(
                            'customer_id' => $customer_id,
                            'staff_id' => $staff_id,
                            'rental_id' => $rent_id,
                            'amount' => $rental,
                        );
                        $status = $this->db->insert('payment', $data);
                        if ($status) {
                            $this->db->set('rented_out', $rent_id)->where('inventory_id', $inventory_free)->update('inventory');
                            $response = array(
                                'success' => true,
                                'message' => "record added, film is rented out",
                            );
                            return $response;
                        } else {
                            $response = array(
                                'success' => false,
                                'message' => "error occured while adding in payment",
                            );
                            return $response;
                        }
                    } else {
                        $response = array(
                            'success' => false,
                            'message' => "error occured while entering in rental",
                        );
                        return $response;
                    }
                } else {
                    $response = array(
                        'success' => false,
                        'message' => "no film is free ",
                    );
                    return $response;
                }
            } else {
                $response = array(
                    'success' => false,
                    'message' => "invalid staff id",
                );
                return $response;
            }
        } else {
            $response = array(
                'success' => false,
                'message' => "invalid customer id",
            );
            return $response;
        }

    }
    public function update($id)
    {
        $inv_id_rental = $this->db->select('inventory_id')->get_where('rental', array('rental_id' => $id))->result_array();

        if ($inv_id_rental) {

            $this->db->set('rented_out', 0)->where('inventory_id', $inv_id_rental[0]['inventory_id'])->where('rented_out', $id)->update('inventory');

            if ($this->db->affected_rows() == 1) {
                $response = array(
                    'success' => true,
                    'message' => "film returned, record updated",
                );
                return $response;
            } else {
                $response = array(
                    'success' => false,
                    'message' => "u entered an invalid rental id, no film is alloted on this id",
                );
                return $response;
            }
        } else {
            $response = array(
                'success' => false,
                'message' => "invalid rental id",
            );
            return $response;
        }
    }
    public function check($film_id)
    {
        $response = array(
            'suucees' => true,
            'message' => 'recieved',
        );
        return $response;
    }

    //     public function insert($film_id,$customer_id,$staff_id){
    //         $result = $this->db->get_where('customer',array('customer_id'=>$customer_id))->result_array();
    //         if($result){
    //             $result = $this->db->get_where('staff',array('staff_id'=>$staff_id))->result_array();
    //             if($result){
    //                 $result = $this->db->select('inventory_id')->get_where('inventory',array('film_id'=>$film_id))->result_array();

    //         foreach($result as $key =>$value){

    //             $inventory_id[] = $value['inventory_id'];
    //         }

    //         $result = $this->db->select('inventory_id,is_returned')->where_in('inventory_id',$inventory_id)->get('rental')->result_array();

    //         foreach($result as $key=>$value){
    //             $inv_id[] = $value['inventory_id'];
    //             $is_returned[] = $value['is_returned'];
    //         }

    //         $myArray = array(
    //             'inventory_id'=>$inventory_id,
    //             'inv_id'=>$inv_id,
    //             'is_returned'=>$is_returned
    //         );

    //         $diff = array_diff($inventory_id,$inv_id);

    //         if($diff){
    //             foreach($diff as $key){
    //                 $inventory_key = $key;
    //             }

    //             $data = array(
    //                 'inventory_id'=>$inventory_key,
    //                 'customer_id' => $customer_id,
    //                 'staff_id'=>$staff_id
    //             );
    //             $this->db->insert('rental',$data);
    //             return "Record entered alloted on rent";
    //             }
    //             else{

    //             foreach($is_returned as $result){
    //                 if($result != 0){
    //                     $free = $this->db->select('inventory_id')->get_where('rental',array('is_returned'=>$result))->result_array();
    //                     print_r($free);
    //                     foreach($free as $inventory => $value){
    //                         $inventory_free = $value['inventory_id'];
    //                     }//foreach inside if of foreach
    //                     $data = array(
    //                         'inventory_id'=>$inventory_free,
    //                         'customer_id' => $customer_id,
    //                         'staff_id'=>$staff_id
    //                     );
    //                 $this->db->insert('rental',$data);
    //                 return "Record entered alloted on rent";
    //                 }

    //             }

    //         }

    //     }

    // }

    //     }

}
