<?php

/**
 * @Author: xuren
 * @Date:   2019-05-09 10:08:07
 * @Last Modified by:   xuren
 * @Last Modified time: 2019-05-09 10:08:45
 */
class RetentionCntByDayModel{
	static $_table = 'reg_retention_cnt_day';
	static $_pk = 'id';
	static $_db_key = "kxgame_log";
	static $_db = null;

	static function db(){
		if(self::$_db)
			return self::$_db;
		
		self::$_db = DbLib::getDbStatic(self::$_db_key,self::$_table,self::$_pk);
		return self::$_db;
	}
	
	public static function __callStatic($func, $arguments){
		return call_user_func_array(array(self::db(),$func), $arguments);
	}

}