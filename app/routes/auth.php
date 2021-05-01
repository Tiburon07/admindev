<?php

use \app\controllers\User;

$app->get('/auth/login', User::class.":login");
$app->post('/auth/login', User::class.":loginUser");
$app->get('/auth/logout', User::class.":logout");
$app->get('/auth/register', User::class.":register");
$app->post('/auth/store', User::class.":store");
$app->put('/auth/update', User::class.":update");
$app->delete('/auth/delete', User::class.":destroy");
