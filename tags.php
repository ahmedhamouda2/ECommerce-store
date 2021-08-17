<?php
    session_start();
    include 'init.php';
?>

    <div class="container">
        <div class="row justify-content-center">
            <?php
                $tag = isset($_GET['name']) ? $_GET['name']: 0;
                echo '<h2>' . $_GET['name'] . '</h2>';
            ?>
        </div>
    </div>

<?php include $tpl . 'footer.php';?>
