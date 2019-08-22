<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Language extends REST_Controller {
    
    public function __construct() {
       parent::__construct();
       $this->load->model('language_model');
       $this->load->library('session');

    }
    public function index_get(){
       $response = $this->language_model->read();

       $this->response($response,REST_Controller::HTTP_OK);
    }

    public function index_post(){
        $data = $this->post();
        $status = $this->language_model->insert($data);

        if($status)
        echo "record added";
        else
        echo "some issue occured";
    }

    public function index_put(){
        $language_id = $this->put('language_id');
        $name = $this->put('name');

        $status = $this->language_model->update($language_id,$name);
        // print_r($status);
        // die();
        if($status)
        $this->response(['Record updated'],REST_Controller::HTTP_OK);
        else
        $this->response(['problem occured'],REST_Controller::HTTP_OK);
    }

    public function index_delete($id){
        $status = $this->language_model->delete($id);
        if($status)
        $this->response(['Record deleted'],REST_Controller::HTTP_OK);
        else
        $this->response(['problem occured'],REST_Controller::HTTP_OK);
    }
}
?>