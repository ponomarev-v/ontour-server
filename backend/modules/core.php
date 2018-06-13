<?php

class Core
{
    /**
     * @return mysqlidb
     */
    static public $db;

    /**
     * @return mysqlidb
     */
    public static function DB()
    {
        if(empty(self::$db)) {
            self::$db = new mysqlidb(
                Config::DB_HOST,
                Config::DB_LOGIN,
                Config::DB_PASSWORD,
                Config::DB_NAME
            );
        }
        return self::$db;
    }
}