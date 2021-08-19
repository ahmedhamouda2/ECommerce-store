<!DOCTYPE html>
<html dir="<?php echo lang('DIRECTION'); ?>">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo getTitle(); ?></title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="<?php echo $css?>jquery-ui.min.css">
        <link rel="stylesheet" href="<?php echo $css?>jquery.selectBoxIt.css">
        <link rel="stylesheet" href="<?php echo $css?>frontend.css">
    </head>
    <body>
        <div class="upper-bar">
            <div class="container text-right">
                <?php
                    if(isset($_SESSION['user'])){ ?>
                    <?php        
                        $getUser = $con->prepare("SELECT * FROM users WHERE Username = ?"); 
                        $getUser->execute(array($sessionUser));
                        $info = $getUser->fetch();
                        $userAvatar = $info['Avatar'];
                    ?>
                        <div class="btn-group my-info">
                            <?php
                                if(empty($userAvatar)){
                                    echo '<img class="rounded-circle" src="admin/uploads/avatars/default.png" alt = "Default image">';
                                } else {
                                    echo '<img class="rounded-circle" src="admin/uploads/avatars/' . $userAvatar . '" alt = "avatar image">';
                                }
                            ?>
                            <span class="btn btn-outline-dark dropdown-toggle" data-toggle="dropdown"> <?php echo $sessionUser?> </span>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user fa-fw"></i><?php echo lang('Profile'); ?></a></li>
                                <li><a class="dropdown-item" href="newads.php"><i class="fas fa-plus-square fa-fw"></i><?php echo lang('New_Item'); ?></a></li>
                                <li><a class="dropdown-item" href="profile.php#my-ads"><i class="fas fa-tags fa-fw"></i><?php echo lang('My_Items'); ?></a></li>
                                <li><a class="dropdown-item special-dropdown" href="logout.php"><i class="fas fa-sign-out-alt fa-fw"></i><?php echo lang('LOGOUT'); ?></a></li>
                            </ul>
                        </div>
                <?php
                    } else {
                ?>
                <a href="login.php">
                    <div class="text-right button-login">Login/Singup</div>
                </a>
                <?php } ?>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand active" href="index.php"><?php echo lang('HomePage'); ?></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <?php
                            $allCats = getAllFrom("*","categories","WHERE parent = 0" , "" , "ID" , "ASC");
                            foreach($allCats as $cat) {
                                echo '<li class="nav-item"><a class="nav-link" href="categories.php?pageid=' . $cat['ID'] . '">' . lang($cat['Name']) . '</a></li>';
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
