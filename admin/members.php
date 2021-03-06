<?php

/*
	================================================
	== Manage Members Page
	== You Can Add | Edit | Delete Members From Here
	================================================
	*/

session_start();
$pageTitle = 'Members';
if (isset($_SESSION['Username'])) {
    include 'init.php';

    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
    // start manage page
    if ($do == 'Manage') { // manage member page
        $query = '';
        if(isset($_GET['page']) && $_GET['page']=='Pending'){
            $query = 'AND RegStatus = 0';
        }

        // select all users except Admin
        $stmt = $con->prepare("SELECT * FROM users WHERE GroupID != 1 $query ORDER BY UserID DESC");
        $stmt->execute();
        // assign to varible
        $rows = $stmt->fetchAll();
        if(!empty($rows)){
        ?>
            <h2 class="text-center">Manage Member</h2>
            <div class="container">
                <div class="table-responsive">
                    <table class="main-table manage-members text-center table table-bordered">
                        <tr>
                            <td>#ID</td>
                            <td>Avatar</td>
                            <td>Username</td>
                            <td>Email</td>
                            <td>Full Name</td>
                            <td>Registered Date</td>
                            <td>Control</td>
                        </tr>
                        <?php 
                            foreach ($rows as $row) {
                                echo '<tr>';
                                    echo'<td>' . $row['UserID'] . '</td>';
                                    echo'<td>';
                                        if(empty($row["Avatar"])){
                                            echo '<img src="uploads/avatars/default.png" alt = "Default image">';
                                        } else {
                                            echo '<img src="uploads/avatars/' . $row["Avatar"] . '" alt = "avatar image">';
                                        }
                                    echo '</td>';
                                    echo'<td>' . $row['Username'] . '</td>';
                                    echo'<td>' . $row['Email'] . '</td>';
                                    echo'<td>' . $row['FullName'] . '</td>';
                                    echo'<td>' . $row['Date'] . '</td>';
                                    echo'<td>
                                            <a href="members.php?do=Edit&userid=' . $row['UserID'] . '" class="btn btn-success" role="button"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                                            
                                            <a href="members.php?do=Delete&userid=' . $row['UserID'] . '" class="btn btn-danger confirm" role="button"><i class="fas fa-times" aria-hidden="true"></i> Delete</a>';
                                            if($row['RegStatus'] == 0){
                                                echo '<a href="members.php?do=Activate&userid=' . $row['UserID'] . '" class="btn btn-info activate" role="button"><i class="fas fa-user-check" aria-hidden="true"></i> Activate</a>';
                                            }

                                        echo '</td>';
                                echo '</tr>';
                            }
                        ?>

                    </table>
                </div>
                <a href="members.php?do=Add" class="btn btn-primary btn-sm" role="button"><i class="fa fa-plus" aria-hidden="true"></i> New Mebmer</a>
            </div>
            <?php } else {
                echo '<div class="container">';
                    echo '<div class="alert alert-info" role="alert">There\'s No Mebmer to show</div>';
                    echo '<a href="members.php?do=Add" class="btn btn-primary btn-sm" role="button"><i class="fa fa-plus" aria-hidden="true"></i> New Mebmer</a>';
                echo '</div>';
        } ?>
    <?php } elseif ($do == 'Add') { 
        // add members page
        ?>
            <h2 class="text-center">Add New Member</h2>
            <div class="container">
                <form action="?do=Insert" method="POST" enctype="multipart/form-data">
                    <!-- start username field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end" for="username">Username</label>
                        <div class="col-sm-10 col-md-6">
                            <input id="username" type="text" name="username" class="form-control" autocomplete="off" required aria-required="true"  placeholder="Username to login into Shop" aria-label="Username to login into Shop">
                        </div>
                    </div>
                    <!-- End username field -->
                    <!-- start password field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Password</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="password" name="password" class="password form-control" autocomplete="new-password" required aria-required="true" placeholder="Password must be Hard & Complex" aria-label="Password must be Hard & Complex">
                            <i class="show-pass fas fa-eye fa-2x" aria-hidden="true"></i>
                        </div>
                    </div>
                    <!-- end password field -->
                    <!-- start Email field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end" for="email">Email</label>
                        <div class="col-sm-10 col-md-6">
                            <input id="email" type="email" name="email" class="form-control" autocomplete="email" required aria-required="true" placeholder="Email must be valid" aria-label="Email must be valid">
                        </div>
                    </div>
                    <!-- end Email field -->
                    <!-- start fullname field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end" for="Fullname">Full Name</label>
                        <div class="col-sm-10 col-md-6">
                            <input id="Fullname" type="text" name="full" class="form-control" required aria-required="true" placeholder="Full name Appear in your profile page" aria-label="Full name Appear in your profile page">
                        </div>
                    </div>
                    <!-- end fullname field -->
                    <!-- start avatar field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end" for="avatar">User Avatar</label>
                        <div class="col-sm-10 col-md-6">
                            <input id="avatar" type="file" name="avatar">
                        </div>
                    </div>
                    <!-- end avatar field -->
                    <!-- start submit -->
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <input type="submit" value="Add Member" class="btn btn-primary btn-sm" role="button">
                        </div>
                    </div>
                    <!-- end submit -->
                </form>
            </div>

    <?php
    } elseif ($do == 'Insert') {  // Insert member page
        echo "<div class='container'>";
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            echo "<h2 class='text-center'>Update Member</h2>";
            echo "<div class='container'>";

            // get variables from the Form [names in form]
            $user       = $_POST['username'];
            $pass       = $_POST['password'];
            $email      = $_POST['email'];
            $full_name = $_POST['full'];

            $hashPass = sha1($_POST['password']);

            // upload variables
            $avatarName = $_FILES['avatar']['name'];
            $avatarType = $_FILES['avatar']['type'];
            $avatarTmp = $_FILES['avatar']['tmp_name'];
            $avatarSize = $_FILES['avatar']['size'];

            // list of allowed images to upload
            $avatarAllowedExtension = array("png" ,"jpg" ,"jpeg" ,"gif" , 'webp');

            //get avatar extension
            $explodeAvatar = explode('.' , $avatarName);
            $avatarExtension = strtolower(end($explodeAvatar));

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
            if(empty($pass)){
                $formErrors[] = 'Password cant be <strong>empty.</strong>';
            }
            if(empty($full_name)){
                $formErrors[] = 'Full Name cant be <strong>empty.</strong>';
            }
            if(empty($email)){
                $formErrors[] = 'Email cant be <strong>empty.</strong>';
            }
            if(!empty($avatarName)  && !in_array($avatarExtension ,$avatarAllowedExtension)){
                $formErrors[] = 'This extension of image is not <strong>allowed.</strong>';
            }
            if(empty($avatarName)){
                $formErrors[] = 'Avatar is <strong>required.</strong>';
            }
            if($avatarSize > 4194304){      // 4 MB * 1024 * 1024 = 4194340 bytes 
                $formErrors[] = 'Avatar can\'t be larger than <strong> 4MB</strong>';
            }
            // loop into errors array and echo it 
            foreach($formErrors as $error){
                echo  '<div class="alert alert-danger" role="alert">' . $error . '</div>';
            }

            // check if there no error proceed the update operation
                if(empty($formErrors)){
                    $avatar = rand(0,1000000) . '_' . $avatarName;
                    move_uploaded_file($avatarTmp , 'uploads\avatars\\' . $avatar);

                    // check if user exist to database
                    $check = checkItem("Username", "users", $user);
                    if($check == 1) {
                        $theMsg = '<div class="alert alert-danger" role="alert"> Sorry , This user is <strong>exist</strong></div>';
                        redirectHome($theMsg , 'back');
                    } else {
                        // Insert user info in database
                        $stmt = $con->prepare("INSERT INTO users(Username , `Password` , Email , FullName ,RegStatus , `Date` , Avatar) VALUES(:zuser , :zpass , :zmail , :zname , 1 , now() , :zavatar) ");
                        $stmt->execute(array(
                            'zuser' => $user,
                            'zpass' => $hashPass,
                            'zmail' => $email,
                            'zname' => $full_name,
                            'zavatar' => $avatar
                        ));
    
                        // echo success message 
                        $theMsg = "<div class='alert alert-success' role='alert'>" . $stmt->rowCount() . ' Record Inserted</div>';
						redirectHome($theMsg, 'back');
                    }
                }

        } else {
            $theMsg = "<div class='alert alert-danger' role='alert'>Sorry you cant browse this page directly</div>";
            redirectHome($theMsg);
        }
        echo "</div>";

    } elseif ($do == 'Edit') {  // Edit page 
        $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']): 0;
        // check if user exist in database
        $stmt = $con->prepare("SELECT * FROM users WHERE UserID = ? LIMIT 1");
        $stmt->execute(array($userid));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
        if($count > 0) { ?>
            <h2 class="text-center">Edit Member</h2>
            <div class="container">
                    <form action="?do=Update" method="POST">
                        <input type="hidden" name="userid" value="<?php echo $userid ?>">
                        <!-- start username field -->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label d-flex justify-content-sm-end" for="username">Username</label>
                            <div class="col-sm-10 col-md-6">
                                <input id="username" type="text" name="username" class="form-control" value="<?php echo $row['Username'] ?>" autocomplete="off" required aria-required="true">
                            </div>
                        </div>
                        <!-- End username field -->
                        <!-- start password field -->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Password</label>
                            <div class="col-sm-10 col-md-6">
                                <input type="hidden" name="oldpassword" value="<?php echo $row['Password'] ?>">
                                <input type="password" name="newpassword" class="form-control" autocomplete="new-password" placeholder="Leave Blank If You Don't Want To Change" aria-label="Leave Blank If You Don't Want To Change">
                            </div>
                        </div>
                        <!-- end password field -->
                        <!-- start Email field -->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label d-flex justify-content-sm-end" for="email">Email</label>
                            <div class="col-sm-10 col-md-6">
                                <input id="email" type="email" name="email" class="form-control" autocomplete="email" value="<?php echo $row['Email'] ?>" required aria-required="true">
                            </div>
                        </div>
                        <!-- end Email field -->
                        <!-- start fullname field -->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label d-flex justify-content-sm-end" for="Fullname">Full Name</label>
                            <div class="col-sm-10 col-md-6">
                                <input id="Fullname" type="text" name="full" class="form-control"  value="<?php echo $row['FullName'] ?>" required aria-required="true">
                            </div>
                        </div>
                        <!-- end fullname field -->
                        <!-- start submit -->
                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                                <input type="submit" value="save" class="btn btn-primary btn-sm" role="button">
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
            $full_name  = $_POST['full'];

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

                    $stmt2 = $con->prepare("SELECT 
                                                * 
                                            FROM 
                                                users 
                                            WHERE 
                                                Username = ? 
                                            AND 
                                                UserID != ?");
                    $stmt2->execute(array($user,$id));
                    $count = $stmt2->rowcount();
                    if($count == 1){
                        $theMsg = "<div class='alert alert-danger' role='alert'>Sorry this user is exist</div>";
                        redirectHome($theMsg, 'back');
                    } else {
                        // Update the database with this info
                        $stmt = $con->prepare("UPDATE users SET Username = ? , Email = ? , FullName = ? , Password = ? WHERE UserID = ?");
                        $stmt->execute(array($user , $email , $full_name ,$pass , $id ));
            
                        // echo success message 
                        $theMsg = "<div class='alert alert-success' role='alert'>" . $stmt->rowCount() . ' Record Updated</div>';
                        redirectHome($theMsg, 'back');
                    }
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
            // select all data depend on this ID 
            $check = checkItem("userid", "users", $userid);
            if($check > 0) {
                $stmt = $con->prepare("UPDATE users SET RegStatus = 1 WHERE UserID = ?");
                $stmt->execute(array($userid));
                $theMsg = "<div class='alert alert-success' role='alert'>" . $stmt->rowCount() . ' Record Activated</div>';
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
