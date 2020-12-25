<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Вывод месяцев
 * @param $mount
 * @return string
 */
function procrm_subscribes_mount($mount)
{
    if ($mount >= 2 && $mount <= 4)
        return $mount . ' ' . _l('months');
    elseif ($mount >= 5)
        return $mount . ' ' . _l('_months');

    return $mount . ' ' . _l('month');
}