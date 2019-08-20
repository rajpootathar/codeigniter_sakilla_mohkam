<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Item extends REST_Controller {
    
	  /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
       $this->load->database();
       
    }
       
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
	public function index_get($id = 0)
	{
        if(!empty($id)){
            $data = $this->db->get_where("items", ['id' => $id])->row_array();
        }else{
            $data = $this->db->get("items")->result();
        }
     
        $this->response($data, REST_Controller::HTTP_OK);
	}
      
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index_post()
    {
        // $input = array(
        //   'title' => 'abc',
        //   'description' => 'xyz'  
        // );
        // $input = array(
        //     'title' => $this->post("title"),
        //     'description' => $this->post("description")
        // );
        
        $input = $this->post();
        // $input = $this->input->post();
        // $json = json_decode($input);
        print_r($input);
        // print_r($input2);
        // print_r($_POST);
        //  die('dieing');
        // $this->db->set($input);
        $this->db->insert('items',$input);
     
        $this->response(['Item created successfully.'], REST_Controller::HTTP_OK);
    } 
     
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index_put($id)
    {
        $id = $this->put('id');
        $array = array(
            'title' => $this->put("title"),
            'description' => $this->put("description")
        );
        // $input = $this->put();
        echo $id;
        print_r($array);
        //  $this->db->where('id',$id);
        $this->db->update('items', $array,array('id'=>$id));
     
        $this->response(['Item updated successfully.'], REST_Controller::HTTP_OK);
    }
     
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index_delete($id)
    {
        $this->db->delete('items', array('id'=>$id));
       
        $this->response(['Item deleted successfully.'], REST_Controller::HTTP_OK);
    }
    	
}