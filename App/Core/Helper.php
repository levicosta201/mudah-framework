<?php
declare(strict_types=1);
ob_start();
session_start();
/*
 * This file is part of the leviframework to projetc webjump.
 *
 * (c) Levi Costa <levi.costa1@gmail.com>
 *
 * For non-commercial use
 * 
 */


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

if(!function_exists('getFileData')){
	function getFileData($file)
	{
		if(!$file)
			return;

		$data = [];
		$file_explode = explode('.', $file['name']);
		$data['name'] = $file_explode[0];
		$data['extension'] = $file_explode[1];
		$data['tmp_name'] = $file['tmp_name'];

		return $data;
	}
}

if(!function_exists('generateRandFileName')) {
	function generateRandFileName() : string
	{
		return md5(uniqid(rand(), true));
	}
}

if(!function_exists('basePublicPath')) {
	function basePublicPath($path)
	{
		return dirname((__DIR__) . '', 2) . $path;
	}
}

if(!function_exists('uploadFile')) {
	function uploadFile($dir, $name, $extension, $tmp)
	{
		$file = $dir . basename($name . '.' .$extension);
		if(move_uploaded_file($tmp, $file))
			return '/images/product/' .$name . '.' .$extension;
		return false;
	}
}

if(!function_exists('moneyToReal')) {
	function moneyToReal($value) : string
	{
		return number_format($value, 2, ',', '.');
	}
}

if(!function_exists('saveSession')) {
	function saveSession($key, $value) : void
	{
		$_SESSION[$key] = $value;
	}
}

if(!function_exists('getSession')) {
	function getSession($key) : string
	{
		return $_SESSION[$key];
	}
}

if(!function_exists('stringToXml')) {
	function stringToXml($xml)
	{
		return simplexml_load_string($xml);
	}
}