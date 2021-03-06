<?php
    session_start();
    $pageTitle = 'Show Items';
    include 'init.php';
    $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']): 0;

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
								Item_ID = ?
                            AND 
                                Approve = 1");
    $stmt->execute(array($itemid));
    $count = $stmt->rowCount();
    if($count > 0) {
    $item = $stmt->fetch();

?>
    <h2 class="text-center"><?php echo $item['Name']?></h2>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <?php echo '<img class="card-img-top img-fluid img-thumbnail rounded-circle d-block m-auto" src="layout/assets/' . $item["Image"] . '" alt="Card image">'; ?>
            </div>
            <div class="col-md-8 item-info">
                <h2 class="special-heading"><?php echo $item['Name']?></h2>
                <p class="price-color">Price  : <span>$<?php echo $item['Price']?></span></p>
                <p><?php echo $item['Description']?></p>
                <hr>
                <p><span>Made in </span> <?php echo ucfirst($item['Country_Made'])?></p>
                <p class="tags-items"><span>Category </span> <a href="categories.php?pageid=<?php echo $item['Cat_ID']?>"><?php echo $item['catogry_name']?></a></p>
                <p><span>Posted by </span> <?php echo $item['Username']?></p>
                <p><span>Date posted  </span> <?php echo $item['Add_Date']?></p>
                <hr>
                <p class="tags-items">
                    <span>Tags </span>
                    <?php
                        $alltags = explode("," , $item['tags']) ;
                        foreach($alltags as $tag) {
                            $tagWithoutSpace = str_replace(" ", "" , $tag);
                            $lowerTag = strtolower($tagWithoutSpace);
                            if(!empty($tag)) {
                                echo "<a href='tags.php?name={$lowerTag}'>" . $tag . '</a>';
                            }
                        }
                    ?>
                </p>
            </div>
        </div>
        <hr>
        <!-- Start add comment section -->
        <?php if(isset($_SESSION['user'])) {?>
            <div class="row">
                <div class="offset-md-4 add-comment">
                    <h3>Add Your Comment</h3>
                    <form action="<?php echo $_SERVER['PHP_SELF'] . '?itemid=' . $item['Item_ID']  ?>" method="POST">
                        <textarea class="form-control" name="comment" cols="50" rows="5" required aria-required="true" aria-label="comment"></textarea>
                        <input class="btn btn-primary" type="submit" value="Add Comment" role="button">
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
                                    echo '<div class="alert alert-success mt-2" role="alert">Comment Added</div>';
                                }
                            }
                        }
                    ?>
                </div>
            </div>
            <?php } else {
                echo 'Please <a href="login.php" role="button">Login</a> or <a href="login.php">Register</a> to add a comment';
            } ?> 
        <hr>
        <!-- End add comment section -->
        <?php
            $stmt = $con->prepare("SELECT 
                                        comments.* ,users.Username , users.Avatar
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
        <?php foreach($comments as $comment) { ?>
            <div class="comment-box">
                <div class="row">
                    <div class="col-sm-2 text-center">
                        <?php
                        if(empty($comment['Avatar'])){
                            echo '<img class="img-fluid img-thumbnail rounded-circle d-block m-auto" src="admin/uploads/avatars/default.png" alt = "Default image">';
                        } else {
                            echo '<img class="img-fluid img-thumbnail rounded-circle d-block m-auto" src="admin/uploads/avatars/' . $comment['Avatar'] . '" alt = "avatar image">';
                        } 
                        ?>
                        <?php echo $comment['Username'] ?>
                    </div>
                    <div class="col-sm-10 d-flex flex-column">
                        <p class="lead"><?php echo $comment['comment'] ?></p>
                        <p class="date-comment"><?php echo $comment['comment_date'] ?></p>
                    </div>
                </div>
            </div>
            <hr>
        <?php } ?>
    </div>

<?php 
    } else {
        echo '<div class="container">';
            echo '<div class="alert alert-danger" role="alert">There\'s No such ID or this item Awaiting approval</div>';
        echo '</div>';
    }
    include $tpl . 'footer.php';
?>
