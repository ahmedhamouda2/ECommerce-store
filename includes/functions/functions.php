<?php 

	/*
	** Get all items Function (ultimate function) v4.0
	** Function to get all items from database
	*/

	function getAllFrom($field , $table ,$where = NULL , $and = NULL ,  $orderField , $ordering="DESC") {
		global $con;
		$getAll= $con->prepare("SELECT $field  FROM $table $where ORDER BY $orderField $ordering");
		$getAll->execute();
		$all = $getAll->fetchAll();
		return $all;
	}

	/*
	** Get categories Function
	** Function to get categories from database
	*/

	function getCat() {
		global $con;
		$getCat= $con->prepare("SELECT * FROM categories ORDER BY ID ASC");
		$getCat->execute();
		$cats = $getCat->fetchAll();
		return $cats;
	}

	/*
	** Get AD items Function v3.0
	** Function to get AD items from database
	*/

	function getitems($where , $value , $approve = NULL) {
		global $con;
		$sql = $approve == NULL ? 'AND Approve = 1' : '';
		$getitem= $con->prepare("SELECT * FROM items WHERE $where = ? $sql ORDER BY item_ID DESC");
		$getitem->execute(array($value));
		$items = $getitem->fetchAll();
		return $items;
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

// 	/*
// 	** Home Redirect Function  v2.0
// 	** This function accept parameters
// 	** $theMsg = Echo the message [Error , success , warning]
// 	** $url = the link you want to redirect 
// 	** $seconds = Seconds before Redirecting
// 	*/

// 	function redirectHome($theMsg , $url=null, $seconds = 3) {
// 		if($url == null){
// 			$url= 'index.php';
// 			$link = 'HomePage';
// 		} else {
// 			$url = $_SERVER['HTTP_REFERER'];
// 			$link = 'Previous page';
// 		}
// 		echo $theMsg;
// 		echo "<div class='alert alert-info' role='alert'>You Will Be Redirected to $link After $seconds Seconds.</div>";
// 		header("refresh:$seconds;url=$url");
// 		exit();
// 	}


// 	/*
// 	** Count number of items function
// 	** Function to count number of items rows
// 	** $item = The item to count
// 	** $table = The table to choose from
// 	*/

// 	function countItems($item, $table) {
// 		global $con;
// 		$stmt2 = $con->prepare("SELECT COUNT($item) FROM $table");
// 		$stmt2->execute();
// 		return $stmt2->fetchColumn();
// 	}


// 	/*
// 	** Get Latest Records Function
// 	** Function to get latest items from database [ Users, Items, Comments ]
// 	** $select = field to select
// 	** $table = The table to choose from
// 	** $order = The Desc ordering
// 	** $limit = Number of records to get
// 	*/

// 	function getLatest($select, $table, $order, $limit = 5) {
// 		global $con;
// 		$getStmt = $con->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");
// 		$getStmt->execute();
// 		$rows = $getStmt->fetchAll();
// 		return $rows;
// 	}