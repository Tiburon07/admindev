<?php


namespace app\traits;

use \app\database\Connection;

trait Conn
{
    protected $conn;

    public function __construct(){
        $this->conn = Connection::conn();
    }
}