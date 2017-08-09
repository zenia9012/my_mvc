<?php
/**
 * Created by PhpStorm.
 * User: Yevhenii
 * Date: 31.07.2017
 * Time: 11:24
 */

class PageModels extends Model {

	public function pageList( $defaultVisibility = 1 ) {
		$query = "SELECT * FROM page WHERE is_published = ?";
		$stn   = $this->db->prepare( $query );
		$stn->execute( [ $defaultVisibility ] );
		$pageArray = $stn->fetchAll( PDO::FETCH_ASSOC );

		return $pageArray;
	}

	public function pageListAdmin() {
		$query     = "SELECT * FROM page ";
		$stn       = $this->pdo->query( $query );
		$pageArray = $stn->fetchAll( PDO::FETCH_ASSOC );

		return $pageArray;
	}

	public function getPage( $alias ) {
		$query = 'Select * FROM page WHERE alias = ?';
		$stn   = $this->db->prepare( $query );
		$stn->execute( [ $alias ] );
		$aliasPage = $stn->fetchAll( PDO::FETCH_ASSOC );

		return $aliasPage;
	}

	public function getById( $id ) {
		$query = 'Select * FROM page WHERE id = ?';
		$stn   = $this->db->prepare( $query );
		$stn->execute( [ $id ] );
		$idPage = $stn->fetch( PDO::FETCH_ASSOC );

		return $idPage;
	}


	public function savePage() {
		if ( ! isset( $_POST['alias'] ) || ! isset( $_POST['title'] ) || ! isset( $_POST['content'] ) ) {
			return false;
		}
		$alias       = $_POST['alias'];
		$title       = $_POST['title'];
		$content     = $_POST['content'];
		$isPublished = isset( $_POST['is_published'] ) ? '1' : '0';

		$sth = "INSERT INTO `page`(`id`, `alias`, `title`, `content`, `is_published`) 
				VALUES (NULL , '{$alias}', '{$title}', '{$content}', '{$isPublished}' )";

		return $this->pdo->query( $sth );
	}

	public function editPage() {

		if ( ! isset( $_POST['id'] ) || ! isset( $_POST['alias'] ) || ! isset( $_POST['title'] ) || ! isset( $_POST['content'] ) ) {
			return false;
		}
		$id          = $_POST['id'];
		$alias       = $_POST['alias'];
		$title       = $_POST['title'];
		$content     = $_POST['content'];
		$isPublished = isset( $_POST['is_published'] ) ? '1' : '0';
		$query       = "UPDATE `page` SET `alias`='{$alias}',`title`='{$title}',`content`='{$content}',`is_published`='{$isPublished}' WHERE `id` = '{$id}'";

		$this->pdo->query( $query );

		return true;
	}

	public function delete( $id ) {
		$query = "DELETE FROM `page` WHERE id = {$id}";

		return $this->pdo->query( $query );
	}

}