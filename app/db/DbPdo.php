<?php


namespace app\db;

use PDO;

class DbPdo {

    protected $conn;
    protected static $instance;

    protected function __construct(array $options){
        $this->conn = new PDO(
            $options['dsn'],
            $options['user'],
            $options['password'],
            $options['pdo_options']
        );
    }

    public static function getInstance(array $options){
        if(!self::$instance){
            self::$instance = new static($options);
        }
        return self::$instance;
    }

    public function getConn(){
        return $this->conn;
    }
}