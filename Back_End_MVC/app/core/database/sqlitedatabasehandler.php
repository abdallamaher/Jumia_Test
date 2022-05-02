<?php

namespace App\Core\Database;

class SqliteDataBaseHandler extends DatabaseHandler
{

    private static $_handler;

    private function __construct(){
        self::init();
    }

    protected static function init()
    {
        try {
            var_dump('here');
            self::$_handler = new \PDO('sqlite:sample.db');
            var_dump('here');
        } catch (\PDOException $e) {

        }
    }

    public static function getInstance()
    {
        if(self::$_handler === null) {
            self::$_handler = new self();
        }
        return self::$_handler;
    }

    public function prepare()
    {

    }
}