<?php
    session_start();
    if(isset($_SESSION['Username'])){
        echo 'welcome ' . $_SESSION['Username'];
    } else {
        header('location:index.php');
        exit();
    }