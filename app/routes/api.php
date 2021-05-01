<?php

use \app\controllers\Home;

require '../middlewares/logged.php';

$app->get('/', Home::class.":index")->add($logged);