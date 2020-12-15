<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!$CI->db->table_exists(db_prefix() . 'procrm_subscribes_categories')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() . "procrm_subscribes_categories` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');

    $CI->db->query('ALTER TABLE `' . db_prefix() . 'procrm_subscribes_categories`
  ADD PRIMARY KEY (`id`);');

    $CI->db->query('ALTER TABLE `' . db_prefix() . 'procrm_subscribes_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT');
}