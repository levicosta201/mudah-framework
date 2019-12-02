<?php

/*
 * This file is part of the leviframework to projetc webjump.
 *
 * (c) Levi Costa <levi.costa1@gmail.com>
 *
 * For non-commercial use
 * 
 */

use \App\Controller\DashboardController as DashboardController;
use \App\Controller\LoginController as LoginController;
use \App\Controller\RepositorieController as RepositorieController;

use Zend\Diactoros\ServerRequestFactory;
use function FastRoute\simpleDispatcher;
use Narrowspark\HttpEmitter\SapiEmitter;
use Middlewares\RequestHandler;
use FastRoute\RouteCollector;
use Zend\Diactoros\Response;
use Middlewares\FastRoute;
use DI\ContainerBuilder;
use function DI\create;
use function DI\get;
use BC\Blade\Blade;
use Relay\Relay;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

$containerBuilder = new ContainerBuilder();
$containerBuilder->useAutowiring(false);
$containerBuilder->useAnnotations(false);
$containerBuilder->addDefinitions([
    DashboardController::class => create(DashboardController::class)
        ->constructor(get('Response')),
        'Response' => function() {
            return new Response();
        },
    LoginController::class => create(LoginController::class)
        ->constructor(get('Response')),
        'Response' => function() {
            return new Response();
        },
    RepositorieController::class => create(RepositorieController::class)
        ->constructor(get('Response')),
        'Response' => function() {
            return new Response();
        },
]);

$container = $containerBuilder->build();

/*
* Define system routes
*
*/ 
$routes = simpleDispatcher(function (RouteCollector $route) {    
    //Routes for Dashboard
    $route->get('/', [
        LoginController::class, 
        'index',
    ]);

    $route->get('/logout', [
        LoginController::class, 
        'logout',
    ]);

    $route->get('/github/callback/', [
        LoginController::class, 
        'gitHubCallBackLogin',
    ]);

    $route->get('/auth/dashboard/', [
        DashboardController::class, 
        'index',
    ]);

    $route->get('/auth/repo/detail/', [
        RepositorieController::class,
        'detail',
    ]);

    $route->get('/auth/search/', [
        DashboardController::class, 
        'search',
    ]);

});

$middlewareQueue[] = new FastRoute($routes);
$middlewareQueue[] = new RequestHandler($container);

$requestHandler = new Relay($middlewareQueue);
$response = $requestHandler->handle(ServerRequestFactory::fromGlobals());

$emitter = new SapiEmitter();

return $emitter->emit($response);