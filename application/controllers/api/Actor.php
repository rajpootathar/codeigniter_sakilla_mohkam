<?php

require APPPATH . 'libraries/REST_Controller.php';

class Actor extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('actor_model');
        $this->load->library('session');

    }

    public function index_get()
    {
        $data = $this->actor_model->read();
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function index_post()
    {
        $f_name = $this->post('first_name');
        $l_name = $this->post('last_name');

        if ($f_name == null || $l_name == null) {
            $response = array(
                'success' => false,
                'message' => "kindly enter both fields",
            );
            $this->response($response, REST_Controller::HTTP_OK);
        } else {
            $data = $this->post();
            $status = $this->actor_model->insert($data);
            if ($status) {
                $response = array(
                    'success' => true,
                    'message' => "record added",
                );
                $this->response($response, REST_Controller::HTTP_OK);
            } else {
                $response = array(
                    'success' => false,
                    'message' => "invalid film id",
                );
                $this->response($response, REST_Controller::HTTP_OK);
            }

        }

    }

    public function index_put()
    {
        $id = $this->put('actor_id');

        $data = $this->put();
        if ($id == null) {
            $this->response('kindly enter the id');
        } else {
            $status = $this->actor_model->update($data, $id);

            $this->response($status, REST_Controller::HTTP_OK);
        }
    }

    public function index_delete($id)
    {
        if ($id == null) {
            $response = array(
                'success' => false,
                'message' => "kindly enter the id",
            );
            $this->response($response, REST_Controller::HTTP_OK);
        } else {
            $status = $this->actor_model->delete($id);
            if ($status) {
                $response = array(
                    'success' => true,
                    'message' => "record deleted",
                );
                $this->response($response, REST_Controller::HTTP_OK);
            } else {
                $response = array(
                    'success' => false,
                    'message' => "invalid id",
                );
                $this->response($response, REST_Controller::HTTP_OK);
            }

        }
    }
}
