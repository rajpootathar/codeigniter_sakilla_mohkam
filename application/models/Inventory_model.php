<?php
class Inventory_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function read()
    {
        $data = $this->db->get('inventory')->result_array();
        return $data;
    }

    public function insert($data, $id)
    {
        $result = $this->db->get_where('film', array('film_id' => $id))->result_array();
        if ($result) {
            $status = $this->db->insert('inventory', $data);
            return $status;
        } else {
            return false;
        }

    }

    public function update($film_id, $inv_id)
    {
        $result = $this->db->get_where('inventory', array('inventory_id' => $inv_id))->result_array();
        if ($result) {
            $result = $this->db->get_where('film', array('film_id' => $film_id))->result_array();
            if ($result) {
                $array = array(
                    'film_id' => $film_id,
                );
                $status = $this->db->update('inventory', $array, array('inventory_id' => $inv_id));
                return $status;
            } else {
                return false;
            }

        } else {
            return false;
        }

    }

    public function delete($id)
    {
        $result = $this->db->get_where('inventory', array('inventory_id' => $id))->result_array();
        // print_r($result);
        // die();
        if ($result) {
            $this->db->query('SET FOREIGN_KEY_CHECKS=0');
            $status = $this->db->delete('inventory', array('inventory_id' => $id));
            $this->db->query('SET FOREIGN_KEY_CHECKS=0');
            return $status;
        } else {
            return false;
        }

    }

}
