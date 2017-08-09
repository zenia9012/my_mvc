<?php
/**
 * Created by PhpStorm.
 * User: Yevhenii
 * Date: 01.08.2017
 * Time: 8:55
 */

class User extends Controller {

	public function __construct( array $data = [] ) {
		parent::__construct( $data );
		$this->model = new UserModel();
	}

	public function register_user() {
		if ( $_POST['password'] != $_POST['confirmPass'] ) {
			Session::setUserMessage( 'your password not the same' );

			return false;
		}
		if ( strlen( $_POST['password'] ) < 4 ) {
			Session::setUserMessage( 'password length so short, min length 5 symbol' );

			return false;
		}
		if ( $_POST ) {
			if ( $this->model->register( $_POST ) ) {
				Session::setUserMessage( 'registration was successful' );
			}
		}
	}

	public function admin_login() {
		if ( $_POST && isset( $_POST['login_user'] ) && isset( $_POST['pass'] ) ) {
			$user = $this->model->getByLogin( $_POST['login_user'] );
			if ( $user ) {
				$pass =  $_POST['pass'];
				if ( $pass == $user['password'] ) {
					Session::set( 'login', $user );
					Session::set( 'role', $user['role'] );
				}
				Router::redirect( '/admin/page/' );
			} else {
				Session::setUserMessage( 'User not exist' );
			}
		}
	}

	public function admin_logout() {
		Session::destroy();
		Router::redirect( '/page/index' );
	}

	public function admin_all(  ) {
		$this->data['user'] = $this->model->getAllUser();
	}

	public function admin_edit(  ) {
		if ($_POST){
			$result = $this->model->editUser();
			if (! $result ) {
				Session::setUserMessage( 'Error' );
			}
			Router::redirect( '/admin/user/all/' );
			Session::setUserMessage( 'User was saved' );
		}

		$param = App::$router->getParam();
		$this->data['user'] = $this->model->getUserById($param[0]);
	}
}