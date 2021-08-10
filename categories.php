<?php include 'init.php'; ?>

    <div class="container">
        <h2 class="text-center"><?php echo str_replace('-' , ' ' , $_GET['pagename']) ?></h2>
        <?php
            foreach(getitems($_GET['pageid']) as $item){
                echo $item['Name'];
            }
        ?>
    </div>

<?php include $tpl . 'footer.php';?>