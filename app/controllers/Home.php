<?php

namespace app\controllers;

use app\classes\Flash;
use app\classes\Validate;
use app\database\modules\User;

class Home extends Base
{
    private $user;
    private $validate;

    public function __construct() {
        $this->user = new User();
        $this->validate = new Validate();
    }

    public function index($request, $response){
        return $this->getTwig()->render($response, $this->setView('site/home'), [
            'title' => 'Home',
            'users' => '',
            'message' => ''
        ]);
    }

    public function edit(){

    }
}
