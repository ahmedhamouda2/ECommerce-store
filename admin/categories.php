<?php

	/*
	================================================
	== categories Page
	================================================
	*/

	session_start();
	$pageTitle = 'categories';
	if (isset($_SESSION['Username'])) {
		include 'init.php';
		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
		if ($do == 'Manage') {


		} elseif ($do == 'Add') {


		} elseif ($do == 'Insert') {


		} elseif ($do == 'Edit') {


		} elseif ($do == 'Update') {


		} elseif ($do == 'Delete') {


        }

		include $tpl . 'footer.php';

	} else {

		header('Location: index.php');

		exit();
	}


?>