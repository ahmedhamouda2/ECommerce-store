<?php
    session_start();
    $pageTitle = 'Show Items';
    include 'init.php';
    $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']): 0;
    // check if user exist in database
    $stmt = $con->prepare("SELECT 
                                items.* , categories.Name AS catogry_name , users.Username
                            FROM 
                                items
                            INNER JOIN 
                                categories 
                            ON 
                                items.Cat_ID = categories.ID
                            INNER JOIN 
                                users 
                            ON 
                                items.Member_ID = users.UserID
                            WHERE 
								Item_ID = ?");
    $stmt->execute(array($itemid));
    $count = $stmt->rowCount();
    if($count > 0) {
    $item = $stmt->fetch();

?>
    <h2 class="text-center"><?php echo $item['Name']?></h2>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <img class="card-img-top img-fluid img-thumbnail" src="https://picsum.photos/250" alt="Card image">
            </div>
            <div class="col-md-9">
            <h2 class="special-heading"><?php echo $item['Name']?></h2>
            <p><?php echo $item['Description']?></p>
            <span><?php echo $item['Add_Date']?></span>
            <div>Price : <?php echo $item['Price']?></div>
            <div>Made in : <?php echo $item['Country_Made']?></div>
            <div>Category : <?php echo $item['catogry_name']?></div>
            <div>Added by : <?php echo $item['Username']?></div>
            </div>
        </div>
    </div>

<?php 
    } else {
        echo '<div class="container">';
            echo '<div class="alert alert-danger" role="alert">There\'s No such ID</div>';
        echo '</div>';
    }
    include $tpl . 'footer.php';
?>