<?php
    session_start();
    if(isset($_SESSION['Username'])){
        echo 'welcome ' . $_SESSION['Username'];
    } else {
        echo 'You are not authorized to view this page.';
    }