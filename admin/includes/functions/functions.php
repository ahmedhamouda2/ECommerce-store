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