<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo getTitle(); ?></title>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="<?php echo $css?>jquery-ui.min.css">
        <link rel="stylesheet" href="<?php echo $css?>jquery.selectBoxIt.css">
        <link rel="stylesheet" href="<?php echo $css?>backend.css">
    </head>
    <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand active" href="dashboard.php"><?php echo lang('HOME_ADMIN') ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="categories.php"><?php echo lang('CATEGORIES') ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="Items.php"><?php echo lang('ITEMS') ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="members.php"><?php echo lang('MEMBERS') ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="comments.php"><?php echo lang('COMMENTS') ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><?php echo lang('STATISTICS') ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><?php echo lang('LOGS') ?></a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo lang('DROPDOWN_Name') ?></a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="members.php?do=Edit&userid=<?php echo $_SESSION['ID'] ?>"><?php echo lang('EDIT_PROFILE') ?></a>
                            <a class="dropdown-item" href="#"><?php echo lang('SETTINGS') ?></a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="logout.php"><?php echo lang('LOGOUT') ?></a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
