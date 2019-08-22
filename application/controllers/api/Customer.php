<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Customer extends REST_Controller {
    
    public function __construct() {
       parent::__construct();
       $this->load->model('customer_model');
       $this->load->library('session');

    }

    public function index_get(){
        $response = $this->customer_model->read();

        $this->response([$response],REST_Controller::HTTP_OK);
    }

    public function index_post(){
        $address = $this->post('address');
        $fname = $this->post('first_name');
        $lname = $this->post('last_name');
        $email = $this->post('email');

        $status = $this->customer_model->insert($address,$fname,$lname,$email);
        if($status)
        $this->response($status,REST_Controller::HTTP_OK);
        else
        $this->response(['problem occured'],REST_Controller::HTTP_OK);

    }

    public function index_put(){
        $address = $this->put('address');
        $cust_id = $this->put('customer_id');
        $fname = $this->put('first_name');
        $lname = $this->put('last_name');
        $email = $this->put('email');
       
        $status = $this->customer_model->update($address,$cust_id,$fname,$lname,$email);

        $this->response($status,REST_Controller::HTTP_OK);
    }

    public function index_delete($id){
        $status = $this->customer_model->delete($id);
        if($status)
        $this->response(['Record deleted'],REST_Controller::HTTP_OK);
        else
        $this->response(['problem occured'],REST_Controller::HTTP_OK);
    }

}
?>