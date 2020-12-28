<?php
defined('BASEPATH') or exit('No direct script access allowed');

$CI = &get_instance();

// Категория абонементов
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

// Абонементы
if (!$CI->db->table_exists(db_prefix() . 'procrm_subscribes')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() . "procrm_subscribes` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` int(40) NOT NULL,
  `duration` int(11) NOT NULL,
  `frost_days` int(11) NOT NULL,
  `time` JSON NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');

    $CI->db->query('ALTER TABLE `' . db_prefix() . 'procrm_subscribes`
  ADD PRIMARY KEY (`id`);');

    $CI->db->query('ALTER TABLE `' . db_prefix() . 'procrm_subscribes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT');
}

// Активные абонементы
if (!$CI->db->table_exists(db_prefix() . 'procrm_active_subscribes')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() . "procrm_active_subscribes` (
  `id` int(11) NOT NULL,
  `subscribe_id` int(11) NOT NULL,
  `lead_id` int(11) NOT NULL,
  `used_frost_days` int(11) NOT NULL,
  `status` ENUM('active', 'frozen', 'past') DEFAULT 'active',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');

    $CI->db->query('ALTER TABLE `' . db_prefix() . 'procrm_active_subscribes`
  ADD PRIMARY KEY (`id`);');

    $CI->db->query('ALTER TABLE `' . db_prefix() . 'procrm_active_subscribes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT');
}