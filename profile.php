<?php
    session_start();
    $pageTitle = 'Profile';
    include 'init.php';
    if(isset($_SESSION['user'])) {
        $getUser = $con->prepare("SELECT * FROM users WHERE Username = ?"); 
        $getUser->execute(array($sessionUser));
        $info = $getUser->fetch();
        echo  $info['Username'] . $info['Password'];
?>
    <h2 class="text-center">My Profile</h2>
    <div class="information block">
        <div class="container">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    My Information
                </div>
                <div class="card-body">
                    Name : Ahmed
                </div>
            </div>
        </div>
    </div>
    <div class="my-ads block">
        <div class="container">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    My-Ads
                </div>
                <div class="card-body">
                    Test Ads
                </div>
            </div>
        </div>
    </div>
    <div class="my-comments block">
        <div class="container">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Latest Comments
                </div>
                <div class="card-body">
                    Test Comments
                </div>
            </div>
        </div>
    </div>

<?php 
    } else {
        header('location:login.php');
        exit();
    }
    include $tpl . 'footer.php';
?>