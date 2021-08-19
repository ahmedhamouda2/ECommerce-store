<?php 

	/*
	** Get all items Function (ultimate function) v4.0
	** Function to get all items from database
	*/

	function getAllFrom($field , $table ,$where = NULL , $and = NULL ,  $orderField , $ordering="DESC") {
		global $con;
		$getAll= $con->prepare("SELECT $field  FROM $table $where $and ORDER BY $orderField $ordering");
		$getAll->execute();
		$all = $getAll->fetchAll();
		return $all;
	}

	/*
	** check the user is not activated
	** Function to check the RegStatus of the user
	*/

	function checkUserStatus($user){
		global $con;
		$stmtx = $con->prepare("SELECT Username , RegStatus FROM users WHERE Username = ? AND RegStatus = 0");
		$stmtx->execute(array($user));
		$status = $stmtx->rowCount();
		return $status;
	}

	/*
	** Check user Function
	** Function to Check user In Database
	** $select = The user To Select
	** $from = The Table To Select From 
	** $value = The Value Of Select
	*/

	function checkItem($select, $from, $value) {
		global $con;
		$statement = $con->prepare("SELECT $select FROM $from WHERE $select = ?");
		$statement->execute(array($value));
		$count = $statement->rowCount();
		return $count;
	}

// Title Function that Echo the page title in case the page has the variable $pageTitle and Echo Default title for other pages.

	function getTitle() {
		global $pageTitle;
		if (isset($pageTitle)) {
			echo $pageTitle;
		} else {
			echo 'Default';
		}
	}
