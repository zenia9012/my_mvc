<?php
/**
 * Created by PhpStorm.
 * User: Yevhenii
 * Date: 31.07.2017
 * Time: 13:19
 */

class Session {
	public static $userMessage;

	/**
	 * @param mixed $userMessage
	 */
	public static function setUserMessage( $userMessage ) {
		self::$userMessage = $userMessage;
	}

	public static function hasUserMessage() {
		return isset( self::$userMessage ) ? true : false;
	}

	public static function echoMessage() {
		echo self::$userMessage;
		self::$userMessage = null;
	}

	public static function set( $key, $value ) {
		$_SESSION[$key] = $value;
	}

	public static function get($key){
		if (isset($_SESSION[$key])){
			return $_SESSION['key'];
		}
		return false;
	}

	public static function delete( $key ) {
		if (isset($_SESSION[$key])){
			unset($_SESSION[$key]);
		}
	}

	public static function destroy(  ) {
		session_destroy();
	}

}