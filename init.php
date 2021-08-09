<?php 

include 'admin/connect.php';

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
