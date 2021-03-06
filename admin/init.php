<?php 

// This file is to organize the project and when needed to change the name of folders or whatever. Access is faster and become projects more dynamic, it will make the difference in big projects.

include 'connect.php';

// Routes 

$tpl = 'includes/templates/';       // templates directory
$css = 'layout/css/';               // css directory
$js = 'layout/js/';                 // js directory
$lang 	= 'includes/languages/';    // Language Directory
$func 	= 'includes/functions/';    // functions Directory

//include the important files

include $func . 'functions.php';
include $lang . 'english.php';
include $tpl . 'header.php';

// include navbar on all pages except the one with $noNavbar variable

if(!isset($noNavbar)){ include $tpl . 'navbar.php';}