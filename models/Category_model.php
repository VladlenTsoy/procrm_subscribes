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

    /**
     * @param $id
     * @param $data
     * @return bool
     */
    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update(db_prefix() . 'procrm_subscribes_categories', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * @param $ids
     * @return bool
     */
    public function delete($ids)
    {
        if($ids) {
            $this->db->where('id NOT IN (' . implode(',', $ids) . ')');
            $this->db->delete(db_prefix() . 'procrm_subscribes_categories');
            return true;
        }
        return false;
    }
}