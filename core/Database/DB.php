<?php

namespace Core\Database;

use Exception;
use PDOException;

class DB
{
    private static ?\PDO $pdo = null;

    private function __construct()
    {
        // 
    }

    public static function connection(): \PDO
    {
        global $app;

        if ($app->config->dbName === null) {
            throw new Exception("Database name not configured");
        }
        if ($app->config->dbHost === null) {
            throw new Exception("Database host not configured");
        }
        if ($app->config->dbPort === null) {
            throw new Exception("Database port not configured");
        }
        if ($app->config->dbUser === null) {
            throw new Exception("Database user not configured");
        }
        if ($app->config->dbPass === null) {
            throw new Exception("Database password not configured");
        }

        try {
            if (self::$pdo == null) {
                self::$pdo = new \PDO("mysql:host=" . $app->config->dbHost . ";dbname=" . $app->config->dbName, $app->config->dbUser, $app->config->dbPass);
                self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            }
            return self::$pdo;
        } catch (PDOException $th) {
            throw $th;
        }
    }
}
