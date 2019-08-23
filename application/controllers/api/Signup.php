<?php

require APPPATH . 'libraries/REST_Controller.php';

class Signup extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('signup_model');
        $this->load->library('session');

    }

    // public function index_get(){

    //     $data = $this->sakila_model->read();
    //     if($data)
    //     $this->response($data,REST_Controller::HTTP_OK);
    //     else
    //     $this->response(['error occured'],REST_Controller::HTTP_OK);

    // }

    public function index_post()
    {
        $address = $this->post('address');
        $fname = $this->post('first_name');
        $lname = $this->post('last_name');
        $email = $this->post('email');
        $uname = $this->post('username');
        $password = $this->post('password');

        $status = $this->signup_model->insert($address, $fname, $lname, $email, $uname, $password);
        if ($status) {
            $this->response($status, REST_Controller::HTTP_OK);
        } else {
            $this->response(['problem occured'], REST_Controller::HTTP_OK);
        }

    }

    // public function index_put(){
    //     $category_id = $this->put('category_id');
    //     print_r($category_id);
    //     $this->session->set_userdata('category_id',$category_id);
    //     $c_name = $this->put('name');
    //     print_r($c_name);
    //     $this->session->set_userdata('c_name',$c_name);

    //     $status = $this->sakila_model->update();
    //     if($status)
    //     $this->response(['Record updated'],REST_Controller::HTTP_OK);
    //     else
    //     $this->response(['problem occured'],REST_Controller::HTTP_OK);

    // }

    // public function index_delete($id){
    //     echo $id;
    //     $this->session->set_userdata('category_id',$id);
    //     $status = $this->sakila_model->delete();
    //     if($status)
    //     $this->response(['Record deleted'],REST_Controller::HTTP_OK);
    //     else
    //     $this->response(['problem occured'],REST_Controller::HTTP_OK);
    // }
}
