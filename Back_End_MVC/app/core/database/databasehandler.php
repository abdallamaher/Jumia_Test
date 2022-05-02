<?php

namespace App\Core\Database;

abstract class DatabaseHandler
{
    const DATABASE_DRIVER_POD       = 1;
    const DATABASE_DRIVER_MYSQLI    = 2;
    const DATABASE_DRIVER_SQLITE    = 3;

    private function __construct() {}

    public static function factory()
    {
        $driver = DATABASE_CONN_DRIVER;
        if ($driver == self::DATABASE_DRIVER_POD) {
            return PDODatabaseHandler::getInstance();
        } elseif ($driver == self::DATABASE_DRIVER_MYSQLI) {
            return MySQLiDatabaseHandler::getInstance();
        } elseif ($driver == self::DATABASE_DRIVER_SQLITE) {
            return SqliteDataBaseHandler::getInstance();
        }
    }
}