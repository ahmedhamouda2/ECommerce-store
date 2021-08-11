<?php
    session_start();
    $pageTitle = 'Profile';
    include 'init.php';
    echo 'welcome ' . $_SESSION['user'];
    include $tpl . 'footer.php';
?>