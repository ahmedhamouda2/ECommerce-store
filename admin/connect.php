<?php

	$dsn = 'mysql:host=localhost;dbname=shop';
	$user = 'root';
	$pass = '';
	$options = array(
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',  // To Enable Arabic language
	);

	try {
		$con = new PDO($dsn, $user, $pass, $options);
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo 'Successfully connected';
	}

	catch(PDOException $e) {
		echo 'Failed To Connect' . $e->getMessage();
	}