<?php

namespace EShopPhp\Config;

class Database
{
    private static ?\PDO $pdo = null;

    public static function getConnection(string $env = "test"): \PDO
    {
        if (self::$pdo == null) {
            require_once __DIR__ . "/../../config/Database.php";
            $config = getDatabaseConfig();
            self::$pdo = new \PDO(
                $config['database'][$env]['url'],
                $config['database'][$env]['username'],
                $config['database'][$env]['password']
            );
        }

        return self::$pdo;
    }

    public static function beginTransaction()
    {
        Database::$pdo->beginTransaction();
    }

    public static function commitTransaction()
    {
        Database::$pdo->commit();
    }

    public static function rollbackTransaction()
    {
        Database::$pdo->rollBack();
    } 
}