<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Active_subscribe_model extends App_Model
{
    /**
     * Создание
     * @param $data
     * @return boolean
     */
    public function create($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        if ($this->db->insert(db_prefix() . 'procrm_active_subscribes', $data)) {
            return $this->db->insert_id();
        }

        return false;
    }

    /**
     *
     * @param $id
     * @param $data
     * @return boolean
     */
    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update(db_prefix() . 'procrm_active_subscribes', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }
}