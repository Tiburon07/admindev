<?php
declare(strict_types=1);

require __DIR__ . "/middlewares/LoggedMiddleware.php";

use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use app\controllers\UserController;
use app\controllers\AuthController;
use app\controllers\ConiController;
use app\controllers\HomeController;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', HomeController::class.":index")->add(new LoggedMiddleware());

    $app->group('/auth', function (Group $group) {
        //GET
        $group->get('/login', AuthController::class.":getLoginView");
        $group->get('/register', AuthController::class.":getRegisterView");
        $group->get('/logout', AuthController::class.":logout");
        //POST
        $group->post('/login', AuthController::class.":login");
        $group->post('/store', UserController::class.":createUser");
    });

    $app->group('/api', function (Group $group){
        //GET
        $group->get('/getUsers', UserController::class.":getUsers")->add(new LoggedMiddleware());
        $group->get('/getFsn', ConiController::class.":getFsn")->add(new LoggedMiddleware());
        $group->get('/getAttivita', ConiController::class.":getAttivita")->add(new LoggedMiddleware());

        //POST
        $group->post('/createAttivita', ConiController::class.":createAttivita")->add(new LoggedMiddleware());
    });

    $app->get('/coni/attivita', ConiController::class.":getAttivitaView")->add(new LoggedMiddleware());

    //Rotta 404
    $app->map(['GET','POST','PUT','DELETE','PATCH'], '/{routes:.+}', HomeController::class.":notFound")->add(new LoggedMiddleware());
};
