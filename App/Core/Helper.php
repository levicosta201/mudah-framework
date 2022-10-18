<?php
declare(strict_types=1);
ob_start();
session_start();

/**
 * Function to get real url from app
 * @param url_complete
 * @var String $param
 */
if(!function_exists('url')) {
    function url($param) : string
    {
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
            $link = "https";
        else
            $link = "http";

        $link .= "://";

        $link .= $_SERVER['HTTP_HOST'];

        if($param)
            return $link . '/' .$param;
        return $link;
    }
}

if(!function_exists('basePublicPath')) {
    function basePublicPath($path)
    {
        return dirname((__DIR__) . '', 2) . $path;
    }
}

if(!function_exists('saveSession')) {
    function saveSession($key, $value) : void
    {
        $_SESSION[$key] = $value;
    }
}

if(!function_exists('getSession')) {
    function getSession($key)
    {
        return $_SESSION[$key] ?? '';
    }
}

if (!function_exists('cleanString')) {
    function cleanString($string)
    {
        $string = str_replace(' ', '', $string);
        $string = str_replace('-', '', $string);
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    }
}
