<?php
/**
 * Created by PhpStorm.
 * User: Yevhenii
 * Date: 01.08.2017
 * Time: 8:54
 */

class UserModel extends Model {

	public function register( $data ) {
		if (!isset($data['login']) || !isset($data['r_email']) || !isset($data['password']) || !isset($data['confirmPass'])){
			return false;
		}

		$login = $data['login'];
		$email = $data['r_email'];
		$pass = $data['password'];

		$sth = "INSERT INTO `user`(`id`, `login`, `email`, `password`) VALUES (NULL , '{$login}', '{$email}', '{$pass}')";


		return $this->pdo->query($sth);
	}

	public function getByLogin( $login ) {
		$query = "SELECT * FROM `user` WHERE login = ?";
		$stn = $this->pdo->prepare($query);
		$stn->execute([$login]);
		$user = $stn->fetch(PDO::FETCH_ASSOC);
		if (!empty($user)){
			return $user;
		}else{
			return false;
		}
	}

	public function getAllUser(  ) {
		$query = "SELECT * FROM user";
		$stn = $this->pdo->query($query);
		return  $stn->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getUserById( $id ) {
		$query = "SELECT * FROM user WHERE id = ?";
		$stn = $this->pdo->prepare($query);
		$stn->execute([$id]);
		return $stn->fetch(PDO::FETCH_ASSOC);
	}

	public function editUser(  ) {
		if ( ! isset( $_POST['id'] ) || ! isset( $_POST['login'] ) || ! isset( $_POST['email'] ) || ! isset( $_POST['role'] ) ) {
			return false;
		}
		$id          = $_POST['id'];
		$login       = $_POST['login'];
		$email       = $_POST['email'];
		$role     = $_POST['role'];
		$password     = $_POST['password'];
		$isActive = isset( $_POST['is_active'] ) ? '1' : '0';
		$query       = "UPDATE `user` SET `login`= '{$login}',`email`= '{$email}',`role`= '{$role}',`password`= '{$password}',`is_active`= '{$isActive}' WHERE `id` = '{$id}'";

		$this->pdo->query( $query );

		return true;
	}
}