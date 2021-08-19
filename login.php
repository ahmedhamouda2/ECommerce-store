<?php
    session_start();
    $pageTitle = 'Login';
    if(isset($_SESSION['user'])){
        header('location:index.php');
    }
    include 'init.php';

    // check if user coming form HTTP Post Request
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['login'])) {
            $user = $_POST['username'];
            $pass = $_POST['password'];
            $hashedPass = sha1($pass);          // password encryption
            
            // check if user exist in database
            $stmt = $con->prepare("SELECT UserID , Username , `Password` FROM users WHERE Username = ? AND `Password` = ?");
            $stmt->execute(array($user ,$hashedPass));
            $get = $stmt->fetch();
            $count = $stmt->rowCount();
    
            // if count > 0 this mean the database contains a record about this username
            if($count > 0) {
                $_SESSION['user'] = $user;              // Register session name
                $_SESSION['uid'] = $get['UserID'];      // Register session user id
                header('location:index.php');           // Redirect To index Page
                exit();
            }
        } else {
            $formErrors = array();
            $username   = $_POST['username'];
            $password   = $_POST['password'];
            $password2  = $_POST['password2'];
            $email      = $_POST['email'];
            if(isset($username)) {
                $filterUser = filter_var($username , FILTER_SANITIZE_STRING);
                if(strlen($filterUser) < 4) {
                    $formErrors[] = 'Username must be larger than <strong>4</strong> characters';
                }
            }
            if(isset($password) && isset($password2)) {
                if(empty($password)){
                    $formErrors[] = 'Sorry Password can\'t be Empty';
                }
                if(sha1($password) !== sha1($password2)){
                    $formErrors[] = 'Sorry Password is not match';
                }
            }
            if(isset($email )) {
                $filterEmail = filter_var($email  , FILTER_SANITIZE_EMAIL);
                if(filter_var($filterEmail , FILTER_SANITIZE_EMAIL ) != true) {
                    $formErrors[] = 'This Email not valid';
                }
            }
            // check if there no error proceed the user add
            if(empty($formErrors)){
                // check if user exist to database
                $check = checkItem("Username", "users", $username);
                if($check == 1) {
                    $formErrors[] = 'Sorry this User is Exists';
                } else {
                    // Insert user info in database
                    $stmt = $con->prepare("INSERT INTO 
                                                users(Username , `Password` , Email  ,RegStatus , `Date`)
                                            VALUES(:zuser , :zpass , :zmail , 0 , now())");
                    $stmt->execute(array(
                        'zuser' => $username,
                        'zpass' => sha1($password),
                        'zmail' => $email
                    ));

                    // echo success message
                    $successMsg = 'Congrats You are now registered user';
                }
            }
        }
    }
?>
<div class="container login-page">
    <h2 class="text-center"><span class="selected" data-class="login">Login</span> | <span data-class="signup">Signup</span></h2>
    <!-- start login form -->
    <form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class="custom-input">
            <input class="form-control" type="text" name="username" autocomplete="off" required>
            <label>Type your username</label>
        </div>
        <div class="custom-input">
            <input class="form-control" type="password" name="password" autocomplete="new-password" required>
            <label>Type your password</label>
        </div>
        <input class="btn btn-primary btn-block" type="submit" name="login" value="login">
        <div class="divider"></div>
        <div class="copyright text-center">
            <span>© 2021, Ahmed Hamouda , All rights reserved.</span>
        </div>
    </form>
    <!-- End login form -->
    <br>
    <!-- start signup form -->
    <form class="signup" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class="custom-input">
            <input class="form-control" type="text" name="username" autocomplete="off" required pattern=".{4,}" title="Username must be 4 chars or more">
            <label>Type your username</label>
        </div>
        <div class="custom-input">
            <input class="form-control" type="password" name="password" autocomplete="new-password" required minlength="4">
            <label>Type a complex password</label>
        </div>
        <div class="custom-input">
            <input class="form-control" type="password" name="password2" autocomplete="new-password" required minlength="4">
            <label>Type a password again</label>
        </div>
        <div class="custom-input">
            <input class="form-control" type="email" name="email" required>
            <label>Type valid email</label>
        </div>
        <input class="btn btn-success btn-block" type="submit" name="Signup" value="Signup">
        <div class="divider"></div>
        <div class="copyright text-center">
            <span>© 2021, Ahmed Hamouda , All rights reserved.</span>
        </div>
    </form>
    <!-- end signup form -->
    <div class="the-messages text-center">
        <?php
            if(!empty($formErrors)){
                foreach($formErrors as $error){
                    echo '<div class="alert alert-danger">' . $error . '</div>';
                }
            }
            if(isset($successMsg)){
                echo '<div class="alert alert-success">' . $successMsg . '</div>';
            }
        ?>
    </div>
</div>

<?php include $tpl . 'footer.php'; ?>
