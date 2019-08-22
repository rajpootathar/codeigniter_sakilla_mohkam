<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Inventory extends REST_Controller {
    
    public function __construct() {
       parent::__construct();
       $this->load->model('inventory_model');
       $this->load->library('session');

    }

    public function index_get(){
        $data = $this->inventory_model->read();
        $this->response($data,REST_Controller::HTTP_OK);
    }

    public function index_post(){
        $id = $this->post('film_id');
        $data = $this->post();
        if($id == NULL){
            $this->response("null value is not allowed",REST_Controller::HTTP_OK);
        }
        else{
            $status = $this->inventory_model->insert($data,$id);
            if($status)
            $this->response("record added",REST_Controller::HTTP_OK);
            else
            $this->response("invalid film id",REST_Controller::HTTP_OK);

        }
    }

    public function index_put(){
        $film_id = $this->put('film_id');
        $inv_id = $this->put('inventory_id');
        
        if($film_id == NULL || $inv_id == NULL){
            $this->response("null value is not allowed",REST_Controller::HTTP_OK);
        }
        else{
            $status = $this->inventory_model->update($film_id,$inv_id);
            if($status)
            $this->response("record updated",REST_Controller::HTTP_OK);
            else
            $this->response("invalid film id",REST_Controller::HTTP_OK);
        }
    }
    public function index_delete($id = 0){
        if($id == NULL || $id == 0){
            $this->response("kindly enter the id");
        }
        else{
            $status = $this->inventory_model->delete($id);
            if($status)
            $this->response('record deleted',REST_Controller::HTTP_OK);
            else
            $this->response('invalid id',REST_Controller::HTTP_OK);
        }

    }
}