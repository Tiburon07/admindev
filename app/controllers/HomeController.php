<?php

namespace app\controllers;

use app\classes\Flash;
use app\classes\Validate;
use app\modules\UserModel;
use Firebase\JWT\JWT;
use Psr\Log\LoggerInterface;

class HomeController extends BaseController
{
    private $user;
    private $validate;
    private $token;

    public function __construct(LoggerInterface $logger) {
        parent::__construct($logger);
        $config = parse_ini_file(__DIR__ . '/../config.ini', true);
        $this->token = JWT::encode([],$config['jwt']['token'],"HS256");
        $this->user = new UserModel();
        $this->validate = new Validate();
    }

    public function index($request, $response){
        $this->logger->info('ciaone');
        $users = $this->user->find();
        $message = Flash::get('message');

        return $this->getTwig()->render($response, $this->setView('site/home'), [
            'title' => 'Home',
            'users' => $users,
            'message' =>  $message,
            'token' => $this->token
        ]);
    }

    public function notFound($request, $response){
        return $this->getTwig()->render($response, $this->setView('site/404'));
    }

    public function edit(){

    }
}
