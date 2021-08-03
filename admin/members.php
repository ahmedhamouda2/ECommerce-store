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
    if ($do == 'Manage') {
        // manage page
        echo 'welcome to Manage page';
        echo '<a href="members.php?do=Add"> Add New Mebmer</a>';
    } elseif ($do == 'Add') { 
        // add members page
        ?>
            <h2 class="text-center">Add New Member</h2>
            <div class="container">
                    <form action="?do=Insert" method="POST">
                        <!-- start username field -->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Username</label>
                            <div class="col-sm-10 col-md-6">
                                <input type="username" name="username" class="form-control" autocomplete="off" required  placeholder="Username to login into Shop">
                            </div>
                        </div>
                        <!-- End username field -->
                        <!-- start password field -->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Password</label>
                            <div class="col-sm-10 col-md-6">
                                <input type="password" name="password" class="password form-control" autocomplete="new-password" required placeholder="Password must be Hard & Complex">
                                <i class="show-pass fas fa-eye fa-2x"></i>
                            </div>
                        </div>
                        <!-- end password field -->
                        <!-- start Email field -->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Email</label>
                            <div class="col-sm-10 col-md-6">
                                <input type="email" name="email" class="form-control" required  placeholder="Email must be valid">
                            </div>
                        </div>
                        <!-- end Email field -->
                        <!-- start fullname field -->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Full Name</label>
                            <div class="col-sm-10 col-md-6">
                                <input type="text" name="full" class="form-control" required  placeholder="Full name Appear in your profile page">
                            </div>
                        </div>
                        <!-- end fullname field -->
                        <!-- start submit -->
                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                                <input type="submit" value="Add Member" class="btn btn-primary btn-lg">
                            </div>
                        </div>
                        <!-- end submit -->
                    </form>
                </form>
            </div>

    <?php
    } elseif ($do == 'Insert') {  // Insert member page
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            echo "<h2 class='text-center'>Update Member</h2>";
            echo "<div class='container'>";

            // get variables from the Form [names in form]
            $user       = $_POST['username'];
            $pass       = $_POST['password'];
            $email      = $_POST['email'];
            $full_name = $_POST['full'];

            $hashPass = sha1($_POST['password']);

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
            // loop into errors array and echo it 
            foreach($formErrors as $error){
                echo  '<div class="alert alert-danger" role="alert">' . $error . '</div>';
            }

            // check if there no error proceed the update operation
                if(empty($formErrors)){
                    // Insert user info in database
                    
                    // echo success message 
                    echo '<div class="alert alert-success" role="alert">' . $stmt->rowCount() . ' Record Inserted</div>';
                }

        } else {
            echo 'Sorry you cant browse this page directly';
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
                            <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Username</label>
                            <div class="col-sm-10 col-md-6">
                                <input type="username" name="username" class="form-control" value="<?php echo $row['Username'] ?>" autocomplete="off" required>
                            </div>
                        </div>
                        <!-- End username field -->
                        <!-- start password field -->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Password</label>
                            <div class="col-sm-10 col-md-6">
                                <input type="hidden" name="oldpassword" value="<?php echo $row['Password'] ?>">
                                <input type="password" name="newpassword" class="form-control" autocomplete="new-password" placeholder="Leave Blank If You Don't Want To Change">
                            </div>
                        </div>
                        <!-- end password field -->
                        <!-- start Email field -->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Email</label>
                            <div class="col-sm-10 col-md-6">
                                <input type="email" name="email" class="form-control" value="<?php echo $row['Email'] ?>" required>
                            </div>
                        </div>
                        <!-- end Email field -->
                        <!-- start fullname field -->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Full Name</label>
                            <div class="col-sm-10 col-md-6">
                                <input type="text" name="full" class="form-control"  value="<?php echo $row['FullName'] ?>" required>
                            </div>
                        </div>
                        <!-- end fullname field -->
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
            echo 'There\'s No such ID';
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
                    echo '<div class="alert alert-success" role="alert">' . $stmt->rowCount() . ' Record Updated</div>';
                }

        } else {
            echo 'Sorry you cant browse this page directly';
        }
        echo "</div>";
    } 
    include $tpl . 'footer.php';
} else {
    header('location:index.php');
    exit();
}
