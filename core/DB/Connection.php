<?php

namespace Core\DB;

use Config\Config;
use PDO;

class Connection
{
    protected static PDO|null $connection = null;

    public static function connect(): PDO
    {
        if(is_null(static::$connection)){
            $dsn = 'mysql:host=' . Config::get('db.host') . ';'
                . 'port=' . Config::get('db.port') . ';'
                . 'dbname=' . Config::get('db.database') . ';'
                . 'charset=utf8';
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
                ];

            static::$connection = new PDO(
                $dsn,
                Config::get('db.user'),
                Config::get('db.password'),
                $options
            );

            return static::$connection;
        }

        return static::$connection;
    }
}