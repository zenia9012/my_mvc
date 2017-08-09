<?php

class FeedbackModel extends Model {

	public function save( $data ) {

		if ( ! isset( $data['name'] ) || ! isset( $data['email'] ) || ! isset( $data['message'] ) ) {
			return false;
		}

		$name    = $data['name'];
		$email   = $data['email'];
		$message = $data['message'];

		$sth = "INSERT INTO `message`(`id`, `name`, `email`, `message`) VALUES (NULL , '{$name}', '{$email}', '{$message}')";

		return $this->pdo->query( $sth );
	}

	public function getListMessage(  ) {
		$query = "SELECT * FROM message";
		$stn = $this->pdo->query($query);
		$pageArray = $stn->fetchAll( PDO::FETCH_ASSOC );

		return $pageArray;
	}

	public function deleteMessage( $id ) {
		$query = "DELETE FROM message WHERE id = ?";
		$stn = $this->pdo->prepare($query);
		$stn->execute([$id]);
	}

	public function getMessageById( $id ) {
		$query = "SELECT * FROM message WHERE id = ?";
		$stn = $this->pdo->prepare($query);
		$stn->execute([$id]);
		return $stn->fetch(PDO::FETCH_ASSOC);
	}

	public function editMessage(  ) {
		if (!isset($_POST['name']) && !isset($_POST['email']) &&!isset($_POST['message'])){
			return false;
		}

		$id = $_POST['id'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$message = $_POST['message'];

		$query = "UPDATE `message` SET `name`='{$name}',`email`='{$email}',`message`='{$message}' WHERE `id` = '{$id}'";

		$this->pdo->query( $query );
		return true;
	}
}