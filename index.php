<?php
    session_start();
    $pageTitle = 'HomePage';
    include 'init.php';
?>
    <div class="container">
        <div class="row">
            <?php
            $allItems = getAllFrom('*' , 'items', 'WHERE Approve = 1' , 'item_ID');
                foreach($allItems as $item){
                    echo '<div class="col-sm-6 col-md-4 col-lg-3">';
                        echo '<div class="card mt-3">';
                        echo '<span class="price">$' . $item['Price'] . '</span>';
                            echo '<img class="card-img-top img-fluid img-thumbnail" src="https://picsum.photos/250" alt="Card image">';
                            echo '<div class="card-body">';
                                echo '<h4 class="card-title"><a href="items.php?itemid=' . $item['Item_ID'] . '">' . $item['Name'] . '</a></h4>';
                                echo '<p class="card-text">' . $item['Description'] . '</p>';
                                echo '<div class="date text-right">' . $item['Add_Date'] . '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }
            ?>
        </div>
    </div>
<?php 
    include $tpl . 'footer.php';
?>