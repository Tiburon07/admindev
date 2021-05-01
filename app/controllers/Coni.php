<?php


namespace app\controllers;

use app\classes\Flash;
use app\classes\Validate;
use app\database\modules\User;

class Coni extends Base
{
    private $user;
    private $validate;

    public function __construct()
    {
        $this->user = new User();
        $this->validate = new Validate();
    }

    public function getTicket($request, $response)
    {
        return $this->getTwig()->render($response, $this->setView('site/coni/ticket'), [
            'title' => 'Ticket',
        ]);
    }
}
