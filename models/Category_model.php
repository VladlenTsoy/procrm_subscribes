<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category_model extends App_Model
{
    /**
     * .
     * @param $data
     * @return boolean
     */
    public function create($data)
    {
        if ($this->db->insert(db_prefix() . 'procrm_subscribes_categories', $data)) {
            return $this->db->insert_id();
        }

        return false;
    }

    /**
     * @return bool
     */
    public function getAll()
    {
        $result = $this->db->get(db_prefix() . 'procrm_subscribes_categories')->result_array();
        if ($result) {
            return $result;
        }

        return false;
    }
}