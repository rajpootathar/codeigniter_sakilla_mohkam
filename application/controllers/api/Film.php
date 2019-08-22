<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Film extends REST_Controller {
    
    public function __construct() {
       parent::__construct();
       $this->load->model('film_model');
       $this->load->library('session');

    }

    public function index_get(){
        $data = $this->film_model->read();

        $this->response($data,REST_Controller::HTTP_OK);
    }

    public function index_post(){
        $lang_id = $this->post('language_id');
        $data = $this->post();

        $status = $this->film_model->insert($lang_id,$data);

        if($status)
        $this->response("film added",REST_Controller::HTTP_OK);
        else
        $this->response('problem occured',REST_Controller::HTTP_OK);

    }

    public function index_put(){
        $lang_id = $this->put('language_id');
        $film_id = $this->put('film_id');
        $data = $this->put();

        $status = $this->film_model->update($lang_id,$film_id,$data);
        $this->response($status,REST_Controller::HTTP_OK);
    }
    public function index_delete($id){
        $status = $this->film_model->delete($id);
        if($status)
        $this->response(['Record deleted'],REST_Controller::HTTP_OK);
        else
        $this->response(['invalid film id'],REST_Controller::HTTP_OK);

    }

}
?>