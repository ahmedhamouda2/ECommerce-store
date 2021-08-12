<?php
    session_start();
    $pageTitle = 'New Ads';
    include 'init.php';
    if(isset($_SESSION['user'])) {
        $getUser = $con->prepare("SELECT * FROM users WHERE Username = ?"); 
        $getUser->execute(array($sessionUser));
        $info = $getUser->fetch();
?>
    <h2 class="text-center">Create New Ads</h2>
    <div class="create-ad block">
        <div class="container">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Create New Ads
                </div>
                <div class="card-body">
                    Test
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