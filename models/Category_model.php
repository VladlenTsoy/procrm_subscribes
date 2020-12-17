<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category_model extends App_Model
{
    /**
     * Создать категорию
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
     * Вывод всех категорий
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
     * Вывод по Id
     * @param $id
     * @return bool
     */
    public function getById($id)
    {
        $this->db->where('id', $id);
        $result = $this->db->get(db_prefix() . 'procrm_subscribes_categories')->row_array();
        if ($result) {
            return $result;
        }

        return false;
    }

    /**
     * Обновление по Id
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
     * Удалить категории по ids
     * @param $ids
     * @return bool
     */
    public function delete($ids)
    {
        if($ids) {
            $this->db->where_not_in('id', $ids);
            $this->db->delete(db_prefix() . 'procrm_subscribes_categories');
            return true;
        }
        return false;
    }

    /**
     * Вывод всех кроме ids
     * @param $ids
     * @return bool
     */
    public function getByNotIds($ids)
    {
        if($ids) {
            $this->db->where('id NOT IN (' . implode(',', $ids) . ')');
            return $this->db->get(db_prefix() . 'procrm_subscribes_categories')->result_array();
        }
        return false;
    }
}