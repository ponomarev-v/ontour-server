<?php

class Core
{
    static public $db;

    /**
     * @return MysqliDb
     */
    public static function DB()
    {
        if(empty(self::$db)) {
            self::$db = new MysqliDb(
                Config::DB_HOST,
                Config::DB_LOGIN,
                Config::DB_PASSWORD,
                Config::DB_NAME
            );
        }
        return self::$db;
    }
}