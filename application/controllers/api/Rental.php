<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Rental extends REST_Controller {
    
    public function __construct() {
       parent::__construct();
       $this->load->model('rental_model');
       $this->load->library('session');

    }

    public function index_post(){
        $film_id = $this->post('film_id');
        $customer_id = $this->post('customer_id');
        $staff_id = $this->post('staff_id');

        $status = $this->rental_model->insert($film_id,$customer_id,$staff_id);
        
        $this->response($status,REST_Controller::HTTP_OK);
       
    }
}
    ?>