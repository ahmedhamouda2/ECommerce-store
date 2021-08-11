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
                    <div class="row">
                        <?php
                            foreach(getitems('Member_ID' , $info['UserID']) as $item){
                                echo '<div class="col-sm-6 col-md-4 col-lg-3">';
                                    echo '<div class="card">';
                                        echo '<img class="card-img-top img-fluid img-thumbnail" src="https://picsum.photos/250" alt="Card image">';
                                        echo '<div class="card-body border-0">';
                                            echo '<h4 class="card-title">' . $item['Name'] . '</h4>';
                                            echo '<p class="card-text">' . $item['Description'] . '</p>';
                                            echo '<div class="d-flex justify-content-around">';
                                                echo '<button type="button" class="btn btn-light">' . $item['Price'] . '</button>'; 
                                                echo '<a href="#" class="btn btn-primary">See More</a>';
                                            echo '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                            }
                        ?>
                    </div>
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