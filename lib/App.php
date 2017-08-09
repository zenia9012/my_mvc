<?php

class App {

	public static $router; //+
	public static $db;

	/**
	 * @return mixed
	 */
	public static function getRouter() { //+
		return self::$router;
	}

	public static function run( $uri ) {
		self::$router = new Router( $uri ); //+
		self::$db     = DB::getInstance();

		Lang::load( self::$router->getLanguage() );

		$controllerClass  = ucfirst( self::$router->getController() ); //+
		$controllerMethod = self::$router->getMethodPrefix() . self::$router->getAction(); //+


		$layout = self::$router->getRoutes();//+
		if ( $layout == 'admin' ) {
			if ( $_SESSION['role'] != 'admin' ) {
				if ($controllerMethod != 'admin_login' ){
					Router::redirect( '/admin/user/login/' );
				}
			}
		}

		$obj = new $controllerClass;
		if ( class_exists( $controllerClass ) ) {
			if ( method_exists( $obj, $controllerMethod ) ) {
				$result  = $obj->$controllerMethod(); // +
				$viewObj = new Views( $obj->getData(), $result );//+
				$content = $viewObj->render();//+
			} else {
				throw new Exception( "Method {$controllerMethod} not found, class name : 
				{$controllerClass}" ); //+
			}
		} else {
			throw new Exception( "Class {$controllerClass} not found" ); //+
		}

		$layoutPath = VIEWS_PATH . DS . $layout . '.phtml'; //+
		$layoutObj  = new Views( compact( 'content' ), $layoutPath );
		echo $layoutObj->render();
	}

}