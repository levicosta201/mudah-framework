<?php

/*
 * This file is part of the naframework to projetc webjump.
 *
 * (c) na Costa <na.costa1@gmail.com>
 *
 * For non-commercial use
 * 
 */

use App\Controller\IndexController;
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
    IndexController::class => create(IndexController::class)
        ->constructor(get('Response')),
        'Response' => function() {
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
    $route->get('/', [IndexController::class, 'index']);
    $route->get('/checkout', [IndexController::class, 'checkout']);
    $route->post('/address', [IndexController::class, 'address']);
    $route->get('/order', [IndexController::class, 'order']);
    $route->put('/buy', [IndexController::class, 'buy']);
    $route->get('/finish', [IndexController::class, 'finish']);
    $route->get('/thankyou', [IndexController::class, 'thankyou']);
});

$middlewareQueue[] = new FastRoute($routes);
$middlewareQueue[] = new RequestHandler($container);

$requestHandler = new Relay($middlewareQueue);
$response = $requestHandler->handle(ServerRequestFactory::fromGlobals());

$emitter = new SapiEmitter();

return $emitter->emit($response);