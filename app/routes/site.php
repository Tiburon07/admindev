<?php

use \app\controllers\Home;
use \app\controllers\Coni;

$app->get('/', Home::class.":index")->add($logged);
$app->get('/coni/ticket', Coni::class.":getTicket")->add($logged);