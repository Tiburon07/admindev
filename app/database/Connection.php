<?php

namespace app\database;
use PDO;
use PDOException;

class Connection
{

    private static $pdo = null;

    public static function conn(){
        if(static::$pdo){
            return static::$pdo;
        }

        try {
            static::$pdo = new PDO('mysql:host=db4free.net;dbname=admindev','tiburon','yamahaMT07', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ]);

            return static::$pdo;
        }catch (PDOException $e){
            var_dump($e->getMessage());
        }
    }

}