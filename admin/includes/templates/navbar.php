<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand active" href="#"><?php echo lang('HOME_ADMIN') ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="#"><?php echo lang('CATEGORIES') ?></a></li>
                <li class="nav-item"><a class="nav-link" href="#"><?php echo lang('ITEMS') ?></a></li>
                <li class="nav-item"><a class="nav-link" href="#"><?php echo lang('MEMBERS') ?></a></li>
                <li class="nav-item"><a class="nav-link" href="#"><?php echo lang('STATISTICS') ?></a></li>
                <li class="nav-item"><a class="nav-link" href="#"><?php echo lang('LOGS') ?></a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo lang('DROPDOWN_Name') ?></a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#"><?php echo lang('EDIT_PROFILE') ?></a>
                        <a class="dropdown-item" href="#"><?php echo lang('SETTINGS') ?></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php"><?php echo lang('LOGOUT') ?></a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>