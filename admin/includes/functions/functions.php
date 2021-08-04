<?php 

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
	** Home Redirect Function
	** This Function Accept Parameters
	** $errorMsg = Echo The Error Message 
	** $seconds = Seconds Before Redirecting
	*/

	function redirectHome($errorMsg, $seconds = 3) {
		echo  "<div class='alert alert-danger' role='alert'>$errorMsg</div>";
		echo "<div class='alert alert-info' role='alert'>You Will Be Redirected to After $seconds Seconds.</div>";
		header("refresh:$seconds;url=index.php");
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