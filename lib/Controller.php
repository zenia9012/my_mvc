<?php
/**
 * Created by PhpStorm.
 * User: Yevhenii
 * Date: 27.07.2017
 * Time: 15:11
 */

class Controller {
	public $data; //+
	protected $model; //+
	protected $params; //+

	/**
	 * @return mixed
	 */
	public function getData() {
		return $this->data;
	}

	/**
	 * @return mixed
	 */
	public function getModel() {
		return $this->model;
	}

	/**
	 * @return mixed
	 */
	public function getParams() {
		return $this->params;
	}

	public function __construct( $data = []) { //+
		$this->data = $data;
		$this->params = App::$router->getParam;
	}
}