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

        $users = $this->user->find();
        $message = Flash::get('message');

        return $this->getTwig()->render($response, $this->setView('site/home'), [
            'title' => 'Home',
            'users' => $users,
            'message' =>  $message
        ]);
    }

    public function notFound($request, $response){
        return $this->getTwig()->render($response, $this->setView('site/404'));
    }

    public function edit(){

    }
}
