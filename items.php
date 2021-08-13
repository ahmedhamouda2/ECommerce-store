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
            <div class="col-md-9 item-info">
                <h2 class="special-heading"><?php echo $item['Name']?></h2>
                <p><?php echo $item['Description']?></p>
                <ul class="list-unstyled">
                    <li>
                        <i class="fas fa-calendar-day fa-fw"></i>
                        <span>Add Date : </span><?php echo $item['Add_Date']?>
                    </li>
                    <li>
                        <i class="fas fa-money-bill-alt fa-fw"></i>
                        <span>Price :  </span>$<?php echo $item['Price']?>
                    </li>
                    <li>
                        <i class="fas fa-globe fa-fw"></i>
                        <span>Made in : </span><?php echo $item['Country_Made']?>
                    </li>
                    <li>
                    <i class="fas fa-tags fa-fw"></i>
                        <span>Category : <a href="categories.php?pageid=<?php echo $item['Cat_ID']?>"></span><?php echo $item['catogry_name']?></a>
                    </li>
                    <li>
                        <i class="fas fa-user fa-fw"></i>
                        <span>Added by : <a href="#"></span><?php echo $item['Username']?></a>
                    </li>
                </ul>
            </div>
        </div>
        <hr>
        <!-- Start add comment section -->
        <?php if(isset($_SESSION['user'])) {?>
            <div class="row">
                <div class="offset-md-3 add-comment">
                    <h4>Add Your Comment</h4>
                    <form action="<?php echo $_SERVER['PHP_SELF'] . '?itemid=' . $item['Item_ID']  ?>" method="POST">
                        <textarea class="form-control" name="comment" cols="50" rows="5"></textarea>
                        <input class="btn btn-primary" type="submit" value="Add Comment">
                    </form>
                    <?php
                        if($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $comment = filter_var($_POST['comment'] ,FILTER_SANITIZE_STRING);
                            $itemid = $item['Item_ID'];
                            $userid = $_SESSION['uid'];
                            if(!empty($comment)) {
                                $stmt = $con->prepare("INSERT INTO 
                                                            comments(comment,`status`,comment_date,item_id,`user_id`)
                                                        VALUES(:zcomment,0,NOW(),:zitemid,:zuserid)");
                                $stmt->execute(array(
                                    'zcomment' => $comment,
                                    'zitemid' => $itemid,
                                    'zuserid' => $userid,
                                ));
                                if($stmt){
                                    echo '<div class="alert alert-success mt-2">Comment Added</div>';
                                }
                            }
                        }
                    ?>
                </div>
            </div>
            <?php } else {
                echo 'Please <a href="login.php">Login</a> or <a href="login.php">Register</a> to add a comment';
            } ?> 
        <hr>
        <!-- End add comment section -->
        <?php
            $stmt = $con->prepare("SELECT 
                                        comments.* ,users.Username 
                                    FROM 
                                        comments 
                                    INNER JOIN
                                        users
                                    ON
                                        users.UserID = comments.user_id
                                    WHERE
                                        item_id = ?
                                    AND 
                                        `status` = 1
                                    ORDER BY 
                                        c_id DESC");
            $stmt->execute(array($item['Item_ID']));
            $comments = $stmt->fetchAll();
        ?>
        <?php
            foreach($comments as $comment) {
                echo '<div class="row">';
                    echo '<div class="col-md-3">' . $comment['Username'] . '</div>';
                    echo '<div class="col-md-9">' . $comment['comment'] . '</div>';
                echo '</div>';
            }
        ?>
    </div>

<?php 
    } else {
        echo '<div class="container">';
            echo '<div class="alert alert-danger" role="alert">There\'s No such ID</div>';
        echo '</div>';
    }
    include $tpl . 'footer.php';
?>