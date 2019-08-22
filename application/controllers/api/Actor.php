<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Actor extends REST_Controller {
    
    public function __construct() {
       parent::__construct();
       $this->load->model('actor_model');
       $this->load->library('session');

    }

    public function index_get(){
        $data = $this->actor_model->read();
        $this->response($data,REST_Controller::HTTP_OK);
    }

    public function index_post(){
        $f_name = $this->post('first_name');
        $l_name = $this->post('last_name');

        if($f_name == NULL || $l_name == NULL){
            $this->response("kindly enter both fields",REST_Controller::HTTP_OK);
        }
        else{
            $data = $this->post();
            $status = $this->actor_model->insert($data);
            if($status)
            if($status)
            $this->response("record added",REST_Controller::HTTP_OK);
            else
            $this->response("invalid film id",REST_Controller::HTTP_OK);
        }
       

    }

    public function index_put(){
        $id = $this->put('actor_id');
        
        $data = $this->put();
    if($id == NULL){
        $this->response('kindly enter the id');
    }
    else{
        $status = $this->actor_model->update($data,$id);
        
        $this->response($status,REST_Controller::HTTP_OK);
    }
    }

    public function index_delete($id){
        if($id == NULL){
            $this->response('kindly enter the id');
        }
        else{
            $status = $this->actor_model->delete($id);
            if($status)
            $this->response('record deleted',REST_Controller::HTTP_OK);
            else
            $this->response('invalid id',REST_Controller::HTTP_OK);
        }
    }
}