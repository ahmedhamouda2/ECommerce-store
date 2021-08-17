<?php
    session_start();
    include 'init.php';
?>

    <div class="container">
        <div class="row">
            <?php
                $tag = isset($_GET['name']) ? $_GET['name']: 0;
                echo '<h2 class="text-center">' . $_GET['name'] . '</h2>';
            ?>
        </div>
    </div>

<?php include $tpl . 'footer.php';?>
