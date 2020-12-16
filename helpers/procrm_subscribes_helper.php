<?php
defined('BASEPATH') or exit('No direct script access allowed');
define('PROCRM_SUBSCRIBES_VERSIONING', '2.6.1');


/**
 * @param $mount
 * @return string
 */
function procrm_subscribes_mount($mount)
{
    if ($mount >= 2 && $mount <= 4)
        return $mount . ' месяца';
    elseif ($mount >= 5)
        return $mount . ' месяцев';

    return $mount . ' месяц';
}