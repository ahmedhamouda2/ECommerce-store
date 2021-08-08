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
                                    users.UserID = comments.user_id");
        $stmt->execute();

        // assign to varible
        $rows = $stmt->fetchAll();

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
                            foreach ($rows as $row) {
                                echo '<tr>';
                                    echo'<td>' . $row['c_id'] . '</td>';
                                    echo'<td>' . $row['comment'] . '</td>';
                                    echo'<td>' . $row['Item_Name'] . '</td>';
                                    echo'<td>' . $row['Username'] . '</td>';
                                    echo'<td>' . $row['comment_date'] . '</td>';
                                    echo'<td>
                                            <a href="comments.php?do=Edit&commentid=' . $row['c_id'] . '" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
                                            
                                            <a href="comments.php?do=Delete&commentid=' . $row['c_id'] . '" class="btn btn-danger confirm"><i class="fas fa-times"></i> Delete</a>';
                                            if($row['status'] == 0){
                                                echo '<a href="comments.php?do=Approve&commentid=' . $row['c_id'] . '" class="btn btn-info approve"><i class="fas fa-check"></i> Approve</a>';
                                            }

                                        echo '</td>';
                                echo '</tr>';
                            }
                        ?>

                    </table>
                </div>
            </div>
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
                                    <input type="submit" value="save" class="btn btn-primary btn-lg">
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
        echo "<h2 class='text-center'>Update Member</h2>";
        echo "<div class='container'>";
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // get variables from the Form [names in form]
            $id         = $_POST['userid'];
            $user       = $_POST['username'];
            $email      = $_POST['email'];
            $full_name = $_POST['full'];

            // password trick 
            $pass = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);

            // validate the Form 
            $formErrors = array();
            if(empty($user)){
                $formErrors[] = 'User cant be <strong>empty.</strong>';
            }
            if(strlen($user) < 4 ){
                $formErrors[] = 'Username cant be less than <strong>4 characters.</strong>';
            }
            if(strlen($user) > 20 ){
                $formErrors[] = 'Username cant be more than <strong>20 characters.</strong>';
            }
            if(empty($full_name)){
                $formErrors[] = 'Full Name cant be <strong>empty.</strong>';
            }
            if(empty($email)){
                $formErrors[] = 'Email cant be <strong>empty.</strong>';
            }
            // loop into errors array and echo it 
            foreach($formErrors as $error){
                echo  '<div class="alert alert-danger" role="alert">' . $error . '</div>';
            }

            // check if there no error proceed the update operation
                if(empty($formErrors)){
                    // Update the database with this info
                    $stmt = $con->prepare("UPDATE users SET Username = ? , Email = ? , FullName = ? , Password = ? WHERE UserID = ?");
                    $stmt->execute(array($user , $email , $full_name ,$pass , $id ));
        
                    // echo success message 
                    $theMsg = "<div class='alert alert-success' role='alert'>" . $stmt->rowCount() . ' Record Updated</div>';
                    redirectHome($theMsg, 'back');
                }

        } else {
            $theMsg = "<div class='alert alert-danger' role='alert'>Sorry you cant browse this page directly</div>";
            redirectHome($theMsg);
        }
        echo "</div>";
    }   elseif ($do == 'Delete')  {
        // Delete member page
        echo "<h2 class='text-center'>Delete Member</h2>";
        echo "<div class='container'>";
            // Check if eet request userid Is Numeric & Get its integer value   
            $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']): 0;
            // check if user exist in database
            $stmt = $con->prepare("SELECT * FROM users WHERE UserID = ? LIMIT 1");
            $check = checkItem("userid", "users", $userid);

            if($check > 0) {
                $stmt = $con->prepare("DELETE FROM users WHERE UserID = :zuser");
                $stmt->bindParam(":zuser", $userid);
                $stmt->execute();
                $theMsg = "<div class='alert alert-success' role='alert'>" . $stmt->rowCount() . ' Record Deleted</div>';
                redirectHome($theMsg);
            } else {
                $theMsg = "<div class='alert alert-danger' role='alert'>This id is <strong>not exist</strong></div>";
                redirectHome($theMsg);
            }
        echo "</div>";
    } elseif($do== 'Activate'){
        // Activate member page
        echo "<h2 class='text-center'>Activate Member</h2>";
        echo "<div class='container'>";
            // Check if eet request userid Is Numeric & Get its integer value   
            $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']): 0;
            // check if user exist in database
            $stmt = $con->prepare("SELECT * FROM users WHERE UserID = ? LIMIT 1");
            // select all data depend on this ID 
            $check = checkItem("userid", "users", $userid);

            if($check > 0) {
                $stmt = $con->prepare("UPDATE users SET RegStatus = 1 WHERE UserID = ?");
                $stmt->execute(array($userid));
                $theMsg = "<div class='alert alert-success' role='alert'>" . $stmt->rowCount() . ' Record Activated</div>';
                redirectHome($theMsg);
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
