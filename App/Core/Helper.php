<?php
declare(strict_types=1);
ob_start();
session_start();

use Jenssegers\Blade\Blade;

if(!function_exists('view')) {
	function view(string $view, array $data = [])
	{
		$blade =  new Blade(dirname(__DIR__).'/View', dirname(__DIR__).'/Cache/View');
		
		try {
			return $blade->make($view, $data);
		} catch(\Exception $e) {
			//not forget: create new Exception class for beuaty view to show and simplify error 
			//for easy user customer
			echo $e->getMessage();
		}
	}
}

/**
  * Function to get real url from app
  * @param url_complete
  * @var String $param
  */
if(!function_exists('url')) {
	function url($param)
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

if(!function_exists('saveSession')) {
	function saveSession(string $key, $value) : void
	{
		$_SESSION[$key] = $value;
	}
}

if(!function_exists('removeSession')) {
	function removeSession(string $key) : void
	{
		unset($_SESSION[$key]);
	}
}

if(!function_exists('getSession')) {
	function getSession(string $key)
	{
		return $_SESSION[$key] ?? '';
	}
}

if(!function_exists('redirect')) {
	function redirect($url)
	{
		return dd(header('Location: ' . url($url)));
	}
}

if(!function_exists('storeUserData')) {
	function storeUserData()
	{

	}
}

if(!function_exists('getUserData')) {
	function getUserData()
	{
		
	}
}

if(!function_exists('changeBorderColor')) {
	function changeBorderColor($language)
	{
		switch ($language) {
			case 'php':
				return 'primary';
				break;
			case 'java':
				return 'success';
				break;
			case 'javascript':
				return 'info';
				break;
			case 'c':
				return 'warning';
				break;
			case 'c++':
				return 'danger';
				break;			
			default:
				return 'primary';
				break;
		}
	}
}