<?php

class Database
{
    private static $connection;

    public static function getConnection()
    {
        if (!self::$connection) {
            $host = '127.0.0.1'; //localhost
            $db = 'api_db';
            $user = 'root';
            $pass = 'password';

            $dsn = "mysql:host=$host;dbname=$db;charset=utf8";
            self::$connection = new PDO($dsn, $user, $pass);
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$connection;
    }
}
