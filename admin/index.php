<?php
    session_start();
    $noNavbar = '';
    $pageTitle = 'Login';
    if(isset($_SESSION['Username'])){
        header('location:dashboard.php');       // Redirect To Dashboard Page
    }
    include 'init.php';

    // check if user coming form HTTP Post Request
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['user'];
        $password = $_POST['pass'];
        $hashedPass = sha1($password);          // password encryption
        
        // check if user exist in database
        $stmt = $con->prepare("SELECT UserID , Username , Password FROM users WHERE Username = ? AND Password = ? AND GroupID = 1 LIMIT 1");
        $stmt->execute(array($username ,$hashedPass));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();

        // if count > 0 this mean the database contains a record about this username
        if($count > 0) {
            $_SESSION['Username'] = $username;      // Register seesion name
            $_SESSION['ID'] = $row['UserID'];      // Register seesion ID
            header('location:dashboard.php');       // Redirect To Dashboard Page
            exit();
        }
    }
?>
<div class="parent">
    <form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <h3 class="heading-login"><?php echo lang('Admin_Login') ?></h3>
        <div class="custom-input">
            <input class="form-control" type="text" name="user" autocomplete="off">
            <label>Username</label>
        </div>
        <div class="custom-input">
            <input class="form-control" type="password" name="pass" autocomplete="new-password">
            <label>Password</label>
        </div>
        <input class="btn btn-primary btn-block" type="submit" value="Login" />
        <div class="help text-center mt-2">
            <a href="#">Need help?</a>
        </div>
    </form>
</div>

<div class="divider"></div>
<div class="copyright text-center">
    <span>© 2021, Ahmed Hamouda , All rights reserved.</span>
</div>

<?php include $tpl . 'footer.php';?>