<?php
    session_start();
    $pageTitle = 'Login';
    if(isset($_SESSION['user'])){
        header('location:index.php');
    }
    include 'init.php';

    // check if user coming form HTTP Post Request
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $hashedPass = sha1($pass);          // password encryption
        
        // check if user exist in database
        $stmt = $con->prepare("SELECT Username , `Password` FROM users WHERE Username = ? AND `Password` = ?");
        $stmt->execute(array($user ,$hashedPass));
        $count = $stmt->rowCount();

        // if count > 0 this mean the database contains a record about this username
        if($count > 0) {
            $_SESSION['user'] = $user;      // Register seesion name
            header('location:index.php');       // Redirect To index Page
            exit();
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
        <input class="btn btn-primary btn-block" type="submit" name="submit" value="login">
    </form>
    <!-- End login form -->
    <br>
    <!-- start signup form -->
    <form class="signup">
        <div class="custom-input">
            <input class="form-control" type="text" name="username" autocomplete="off" required>
            <label>Type your username</label>
        </div>
        <div class="custom-input">
            <input class="form-control" type="password" name="password" autocomplete="new-password" required>
            <label>Type a complex password</label>
        </div>
        <div class="custom-input">
            <input class="form-control" type="password" name="password2" autocomplete="new-password" required>
            <label>Type a password again</label>
        </div>
        <div class="custom-input">
            <input class="form-control" type="email" name="email" required>
            <label>Type valid email</label>
        </div>
        <input class="btn btn-success btn-block" type="submit" name="submit" value="Signup">
    </form>
    <!-- end signup form -->
</div>

<?php include $tpl . 'footer.php'; ?>