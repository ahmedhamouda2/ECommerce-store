<?php
    session_start();
    $noNavbar = '';
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
        $stmt = $con->prepare("SELECT Username , Password FROM users WHERE Username = ? AND Password = ? AND GroupID = 1");
        $stmt->execute(array($username ,$hashedPass));
        $count = $stmt->rowCount();
        // echo $count;

        // if count > 0 this mean the database contains a record about this username
        if($count > 0) {
            $_SESSION['Username'] = $username;      // Register seesion name
            header('location:dashboard.php');       // Redirect To Dashboard Page
            exit();
        }
    }
?>

<form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
    <h4 class="text-center">Admin Login</h4>
    <div class="custom-input">
        <input class="form-control" type="text" name="user" autocomplete="off">
        <label>Username</label>
    </div>
    <div class="custom-input">
        <input class="form-control" type="password" name="pass" autocomplete="new-password">
        <label>Password</label>
    </div>
    <input class="btn btn-primary btn-block" type="submit" value="Login" />
</form>

<?php include $tpl . 'footer.php';?>