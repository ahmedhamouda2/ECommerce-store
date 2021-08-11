<?php
    session_start();
    $pageTitle = 'HomePage';
    include 'init.php';
    echo 'welcome';
    include $tpl . 'footer.php';

?>