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