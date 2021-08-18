<?php
    session_start();
    $pageTitle = 'Profile';
    include 'init.php';
    if(isset($_SESSION['user'])) {
        $getUser = $con->prepare("SELECT * FROM users WHERE Username = ?"); 
        $getUser->execute(array($sessionUser));
        $info = $getUser->fetch();
        $userid =$info['UserID'];
?>
    <h2 class="text-center">My Profile</h2>
    <div class="information block">
        <div class="container">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    My Information
                </div>
                <div class="card-body">
                    <div class="avatar">
                        <?php                                 
                        if(empty($info['Avatar'])){
                            echo '<img class="special-avatar" src="admin/uploads/avatars/default.png" alt = "Default image">';
                        } else {
                            echo '<img class="special-avatar" src="admin/uploads/avatars/' . $info['Avatar'] . '" alt = "avatar image">';
                        }
                        ?>
                    </div>
                    <div class="edit-profile mt-3 mb-3">
                        <a href="#">Edit Profile</a>
                    </div>
                    <div>
                        <h4 class="mb-0"><?php echo $info['Username'] ?></h4>
                        <p>@ <?php echo $info['FullName'] ?></p>
                        <p>email : <?php echo $info['Email'] ?></p>
                    </div>
                    <div class="date-join">
                        <i class="fas fa-clock fa-fw "></i>
                        <span>Joined <?php echo $info['Date'] ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="my-ads" class="my-ads block">
        <div class="container">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    My-Items
                </div>
                <div class="card-body">
                    <?php
                    $myItems = getAllFrom("*", "items" ,"WHERE Member_ID = $userid" , "" ,  "Item_ID", "DESC");
                    if(!empty($myItems)){
                        echo '<div class="row">';
                        foreach($myItems as $item){
                            echo '<div class="col-sm-6 col-md-4 col-lg-3">';
                                echo '<div class="card mt-3">';
                                    if($item['Approve'] == 0) {echo '<span class="approve-msg">Awaiting Approval</span>';}
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
                    $myComments = getAllFrom("comment", "comments" ,"WHERE user_id = $userid" , "" ,  "c_id", "DESC");
                    if(!empty($myComments)){
                        foreach($myComments as $comment){
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