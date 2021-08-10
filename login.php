<?php include 'init.php'; ?>
<div class="container login-page">
    <h2 class="text-center"><span class="login">login</span> | <span class="signup">Signup</span></h2>
    <form class="login">
        <div class="custom-input">
            <input class="form-control" type="text" name="username" autocomplete="off">
            <label>Type your username</label>
        </div>
        <div class="custom-input">
            <input class="form-control" type="password" name="password" autocomplete="new-password">
            <label>Type your password</label>
        </div>
        <input class="btn btn-primary btn-block" type="submit" name="submit" value="login">
    </form>
    <br>
    <form class="signup">
        <div class="custom-input">
            <input class="form-control" type="text" name="username" autocomplete="off">
            <label>Type your username</label>
        </div>
        <div class="custom-input">
            <input class="form-control" type="password" name="password" autocomplete="new-password">
            <label>Type a complex password</label>
        </div>
        <div class="custom-input">
            <input class="form-control" type="password" name="password2" autocomplete="new-password">
            <label>Type a password again</label>
        </div>
        <div class="custom-input">
            <input class="form-control" type="email" name="email">
            <label>Type valid email</label>
        </div>
        <input class="btn btn-success btn-block" type="submit" name="submit" value="Signup">
    </form>
</div>

<?php include $tpl . 'footer.php'; ?>