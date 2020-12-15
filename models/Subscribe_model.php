<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subscribe_model extends App_Model
{
    /**
     * .
     * @param $data
     * @return boolean
     */
    public function create($data)
    {
        if ($this->db->insert(db_prefix() . 'procrm_subscribes', $data)) {
            return $this->db->insert_id();
        }

        return false;
    }

    /**
     * @return bool
     */
    public function getAll()
    {
        $result = $this->db->get(db_prefix() . 'procrm_subscribes')->result_array();
        if ($result) {
            return $result;
        }

        return false;
    }
}