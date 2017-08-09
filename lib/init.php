<?php

require( ROOT . DS . 'config' . DS . 'config.php' ); //+

spl_autoload_register( function ( $className ) { //+
	$filename       = strtolower( $className . '.php' );
	$libPath        = ROOT . DS . 'lib' . DS . $filename;
	$controllerPath = ROOT . DS . 'controllers' . DS . $filename;
	$modelsPath     = ROOT . DS . 'models' . DS . $filename;
	if ( file_exists( $libPath ) ) {
		require_once $libPath;
	} elseif ( file_exists( $controllerPath ) ) {
		require_once $controllerPath;
	} elseif ( file_exists( $modelsPath ) ) {
		require_once $modelsPath;
	} else {
		throw new Exception( "{$filename} not found !!! " );
	}
} );

function __( $key, $defaultValue = '' ){
	return Lang::get($key, $defaultValue);//+
}
