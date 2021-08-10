<?php include 'init.php'; ?>

    <div class="container">
        <h2 class="text-center"><?php echo str_replace('-' , ' ' , $_GET['pagename']) ?></h2>
        <div class="row">
            <?php
                foreach(getitems($_GET['pageid']) as $item){
                    echo '<div class="col-sm-6 col-md-3">';
                        echo '<div class="thumbnail item-box">';
                            echo '<img class="img-responsive" src="https://picsum.photos/250" alt="">';
                            echo '<div class="caption">';
                                echo '<h3>' . $item['Name'] . '</h3>';
                                echo '<p>' . $item['Description'] . '</p>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }
            ?>
        </div>
    </div>

<?php include $tpl . 'footer.php';?>