<?php

class Database
{
    private static $dbHost = '127.0.0.1';
    private static $dbName = 'spotify';
    private static $dbUser = 'root';
    private static $dbPass = '';

    private static $dbConnection = null;
    private static $dbStatement = null;

    private static function connect()
    {
        if(is_null(self::$dbConnection)) {
            try {
                self::$dbConnection = new PDO(
                    'mysql:host=' . self::$dbHost . ';dbname=' . self::$dbName,
                    self::$dbUser,
                    self::$dbPass
                );
            } catch(PDOException $error) {

            }
        }
    }

    public static function query($sql, $placeholders = [])
    {
        self::connect();

        self::$dbStatement = self::$dbConnection->prepare($sql);
        self::$dbStatement->execute($placeholders);
    }

    public static function get()
    {
        if(!is_null(self::$dbStatement))
            return self::$dbStatement->fetch(PDO::FETCH_ASSOC);

        return [];
    }

    public static function getAll()
    {
        if(!is_null(self::$dbStatement))
            return self::$dbStatement->fetchAll(PDO::FETCH_ASSOC);

        return [];
    }
}