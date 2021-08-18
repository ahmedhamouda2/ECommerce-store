<?php
    session_start();
    include 'init.php';
?>

    <div class="container">
            <?php 
            if(isset($_GET['name'])) {
                $tag = $_GET['name'];
                echo '<h2 class="text-center">' . $tag . '</h2>';
                $tagsItems = getAllFrom("*","items","WHERE tags LIKE '%$tag%'" , "AND Approve = 1" , "Item_ID");
                echo '<div class="row">';
                    foreach($tagsItems as $item){
                        echo '<div class="col-sm-6 col-md-4 col-lg-3">';
                            echo '<div class="card mt-3">';
                                echo '<a class="custom-item" href="items.php?itemid=' . $item['Item_ID'] . '">';
                                    echo '<span class="price">$' . $item['Price'] . '</span>';
                                        echo '<img class="card-img-top img-fluid img-thumbnail" src="https://picsum.photos/250" alt="Card image">';
                                        echo '<div class="card-body">';
                                            echo '<h4 class="card-title">' . $item['Name'] . '</h4>';
                                            echo '<p class="card-text">' . $item['Description'] . '</p>';
                                            echo '<div class="d-flex justify-content-between">';
                                                echo '<span class="date text-left">' . $item['Country_Made'] . '</span>';
                                                echo '<span class="date text-right">' . $item['Add_Date'] . '</span>';
                                            echo '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                echo '</a>';
                        echo '</div>';
                    }
                echo '</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">You must enter <strong>Tag name</strong></div>';
            }
            ?>
    </div>

<?php include $tpl . 'footer.php';?>
