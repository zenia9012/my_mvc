<?php
/**
 * Created by PhpStorm.
 * User: Yevhenii
 * Date: 27.07.2017
 * Time: 15:20
 */

class Page extends Controller {

	public function __construct( array $data = [] ) {
		parent::__construct( $data );
		$this->model = new PageModels();
	}

	public function index() {
		$this->data['pages'] = $this->model->pageList();
	}

	public function view() {
		$paramArray = App::$router->getParam();//+

		if ( isset( $paramArray[0] ) ) {
			$allias              = strtolower( $paramArray[0] );
			$this->data['alias'] = $this->model->getPage( $allias );
		}
	}

	public function admin_index() {
		$this->data['pages'] = $this->model->pageListAdmin();
	}

	public function admin_edit() {
		if ( $_POST ) {
			$result = $this->model->editPage();
			if (! $result ) {
				Session::setUserMessage( 'Error' );
			}
			Router::redirect( '/admin/page/' );
			Session::setUserMessage( 'Page was saved' );
		}

		$paramArray = App::$router->getParam();
		if ( isset( $paramArray[0] ) && is_numeric( $paramArray[0] ) ) {
			$this->data['pages'] = $this->model->getById( $paramArray[0] );
		} else {
			Session::setUserMessage( 'wrong page id' );
			Router::redirect( '/admin//' );
		}

	}

	public function admin_Add() {
		if ( $_POST ) {
			$result = $this->model->savePage();
			if ( $result ) {
				Session::setUserMessage( 'Page was saved' );
			} else {
				Session::setUserMessage( 'Error' );
			}
			Router::redirect( '/admin/page/' );
		}
	}

	public function admin_delete() {
		$paramArray = App::$router->getParam();
		$result     = $this->model->delete( $paramArray[0] );
		if ( $result ) {
			Session::setUserMessage( 'Page was deleted' );
		} else {
			Session::setUserMessage( 'Error' );
		}
			Router::redirect('/admin/page');
	}
}