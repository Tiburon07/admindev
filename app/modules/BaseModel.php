<?php


namespace app\modules;

use app\db\DbFactory;
use app\traits\Create;
use app\traits\Delete;
use app\traits\Read;
use app\traits\Update;

abstract class BaseModel
{
    use Create, Read, Update, Delete;

    protected $conn;
    public $error;

    public function __construct(){
        $config = parse_ini_file(__DIR__ . '/../config.ini', true);
        $pdo = DbFactory::create($config);
        $this->conn = $pdo->getConn();
    }

}