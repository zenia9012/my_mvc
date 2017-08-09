<?php


class Model {
	protected $db;
	protected $pdo;

	public function __construct() {
		$this->db = App::$db; /// ???????

		$this->pdo = new \PDO( 'mysql: host=localhost; dbname=zurba-mvc', 'root', '' );
		$this->pdo->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );
	}
}

