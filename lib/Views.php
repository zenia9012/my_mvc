<?php
/**
 * Created by PhpStorm.
 * User: Yevhenii
 * Date: 28.07.2017
 * Time: 10:21
 */

class Views {
	public $data; //+
	protected $path; //+

	public function __construct( $data, $path = '' ) {
		if ( ! $path ) {
			$path = self::getDefaultPath();
		}
		if ( ! file_exists( $path ) ) { //+
			throw new Exception( "File {$path} not exists" );
		}
		$this->path = $path;
		$this->data = $data;
	}

	protected static function getDefaultPath() {
		$router = App::$router; //+
		if ( ! $router ) {
			return false;
		}
		$templateName = $router->getMethodPrefix() . $router->getAction() . '.phtml'; //+
		$templatePath = ROOT . DS . Config::get( 'views_dir' ) . DS . $router->getController() . DS . $templateName;//+

		return $templatePath;
	}

	public function render() {
		$data = $this->data;//+
		ob_start(); //+
		include( $this->path ); //+
		$content = ob_get_clean();

		return $content;
	}
}