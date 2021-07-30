<?php 
    include 'init.php';
    include $tpl . 'header.php';
    include $lang . 'english.php';
?>

<form class="login">
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