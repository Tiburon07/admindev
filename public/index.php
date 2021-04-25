<?php

session_start();

require '../vendor/autoload.php';

use Slim\Factory\AppFactory;
use Slim\Middleware\MethodOverrideMiddleware;

$app = AppFactory::create();
require '../app/routes/site.php';
require '../app/routes/user.php';

$methodOverrideMiddleware = new MethodOverrideMiddleware();
$app->add($methodOverrideMiddleware);

$app->add(function ($request, $handler) {// solving CORS issues
    $response = $handler->handle($request);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

$app->map(['GET','POST','PUT','DELETE','PATCH'], '/{routes:.+}', function ($request, $response){
   $response->getBody()->write('Somethig wrong');
   return $response;
});

$app->run();