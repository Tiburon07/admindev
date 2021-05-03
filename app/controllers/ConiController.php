<?php


namespace app\controllers;

use app\classes\Error;
use app\classes\Payload;
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
    private $attivita;

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

    public function getFsn($request, $response){
        $payload = new Payload();
        $federazioni = $this->attivita->getFsn();
        $payload->setData($federazioni['data']);

        if($federazioni['status']){
            $payload->setStatusCode(500);
            $payload->setError(new Error(Error::SERVER_ERROR,$federazioni['message']));
        }

        $response->getBody()->write(json_encode($payload, JSON_PRETTY_PRINT));
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function createAttivita($request, $response){
        $payload = new Payload();
        $body = json_decode($request->getBody(),true);

        $created = $this->attivita->create($body);
        if($created['status']){
            $payload->setStatusCode(500);
            $payload->setError(new Error(Error::SERVER_ERROR,$created['message']));
        }

        $response->getBody()->write(json_encode($payload, JSON_PRETTY_PRINT));
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function getAttivita($request, $response, $args){
        $payload = new Payload();
        $attivita = $this->attivita->find();
        $payload->setData($attivita['data']);

        if($attivita['status']){
            $payload->setStatusCode(500);
            $payload->setError(new Error(Error::SERVER_ERROR,$attivita['message']));
        }

        $response->getBody()->write(json_encode($payload, JSON_PRETTY_PRINT));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
