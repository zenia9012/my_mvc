<?php
require '../lib/Config.php';

Config::set( 'site_name', 'mvc' ); //+
Config::set( 'language', [ 'en', 'uk' ] ); //+

Config::set( 'routes', [ 'default' => '', 'admin' => 'admin_' ] ); //+
Config::set( 'default_route', 'layout' );//+
Config::set( 'default_language', 'en' ); //+
Config::set( 'default_controller', 'page' ); //+
Config::set( 'default_action', 'index' ); //+

Config::set( 'dir', 'zurba-mvc' );
Config::set( 'views_dir', 'views' );

//PDO

Config::set('db_host', 'localhost');
Config::set('db_name', 'zurba-mvc');
Config::set('db_user', 'root');
Config::set('db_pass', '');


Config::set('salt', 'wygfuyergfiuer312');

