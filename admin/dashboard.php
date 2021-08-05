<?php
    session_start();
    if(isset($_SESSION['Username'])){
        $pageTitle = 'Dashboard';
        include 'init.php';

        // start dashbord 
        echo '<pre>';
        print_r(getLatest('*' , 'users' , 'UserID' , 5));
        echo '</pre>';
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
                            <span><a href="#">1500</a></span>
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
                            <i class="fa fa-users"></i> Latest Registered Users
                        </div>
                        <div class="card-body">
                            Test
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