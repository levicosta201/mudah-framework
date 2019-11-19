<?php

/*
 * This file is part of the leviframework to projetc webjump.
 *
 * (c) Levi Costa <levi.costa1@gmail.com>
 *
 * For non-commercial use
 * 
 */

use DI\ContainerBuilder;
use Core\Kernel\Router;
use Core\Kernel\Request;

if(getenv('APP_ENV') != 'production') {
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
}

require_once dirname(__DIR__) . '/vendor/autoload.php';

/*
* Require helper to use dd() function similar Laravel
*
*/
require dirname(__DIR__) . '/vendor/larapack/dd/src/helper.php';

/*
 * Read .env file with up one level
 *
 */
$dotenv = Dotenv\Dotenv::create(dirname(__DIR__, 1));
$dotenv->overload();

$router = new Router(new Request);
require_once dirname(__FILE__, 2) . '/App/Routes/web.php';
	
	