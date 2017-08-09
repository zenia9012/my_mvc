<?php
/**
 * Created by PhpStorm.
 * User: Yevhenii
 * Date: 25.07.2017
 * Time: 18:37
 */

class Router {
	protected $uri;//+
	protected $controller;//+
	protected $action;//+
	protected $param;//+
	protected $newUri;
	protected $language; //+
	protected $routes; //+

	public static function redirect( $location ) {
		header("Location: "  . $location );
	}
	/**
	 * @return string
	 */
	public function getRoutes(): string {
		return $this->routes;
	}

	protected $methodPrefix;

	/**
	 * @return mixed
	 */
	public function getLanguage() {
		return $this->language;
	}

	/**
	 * @return mixed
	 */
	public function getUri() {
		return $this->uri;
	}

	/**
	 * @return mixed
	 */
	public function getController() {
		return $this->controller;
	}

	/**
	 * @return mixed
	 */
	public function getAction() {
		return $this->action;
	}

	/**
	 * @return mixed
	 */
	public function getParam() {
		return $this->param;
	}

	public function __construct( $uri ) {
		$this->uri          = urldecode( trim( $uri, '/' ) ); //+
		$routs            = Config::get( 'routes' ); //+
		$this->routes       = Config::get( 'default_route' ); //+
		$this->methodPrefix = isset( $router[ $this->routes ] ) ? $routs[ $this->routes ] : '';
		$this->language     = Config::get( 'default_language' );//+
		$this->controller   = Config::get( 'default_controller' );//+
		$this->action       = Config::get( 'default_action' );//+

		$uriParts     = explode( '?', $this->uri );//+
		$uriFirstPart = isset( $uriParts[0] ) ? $uriParts[0] : $this->uri;//+
		$uriArray     = explode( '/', $uriFirstPart );//+

		if ( count( $uriArray ) ) {
			// get route or language at first element
			if ( in_array( strtolower( current( $uriArray ) ), array_keys( $routs ) ) ) {
				$this->routes       = strtolower( current( $uriArray ) );//+
				$this->methodPrefix = isset( $routs[ $this->routes ] ) ? $routs[ $this->routes ] : '';
				array_shift( $uriArray );//+
			} elseif ( in_array( strtolower( current( $uriArray ) ), Config::get( 'language' ) ) ) {
				$this->language = strtolower( current( $uriArray ) );//+
				array_shift( $uriArray );//+
			}

			//get controller
			if ( current( $uriArray ) ) {
				$this->controller = strtolower( current( $uriArray ) );
				array_shift( $uriArray );
			}

			//get action
			if ( current( $uriArray ) ) {
				$this->action = strtolower( current( $uriArray ) );
				array_shift( $uriArray );
			}

			//get param - all the rest
			$this->param = $uriArray;
		}
	}

	/**
	 * @return string
	 */
	public function getMethodPrefix(): string {
		return $this->methodPrefix;
	}

	public function getRealUri( $strUri = '' ) {
		if ( $strUri && Config::get( 'dir' ) ) {
			$dirArray  = explode( '/', Config::get( 'dir' ) );
			$arrayUri  = explode( '/', $strUri );
			$isInArray = false;
			foreach ( $dirArray as $key => $dirPart ) {
				if (!empty($dirPart) && $dirPart == $arrayUri[ $key ] ) {
					array_shift( $arrayUri );
					$isInArray = true;
				}
			}
			if ( ! $isInArray ) {
				throw new Exception( "Config parameter {Config::get('dir')}" );
			}

			return $arrayUri;
		}

		return false;
	}

}