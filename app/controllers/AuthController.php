<?php

namespace app\controllers;

use app\classes\Flash;
use app\classes\Login;
use app\classes\Validate;
use app\modules\UserModel;
use Psr\Log\LoggerInterface;

class AuthController extends BaseController {
    private $user;
    private $validate;
    private $login;

    public function __construct(LoggerInterface $logger){
        parent::__construct($logger);
        $this->user = new UserModel();
        $this->validate = new Validate();
        $this->login = new Login();
    }

    public function getRegisterView($request, $response, $args){
        $messages = Flash::getAll();
        return $this->getTwig()->render($response, $this->setView('site/login_register/register'), [
            'title' => 'Registrazione',
            'messages' => $messages
        ]);
    }

    public function getLoginView($request, $response){
        $messages = Flash::getAll();
        return $this->getTwig()->render($response, $this->setView('site/login_register/login'), [
            'title' => 'Login',
            'messages' => $messages
        ]);
    }

    public function login($request, $response){
        $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);

        //Validazione input
        $this->validate->required(['email', 'password'])->email($email);
        $errors = $this->validate->getErrors();
        if($errors){
            Flash::flashes($errors);
            return redirect($response, '/auth/login');
        }

        $logged = $this->login->login($email,$password);

        if($logged){
            return redirect($response, '/');
        }

        Flash::set('message', 'Email o password errate, tentare nuovamente o contattare l\'amministratore', 'error');
        return redirect($response, '/auth/login');

    }

    public function logout($request, $response, $args){
        $this->login->logout();
        return redirect($response,'/auth/login');
    }
}