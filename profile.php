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
                    <ul class="list-unstyled">
                        <li>
                            <i class="fas fa-unlock-alt"></i>
                            <span>Login Name</span> : <?php echo $info['Username'] ?>
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <span>Email</span> : <?php echo $info['Email'] ?>
                        </li>
                        <li>
                            <i class="fas fa-user"></i>
                            <span>Full Name</span> : <?php echo $info['FullName'] ?>
                        </li>
                        <li>
                            <i class="fas fa-calendar-day"></i>
                            <span>Registered Date</span> : <?php echo $info['Date'] ?>
                        </li>
                    </ul>
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
                    <?php
                    if(!empty(getitems('Member_ID' , $info['UserID']))){
                        echo '<div class="row">';
                        foreach(getitems('Member_ID' , $info['UserID']) as $item){
                            echo '<div class="col-sm-6 col-md-4 col-lg-3">';
                                echo '<div class="card">';
                                    echo '<span class="price">$' . $item['Price'] . '</span>'; 
                                    echo '<img class="card-img-top img-fluid img-thumbnail" src="https://picsum.photos/250" alt="Card image">';
                                    echo '<div class="card-body border-0">';
                                        echo '<h4 class="card-title"><a href="items.php?itemid=' . $item['Item_ID'] . '">' . $item['Name'] . '</a></h4>';
                                        echo '<p class="card-text">' . $item['Description'] . '</p>';
                                        echo '<div class="date text-right">' . $item['Add_Date'] . '</div>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        }
                        echo '</div>';
                    } else {
                        echo 'There\'s no Ads to show , Create <a href="newads.php">New ads</a>';
                    }
                    ?>
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
                    <?php
                    $stmt = $con->prepare("SELECT comment FROM comments WHERE user_id = ?");
                    $stmt->execute(array($info['UserID']));

                    // assign to varible
                    $comments = $stmt->fetchAll();
                    if(!empty($comments)){
                        foreach($comments as $comment){
                            echo '<p>' . $comment['comment'] . '</p>';
                        }
                    } else {
                        echo 'There\'s no comments to show';
                    }
                    ?>
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