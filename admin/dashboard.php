<?php
    session_start();
    if(isset($_SESSION['Username'])){
        $pageTitle = 'Dashboard';
        include 'init.php';

        // start dashbord
        $latestNumUsers = 5;  // number of latest users
        $theLatestUsers = getLatest('*' , 'users' , 'UserID' , $latestNumUsers); // latest user array
        $latestNumItems = 5;  // number of latest items
        $theLatestItems = getLatest('*' , 'items' , 'Item_ID' , $latestNumItems); // latest item array
        ?>
        
        <section class="container home-stats text-center">
            <h2>Dashbord</h2>
            <div class="row">
                <div class="col-md-3">
                    <div class="stat stat-member d-flex flex-row justify-content-around">
                        <div>
                            Total Members 
                            <span><a href="members.php"><?php echo countItems('UserID', 'users') ?></a></span>
                        </div>
                        <div><i class="fas fa-users fa-5x"></i></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat stat-pending d-flex flex-row justify-content-around">
                        <div>
                            Pending Members 
                            <span><a href="members.php?do=Manage&page=Pending"><?php echo checkItem('RegStatus', 'users', 0) ?></a></span>
                        </div>
                        <div><i class="fas fa-user-clock fa-5x"></i></i></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat stat-items d-flex flex-row justify-content-around">
                        <div>
                            Total Items 
                            <span><a href="Items.php"><?php echo countItems('Item_ID', 'items') ?></a></span>
                        </div>
                        <div><i class="fas fa-tags fa-5x"></i></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat stat-comments d-flex flex-row justify-content-around">
                        <div>
                            Total Comments 
                            <span><a href="#">3001</a></span>
                        </div>
                        <div><i class="fas fa-comments fa-5x"></i></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="container latest">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-users"></i> Latest <?php echo $latestNumUsers ?> Registered Users 
                            <span class="float-right toggle-info">
                                <i class="fa fa-plus"></i>
                            </span>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled latest-users">
                                <?php 
                                    foreach($theLatestUsers as $user){
                                        echo '<li>';
                                            echo $user['Username'];
                                            echo '<a href="members.php?do=Edit&userid=' . $user['UserID'] . '">';
                                                echo '<span class="btn btn-success float-right">';
                                                    echo '<i class="fa fa-edit"></i> Edit';
                                                    if($user['RegStatus'] == 0){
                                                        echo '<a href="members.php?do=Activate&userid=' . $user['UserID'] . '" class="btn btn-info activate float-right"><i class="fas fa-user-check"></i> Activate</a>';
                                                    }
                                                echo '</span>';
                                            echo '</a>';
                                        echo '</li>';
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-tag"></i> Latest Items
                            <span class="float-right toggle-info">
                                <i class="fa fa-plus"></i>
                            </span>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled latest-users">
                                <?php 
                                    foreach($theLatestItems as $item){
                                        echo '<li>';
                                            echo $item['Name'];
                                            echo '<a href="Items.php?do=Edit&itemid=' . $item['Item_ID'] . '">';
                                                echo '<span class="btn btn-success float-right">';
                                                    echo '<i class="fa fa-edit"></i> Edit';
                                                    if($item['Approve'] == 0){
                                                        echo '<a href="Items.php?do=Approve&itemid=' . $item['Item_ID'] . '" class="btn btn-info approve float-right"><i class="fas fa-check"></i> Approve</a>';
                                                    }
                                                echo '</span>';
                                            echo '</a>';
                                        echo '</li>';
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- start latest comment -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-comments"></i> Latest Comments 
                            <span class="float-right toggle-info">
                                <i class="fa fa-plus"></i>
                            </span>
                        </div>
                        <div class="card-body">
                            <?php 
                                // select all users except Admin
                                $stmt = $con->prepare("SELECT 
                                                            comments.* , users.Username 
                                                        FROM 
                                                            comments 
                                                        INNER JOIN
                                                            users
                                                        ON
                                                            users.UserID = comments.user_id");
                                $stmt->execute();
                                $comments = $stmt->fetchAll();

                                foreach($comments as $comment) {
                                    echo '<div class="comment-box d-flex">';
                                        echo '<span class="user-n">' . $comment['Username'] . '</span>';
                                        echo '<p class="user-c">' . $comment['comment'] . '</p>';
                                    echo '</div>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End latest comment -->
        </section>

        <?php 

        include $tpl . 'footer.php';
    } else {
        header('location:index.php');
        exit();
    }