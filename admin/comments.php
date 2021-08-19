<?php

/*
	================================================
	== comments manage Page
	== You Can Edit | Delete comments From Here
	================================================
	*/

session_start();
$pageTitle = 'Comments';
if (isset($_SESSION['Username'])) {
    include 'init.php';

    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
    // start manage page
    if ($do == 'Manage') { // manage comments page
        // select all users except Admin
        $stmt = $con->prepare("SELECT 
                                    comments.* , items.Name AS Item_Name , users.Username 
                                FROM 
                                    comments 
                                INNER JOIN
                                    items
                                ON
                                    items.Item_ID = comments.item_id 
                                INNER JOIN
                                    users
                                ON
                                    users.UserID = comments.user_id
                                ORDER BY 
                                    c_id DESC");
        $stmt->execute();

        // assign to varible
        $comments = $stmt->fetchAll();
        if(!empty($comments)) {
            ?>
            <h2 class="text-center">Manage Comments</h2>
            <div class="container">
                <div class="table-responsive">
                    <table class="main-table text-center table table-bordered">
                        <tr>
                            <td>#ID</td>
                            <td>Comment</td>
                            <td>Item Name</td>
                            <td>User Name</td>
                            <td>Added Date</td>
                            <td>Control</td>
                        </tr>
                        <?php 
                            foreach ($comments as $comment) {
                                echo '<tr>';
                                    echo'<td>' . $comment['c_id'] . '</td>';
                                    echo'<td class="comment-custom">' . $comment['comment'] . '</td>';
                                    echo'<td>' . $comment['Item_Name'] . '</td>';
                                    echo'<td>' . $comment['Username'] . '</td>';
                                    echo'<td>' . $comment['comment_date'] . '</td>';
                                    echo'<td>
                                            <a href="comments.php?do=Edit&commentid=' . $comment['c_id'] . '" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
                                            <a href="comments.php?do=Delete&commentid=' . $comment['c_id'] . '" class="btn btn-danger confirm"><i class="fas fa-times"></i> Delete</a>';
                                            if($comment['status'] == 0){
                                                echo '<a href="comments.php?do=Approve&commentid=' . $comment['c_id'] . '" class="btn btn-info approve"><i class="fas fa-check"></i> Approve</a>';
                                            }
                                        echo '</td>';
                                echo '</tr>';
                            }
                        ?>
                    </table>
                </div>
            </div>
        <?php } else {
                echo '<div class="container">';
                    echo '<div class="alert alert-info">There\'s No Comments to show</div>';
                echo '</div>';
        } ?>

    <?php } elseif ($do == 'Edit') {  // Edit page 
            $commentid = isset($_GET['commentid']) && is_numeric($_GET['commentid']) ? intval($_GET['commentid']): 0;
            // check if comment exist in database
            $stmt = $con->prepare("SELECT * FROM comments WHERE c_id = ? LIMIT 1");
            $stmt->execute(array($commentid));
            $row = $stmt->fetch();
            $count = $stmt->rowCount();

            if($count > 0) { ?>
                <h2 class="text-center">Edit Comment</h2>
                <div class="container">
                        <form action="?do=Update" method="POST">
                            <input type="hidden" name="commentid" value="<?php echo $commentid ?>">
                            <!-- start comment field -->
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Comment</label>
                                <div class="col-sm-10 col-md-6">
                                    <textarea name="comment" class="form-control"><?php echo $row['comment'] ?></textarea>
                                </div>
                            </div>
                            <!-- End comment field -->
                            <!-- start submit -->
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <input type="submit" value="save" class="btn btn-primary btn-sm">
                                </div>
                            </div>
                            <!-- end submit -->
                        </form>
                    </form>
                </div>
        <?php
            }else {
                echo '<div class="container">';
                $theMsg = '<div class="alert alert-danger" role="alert">There\'s No such ID</div>';
                redirectHome($theMsg);
                echo '</div>';
            }
    } elseif ($do == 'Update') { // Update page
        echo "<h2 class='text-center'>Update Comment</h2>";
        echo "<div class='container'>";
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // get variables from the Form [names in form]
            $commentid   = $_POST['commentid'];
            $comment     = $_POST['comment'];
            
            // Update the database with this info
            $stmt = $con->prepare("UPDATE comments SET comment = ? WHERE c_id = ?");
            $stmt->execute(array($comment , $commentid));

            // echo success message 
            $theMsg = "<div class='alert alert-success' role='alert'>" . $stmt->rowCount() . ' Record Updated</div>';
            redirectHome($theMsg, 'back');

        } else {
            $theMsg = "<div class='alert alert-danger' role='alert'>Sorry you cant browse this page directly</div>";
            redirectHome($theMsg);
        }
        echo "</div>";
    }   elseif ($do == 'Delete')  {
        // Delete comment page
        echo "<h2 class='text-center'>Delete Comment</h2>";
        echo "<div class='container'>";
            // Check if get request commentid Is Numeric & Get its integer value   
            $commentid = isset($_GET['commentid']) && is_numeric($_GET['commentid']) ? intval($_GET['commentid']): 0;
            // check if comment exist in database
            $check = checkItem("c_id", "comments", $commentid);

            if($check > 0) {
                $stmt = $con->prepare("DELETE FROM comments WHERE c_id = :zid");
                $stmt->bindParam(":zid", $commentid);
                $stmt->execute();
                $theMsg = "<div class='alert alert-success' role='alert'>" . $stmt->rowCount() . ' Record Deleted</div>';
                redirectHome($theMsg , 'back');
            } else {
                $theMsg = "<div class='alert alert-danger' role='alert'>This id is <strong>not exist</strong></div>";
                redirectHome($theMsg);
            }
        echo "</div>";
    } elseif($do== 'Approve'){
        // Approve comment page
        echo "<h2 class='text-center'>Approve Comment</h2>";
        echo "<div class='container'>";
            // Check if eet request commentid Is Numeric & Get its integer value   
            $commentid = isset($_GET['commentid']) && is_numeric($_GET['commentid']) ? intval($_GET['commentid']): 0;
            // select all data depend on this ID 
            $check = checkItem("c_id", "comments", $commentid);

            if($check > 0) {
                $stmt = $con->prepare("UPDATE comments SET status = 1 WHERE c_id = ?");
                $stmt->execute(array($commentid));
                $theMsg = "<div class='alert alert-success' role='alert'>" . $stmt->rowCount() . ' Comment Approved</div>';
                redirectHome($theMsg , 'back');
            } else {
                $theMsg = "<div class='alert alert-danger' role='alert'>This id is <strong>not exist</strong></div>";
                redirectHome($theMsg);
            }
        echo "</div>";
    }
    include $tpl . 'footer.php';
} else {
    header('location:index.php');
    exit();
}

