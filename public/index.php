<?php

/*
 * This file is part of the leviframework to projetc webjump.
 *
 * (c) Levi Costa <levi.costa1@gmail.com>
 *
 * For non-commercial use
 * 
 */

use \App\Controller\ProductsController as ProductsController;
use \App\Controller\LogsController as LogsController;
use \App\Controller\CategoriesController as CategoriesController;

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
    \App\Controller\AuthController::class => create(\App\Controller\AuthController::class)
        ->constructor(get('Response')),

    \App\Controller\Api\AuthApiController::class => create(\App\Controller\Api\AuthApiController::class)
        ->constructor(get('Response'), get('AuthService')),

    \App\Services\AuthService::class => create(\App\Services\AuthService::class)
        ->constructor(get('UserRepository')),

    \App\Controller\ClientsController::class => create(\App\Controller\ClientsController::class)
        ->constructor(get('ClientService'), get('AddressService')),

    \App\Controller\Api\ClientsApiController::class => create(\App\Controller\Api\ClientsApiController::class)
        ->constructor(get('ClientService')),

    \App\Controller\AddressController::class => create(\App\Controller\AddressController::class)
        ->constructor(get('AddressService'), get('ClientService')),

    \App\Controller\Api\AddressApiController::class => create(\App\Controller\Api\AddressApiController::class)
        ->constructor(get('AddressService')),

    'Response' => function() {
        return new Response();
    },

    'AuthService' => function(\DI\Container $container) {
        return new \App\Services\AuthService($container->get('UserRepository'));
    },

    'ClientService' => function(\DI\Container $container) {
        return new \App\Services\ClientService($container->get('ClientRepository'));
    },

    'AddressService' => function(\DI\Container $container) {
        return new \App\Services\AddressService($container->get('AddressRepository'));
    },

    'UserRepository' => function(\DI\Container $container) {
        return new \App\Repositories\UserRepository($container->get('User'));
    },

    'ClientRepository' => function(\DI\Container $container) {
        return new \App\Repositories\ClientRepository($container->get('Client'));
    },

    'AddressRepository' => function(\DI\Container $container) {
        return new \App\Repositories\AddressRepository($container->get('Address'), $container->get('Client'));
    },

    'User' => function() {
        return new \App\Model\User();
    },

    'Client' => function() {
        return new \App\Model\Client();
    },

    'Address' => function() {
        return new \App\Model\Address();
    }
]);

$container = $containerBuilder->build();

/*
* Define system routes
*
*/ 
$routes = simpleDispatcher(function (RouteCollector $route) {    
    //Routes for Dashboard
    $route->get('/', [\App\Controller\AuthController::class, 'index']);

    $route->addGroup('/clients', function (RouteCollector $route) {
        $route->addRoute('GET', '', [\App\Controller\ClientsController::class, 'index']);
        $route->addRoute('GET', '/', [\App\Controller\ClientsController::class, 'index']);
        $route->addRoute('GET', '/add', [\App\Controller\ClientsController::class, 'add']);
        $route->addRoute('GET', '/edit/{id}', [\App\Controller\ClientsController::class, 'edit']);
    });

    $route->addGroup('/address', function (RouteCollector $route) {
        $route->addRoute('GET', '', [\App\Controller\AddressController::class, 'index']);
        $route->addRoute('GET', '/', [\App\Controller\AddressController::class, 'index']);
        $route->addRoute('GET', '/add', [\App\Controller\AddressController::class, 'add']);
        $route->addRoute('GET', '/edit/{id}', [\App\Controller\AddressController::class, 'edit']);
    });

    $route->addGroup('/api', function (RouteCollector $route) {
        $route->addRoute('POST', '/login', [\App\Controller\Api\AuthApiController::class, 'index']);

        $route->addGroup('/clients', function (RouteCollector $route) {
            $route->addRoute('POST', '/add', [\App\Controller\Api\ClientsApiController::class, 'add']);
            $route->addRoute('POST', '/delete', [\App\Controller\Api\ClientsApiController::class, 'delete']);
            $route->addRoute('POST', '/edit', [\App\Controller\Api\ClientsApiController::class, 'edit']);
        });

        $route->addGroup('/address', function (RouteCollector $route) {
            $route->addRoute('POST', '/add', [\App\Controller\Api\AddressApiController::class, 'add']);
            $route->addRoute('POST', '/delete', [\App\Controller\Api\AddressApiController::class, 'delete']);
            $route->addRoute('POST', '/edit', [\App\Controller\Api\AddressApiController::class, 'edit']);
        });
    });
});

$middlewareQueue[] = new FastRoute($routes);
$middlewareQueue[] = new RequestHandler($container);

$requestHandler = new Relay($middlewareQueue);
$response = $requestHandler->handle(ServerRequestFactory::fromGlobals());

$emitter = new SapiEmitter();

return $emitter->emit($response);