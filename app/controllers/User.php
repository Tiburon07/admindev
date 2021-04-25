<?php


namespace app\controllers;
use app\classes\Flash;
use \app\database\modules\User as UserModel;

class User extends Base
{
    private $user;

    public function __construct() {
        $this->user = new UserModel();
    }


    public function create($request, $response, $args){

        $users = $this->user->find();
        $message = Flash::get('message');

        return $this->getTwig()->render($response, $this->setView('site/user_create'), [
            'title' => 'User Create',
            'users' => $users,
            'message' => $message
        ]);
    }

    public function store($request, $response, $args){
        var_dump('registrato');
        return $response;
    }

    public function update($request, $response, $args){
        var_dump('aggiorna');
        return $response;
    }

    public function destroy($request, $response, $args){
        var_dump('elimina');
        return $response;
    }

}