<?php


namespace app\database\modules;

use app\traits\Conn;
use app\traits\Create;
use app\traits\Delete;
use app\traits\Read;
use app\traits\Update;
use PDOException;

abstract class Base
{
    use Create, Read, Update,Delete, Conn;

}