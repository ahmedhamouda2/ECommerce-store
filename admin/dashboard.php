<?php
    session_start();
    if(isset($_SESSION['Username'])){
        $pageTitle = 'Dashboard';
        include 'init.php';

        // start dashbord 
        ?>
        
        <section class="container home-stats text-center">
            <h2>Dashbord</h2>
            <div class="row">
                <div class="col-md-3">
                    <div class="stat">Total Members <span><?php echo countItems('UserID', 'users') ?></span></div>
                </div>
                <div class="col-md-3">
                    <div class="stat">Pindding Members <span>20</span></div>
                </div>
                <div class="col-md-3">
                    <div class="stat">Total Items <span>1500</span></div>
                </div>
                <div class="col-md-3">
                    <div class="stat">Total Comments <span>3001</span></div>
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