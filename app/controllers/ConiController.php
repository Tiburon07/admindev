<?php


namespace app\controllers;

use app\classes\Flash;
use app\classes\Validate;
use app\modules\AttivitaModel;
use app\modules\UserModel;
use Firebase\JWT\JWT;
use Psr\Log\LoggerInterface;

class ConiController extends BaseController
{
    private $user;
    private $validate;
    private $token;

    public function __construct(LoggerInterface $logger)
    {
        parent::__construct($logger);
        $config = parse_ini_file(__DIR__ . '/../config.ini', true);
        $this->user = new UserModel();
        $this->attivita = new AttivitaModel();
        $this->validate = new Validate();
        $this->token = JWT::encode([],$config['jwt']['token']);
    }

    public function getAttivitaView($request, $response){
        return $this->getTwig()->render($response, $this->setView('site/coni/attivita'), [
            'title' => 'Attivita',
            'menu' => 'coni',
            'submenu' => 'attivita',
            'token' => $this->token
        ]);
    }
}
