<?php
    session_start();
    if(isset($_SESSION['Username'])){
        $pageTitle = 'Dashboard';
        include 'init.php';

        // start dashbord
        $latestUser = 5;  // number of latest users
        $theLatest = getLatest('*' , 'users' , 'UserID' , $latestUser); // latest user array
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
                        <div><i class="fas fa-user fa-5x"></i></div>
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
                        <div><i class="fas fa-file-alt fa-5x"></i></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat stat-comments d-flex flex-row justify-content-around">
                        <div>
                            Total Comments 
                            <span><a href="#">3001</a></span>
                        </div>
                        <div><i class="fas fa-comment fa-5x"></i></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="container latest">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-users"></i> Latest <?php echo $latestUser ?> Registered Users
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled latest-users">
                                <?php 
                                    foreach($theLatest as $user){
                                        echo '<li>';
                                            echo $user['Username'];
                                            echo '<a href="members.php?do=Edit&userid=' . $user['UserID'] . '">';
                                                echo '<span class="btn btn-success float-right">';
                                                    echo '<i class="fa fa-edit"></i> Edit';
                                                    if($user['RegStatus'] == 0){
                                                        echo '<a href="members.php?do=Activate&userid=' . $user['UserID'] . '" class="btn btn-info activate float-right"><i class="fas fa-times"></i> Activate</a>';
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
                        </div>
                        <div class="card-body">
                            Test
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php 

        include $tpl . 'footer.php';
    } else {
        header('location:index.php');
        exit();
    }