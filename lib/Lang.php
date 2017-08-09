<?php
/**
 * Created by PhpStorm.
 * User: Yevhenii
 * Date: 29.07.2017
 * Time: 22:52
 */

class Lang {
	protected static $data;

	public static function load( $langCode ) {
		$langFilePath = ROOT . DS . 'lang' . DS . strtolower( $langCode ) . '.php';

		if ( file_exists( $langFilePath ) ) {
			self::$data = include $langFilePath;
		} else {
			throw new Exception( "Lang file not found : {$langFilePath}" );
		}
	}

	public static function get( $key, $defaultValue = '' ) {
		if (!isset(self::$data[strtolower($key)])){
			return $defaultValue;
		}
		return self::$data[strtolower($key)];
	}
}