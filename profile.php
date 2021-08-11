<?php
    session_start();
    $pageTitle = 'Profile';
    include 'init.php';
    if(isset($_SESSION['user'])) {
        $getUser = $con->prepare("SELECT * FROM users WHERE Username = ?"); 
        $getUser->execute(array($sessionUser));
        $info = $getUser->fetch();
?>
    <h2 class="text-center">My Profile</h2>
    <div class="information block">
        <div class="container">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    My Information
                </div>
                <div class="card-body">
                    Name : <?php echo $info['Username'] ?> <br>
                    Email : <?php echo $info['Email'] ?> <br>
                    Full Name : <?php echo $info['FullName'] ?> <br>
                    Registered Date : <?php echo $info['Date'] ?> <br>
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