<?php

/**
 * Desc: open_bank 表
 * User: haopeng
 * Date: 2019/3/7 14:44
 */
class bankModel
{
    public static $_table = 'open_bank';
    public static $_pk = 'id';
    public static $_db_key = DEF_DB_CONN;
    public static $_db = null;

    public static function db ()
    {
        if (self::$_db)
            return self::$_db;

        self::$_db = DbLib::getDbStatic(self::$_db_key, self::$_table, self::$_pk);
        return self::$_db;
    }

    public static function __callStatic ($func, $arguments)
    {
        return call_user_func_array(array(self::db(), $func), $arguments);
    }

}