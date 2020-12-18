<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
    Module Name: PROCRM Subscribes Module
    Description: PROCRM Subscribes module description.
    Author: Tsoy Vladlen
    Author URI: http://procrm.uz
    Version: 2.3.0
    Requires at least: 2.3.*
*/

define('PROCRM_SUBSCRIBES_MODULE_NAME', 'procrm_subscribes');

// Установить кнопку в меню
hooks()->add_action('admin_init', 'procrm_subscribes_init_menu_items');
// Добавить в ролях права
hooks()->add_filter('staff_permissions', 'procrm_subscribes_init_permissions');

$CI = &get_instance();

/**
 * Загрузите помощник procrm subscribes
 */
$CI->load->helper(PROCRM_SUBSCRIBES_MODULE_NAME . '/procrm_subscribes');

/**
 * Установить кнопку в меню
 */
function procrm_subscribes_init_menu_items()
{
    if (is_admin()) {
        $CI = &get_instance();

        if (is_admin() || has_permission(PROCRM_SUBSCRIBES_MODULE_NAME, '', 'view')) {
            $CI->app_menu->add_sidebar_menu_item('procrm_subscribes_menu', [
                'name' => _l('procrm_subscribes'),
                'collapse' => true,
                'position' => 11,
                'icon' => 'fa fa-id-card',
            ]);

            $CI->app_menu->add_sidebar_children_item('procrm_subscribes_menu', [
                'slug' => 'procrm_subscribes_sub_menu_history',
                'name' => _l('active'),
                'href' => admin_url('procrm_subscribes/active'),
                'position' => 1,
                'icon' => 'fa fa-history',
            ]);
        }

        if (is_admin() || has_permission(PROCRM_SUBSCRIBES_MODULE_NAME, '', 'setting')) {
            $CI->app_menu->add_sidebar_children_item('procrm_subscribes_menu', [
                'slug' => 'procrm_subscribes_sub_menu_setting',
                'name' => _l('settings'),
                'href' => admin_url('procrm_subscribes/setting'),
                'position' => 2,
                'icon' => 'fa fa-cog',
            ]);
        }
    }
}

/**
 * Добавить права в ролях
 * @param $data
 * @return mixed
 */
function procrm_subscribes_init_permissions($data)
{

    $data[PROCRM_SUBSCRIBES_MODULE_NAME] = [
        'name' => _l('procrm_subscribes'),
        'capabilities' => [
            'view' => _l('permission_active'),
            'setting' => _l('permission_setting'),
        ],
    ];

    return $data;
}

/**
 * Зарегистрировать hook модуля активации
 */
register_activation_hook(PROCRM_SUBSCRIBES_MODULE_NAME, 'procrm_subscribes_module_activation_hook');

function procrm_subscribes_module_activation_hook()
{
    $CI = &get_instance();
    require_once(__DIR__ . '/install.php');
}

/**
 * Зарегистрируйте языковые файлы, необходимо зарегистрировать, если модуль использует языки
 */
register_language_files(PROCRM_SUBSCRIBES_MODULE_NAME, [PROCRM_SUBSCRIBES_MODULE_NAME]);