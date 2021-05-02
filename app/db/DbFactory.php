<?php


namespace app\db;
use PDO;

class DbFactory
{

    public static function create(array $options){
        $dsn = '';
        if(!array_key_exists('driver',$options['database_locale'])){
            throw new \InvalidArgumentException('Nessun driver predefinito');
        }

        if(!array_key_exists('user',$options['database_locale'])){
            throw new \InvalidArgumentException('Nessun db_user impostato');
        }

        if(!array_key_exists('password',$options['database_locale'])){
            throw new \InvalidArgumentException('Nessun db_password impostata');
        }

        switch ($options['database_locale']['driver']){
            case 'mysql':
            case 'oracle':
            case 'mssql':
                $dsn = $options['database_locale']['driver'].':'.
                    'host='.$options['database_locale']['host'].';'.
                    'dbname='.$options['database_locale']['database'].';'.
                    'charset='.$options['database_locale']['charset'];
                break;
            case 'sqlite':
                $dsn = 'sqllite:'.$options['database_locale']['database'];
                break;
            default:
                throw new \InvalidArgumentException('Driver non impostato o sconosciuto');
        }
;
        $user = $options['database_locale']['user'];
        $password = $options['database_locale']['password'];
        $pdoOptions = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ];

        return DbPdo::getInstance(['dsn'=>$dsn, 'user'=>$user, 'password'=>$password, 'pdo_options'=>$pdoOptions]);
    }

}