<nav class="navbar navbar-expand-lg navbar-dark bg-dark" role="navigation">
    <div class="container">
        <a class="navbar-brand active" href="dashboard.php"><?php echo lang('HOME_ADMIN') ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="categories.php" role="button"><?php echo lang('CATEGORIES') ?></a></li>
                <li class="nav-item"><a class="nav-link" href="Items.php" role="button"><?php echo lang('ITEMS') ?></a></li>
                <li class="nav-item"><a class="nav-link" href="members.php" role="button"><?php echo lang('MEMBERS') ?></a></li>
                <li class="nav-item"><a class="nav-link" href="comments.php" role="button"><?php echo lang('COMMENTS') ?></a></li>
            </ul>
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo lang('DROPDOWN_Name') ?></a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="../index.php" target="_blank" role="button"><i class="fas fa-shopping-cart fa-fw" aria-hidden="true"></i> <?php echo lang('Visit_Shop') ?></a>
                    <a class="dropdown-item" href="members.php?do=Edit&userid=<?php echo $_SESSION['ID'] ?>" role="button"><i class="fas fa-user fa-fw" aria-hidden="true"></i> <?php echo lang('EDIT_PROFILE') ?></a>
                    <a class="dropdown-item" href="#" role="button"><i class="fas fa-cog fa-fw" aria-hidden="true"></i> <?php echo lang('SETTINGS') ?></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php" role="button"><i class="fas fa-sign-out-alt fa-fw" aria-hidden="true"></i> <?php echo lang('LOGOUT') ?></a>
                </div>
            </div>
        </div>
    </div>
</nav>