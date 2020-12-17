<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subscribe_model extends App_Model
{
    /**
     * Создание
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
     * Обновление по id
     * @param $id
     * @param $data
     * @return bool
     */
    public function updateById($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update(db_prefix() . 'procrm_subscribes', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * Вывод по категории
     * @param $categoryId
     * @return bool
     */
    public function getGetCategoryId($categoryId)
    {
        $this->db->where('category_id', $categoryId);
        $result = $this->db->get(db_prefix() . 'procrm_subscribes')->result_array();
        if ($result) {
            return $result;
        }

        return false;
    }

    /**
     * Вывод по Id
     * @param $id
     * @return bool
     */
    public function getById($id)
    {
        $this->db->where('id', $id);
        $result = $this->db->get(db_prefix() . 'procrm_subscribes')->row_array();
        if ($result) {
            return $result;
        }

        return false;
    }

    /**
     * Удаление по Id
     * @param $id
     * @return bool
     */
    public function deleteById($id)
    {
        if ($id) {
            $this->db->where('id', $id);
            $this->db->delete(db_prefix() . 'procrm_subscribes');
            return true;
        }
        return false;
    }
}