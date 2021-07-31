<?php
    session_start();
    if(isset($_SESSION['Username'])){
        include 'init.php';
        echo ' welcome';
        include $tpl . 'footer.php';
    } else {
        header('location:index.php');
        exit();
    }