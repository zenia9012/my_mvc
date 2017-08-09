<?php

define( 'DS', DIRECTORY_SEPARATOR ); //+
define( 'ROOT', dirname( __DIR__ ) ); //+
define( 'VIEWS_PATH', ROOT . DS . 'views' ); // !!new

require_once( ROOT . DS . 'lib' . DS . 'init.php' );

session_start();

try {
	App::run( $_SERVER['REQUEST_URI'] ); //+
} catch ( Exception $e ) {
	echo 'page not found! Error 404 ' . '<br>' . $e->getMessage() . '<br>' . 'return to : ' . '<a href="http://zurba-mvc/page/index/">Home</a>';
}

