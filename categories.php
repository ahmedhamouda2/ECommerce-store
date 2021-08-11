<?php
    session_start();
    include 'init.php';
?>

    <div class="container">
        <h2 class="text-center"><?php echo str_replace('-' , ' ' , $_GET['pagename']) ?></h2>
        <div class="row">
            <?php
                foreach(getitems('Cat_ID' , $_GET['pageid']) as $item){
                    echo '<div class="col-sm-6 col-md-4 col-lg-3">';
                        echo '<div class="card">';
                            echo '<img class="card-img-top img-fluid img-thumbnail" src="https://picsum.photos/250" alt="Card image">';
                            echo '<div class="card-body">';
                                echo '<h4 class="card-title">' . $item['Name'] . '</h4>';
                                echo '<p class="card-text">' . $item['Description'] . '</p>';
                                echo '<div class="d-flex justify-content-around">';
                                    echo '<button type="button" class="btn btn-light">' . $item['Price'] . '</button>'; 
                                    echo '<a href="#" class="btn btn-primary">See More</a>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }
            ?>
        </div>
    </div>

<?php include $tpl . 'footer.php';?>
