<?php

session_start();

require '../vendor/autoload.php';

use Slim\Psr7\Response;
use Slim\Factory\AppFactory;
use Slim\Middleware\MethodOverrideMiddleware;
use \app\controllers\Home;

$app = AppFactory::create();

require '../app/middlewares/logged.php';
require '../app/routes/auth.php';
require '../app/routes/site.php';

$methodOverrideMiddleware = new MethodOverrideMiddleware();
$app->add($methodOverrideMiddleware);

//Rotta 404
$app->map(['GET','POST','PUT','DELETE','PATCH'], '/{routes:.+}', Home::class.":notFound");

$app->run();