<?php 
    include 'init.php';
    include $tpl . 'header.php';
    include $lang . 'english.php';

    // check if user coming form HTTP Post Request
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['user'];
        $password = $_POST['pass'];
        $hashedPass = sha1($password);          // password encryption
        echo $username . ' ' . $hashedPass;
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