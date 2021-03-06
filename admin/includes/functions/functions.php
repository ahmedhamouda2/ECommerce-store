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


	// Title Function that Echo the page title in case the page has the variable $pageTitle and Echo Default title for other pages.

	function getTitle() {
		global $pageTitle;
		if (isset($pageTitle)) {
			echo $pageTitle;
		} else {
			echo 'Default';
		}
	}

	/*
	** Home Redirect Function  v2.0
	** This function accept parameters
	** $theMsg = Echo the message [Error , success , warning]
	** $url = the link you want to redirect 
	** $seconds = Seconds before Redirecting
	*/

	function redirectHome($theMsg , $url=null, $seconds = 3) {
		if($url == null){
			$url= 'index.php';
			$link = 'HomePage';
		} else {
			$url = $_SERVER['HTTP_REFERER'];
			$link = 'Previous page';
		}
		echo $theMsg;
		echo "<div class='alert alert-info' role='alert'>You Will Be Redirected to $link After $seconds Seconds.</div>";
		header("refresh:$seconds;url=$url");
		exit();
	}

	/*
	** Check Items Function
	** Function to Check Item In Database [ Function Accept Parameters ]
	** $select = The Item To Select [ Example: user, item, category ]
	** $from = The Table To Select From [ Example: users, items, categories ]
	** $value = The Value Of Select [ Example: Ahmed, Box, Electronics ]
	*/

	function checkItem($select, $from, $value) {
		global $con;
		$statement = $con->prepare("SELECT $select FROM $from WHERE $select = ?");
		$statement->execute(array($value));
		$count = $statement->rowCount();
		return $count;
	}


	/*
	** Count number of items function
	** Function to count number of items rows
	** $item = The item to count
	** $table = The table to choose from
	*/

	function countItems($item, $table) {
		global $con;
		$stmt2 = $con->prepare("SELECT COUNT($item) FROM $table");
		$stmt2->execute();
		return $stmt2->fetchColumn();
	}


	/*
	** Get Latest Records Function
	** Function to get latest items from database [ Users, Items, Comments ]
	** $select = field to select
	** $table = The table to choose from
	** $order = The Desc ordering
	** $limit = Number of records to get
	*/

	function getLatest($select, $table, $order, $limit = 5) {
		global $con;
		$getStmt = $con->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");
		$getStmt->execute();
		$rows = $getStmt->fetchAll();
		return $rows;
	}