<?php
/**
 * Created by PhpStorm.
 * User: Yevhenii
 * Date: 30.07.2017
 * Time: 9:53
 */

class Contact extends Controller {

	public function __construct( array $data = [] ) {
		parent::__construct( $data );
		$this->model = new FeedbackModel();
	}

	public function index() {
		if ( $_POST ) {
			if ( $this->model->save( $_POST ) ) {
				Session::setUserMessage( 'Thank you ! you message was send' );
			} else {
				Session::setUserMessage( 'Your message wasn\'t send' );
			}
		}
	}

	public function admin_index() {
		$this->data['message'] = $this->model->getListMessage();
	}

	public function admin_delete() {
		$param  = App::$router->getParam();
		$result = $this->model->deleteMessage( $param[0] );
		if ( $result ) {
			Session::setUserMessage( 'Page was deleted' );
		} else {
			Session::setUserMessage( 'Error' );
		}
		Router::redirect( '/admin/contact/' );
	}

	public function admin_edit() {
		if ( $_POST ) {
			$result = $this->model->editMessage();
			if ( ! $result ) {
				Session::setUserMessage( 'Error' );
			}
			Router::redirect( '/admin/contact/' );
			Session::setUserMessage( 'Page was saved' );
		}

		$param = App::$router->getParam();
		if ( isset( $param[0] ) && is_numeric( $param[0] ) ) {
			$this->data['message'] = $this->model->getMessageById( $param[0] );
		}

	}
}