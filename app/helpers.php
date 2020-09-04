<?php

/**
 * 对id进行hash
 * @function: hashIdEncode
 * @date: 2020/8/14
 * @user: hesunfly
 * @param $id
 * @param string $connection
 * @return mixed
 */
function hashIdEncode($id, $connection = 'main')
{
    return \Vinkla\Hashids\Facades\Hashids::connection($connection)->encode($id);
}

/**
 * 对hash的id值进行反转
 * @function: hashIdDecode
 * @date: 2020/8/14
 * @user: hesunfly
 * @param $str
 * @param string $connection
 * @return mixed
 */
function hashIdDecode($str, $connection = 'main')
{
    return \Vinkla\Hashids\Facades\Hashids::connection($connection)->decode($str)[0];
}

function base64encode($str)
{
    if (empty($str)) {
        return '';
    }
    $str = base64_encode($str);
    $str = str_replace(['+', '/', '='], ['!', '.', ':'], $str);
    return $str;
}

function base64decode($str)
{
    if (empty($str)) {
        return '';
    }
    $str = str_replace(['!', '.', ':'], ['+', '/', '='], $str);
    $str = base64_decode($str);
    return $str;
}