<?php 

	/*
	================================================
	== Manage Members Page
	== You Can Add | Edit | Delete Members From Here
	================================================
	*/

    session_start();
    if(isset($_SESSION['Username'])){
        include 'init.php';

        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
        // start manage page
        if ($do == 'Manage') {
            // manage page
        } elseif ($do == 'Edit') {
            // Edit page
            echo 'welcome to edit page , Your id :' .  $_GET['userid'];
        } elseif ($do == 'Insert') {
            // Insert page
        } else {

        }

        include $tpl . 'footer.php';
    } else {
        header('location:index.php');
        exit();
    }