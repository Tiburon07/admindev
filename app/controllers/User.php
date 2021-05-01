<?php


namespace app\controllers;
use app\classes\Flash;
use app\classes\Login;
use app\classes\Validate;
use \app\database\modules\User as UserModel;

class User extends Base
{
    private $user;
    private $validate;
    private $login;

    public function __construct() {
        $this->user = new UserModel();
        $this->validate = new Validate();
        $this->login = new Login();
    }

    public function register($request, $response, $args){
        $messages = Flash::getAll();
        return $this->getTwig()->render($response, $this->setView('site/login_register/register'), [
            'title' => 'Registrazione',
            'messages' => $messages
        ]);
    }

    public function login($request, $response){
        $messages = Flash::getAll();
        return $this->getTwig()->render($response, $this->setView('site/login_register/login'), [
            'title' => 'Login',
            'messages' => $messages
        ]);
    }

    public function loginUser($request, $response){
        $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);
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

        Flash::set('message', 'Errore in fase di login, tentare nuovamente o contattare l\'amministratore', 'error');
        return redirect($response, '/auth/login');

    }

    public function store($request, $response, $args){
        $username = filter_input(INPUT_POST,'username', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);

        $this->validate->required(['username', 'email', 'password'])->exist($this->user,'email', $email);
        $errors = $this->validate->getErrors();

        if($errors){
            Flash::flashes($errors);
            return redirect($response, "/auth/register");
        }

        $created = $this->user->create(['username' => $username, 'email' => $email, 'password' => password_hash($password, PASSWORD_DEFAULT)]);

        if($created) {
            $this->login->login($email,$password);
            return redirect($response, '/');
        }

        Flash::set('message', 'Si è verificato un errore in fase di registrazione');
        return redirect($response, "/auth/register");
    }

    public function update($request, $response, $args){
        var_dump('aggiorna');
        return $response;
    }

    public function logout($request, $response, $args){
        $this->login->logout();
        return redirect($response,'/auth/login');
    }
}