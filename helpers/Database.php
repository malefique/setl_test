<?php

namespace helpers;

use PDO;

class Database
{
    protected static $config;
    public static function connect()
    {
        self::$config = require_once (__DIR__.'/../config.php');
        return new PDO('mysql:host='.self::$config['db']['host'].';port='.self::$config['db']['port'].';dbname='.self::$config['db']['database'].';charset='.self::$config['db']['charset'],self::$config['db']['username'],self::$config['db']['password'],[
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
    }
}