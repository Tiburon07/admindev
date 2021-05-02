<?php
declare(strict_types=1);

use Slim\App;
use app\middlewares\SessionMiddleware;
use Tuupola\Middleware\JwtAuthentication;
use Slim\Middleware\MethodOverrideMiddleware;

return function (App $app) {

    $app->add(new MethodOverrideMiddleware());

    $app->add(new JwtAuthentication([
        "secret" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c",
        "path" => "coni/getUsers"
    ]));
};
