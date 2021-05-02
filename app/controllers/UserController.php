<?php

namespace app\controllers;
use app\classes\EnumErrors;
use app\classes\Error;
use app\classes\Flash;
use app\classes\Login;
use app\classes\Payload;
use app\classes\Validate;
use app\modules\UserModel;
use Psr\Log\LoggerInterface;

class UserController extends BaseController
{
    private $userModel;
    private $validate;
    private $login;

    public function __construct(LoggerInterface $logger) {
        parent::__construct($logger);
        $this->userModel = new UserModel();
        $this->validate = new Validate();
        $this->login = new Login();
    }

    public function getUsers($request, $response, $args){
        $payload = new Payload();
        $users = $this->userModel->getUsers();
        $payload->setData($users['data']);

        if($users['status']){
            $payload->setStatusCode(500);
            $payload->setError(new Error(Error::SERVER_ERROR,$users['message']));
        }

        $response->getBody()->write(json_encode($payload, JSON_PRETTY_PRINT));
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function createUser($request, $response, $args){
        $username = filter_input(INPUT_POST,'username', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);

        $this->validate->required(['username', 'email', 'password'])->exist($this->userModel,'email', $email);
        $errors = $this->validate->getErrors();

        if($errors){
            Flash::flashes($errors);
            return redirect($response, "/auth/register");
        }

        $created = $this->userModel->create(['username' => $username, 'email' => $email, 'password' => password_hash($password, PASSWORD_DEFAULT)]);

        if(!$created['status'] && $created['data']) {
            $this->login->login($email,$password);
            return redirect($response, '/');
        }

        Flash::set('message', 'Si è verificato un errore in fase di registrazione');
        return redirect($response, "/auth/register");
    }
}