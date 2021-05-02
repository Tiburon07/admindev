<?php


namespace app\controllers;

use app\traits\Template;
use Psr\Log\LoggerInterface;

abstract class BaseController
{
    use Template;
    protected $logger;

    public function __construct(LoggerInterface $logger){
        $this->logger = $logger;
    }
}