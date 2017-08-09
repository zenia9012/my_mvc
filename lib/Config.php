<?php
/**
 * Created by PhpStorm.
 * User: Yevhenii
 * Date: 25.07.2017
 * Time: 17:21
 */

class Config
{
	protected static $settings = []; //+

	public static function get( $key ) {//+
		if(isset(self::$settings[$key])){
			return self::$settings[$key];
		}else{
			return null;
		}
	}

	public static function set( $key, $value ) {
		self::$settings[$key] = $value;
	}
}