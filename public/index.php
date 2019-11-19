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
    ProductsController::class => create(ProductsController::class)
        ->constructor(get('Response')),
        'Response' => function() {
            return new Response();
        },
    CategoriesController::class => create(CategoriesController::class)
        ->constructor(get('Response')),
        'Response' => function(){
          return new Response();
        },
    LogsController::class => create(LogsController::class)
        ->constructor(get('Response')),
        'Response' => function(){
          return new Response();
        }
]);

$container = $containerBuilder->build();

/*
* Define system routes
*
*/ 
$routes = simpleDispatcher(function (RouteCollector $route) {    
    //Routes for Dashboard
    $route->get('/', [ProductsController::class, 'index']);
    $route->get('/product/get', [ProductsController::class, 'getById']);
    $route->post('/product/add', [ProductsController::class, 'add']);
    $route->post('/product/delete', [ProductsController::class, 'delete']);
    $route->post('/product/update', [ProductsController::class, 'update']);
    $route->get('/products/import', [ProductsController::class, 'indexImport']);
    $route->post('/products/import', [ProductsController::class, 'processImport']);   

    //Routes for Categories
    $route->get('/categories', [CategoriesController::class, 'index']);
    $route->get('/category/get', [CategoriesController::class, 'getById']);
    $route->post('/category/add', [CategoriesController::class, 'add']);
    $route->post('/category/delete', [CategoriesController::class, 'delete']);
    $route->post('/category/update', [CategoriesController::class, 'update']);

    //Routes for Logs
    $route->get('/logs', [LogsController::class, 'index']);
});

$middlewareQueue[] = new FastRoute($routes);
$middlewareQueue[] = new RequestHandler($container);

$requestHandler = new Relay($middlewareQueue);
$response = $requestHandler->handle(ServerRequestFactory::fromGlobals());

$emitter = new SapiEmitter();

return $emitter->emit($response);