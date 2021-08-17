<?php
    session_start();
    include 'init.php';
?>

    <div class="container">
        <h2 class="text-center">Show category Items</h2>
        <div class="row">
            <?php
                $catgory = isset($_GET['pageid']) && is_numeric($_GET['pageid']) ? intval($_GET['pageid']): 0;
                $allItems = getAllFrom("*","items","where Cat_ID = {$catgory}" , "AND Approve = 1" , "Item_ID");
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

<?php include $tpl . 'footer.php';?>
